<?php

namespace Gdoox\Http\Controllers\backend\catalog\products;

use Gdoox\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Gdoox\Models\Categories;
use Gdoox\Models\Attributes;
use Gdoox\Models\AttributesAssoc;
use Gdoox\Models\AttributesType;
use Gdoox\Models\DropdownOptions;
use Gdoox\Models\CategoryAttribute;
use Gdoox\Models\Products;
use Gdoox\Models\Attribute;
use Gdoox\Models\EcomShops;
use Gdoox\Models\ProductHiddenAttributes;
use Gdoox\User;
use Gdoox\Models\ProductVariationAttributes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Gdoox\Models\NavigationMenu;
use Gdoox\Models\ProductVariationFields;
use Gdoox\Models\DropdownOption;
use DB;
use File;
use Form;
use Image;
use Input;
use UUID;

class ProductsController extends Controller
{
    use \Gdoox\Helpers\backend\dashboard\ImageUpload;
    use  \Gdoox\Helpers\backend\dashboard\HelperFunctions;    
    
    public function __construct() {
        $this->middleware('subuserpermission'); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(){
      try {
            $sites = Request::get('sub_user_sites');
            if(!empty($sites)){
                foreach ($sites as $slug){
                  $sites_[$slug] = $this->SiteName($slug);
                }
                $products[]= Products::whereIn('shopid', '=', $sites )->where('product_type', 'exists', false)->get();
            }
            else {
                $products[]= Products::where('userid', '=', Auth::user()->id )->where('product_type', 'exists', false)->get();
            }
        
            return view('backend.catalog.products.index', compact('products'));
        }
        catch (\Exception $e){
            $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage();
            return view('errors.custom_error')->withErrors($error);
        }
    }
    
     /*
     * site enable or disable
     */
    
    public function toggle($id){
      if(Auth::user()){
        try {
            
            $status = $this->changeProductVisibility($id);
           
            $route = Route::getCurrentRoute()->getName();
            
            if($status==='image_error'){
                return redirect()->back()->withErrors('You can not enable this product without product image. Please edit the product and add images.');
            }
            else if($status==='quantity_error'){
                return redirect()->back()->withErrors('You can not enable this product without quantity. Please add  quantity of product.');
            }
            elseif($status==='price_error'){
                return redirect()->back()->withErrors('You can not enable this product without price. Please add  Price of Product.');
            }
            else {
                if($route === 'ecosys.products.toggle'){
                    return Redirect::route('ecosys.product.index',['site_slug'=>$_GET['site_slug']])->with('message', "Product has been ".$_GET['status']);
                }
                elseif($route === 'network.products.toggle'){
                    return Redirect::route('comnetwork.product.index',['site_slug'=>$_GET['site_slug']])->with('message', "Product has been ".$_GET['status']);
                }
                else {
                    return Redirect::route('products/list')->with('message', "Product has been ".$_GET['status']);
                }
                
            }  
        }
        catch (\Exception $e){
            $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage();
            return view('errors.custom_error')->withErrors($error);
        }
      }
      else {
             return redirect('auth/login')->with('message',"You must be login!"); 
      }
    }
    
    public function toggleOnSite($id){
        if(Auth::user()){
        try {
            $status = $this->changeProductVisibility($id);
            
            if($status==='image_error'){
                return redirect()->back()->withErrors('You can not enable this product without product image. Please edit the product and add images.');
            }
            elseif($status==='quantity_error'){
                return redirect()->back()->withErrors('You can not enable this product without quantity. Please add  quantity of product.');
            }
            elseif($status==='price_error'){
                return redirect()->back()->withErrors('You can not enable this product without price. Please add  Price of Product.');
            }
            else {
                return redirect('site/'.$_GET["shopid"].'/show/'.$id)->with('message', "Product has been ".$_GET['status']);
            }  
        }
        catch (\Exception $e){
            $error = "An error occured. ".
                            "Line Number: ".$e->getLine()." ".
                            "File Name: ".$e->getFile()." ".
                            "Error Description: ".$e->getMessage();
            return view('errors.custom_error')->withErrors($error);
        }
      }
      else {
             return redirect('auth/login')->with('message',"You must be login!"); 
      }
    }

    public function changeProductVisibility($id){
        $product = Products::find($id);
        $status = '';
        if($_GET['status'] ==='enabled'){
            
            if($product->purpose === 'sell'){
                if(empty($product->thumb) && empty($product->product_images) && empty($product->product_data[47])){
                    $status = 'image_error';
                }
                else if(empty($product->product_data[8])){
                    $status = 'quantity_error';
                }
                else if(empty($product->product_data[16]) && empty($product->product_data[18])){
                     $status = 'price_error';
                }
                else {
                    DB::collection('products')->where('_id', $id)->update(['status'=>$_GET['status'], 'disable_edit'=>'Yes']);
                    $status = 'success';
                }
            }
            else {
                // Services / Procurement/ Products dont have Images.
                if(empty($product->product_data[8])){
                    $status = 'quantity_error';
                }
                else if(empty($product->product_data[16]) && empty($product->product_data[18])){
                     $status = 'price_error';
                }
                else {
                    DB::collection('products')->where('_id', $id)->update(['status'=>$_GET['status'], 'disable_edit'=>'Yes']);
                    $status = 'success';
                }
            }        
        }
        else {
            DB::collection('products')->where('_id', $id)->update(['status'=>$_GET['status']]);
            $status = 'success';
        }
        return $status;
    }
    /**
     * Show the form for adding a new product.
     *
     * @return Response
     */    
    public function add(Request $request){
//    if(Auth::user()){ echo strtoupper(Auth::user()->id);}   
      try {
            $input = Request::all();
            $classification = "";
            if(isset($input['classify'])){
                $classification = $input['classify'];
            }
            
            $rules = array(
                'prod_cats' => 'required',
                'prod_cats_name' => 'required',
                'userid'  => 'required'
            );
            
            $route = \Request::route()->getName();
            if($route==='products.add.buy'){
                $purpose = 'buy';
            }
            else {
                $purpose = 'sell';
            }
            
            $validator = Validator::make(Request::all(), $rules);
            if ($validator->fails()) {
                return Redirect::route($route)->withErrors($validator);                        
            } else {
                //Process Add Product request
                //Fetch Ancestors of aall the selected categories
                $catAnsForAttr = $this->fetchAncestorsForAll($input['prod_cats']);
                //Fetch Attr association/classifiction
                
                //Fetch Attributes 
                $attrForCats = $this->fetchAttributesIds($catAnsForAttr);
                sort($attrForCats);   
                $attrAssoc = $this->fetchAttributesAssoc();
                
//                echo "<pre>";
//                print_r($input['prod_cats']);
//                print_r($attrForCats);
//                print_r($attrAssoc);
//                exit;
                
                //Create Add Product form fields
                $productForm = $this->createProductForm($input['prod_cats'], $input['prod_cats_name'], $attrAssoc, $attrForCats, $input['userid'],"","",$purpose);
               
                return view('backend.catalog.products.add', compact('productForm','purpose','classification'));
            }
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
  }    

  /*
   * Edit product
   */
    public function edit($id){
      try {
        $flag = '';
        $product = Products::find($id);
        $purpose = $product->purpose;
        $userid = Auth::user()->id;

        if(!empty($product) ){
            $prod_cats = $product->cat_ids;    
            //Fetch Ancestors of aall the selected categories
            $catAnsForAttr = $this->fetchAncestorsForAll($prod_cats);
            //Fetch Attr association/classifiction
            $attrAssoc = $this->fetchAttributesAssoc();
            //Fetch Attributes 
            $attrForCats = $this->fetchAttributesIds($catAnsForAttr);
            sort($attrForCats);

            $prod_cats_name = array();
            foreach ($prod_cats as $prod_cat){
                  $prod_cats_name[] = $this->fetchCatAncestors($prod_cat);
            }
            
           //Create Add Product form fields
            $productForm = $this->createProductForm($prod_cats, $prod_cats_name, $attrAssoc, $attrForCats, $userid, $product,"",$purpose);

            return view('backend.catalog.products.add', compact('productForm','flag','purpose'));
        }
        else {
            return Redirect::route('products/list');
        }
      }
      catch (\Exception $e){
            $error = "An error occured. ".
                  "Line Number: ".$e->getLine()." ".
                  "File Name: ".$e->getFile()." ".
                  "Error Description: ".$e->getMessage();
            return view('errors.custom_error')->withErrors($error);
      }
    }    
    
    function createProductForm($prod_cats, $prod_cats_name, $attrAssoc, $attrForCats, $userid, $product='', $productaction='', $purpose){    
        $formFields = array();
        // Do not show these attributes if the Purpose is to Buy the Products.
        $attr_not_to_show = array(14, 44, 45, 46, 47, 48, 49);
        $type = '';
        
        // Hide Category on Product Edit.
        if(empty($product)){
            if($prod_cats_name){
                  $formFields[] = '<div class="card">';
                  $formFields[] = '<div class="card-header bgm-green"><h2>You have selected the following categories</h2></div>';
                  $formFields[] = '<div style="padding: 26px 178px" class="card-body card-padding">';
                  foreach($prod_cats_name as $prod_cats_name_){
                      $formFields[]='<h6><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> &nbsp;&nbsp; '.$prod_cats_name_.'</h6>';
                  }
                  $formFields[] = '</div></div>';
            }
        }
        
        foreach($prod_cats as $prod_cat) {
            $formFields[]= $this->createProductFormFields("cat_id[]", "", "", "hidden", "", "", "","", $prod_cat);
        }
       

        $formFields[] = $this->createProductFormFields("userid", "", "", "hidden", "", "", "","", $userid);
      
        // Attributes to hide these in the Product Edit Form.
        $hideattribute = ProductHiddenAttributes::where('type','=','editproduct')->first();
        if(!empty($hideattribute)){
            foreach($hideattribute->attr_ids as $key=>$val){
                $attributeids[] = $key;
            }
        }
        
        // Dont show Logistics and Packaging sections if the Product is Buy or Procurement.
        if($purpose==='buy'){
            unset($attrAssoc['LO']);
            unset($attrAssoc['PK']);
        }
        
        // Looping through the Attribute Associations
        foreach ($attrAssoc as $k=>$v) {
          $formFieldsTemp = array();
          foreach($attrForCats as $attrForCatk => $attrForCat){
                $attributes = Attributes::where('attr_id', strval($attrForCat) )->where('class', '=', $k)->where('lang', '=', 'en')->first();
                if(count($attributes)){
                    $attr_id = $attributes->attr_id;
                    if(strpos($attr_id,';')!== false || strpos($attr_id,'/')!== false) {
                        $disabled = "disabled";
                    } else {
                      $disabled = "";
                    }
                    
                    
                    if(isset($product->type)){
                        $type = $product->type;
                    }
                    elseif(isset ($product->disable_edit)) {
                        $type = $product->disable_edit;
                    }

//                    if(($productaction==='edit-product-variation') || $type==='temporary'){
//                        if($attr_id === '2' || $attr_id === 2){
//                              $siteslug = $this->getSites($userid);
//                              $formFieldsTemp[]= $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, "TD", $attributes->len, "attr_".$attributes->class, $attributes->req,$siteslug, "",$disabled,'',$product,$attr_id);
//                        }
//                        else {
//                            $opt = array();
//                            if($attributes->field_type === "TD" || $attributes->field_type === "TM" ){
//                                // echo $attributes->dropdown_list ;
//                                $dropopt = DropdownOptions::where('_id', $attributes->dropdown_list )->where('lang', '=', 'en')->first();
//                                if(count($dropopt )){
//                                    foreach ($dropopt->options as $dropopt_) {
//                                        $opt[$dropopt_] = $dropopt_;
//                                    }
//                                }
//                            }
//                            //field type and length
//                            $a_type = AttributesType::where('lang', '=', 'en')->Where('id', '=', $attributes->field_type)->project(array('label'))->first();
//                            $fieldinfo = "<br/><small><i>";
//                            $fieldinfo .= $a_type->label;
//                            if(!empty($attributes->len)){
//                                $fieldinfo .= " (Length ". $attributes->len . ")";
//                            }
//                            $fieldinfo .= "</i></small>";
//                            $formFieldsTemp[] = $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, $attributes->field_type, $attributes->len, "attr_".$attributes->class, $attributes->req,$opt, "",$disabled, $fieldinfo, $product,$attr_id);
//                        }
//                   }  

                    if($type=='temporary' && $type!=''){
                        if(in_array($attr_id, $attributeids)){ }
                        elseif($attr_id === '2' || $attr_id === 2){
                              $siteslug = $this->getSites($userid);
                              $formFieldsTemp[]= $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, "TD", $attributes->len, "attr_".$attributes->class, $attributes->req,$siteslug, "",$disabled,'',$product,$attr_id);
                        }
                        else {
                                    $opt = array();
                                    if($attributes->field_type === "TD" || $attributes->field_type === "TM" ){
                                        // echo $attributes->dropdown_list ;
                                        $dropopt = DropdownOptions::where('_id', $attributes->dropdown_list )->where('lang', '=', 'en')->first();
                                        if(count($dropopt )){
                                            foreach ($dropopt->options as $dropopt_) {
                                                $opt[$dropopt_] = $dropopt_;
                                            }
                                        }
                                    }
                                  //field type and length
                                  $a_type = AttributesType::where('lang', '=', 'en')->Where('id', '=', $attributes->field_type)->project(array('label'))->first();
                                  $fieldinfo = "<br/><small><i>";
                                  $fieldinfo .= $a_type->label;
                                  if(!empty($attributes->len)){
                                    $fieldinfo .= " (Length ". $attributes->len . ")";
                                  }
                                  $fieldinfo .= "</i></small>";
                                  
                                    if($purpose==='sell'){
                                        if($attr_id != '606' || $attr_id != 606){
                                                $formFieldsTemp[]= $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, $attributes->field_type, $attributes->len, "attr_".$attributes->class, $attributes->req,$opt, "",$disabled, $fieldinfo, $product,$attr_id);
                                        }   
                                    }
                                    else {
                                        // Check the Attribute Id in the arra, if exists do nothing.
                                        if(!in_array($attr_id, $attr_not_to_show)){
                                                $formFieldsTemp[]= $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, $attributes->field_type, $attributes->len, "attr_".$attributes->class, $attributes->req,$opt, "",$disabled, $fieldinfo, $product,$attr_id);
                                        }
                                    } 
                            }
                    }
                    else {
                            if($attr_id === '2' || $attr_id === 2){
                                $siteslug = $this->getSites($userid);
                                $formFieldsTemp[] = $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, "TD", $attributes->len, "attr_".$attributes->class, $attributes->req,$siteslug, "",$disabled,'',$product,$attr_id);
                            }
                            
                            else {
                                    $opt = array();
                                    if($attributes->field_type === "TD" || $attributes->field_type === "TM" ){
                                        // echo $attributes->dropdown_list ;
                                        $dropopt = DropdownOptions::where('_id', $attributes->dropdown_list )->where('lang', '=', 'en')->first();
                                        if(count($dropopt )){
                                            foreach ($dropopt->options as $dropopt_) {
                                                $opt[$dropopt_] = $dropopt_;
                                            }
                                        }
                                    }
                                    
                                    //field type and length
                                    $a_type = AttributesType::where('lang', '=', 'en')->Where('id', '=', $attributes->field_type)->project(array('label'))->first();
                                    $fieldinfo = "<br/><small><i>";
                                    $fieldinfo .= $a_type->label;
                                    if(!empty($attributes->len)){
                                          $fieldinfo .= " (Length ". $attributes->len . ")";
                                    }
                                    $fieldinfo .= "</i></small>";
                                    
                                    if($purpose ==='sell'){
                                        if($attr_id != '606' || $attr_id != 606){
                                           $formFieldsTemp[] = $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, $attributes->field_type, $attributes->len, "attr_".$attributes->class, $attributes->req,$opt, "",$disabled, $fieldinfo, $product,$attr_id);
                                        }
                                        else { }
                                    }
                                    else {
                                        // Check the Attribute Id in the arra, if exists do nothing.
                                        if(!in_array($attr_id, $attr_not_to_show)){
                                                $formFieldsTemp[]= $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, $attributes->field_type, $attributes->len, "attr_".$attributes->class, $attributes->req,$opt, "",$disabled, $fieldinfo, $product,$attr_id);
                                        }
                                        else { }
                                    }   
                            }
                    }
               }                  
          }

          if(!empty($formFieldsTemp)){
              $formFields[] = '<div class="card">';
              $formFields[] = '<div class="card-header bgm-bluegray"><h2>'.$v.'</h2></div>';// "<hr/><h4>$v</h4><hr/>";
              $formFields[] = '<div class="card-body card-padding">';
              foreach ($formFieldsTemp as $formFieldsTempV) {
                  $formFields[] = $formFieldsTempV;
              }
              //$formFields[] = $formFieldsTemp[];
              $formFields[] = '</div></div>';
          } 
        }
      
      
            $formFields[]= "<div class='card'>
                <div class='card-header bgm-bluegray'><h2>SEO Details</h2></div>  
                    <div class='form-group clearfix'>
                        <label for='seo_title' class='control-label col-md-3 col-sm-3 col-xs-12'>SEO Title</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>";
                        if(isset($product->seo_title)){
                            $formFields[]= "<input type='text' id='seo_title' value='".$product->seo_title."' name='seo_title' class='form-control' placeholder='SEO Title'>";    
                        }
                        else {
                            $formFields[]= "<input type='text' id='seo_title' name='seo_title' class='form-control' placeholder='SEO Title'>";    
                        }
                            
                $formFields[]= "</div>
                    </div>

                    <div class='form-group clearfix'>
                        <label for='seo_description' class='control-label col-md-3 col-sm-3 col-xs-12'>SEO Description</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>";
                        if(isset($product->seo_description)){
                            $formFields[]= "<input type='text' id='seo_description' value='".$product->seo_description."' name='seo_description' class='form-control' placeholder='SEO Description'>";    
                        }
                        else {
                            $formFields[]= "<input type='text' id='seo_description' value='' name='seo_description' class='form-control' placeholder='SEO Description'>";    
                        }    
                        $formFields[]= "</div>
                    </div>

                    <div class='form-group clearfix'>
                        <label for='seo_keywords' class='control-label col-md-3 col-sm-3 col-xs-12'>SEO Keywords</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>";
                        if(isset($product->seo_description)){
                            $formFields[]= "<input type='text' id='seo_keywords' value='".$product->seo_keywords."' name='seo_keywords' class='form-control' placeholder='SEO Keywords'>";    
                        }
                        else {
                            $formFields[]= "<input type='text' id='seo_keywords' value='' name='seo_keywords' class='form-control' placeholder='SEO Keywords'>";    
                        }    
                        $formFields[]= "</div>
                    </div>
                <br />
           </div>";
                        
        if($purpose!=='buy'){
            $formFields[] = '<div class="card">
            <div class="card-header bgm-bluegray"><h2>Product Images</h2></div>';
            
            if (isset($product->product_images)) {
                $formFields[] = '<div class="card-body card-padding-sm">';                  
                    $formFields[] = '<div class="row">';
                    if(is_array($product->product_images)){
                        foreach($product->product_images as $key=>$val){
                        $formFields[] = '<div class="col-md-3 col-sm-6 col-xs-6">
                                <img width="200" height="200" src="'.asset($val).'" alt="">
                                <button type="button" class="delete_image btn btn-primary btn-xs waves-effect" data_product_id="'.$product->_id.'" data_img-name="'.$val.'">Delete This Image</button>
                            </div>';
                        }
                    }    
                    $formFields[] = '</div>';
                    $formFields[] = '</div><hr>';
                }

                $formFields[] = '<div class="item form-group">
                    <div class="prod_images">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" data-toggle="tooltip" data-placement="bottom">Image</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                <div>
                                    <span class="btn btn-info btn-file waves-effect">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input name="product_images[]" type="file" id="product_images">
                                    </span>
                                    <a href="#" class="btn btn-danger fileinput-exists waves-effect" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                            <br>
                            <small><i>Image (uploaded from PC)</i></small>
                        </div>
                    </div>

                    <div id="images_div"></div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="control-label col-md-6 col-sm-6 col-xs-12" data-toggle="tooltip" data-placement="bottom"></label>
                        <div class="control-label col-md-3 col-sm-3 col-xs-12">
                            <button type="button" class="btn btn-round btn-primary add_images">Add More Images</button>
                        </div>
                    </div>
                </div>
                <br />
            </div>';
        }               
 
        if(!empty($product)){
            $formFields[] = '<input type="hidden" name="purpose" id="purpose" value="'.$product->purpose.'"/>';
        }
        return $formFields;
    }
    
    function createProductFormFields($attr_id, $label="", $desc="", $field_type="", $len="", $class="", $req="",$opt, $val="",$disabled="", $fieldinfo ="", $product="", $curr_attr=""){
        $defaultValue = "";
        $allCountries = $regions = array();
        
        $countries = DropdownOption::where('name','countries')->get();
        foreach($countries as $country){
            if(isset($country->parent)){
                $allCountries[$country->parent] = $country->options;
                $regions[] = $country->parent;
            }
        }
        
      
        if(!empty($product) && !empty($product->product_data[$curr_attr])){
            if($curr_attr==='14' || $curr_attr==='574') {
                  $defaultValue = "";
            }
            else {
                  $value = $product->product_data[$curr_attr];
                  $defaultValue = str_replace('â€“', '-', $value);
            }
        }
        
        if($curr_attr==='598'){
            $field = '<div class="item form-group attr_LO">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" data-toggle="tooltip" data-placement="bottom" title="'.$desc.'">'.$desc.'</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div style="overflow:scroll; height:400px;" class="">
                            <ul>';
                            foreach($regions as $region){
                                $field.= '<li style="list-style: none;">
                                    <input type="checkbox" name="top-level" id="top-level">
                                    <label for="top-level">'.$region.'</label>
                                    <ul>';
                                    foreach($allCountries[$region] as $country){
                                        $field.= '<li style="list-style: none;">';
                                            if(isset($product->product_data['598'])){
                                                if(in_array($country, $product->product_data['598'])){
                                                    $field.= '<input type="checkbox" checked value="'.$country.'" name="attr_id[598][]">';
                                                }
                                                else {
                                                    $field.= '<input type="checkbox" value="'.$country.'" name="attr_id[598][]">';
                                                }
                                            }
                                            else {
                                                $field.= '<input type="checkbox" value="'.$country.'" name="attr_id[598][]">';
                                            }
                                            $field.= '<label for="attr_id[598][]">'.$country.'</label>
                                        </li>';
                                    }
                                    $field.= '</ul>
                                </li>';
                            }
                            $field.= '</ul>
                        </div>
                    </div>
                </div>';
            return $field;
        }
                
        //$this->createProductFormFields($attr_id, $label, $desc, $field_type, $len, $class, $req);
        if($req==="M" || $req==="required"){ $req="required";}else{ $req=""; }
        switch ($field_type) {
            case "TD":
                //if($label !==""){
                $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::select($attr_id, $opt, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => '---', $req, $disabled])
                            . $fieldinfo
                        . "</div>
                    </div>";                    
                break;
            case "TM":
                //if($label !==""){
                if(count($opt) > 20){
                  $hgt = 250;
                }else{
                  $hgt = 150;
                }
              
                $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::select($attr_id.'[]', $opt, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => '---', $req, $disabled, 'multiple', 'style'=>'height: '.$hgt.'px;'])
                            . $fieldinfo
                        . "</div>
                    </div>";                    
                break;    
            case "TA":
                //if($label !==""){
                $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::textarea($attr_id, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => $label, $req, $disabled, 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
                break;      
            case "T":
                //if($label !==""){
                $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::text($attr_id, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => $label, $req, $disabled, 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
                break;      
            case "Y":// Year
            case "N":
                //if($label !==""){
                $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::number($attr_id, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => $label, $req, $disabled, 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
                break; 
            case "D":
                //if($label !==""){
                $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::date($attr_id, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                 $req, $disabled, "min"=> date("Y-m-d"), 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
                break; 
            case "H":
                //if($label !==""){
                $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::time($attr_id, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                 $req, $disabled, 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
                break;             
            case "I":
                //if($label !==""){
                $field = "<div class='item form-group ".$class."'>"
                            . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12','data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                            ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                                ."<div class='fileinput fileinput-new' data-provides='fileinput'>
                                    <div class='fileinput-preview thumbnail' data-trigger='fileinput'></div>
                                <div>
                                <span class='btn btn-info btn-file'>
                                    <span class='fileinput-new'>Select image</span>
                                    <span class='fileinput-exists'>Change</span>"
                                        . Form::file($attr_id, '', ['class' => 'form-control col-md-7 col-xs-12 upload-image','accept'=>'image/*',  $req, $disabled, 'maxlength'=> $len])
                                    ."</span>
                                <a href='#' class='btn btn-danger fileinput-exists' data-dismiss='fileinput'>Remove</a>
                            </div>
                        </div>"
                    . $fieldinfo                  
                . "</div>
              </div>";                  
                
               
                
//                $field = "<div class='item form-group ".$class."'>"
//                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
//                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
//                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
//                            . Form::file($attr_id, '', ['class' => 'form-control col-md-7 col-xs-12 upload-image', 
//                               'accept'=>'image/*',  $req, $disabled, 'maxlength'=> $len])
//                            . $fieldinfo                    
//                        . "</div>
//                    </div>";                    
                break;     
            case "F":
                //if($label !==""){
                $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::file($attr_id, '', ['class' => 'form-control col-md-7 col-xs-12 upload-file', 
                                 'accept'=>'file_extension', $req, $disabled, 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
                break;    
            case "U":
            case "UA":
            case "UE":
            case "UI":                
                //if($label !==""){
                $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::url($attr_id, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => $label, $req, $disabled, 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
                break;            
            case "hidden":
                //$field=$this->createFieldHidden($attr_id, $field_type);
                $field = Form::hidden($attr_id, $val, $attributes = array());
                //Form::number('len', $attributes->len, ['class' => 'form-control col-md-7 col-xs-12', 'required'])
                break;
            case "CL":
                $field = "<div class='item form-group ".$class."'>"
                    . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                        'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                    ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                . "<div class='cp-container'><div class='input-group form-group'>
                    <!--span class='input-group-addon'><i class='zmdi zmdi-invert-colors'></i></span-->
                    <div class='fg-line dropdown'>"
                      . Form::text($attr_id, '#03A9F4', ['class' => 'form-control cp-value', 'data-toggle'=>'dropdown', $req, $disabled])
                                                
                       . "<div class='dropdown-menu'>
                        <div class='color-picker' data-cp-default='#03A9F4'></div>
                      </div>

                      <i class='cp-value'></i>
                    </div>"
                    .$fieldinfo.
                    "</div>
                  </div>"
                    . "</div>
                </div>";               
                break;  
            default:
                $field="";
        }     
        return $field;
        //Form::number('len', $attributes->len, ['class' => 'form-control col-md-7 col-xs-12', 'required'])
        //$this->createFieldHidden($attr_id, $label, $desc, $field_type, $len, $class, $req);
        
        
    }

    function fetchAttributesIds($catAnsForAttr){
      try{
        $attrArr =array();
        foreach ($catAnsForAttr as $cat) {
            $attrTmp = CategoryAttribute::Where('cat_id', '=', $cat)->project( array('attr_ids') )->first();//->take(1)->get();
            if(count($attrTmp)){
                foreach($attrTmp->attr_ids as $attr){
                    $attrArr[$attr]=$attr;
                }
            }
        }
        return $attrArr;      
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
  }
    
    function fetchAttributesAssoc(){
      try{
        $attrAssoc = array();
        $attrAssocTmp = AttributesAssoc::where('lang', '=', 'en')->project( array('id','label') )->get();
        foreach($attrAssocTmp as $v){
            $attrAssoc[$v->id] = $v->label;
        }
        return $attrAssoc;
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                          "Line Number: ".$e->getLine()." ".
                          "File Name: ".$e->getFile()." ".
                          "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
  }
    
    function fetchAncestorsForAll($prod_cats){
      try{
        $catAnsForAttr = array();
        foreach ($prod_cats as $cat) {
            $catAnsForAttrTemp=$this->fetchCategoryAnscestors($cat);
            foreach ($catAnsForAttrTemp as $k => $v) {
                $catAnsForAttr[$k]=$v;
            }
        }
        return $catAnsForAttr;
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                          "Line Number: ".$e->getLine()." ".
                          "File Name: ".$e->getFile()." ".
                          "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }
    
    function fetchCategoryAnscestors($currentid){
      try{
        $parent=0;
        //$currentid=$cat;
        $cat_hierachy=array();
        do {
            $sql = Categories::where('lang', '=', 'en')->Where('cat_id', '=', $currentid)->project( array('cat_id','parent') )->first();//->take(1)->get();
            if(count($sql)){
                //array_push($cat_hierachy, $sql->cat_id); 
                $cat_hierachy[$sql->cat_id]= $sql->cat_id;
                if(!empty($sql->parent)){
                    $currentid = $sql->parent;
                    $parent = 1;
                }else{
                    $parent = 0;
                }
            }else{
                $parent = 0;
            }
        }while($parent <> 0);        
        
        return $cat_hierachy;
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request){
      try {
        $input = Request::all();
        $product = new Products;
        $product->userid = Request::get('userid');
        $product->shopid = $input['attr_id'][2];
        $companyid = $this->CompanyId($input['attr_id'][2]);
        $product->company_id = $companyid;
        $input['attr_id'][61] = url('site') .'/'. $input['attr_id'][2] ;//store url
        if(Auth::user()){
            $product->userid = Auth::user()->id;            
            $product->postedby = Auth::user()->username;            
        }
        $product->purpose = Request::get('purpose');
        $product->classification = Request::get('classification');
        $product->cat_ids = Request::get('cat_id');
        $product->postdate = $input['attr_id'][1];
        $product->desc = $input['attr_id'][3];
        $product->thumb = "";
        $product->thumb_path = "";
                
        $product_attr = array();
        $product_images = array();
        $path = Auth::user()->directory_path."/products/".date('Y')."/".date('m')."/".date('d')."/";
        $permission = 0777;
        
        if(isset($input['product_images'])){
            foreach($input['product_images'] as $key => $val){
                if(gettype($val) === "object"){
                    $image = $val->getClientOriginalName();
                    $extension = $val->getClientOriginalExtension();
                    $size = $val->getSize();
                    $mime = $val->getMimeType();
                    if(substr($mime, 0, 5) == 'image') {
                        if(!File::exists($path)) {
                            $target_dir = $this->make_directory($path, $permission, TRUE);
                        }
                        
                        $filename = "prod-" . $this->randomString() . "-". time().".".$extension;  
                     // $val->move( $target_dir, $filename);
                        $val->move($path, $filename);
                        $product_images[] = $path.$filename;
                    }
                }
            }
        }

        foreach($input['attr_id'] as $attr_id => $attr_val){
            if(gettype($attr_val) === "object"){
                $image = $attr_val->getClientOriginalName();
                $extension = $attr_val->getClientOriginalExtension();
                $size = $attr_val->getSize();
                $mime = $attr_val->getMimeType();
                if(substr($mime, 0, 5) == 'image') {
                    if(!File::exists($path)) {
                        $target_dir = $this->make_directory($path, $permission, true);
                    }
                    
                    $filename = "prod-" . $this->randomString() . "-". time().".".$extension;  
                 // $attr_val->move($target_dir, $filename);
                    $attr_val->move($path, $filename);
                    $product->thumb = $filename;
                    $product->thumb_path = $path;
                }
                $product_attr[$attr_id] = $path.$filename;
            }
            else {
                $product_attr[$attr_id] = $attr_val;
            }
        }
        
        $product->product_data = $product_attr; 
        $product->product_images = $product_images;
        
        $product->seo_title = $input['seo_title'];
        $product->seo_description = $input['seo_description'];
        $product->seo_keywords = $input['seo_keywords'];
        $product->status = 'disabled';
        $product->shared_in = "";
        
        $matchedids = $this->checkIdsForProductVariation($product_attr);
        
        if($product->save()){
            $productids = Products::where('userid','=',Auth::user()->id)->where('shopid','=',$input['attr_id'][2])->where('company_id','=',$companyid)->where('desc','=',$input['attr_id'][3])->first();
            if($matchedids >= 1){
                Session::flash('message', 'The Product is Successfully Created.');
                return Redirect::route('products/variation',['productid'=>$productids->_id,'purpose'=>Request::get('purpose')])->with('message','The Product is Successfully Created.');
            }
            else {
                Session::flash('message', 'The Product is Successfully Created.');
                return Redirect::route('products/list');
            }
        }
        else {
            return redirect()->back()->with('message','Product Could not be Added! Please try Again');
        }
      }
      catch (\Exception $e){
            $error = "An error occured. ".
              "Line Number: ".$e->getLine()." ".
              "File Name: ".$e->getFile()." ".
              "Error Description: ".$e->getMessage();
            return view('errors.custom_error')->withErrors($error);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id){
      try {
        $product = Products::find($id);
       //Fetch Attr association/classifiction
        $attrAssoc = $this->fetchAttributesAssoc();

        //Create Add Product form fields
        $productTabs = $this->createProductTabs($attrAssoc, $product);
        //var_dump($productTabs );
//        $attributes= AttributesAssoc::where('id', '=', $id)->where('lang', '=', 'en')->first();

        return view('backend.catalog.products.show', compact('productTabs','product'));
      }
      catch (\Exception $e){
          $error = "An error occured. ".
            "Line Number: ".$e->getLine()." ".
            "File Name: ".$e->getFile()." ".
            "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }
    
    function createProductTabs($attrAssoc, $product){
        $prodTabData = array();
//        $prodTabData[] = "<hr/><h4>You have selected the following categories:</h4><hr/>";
//        foreach($prod_cats_name as $prod_cats_name_){
//            $prodTabData[]='<h6><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> &nbsp;&nbsp; '.$prod_cats_name_.'</h6>';
//        }
        $prodTabData[] = '<ul id="prodTab" class="nav nav-tabs bar_tabs" role="tablist">';
        $ft=1;
        foreach ($attrAssoc as $k=>$v) {
            if($ft===1){
                $prodTabData[] = '<li role="presentation" class="active"><a href="#tab_content_'.$k.'" id="tab_'.$k.'" role="tab" data-toggle="tab" aria-expanded="true">'.$v.'</a></li>';
            }
            else {
                $prodTabData[] = '<li role="presentation" class=""><a href="#tab_content_'.$k.'" id="tab_'.$k.'" role="tab" data-toggle="tab" aria-expanded="true">'.$v.'</a></li>';
            }
            $ft = 0;
        }
        $prodTabData[] = '</ul>';
        
        //return $prodTabData;
        $prodTabData[] = '<div id="prodTabContent" class="tab-content">';
        $ft = 1;
        foreach ($attrAssoc as $k=>$v) {
            if($ft===1){
                $prodTabData[] = '<div role="tabpanel" class="tab-pane fade active in" id="tab_content_'.$k.'" aria-labelledby="tab_'.$k.'">';
            }
            else{
                $prodTabData[] = '<div role="tabpanel" class="tab-pane fade" id="tab_content_'.$k.'" aria-labelledby="tab_'.$k.'">';
            }
            $ft=0;
            //$prodTabData[] = $v;
            
            $prodTabData[]='<table class="table table-striped"><tbody>';
            
            foreach($product->product_data as $attr_k => $attr_v){
                $attributes= Attributes::where('attr_id', strval($attr_k) )->where('class', '=', $k)->where('lang', '=', 'en')->first();
                if(count($attributes)){
                    $prodTabData[]="<tr>";
                        $prodTabData[]="<td class='col-md-4'>";
                        $prodTabData[]= $attributes->label;
                        $prodTabData[]="</td>";
                        $prodTabData[]="<td>";
                            if($attributes->field_type === "I" || $attributes->field_type === "UI" ){
                                if($attr_v !==""){
                                    $prodTabData[]= '<img src="'.$attr_v.'" alt="" />';
                                }
                            }
                            elseif($attributes->field_type === "F" || $attributes->field_type === "U" || $attributes->field_type === "UA" || $attributes->field_type === "UE" ){
                                if($attr_v !==""){
                                    $prodTabData[]= '<a href="'.$attr_v.'" target="_blank">'.$attr_v.'</a>';
                                }
                            }elseif($attributes->field_type === "CL" ){
                              $prodTabData[]= '<i class="cp-value-show" style="background-color: '.$attr_v.';"></i>';
                            }elseif($attributes->field_type === "TM" ){
                              if(!empty($attr_v) ){
                                $prodTabData[]= implode(", ", $attr_v);
                              }
                            }
                            else {
                                $prodTabData[]= $attr_v;
                            }
                        $prodTabData[]="</td>";
                    $prodTabData[]="</tr>";
                }                  
            }   
            $prodTabData[] = '</tbody></table>';  
            
            $prodTabData[] = '</div>';
        }      
        $prodTabData[] = '</div>';
        
        return $prodTabData;
        
    }

    public function randomString(){
    try{
        // Random characters
        $characters = array("B","C","D","F","G","H","J","K","L","M","N",
        "P","Q","R","S","T","V","W","X","Y","Z","b","c","d","f","g","h",
        "j","k","l","m","n","p","q","r","s","t","v","w","x","y","z",
        "0", "1","2","3","4","5","6","7","8","9");

        // set the array
        $keys = array();
        // set length
        $length = 8;

        // loop to generate random keys and assign to an array
        while(count($keys) < $length) {
          $x = mt_rand(0, count($characters)-1);
          if(!in_array($x, $keys)) {
               $keys[] = $x;
            }
        }

        // extract each key from array
        $random_chars='';
        foreach($keys as $key){
           $random_chars .= $characters[$key];
        }

        // display random key
        return $random_chars;
    }
    catch (\Exception $e){
        $error = "An error occured. ".
                        "Line Number: ".$e->getLine()." ".
                        "File Name: ".$e->getFile()." ".
                        "Error Description: ".$e->getMessage();
        return view('errors.custom_error')->withErrors($error);
    }
 }

    public function fetchCatAncestors($currentid){
      try{
        $parent=0;
        $cat_hierachy="";
        do{
            $sql = Categories::where('lang', '=', 'en')->Where('cat_id', '=', $currentid)->orderBy('name')->project( array('name','parent') )->first();//->take(1)->get();
            if(count($sql)){
                if($cat_hierachy === ""){
                    $cat_hierachy = $sql->name ;
                }else{
                    $cat_hierachy = $sql->name . " / " . $cat_hierachy;
                }
                if(!empty($sql->parent)){
                    $currentid = $sql->parent;
                    $parent = 1;
                }else{
                    $parent = 0;
                }
            }else{
                $parent = 0;
            }
        }while($parent <> 0);
        //return $cat_hierachy;
        return $cat_hierachy;
      }
      catch (\Exception $e){
          $error = "An error occured. ".
            "Line Number: ".$e->getLine()." ".
            "File Name: ".$e->getFile()." ".
            "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
        }
     }  
 
    public function editSharedProduct($flag, $id){
      if(Auth::user()){
        try {
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '36')->where('group','business_ecosystem')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                $userid = Auth::user()->id;
                $product = Products::find($id); 
                $purpose = $product->purpose;
                
                if(!empty($product)){
                    $prod_cats = $product->cat_ids;
                    //Fetch Ancestors of aall the selected categories
                    $catAnsForAttr = $this->fetchAncestorsForAll($prod_cats );
                    //Fetch Attr association/classifiction
                    $attrAssoc = $this->fetchAttributesAssoc();

                    //Fetch Attributes 
                    $multItemAttr = ProductHiddenAttributes::where('type','multiitem')->first();
                    $attrForCats = $multItemAttr->attr_ids;
                    sort($attrForCats);
                    $prod_cats_name = array();
                    if(!empty($prod_cats)){
                        foreach ($prod_cats as $prod_cat){
                            $prod_cats_name[] = $this->fetchCatAncestors($prod_cat);
                        }
                    }

                    // Create Add Product form fields
                    $productForm = $this->createProductForm($prod_cats, $prod_cats_name, $attrAssoc, $attrForCats, $userid, $product,"",$purpose);

                    return view('backend.catalog.products.edit_shared_product', compact('nav_menu','route','productForm','id','flag','purpose'));
                }        
        }
        catch (\Exception $e){
            $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage();
            return view('errors.custom_error')->withErrors($error);
        }
      }
      else{
        return redirect('auth/login')->with('message',"You must be login!"); 
      }   
    }
    
    public function updateSharedProduct($id){
      if(Auth::user()){
        try {
                $data = Request::all();

                $product = Products::find($id);
                                
                $product->userid = $data['userid'];
                $product->shopid = $data['attr_id'][2];
                $product->postdate = $data['attr_id'][1];
                $product->desc = $data['attr_id'][3];
                $product->seo_title = $data['seo_title'];
                $product->seo_description = $data['seo_description'];
                $product->seo_keywords = $data['seo_keywords'];
                $product->type = '';
                
                $path = Auth::user()->directory_path."/products/".date('Y')."/".date('m')."/".date('d')."/";
                $permission = 0777;
                $product_images = array();
                if(isset($product->product_images)) {
                    if(!empty($product->product_images)){
                        foreach($product->product_images as $key=>$val){
                            $product_images[] = $val;
                        }
                    }
                }
                
                foreach($data['product_images'] as $key => $val){
                    if(gettype($val) === "object"){
                        $image = $val->getClientOriginalName();
                        $extension = $val->getClientOriginalExtension();
                        $size = $val->getSize();
                        $mime = $val->getMimeType();
                        if(substr($mime, 0, 5) == 'image') {
                            $filename = "prod-" . $this->randomString() . "-". time().".".$extension;  
                            $target_dir = $this->make_directory($path, $permission, true);
                            // $val->move( $target_dir, $filename);
                            $val->move($path, $filename);
                            $product_images[] = $path.$filename;
                        }
                    }
                }
                
                // Get the Image Object and Other Values and insert them into the Array.
                foreach($data['attr_id'] as $attr_id => $attr_val){
                    if(gettype($attr_val) === "object"){
                        $image = $attr_val->getClientOriginalName();
                        $extension = $attr_val->getClientOriginalExtension();
                        $size = $attr_val->getSize();
                        $mime = $attr_val->getMimeType();
                        if(substr($mime, 0, 5) == 'image') {
                            if(!File::exists($path)) {
                                $target_dir = $this->make_directory($path, $permission, true);
                            }

                            $filename = "prod-" . $this->randomString() . "-". time().".".$extension;  
                         // $attr_val->move($target_dir, $filename);
                            $attr_val->move($path, $filename);
                            $product->thumb = $filename;
                            $product->thumb_path = $path;
                        }
                        $product_attr[$attr_id] = $path.$filename;
                    }
                    else {
                        $product_attr[$attr_id] = $attr_val;
                    }
                }
                
                // Insert the values into the array which are not present in Edit Form.
                foreach($product->product_data as $key=>$value){
                    if(!array_key_exists($key, $product_attr)){
                        $product_attr[$key] = $value;
                    }
                }
                
                $product->product_data = $product_attr;
                $product->product_images = $product_images;
                
                if($product->save()){
                    Session::flash('message', 'Product Details Updated Successfully');
                    if($data['flag']==='ecosystem'){
                        return Redirect::route("ecosys.product.index", ['site_slug'=>$data['attr_id'][2]]);
                    }
                    else {
                        return Redirect::route("comnetwork.product.index", ['site_slug'=>$data['attr_id'][2]]);
                    }
                }
                else {
                    return redirect()->back()->with('message','Product Details could not be Updated. Please try Again.');
                }
        }
        catch (\Exception $e){
            $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage();
            return view('errors.custom_error')->withErrors($error);
        }
      }
      else {
             return redirect('auth/login')->with('message',"You must be login!"); 
      }
    }
    
    public function editProduct($id){
      if(Auth::user()){
        try {
                $product = Products::find($id);
                $userid = Auth::user()->id;
                $productaction = "edit-product";
                $purpose = $product->purpose;
                $type = $product->type;
                $flag = '';

                if($product){
                    $prod_cats = $product->cat_ids;
                    //Fetch Ancestors of aall the selected categories
                    $catAnsForAttr = $this->fetchAncestorsForAll($prod_cats);
                    //Fetch Attr association/classifiction
                    $attrAssoc = $this->fetchAttributesAssoc();
                    //Fetch Attributes
                    $attrForCats = $this->fetchAttributesIds($catAnsForAttr);
                    sort($attrForCats);

                    $prod_cats_name = array();
                    foreach ($prod_cats as $prod_cat){
                        $prod_cats_name[] = $this->fetchCatAncestors($prod_cat);
                    }
                    
                   //Create Add Product form fields
                    $formFields = $this->createProductForm($prod_cats,"", $attrAssoc, $attrForCats, $userid, $product, $productaction, $purpose);  
                }
                
                if($type==='temporary'){
                    return view('backend.catalog.products.edit_variation_product', compact('formFields','id','flag','productaction','purpose','product','type'));
                }
                else {
                    return view('backend.catalog.products.edit_product', compact('formFields','id','flag','productaction','purpose','product','type'));
                }
        }
        catch (\Exception $e){
            $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage();
            return view('errors.custom_error')->withErrors($error);
        }
      }
      else{
        return redirect('auth/login')->with('message',"You must be login!"); 
      }   
    }
    
    public function updateProductInfo($id){
      if(Auth::user()){
        try {
                $data = Request::all();
                $product = Products::find($id);
                $productid = $id;
                $product->userid = $data['userid'];
                $product->shopid = $data['attr_id'][2];
                $product->postdate = $data['attr_id'][1];
                $product->desc = $data['attr_id'][3];
                $product->seo_title = $data['seo_title'];
                $product->seo_description = $data['seo_description'];
                $product->seo_keywords = $data['seo_keywords'];
                $product->type = '';
                
                $path = Auth::user()->directory_path."/products/".date('Y')."/".date('m')."/".date('d')."/";
                $permission = 0777;
                $product_images = array();
                if(isset($product->product_images)) {
                    if(!empty($product->product_images)){
                        foreach($product->product_images as $key=>$val){
                            $product_images[] = $val;
                        }
                    }
                }
                
                foreach($data['product_images'] as $key => $val){
                    if(gettype($val) === "object"){
                        $image = $val->getClientOriginalName();
                        $extension = $val->getClientOriginalExtension();
                        $size = $val->getSize();
                        $mime = $val->getMimeType();
                        if(substr($mime, 0, 5) == 'image') {
                            $filename = "prod-" . $this->randomString() . "-". time().".".$extension;  
                            $target_dir = $this->make_directory($path, $permission, true);
                            // $val->move( $target_dir, $filename);
                            $val->move($path, $filename);
                            $product_images[] = $path.$filename;
                        }
                    }
                }
                
                // Get the Image Object and Other Values and insert them into the Array.
                foreach($data['attr_id'] as $attr_id => $attr_val){
                    if(gettype($attr_val) === "object"){
                        $image = $attr_val->getClientOriginalName();
                        $extension = $attr_val->getClientOriginalExtension();
                        $size = $attr_val->getSize();
                        $mime = $attr_val->getMimeType();
                        if(substr($mime, 0, 5) == 'image') {
                            if(!File::exists($path)) {
                                $target_dir = $this->make_directory($path, $permission, true);
                            }

                            $filename = "prod-" . $this->randomString() . "-". time().".".$extension;  
                         // $attr_val->move($target_dir, $filename);
                            $attr_val->move($path, $filename);
                            $product->thumb = $filename;
                            $product->thumb_path = $path;
                        }
                        $product_attr[$attr_id] = $path.$filename;
                    }
                    else {
                        $product_attr[$attr_id] = $attr_val;
                    }
                }
                
                // Insert the values into the array which are not present in Edit Form.
                foreach($product->product_data as $key=>$value){
                    if(!array_key_exists($key, $product_attr)){
                        $product_attr[$key] = $value;
                    }
                }
                
                $product->product_data = $product_attr;
                $product->product_images = $product_images;
                
                if($product->save()){
                    if($data['flag']==='product_variation'){
                        Session::flash('message', 'Product Variation Created Successfully');
                        return view('backend.catalog.products.verify_variation',compact('productid'))->with('message','Product Variation Added Successfully');
                    }
                    else {
                        Session::flash('message', 'Product Details Updated Successfully');
                        return Redirect::route("products/list");
                    } 
                }
                else {
                    return redirect()->back()->with('message','Product Details could not be Updated. Please try Again.');
                }
        }
        catch (\Exception $e){
            $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage();
            return view('errors.custom_error')->withErrors($error);
        }
      }
      else {
             return redirect('auth/login')->with('message',"You must be login!"); 
      }
    }
    
    public function deleteProductImage(){
        if(Auth::user()){
            $request = Request::all();
            $image_name = $request['image_name'];
            $productid = $request['product_id'];
            DB::collection('products')->where('_id', $productid)->pull('product_images', $image_name);
            $arr['status'] =  'true';
            return json_encode($arr);
        }
        else {
            return redirect('auth/login')->with('message',"Please Login to Chat!");
        }
    }
    
    public function checkIdsForProductVariation($product_attr){
        $productattrids = array();
        $variationattrids = array();
        $attribute_ids = ProductVariationAttributes::where('status','=','1')->get();
         
        foreach($product_attr as $key=>$val){
            $productattrids[] = $key;
        }
        
        if(!empty($attribute_ids->count())){
           foreach($attribute_ids as $ids){
                $variationattrids[] = $ids->attr_id;
           }
        }

        $result = !empty(array_intersect($productattrids, $variationattrids));
        return $result ; 
    }
    
    public function verifyVariation(){
        if(Auth::user()){
            $data = Request::all();
            $variationids = array();
            $varfields = array();
            $prodvarfields = array();
            $attrForCats = array();
            $productid = $data['productid'];
            $flag = 'add-variation';
            
            
            $product = Products::find($productid);
            $purpose = $product->purpose;
            // $purpose = $product->purpose;
            
            $productvariation = ProductVariationAttributes::where('status','=','1')->get();
            foreach($productvariation as $variation){
                $variationids[$variation->attr_id] = $variation->desc;
            }
            
            $variationfields = ProductVariationFields::where('status','=','1')->get();
            foreach($variationfields as $key=>$fields){
                if(array_key_exists($fields->attr_id, $product->product_data)){
                    $varfields[$fields->attr_id] = $fields->desc;
                    $attrForCats[] = $fields->attr_id;
                }
            }
            
            ksort($varfields);
            foreach($product->product_data as $key=>$value){
                if(array_key_exists($key, $varfields)){
                    $prodvarfields[$key] = $value;
                }
            }
            
            $catAnsForAttr = $this->fetchAncestorsForAll($product->cat_ids);
            $attrAssoc = $this->fetchAttributesAssoc();
            sort($attrForCats);
            
             $productForm = $this->createVariationProductForm($attrAssoc, $attrForCats, $product);
             
            // Check $prodvariations exists or not. Set $id as $varid if nor exists
            if(!empty($product->product_variation_id)){
                $varid = $product->product_variation_id;
            }
            else {
                $varid = $productid;
            }
            
            $productvars = Products::where('_id','=',$varid)->orWhere('product_variation_id','=',$varid)->get();
            
            return view('backend.catalog.products.verify_variation',compact('productid','productvars','variationids','product','flag','varfields','prodvarfields','productForm','purpose'));
        }
        else {
            return redirect('auth/login')->with('message',"Please Login!");
         }
    }
    
    public function createVariation(){
        $data = Request::all();
        $i = 0;
        $permission = 0777;
        $prod_var = array();
        $images = array();
        $path = Auth::user()->directory_path."/products/".date('Y')."/".date('m')."/".date('d')."/";
        
        if($data['flag']==='add-variation'){
                $productid = $data['productid'];
                $product = Products::find($productid);

                if(!empty($data['attr_id'])){
                    foreach($data['attr_id'] as $key=>$value){
                        if(!empty($value)){
                            foreach($value as $k=>$v){
                                if(gettype($v) === "object"){
                                    $mime = $v->getMimeType();
                                    $extension = $v->getClientOriginalExtension();
                                    if(substr($mime, 0, 5) == 'image') {
                                        if(!File::exists($path)) {
                                            $target_dir = $this->make_directory($path, $permission, true);
                                        }
                                        $filename = "prod-" . $this->randomString() . "-". time().".".$extension;  
                                        $v->move($path, $filename);
                                    }
                                    $prod_var[$k][$key] = $path.$filename;
                                }
                                else {
                                    $prod_var[$k][$key] = $v;
                                }  
                            }
                        }
                    }
                }

                if(!empty($prod_var)){
                    foreach($prod_var as $attributevalues){
                        $newproduct = new Products();
                        foreach($product->product_data as $attrid=>$productdata){
                            if(!array_key_exists($attrid, $attributevalues)){
                                 $attributevalues[$attrid] = $productdata;
                            }

                            if($attrid === 47){
                                $thumb = substr($attributevalues[$attrid], strrpos($attributevalues[$attrid], '/') + 1);
                                $newproduct->thumb = $thumb;
                            }
                        }

                        $newproduct->product_data = $attributevalues;
                        $newproduct->userid = Auth::user()->id;
                        $newproduct->desc = $attributevalues[6];
                        $newproduct->company_id = $product->company_id;
                        $newproduct->postedby = $product->postedby;
                        $newproduct->purpose = $product->purpose;
                        $newproduct->thumb_path = $path;
                        $newproduct->product_images = $images;
                        $newproduct->postdate = $product->postdate;
                        $newproduct->product_id = $productid;
                        $newproduct->shopid = $product->shopid;
                        $newproduct->postedby = $product->postedby;
                        $newproduct->cat_ids = $product->cat_ids;
                        $newproduct->seo_title = "";
                        $newproduct->seo_description = "";
                        $newproduct->seo_keywords = "";
                        $newproduct->status = "disabled";
                        $newproduct->disable_edit="No";
                        $newproduct->duplicate = '';
                        $newproduct->type = "temporary";

                        if(isset($product->product_variation_id)){
                            $newproduct->product_variation_id = $product->product_variation_id;
                        }
                        else {
                            $newproduct->product_variation_id = $productid;
                        }
                        if($newproduct->save()){
                            $i++;
                        }
                    }       
                }

                if(count($prod_var)!== 0){
                    if(count($prod_var) === $i){
                        Session::flash('message', 'Verify the Products and Create the Variations');
                        return Redirect::route('view.product.variation', $productid);
                    }
                    else {
                        return redirect()->back()->with('message','Some Product could not be Saved! Please try Again');
                    }
                }
        }
        else {
                if(!empty($data['attr_id'])){
                    foreach($data['attr_id'] as $key=>$value){
                        if(!empty($value)){
                            foreach($value as $k=>$v){
                                if(gettype($v) === "object"){
                                    $mime = $v->getMimeType();
                                    $extension = $v->getClientOriginalExtension();
                                    if(substr($mime, 0, 5) == 'image') {
                                        if(!File::exists($path)) {
                                            $target_dir = $this->make_directory($path, $permission, true);
                                        }
                                        $filename = "prod-" . $this->randomString() . "-". time().".".$extension;  
                                        $v->move($path, $filename);
                                    }
                                    $prod_var[$k][$key] = $path.$filename;
                                }
                                else {
                                    $prod_var[$k][$key] = $v;
                                }  
                            }
                        }
                    }
                }
                
                foreach($data['_id'] as $id){
                    $proddata = Products::where('_id', $id)->first();
                    foreach ($proddata->product_data as $key=>$value) {
                        if(array_key_exists($key, $prod_var[$i])){
                            if($key=== 481){
                                $proddata->desc = $prod_var[$i][$key];
                            }
                            if(empty($prod_var[$i][$key])){
                                $prod_var[$i][$key] = $value;
                            }
                        }
                        else {
                            $prod_var[$i][$key] = $value;
                        }
                    }
                    ksort($prod_var[$i]);          
                    $proddata->product_data = $prod_var[$i];
                    $proddata->save();
                    $i++;
                }
            }
            
         // Product Id of the product to get the variations.
            $prodid = $data['productid'];
            
            // Redirect to the route to get all the variations.
            return Redirect::route('view.product.variation', $prodid);
    

//            if(isset($product->product_variation_id)){
//                $variationproducts = Products::where('product_variation_id','=', $product->product_variation_id)->orWhere('_id','=',$product->product_variation_id)->get();
//            }
//            else {
//                $variationproducts = Products::where('_id','=', $productid)->orWhere('product_variation_id','=',$productid)->get();
//            }
             
            // return view('backend.catalog.products.view_product_variations',compact('variationproducts','attrVarIds'));

//        $productid = $data['productid'];     
//
//        $productdata = Products::where('_id','=', $productid)->first();
//
//        $newproduct = new Products();
//        $newproduct->userid = Auth::user()->id;
//        $newproduct->desc = $productdata->desc;
//        $newproduct->company_id = $productdata->company_id;
//        $newproduct->postedby = $productdata->postedby;
//        $newproduct->purpose = $productdata->purpose;
//        $newproduct->thumb = $productdata->thumb;
//        $newproduct->thumb_path = $productdata->thumb_path;
//        $newproduct->product_images = "";
//        $newproduct->postdate = $productdata->postdate;
//        $newproduct->product_id = $productid;
//        $newproduct->product_data = $productdata->product_data;
//        $newproduct->shopid = $productdata->shopid;
//        $newproduct->postedby = $productdata->postedby;
//        $newproduct->cat_ids = $productdata->cat_ids;
//        $newproduct->seo_title = $productdata->seo_title;
//        $newproduct->seo_description = $productdata->seo_description;
//        $newproduct->seo_keywords = $productdata->seo_keywords;
//        $newproduct->status = "disabled";
//        $newproduct->disable_edit="Yes";
//        $newproduct->duplicate = '';
//        $newproduct->type = "temporary";
//
//        if(isset($productdata->product_variation_id)){
//            $newproduct->product_variation_id = $productdata->product_variation_id;
//        }
//        else {
//            $newproduct->product_variation_id = $productid;
//        }
//
//        if($newproduct->save()){
//             if(isset($productdata->product_variation_id)){
//                 $productid = Products::where('product_variation_id','=', $productdata->product_variation_id)->where('shopid','=',$productdata->shopid)->where('userid','=',Auth::user()->id)->first();
//             }
//             else {
//                 $productid = Products::where('product_variation_id','=', $productid)->where('shopid','=',$productdata->shopid)->where('userid','=',Auth::user()->id)->first();
//             }
//
//            return Redirect::route('productvariation.edit', $productid->_id);
//        }
//        else {
//            return redirect()->back()->with('message','Product could not be Duplicated! Please try Again');
//        }
   }
   
   
    public function viewVariation($id){
        if(Auth::user()){
            $fieldattr = array();
            $product = Products::find($id);
           
             $variationfields = ProductVariationFields::where('status','=','1')->get();
             foreach($variationfields as $key=>$fields){
                 if(array_key_exists($fields->attr_id, $product->product_data)){
                     $attrVarIds[] = $fields->attr_id;
                 }
             }
             
             ksort($attrVarIds);
             
             $imageattrs = array('47','48','49');

             $attributes = Attributes::where('lang','en')->get();
             foreach($attributes as $attribute){
                 $fieldattr[$attribute->attr_id] = $attribute->desc;
             }

             if(isset($product->product_variation_id)){
                 $variationproducts = Products::where('product_variation_id','=', $product->product_variation_id)->orWhere('_id','=',$product->product_variation_id)->get();
             }
             else {
                 $variationproducts = Products::where('_id','=', $id)->orWhere('product_variation_id','=',$id)->get();
             }
             
//             echo "<pre>";
//             print_r($variationproducts[0]);
//             exit;

            return view('backend.catalog.products.view_product_variations',compact('variationproducts','attrVarIds','fieldattr','imageattrs','id'));
        }
        else{
            return redirect('auth/login')->with('message',"You must be login!"); 
        }
    }

    public function verifyProductVariation($id){
      if(Auth::user()){
              $fields = array();
              $variations = array();
              $data = Request::all();
              $product = Products::find($id);
              $save = $this->updateProduct($id, $data, $product);
              if($save==='success'){

                  $varproduct = Products::where('_id', $id)->first(); 
                  $mainproduct = Products::where('_id', $product->product_variation_id)->first();

                  $catAnsForAttr = $this->fetchAncestorsForAll($product->cat_ids);
                  $attrForCats = $this->fetchAttributesIds($catAnsForAttr);
                  sort($attrForCats);

                  foreach($attrForCats as $attrForCatk => $attrForCat){
                      $attributes = Attributes::where('attr_id', strval($attrForCat) )->where('lang', '=', 'en')->first();
                      $fields[$attributes->attr_id] = $attributes->label;
                  }

                  $prodvariations = ProductVariationAttributes::where('status','1')->get();
                  foreach($prodvariations as $variation){
                      $variations[] = $variation->attr_id;
                  }

                  return view('backend.catalog.products.view_variation',compact('id','mainproduct','varproduct','fields','variations'));
              }
              else {
                  return redirect()->back()->with('message','Product Details could not be Updated. Please try Again.');
              }

              if($product->save()){
                  if($data['flag']==='product_variation'){
                      Session::flash('message', 'Product Variation Created Successfully');
                      return view('backend.catalog.products.verify_variation',compact('productid'))->with('message','Product Variation Added Successfully');
                  }
                  else {
                      Session::flash('message', 'Product Details Updated Successfully');
                      return Redirect::route("products/list");
                  } 
              }

      }
      else {
          return redirect('auth/login')->with('message',"You must be login!"); 
      }  
  }
    
    public function updateProductVariation($id){
        if(Auth::user()){
            $product = Products::find($id);
            if(isset($product->product_variation_id)){
                $variationproducts = Products::where('product_variation_id','=', $product->product_variation_id)->orWhere('_id','=',$product->product_variation_id)->where('type','=','temporary')->get();
            }
            else {
                $variationproducts = Products::where('_id','=', $id)->orWhere('product_variation_id','=',$id)->get();
            }
 
            $i = 0;
            foreach($variationproducts as $products){
                $products->type = "";
                $products->save();
                $i++;
            }
            
            if($variationproducts->count() === $i){
                Session::flash('message', 'Product Variations Added Successfully');
                return Redirect::route('products/list');
            }
            else {
                return redirect()->back()->with('message','Something went wrong! The Product could not be created successfully.');
            }
        }
        else {
            return redirect('auth/login')->with('message',"You must be login!"); 
        }
    }
            
    function getSites($userid){
      try{
        $sites = Request::get('sub_user_sites');
        if(!empty($sites)){
            foreach ($sites as $slug){
              $sites_[$slug] = $this->SiteName($slug);
            }
        }
        else{
            $sites = EcomShops::where('user_id', $userid )->get();
            $sites_=array();
            //$a_types= AttributesType::where('lang', '=', 'en')->get();//all(array('id','label'));
            foreach ($sites as $site) {
              $sites_[$site->slug] = $site->ecomm_company_name;
            }
        }
         return $sites_;
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                          "Line Number: ".$e->getLine()." ".
                          "File Name: ".$e->getFile()." ".
                          "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }
    
    public function deleteProduct($id){
        $delete = Products::find($id);        
        $delete->delete();
        Session::flash('message', 'Product Deleted Successfully');
        return redirect()->route('products/list')->with('message','Product Deleted Successfully');
    }
    
    public function updateProduct($id, $data, $product){ 
            $product->userid = $data['userid'];
            $product->shopid = $data['attr_id'][2];
            $product->postdate = $data['attr_id'][1];
            $product->desc = $data['attr_id'][3];
            $product->seo_title = $data['seo_title'];
            $product->seo_description = $data['seo_description'];
            $product->seo_keywords = $data['seo_keywords'];
            $product_images = array();
            $permission = 0777;

            $path = Auth::user()->directory_path."/products/".date('Y')."/".date('m')."/".date('d')."/";
            
            if($product->type!=='temporary'){
                if(isset($product->product_images)) {
                    if(!empty($product->product_images)){
                        foreach($product->product_images as $key=>$val){
                            $product_images[] = $val;
                        }
                    }
                }
            }

            foreach($data['product_images'] as $key => $val){
                if(gettype($val) === "object"){
                    $image = $val->getClientOriginalName();
                    $extension = $val->getClientOriginalExtension();
                    $size = $val->getSize();
                    $mime = $val->getMimeType();
                    if(substr($mime, 0, 5) == 'image') {
                        $filename = "prod-" . $this->randomString() . "-". time().".".$extension;  
                        $target_dir = $this->make_directory($path, $permission, true);
                        // $val->move( $target_dir, $filename);
                        $val->move($path, $filename);
                        
                        if(!in_array($path.$filename, $product_images)){
                            $product_images[] = $path.$filename;
                        }
                    }
                }
            }

            // Get the Image Object and Other Values and insert them into the Array.
            foreach($data['attr_id'] as $attr_id => $attr_val){
                if(gettype($attr_val) === "object"){
                    $image = $attr_val->getClientOriginalName();
                    $extension = $attr_val->getClientOriginalExtension();
                    $size = $attr_val->getSize();
                    $mime = $attr_val->getMimeType();
                    if(substr($mime, 0, 5) == 'image') {
                        if(!File::exists($path)) {
                            $target_dir = $this->make_directory($path, $permission, true);
                        }

                        $filename = "prod-" . $this->randomString() . "-". time().".".$extension; 
                        $attr_val->move($path, $filename);
                        $product->thumb = $filename;
                        $product->thumb_path = $path;
                    }
                    $product_attr[$attr_id] = $path.$filename;
                }
                else {
                    $product_attr[$attr_id] = $attr_val;
                }
            }

            // Insert the values into the array which are not present in Edit Form.
            foreach($product->product_data as $key=>$value){
                if(!array_key_exists($key, $product_attr)){
                    $product_attr[$key] = $value;
                }
            }

            $product->product_data = $product_attr;
            $product->product_images = $product_images;

            if($product->save()){
                return 'success'; 
            }
            else {
                return 'failure';
            }
    }    
    
    function createVariationProductForm($attrAssoc, $attrForCats, $product){    
        $formFields = array();
  
        $formFields[] = '<div class="card-header bgm-bluegray head-title"></div>';
        $formFields[] = Form::hidden('_id[]', $product->_id);
        
        // Looping through the Attribute Associations
        foreach ($attrAssoc as $k=>$v) {
          $formFieldsTemp = array();
          foreach($attrForCats as $attrForCatk => $attrForCat){
                $attributes = Attributes::where('attr_id', strval($attrForCat) )->where('class', '=', $k)->where('lang', '=', 'en')->first();
                
                if(count($attributes)){
                    $attr_id = $attributes->attr_id;
                    if(strpos($attr_id,';')!== false || strpos($attr_id,'/')!== false) {
                        $disabled = "disabled";
                    } else {
                      $disabled = "";
                    }
                    
                    if(isset($product->type)){
                        $type = $product->type;
                    }
                    else {
                        $type= '';
                    }
                    
                    $opt = array();
                    if($attributes->field_type === "TD" || $attributes->field_type === "TM" ){
                        // echo $attributes->dropdown_list ;
                        $dropopt = DropdownOptions::where('_id', $attributes->dropdown_list )->where('lang', '=', 'en')->first();
                        if(count($dropopt )){
                            foreach ($dropopt->options as $dropopt_) {
                                $opt[$dropopt_] = $dropopt_;
                            }
                        }
                    }
                    
                    //field type and length
                    $a_type = AttributesType::where('lang', '=', 'en')->Where('id', '=', $attributes->field_type)->project(array('label'))->first();
                    $fieldinfo = "<br/><small><i>";
                    $fieldinfo .= $a_type->label;
                    
                    if(!empty($attributes->len)){
                          $fieldinfo .= " (Length ". $attributes->len . ")";
                    }
                    
                    $fieldinfo .= "</i></small>"; 
                    $formFieldsTemp[]= $this->createVariationProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, $attributes->field_type, $attributes->len, "attr_".$attributes->class, $attributes->req, $opt, $disabled, $fieldinfo, $product, $attr_id);
               }                  
          }
          
          if(!empty($formFieldsTemp)){
              foreach ($formFieldsTemp as $formFieldsTempV) {
                  $formFields[] = $formFieldsTempV;
              }
              //$formFields[] = $formFieldsTemp[];
          } 
        }
        
        return $formFields;
    }

    function createVariationProductFormFields($attr_id, $label, $desc, $field_type, $len="", $class, $req="", $opt, $disabled="", $fieldinfo="", $product, $curr_attr){  
      
        if(!empty($product) && !empty($product->product_data[$curr_attr])){
            $value = $product->product_data[$curr_attr];
            $defaultValue = str_replace('â€“', '-', $value);
      }
      else {
         $defaultValue = "";
      }
      
        //$this->createProductFormFields($attr_id, $label, $desc, $field_type, $len, $class, $req);
        if($req==="M" || $req==="required") { $req="required";}else{ $req=""; }
        
        switch ($field_type) {
            case "TD":
                //if($label !==""){
                $field = "<div class='col-md-12 item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::select($attr_id.'[]', $opt, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => '---', $req, $disabled])
                            . $fieldinfo
                        . "</div>
                    </div>";                    
                break;
            case "TM":
                //if($label !==""){
                if(count($opt) > 20){
                  $hgt = 250;
                }else{
                  $hgt = 150;
                }
              
                $field = "<div class='col-md-12 item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::select($attr_id.'[]', $opt, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => '---', $req, $disabled, 'multiple', 'style'=>'height: '.$hgt.'px;'])
                            . $fieldinfo
                        . "</div>
                    </div>";                    
                break;    
            case "TA":
                //if($label !==""){
                $field = "<div class='col-md-12 item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::textarea($attr_id.'[]', $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => $label, $req, $disabled, 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
                break;      
            case "T":
                //if($label !==""){
                $field = "<div class='col-md-12 item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::text($attr_id.'[]', $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => $label, $req, $disabled, 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
                break;      
            case "Y":// Year
            case "N":
                //if($label !==""){
                $field = "<div class='col-md-12 item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::number($attr_id.'[]', $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => $label, $req, $disabled, 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
                break; 
            case "D":
                //if($label !==""){
                $field = "<div class='col-md-12 item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::date($attr_id.'[]', $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                 $req, $disabled, "min"=> date("Y-m-d"), 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
                break; 
            case "H":
                //if($label !==""){
                $field = "<div class='col-md-12 item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::time($attr_id.'[]', $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                 $req, $disabled, 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
                break;             
            case "I":
                //if($label !==""){
                $field = "<div class='col-md-12 item form-group ".$class."'>"
                            . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12','data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                            ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                                ."<div class='fileinput fileinput-new' data-provides='fileinput'>
                                    <div class='fileinput-preview thumbnail' data-trigger='fileinput'></div>
                                <div>
                                <span class='btn btn-info btn-file'>
                                    <span class='fileinput-new'>Select image</span>
                                    <span class='fileinput-exists'>Change</span>"
                                        . Form::file($attr_id.'[]', '', ['class' => 'form-control col-md-7 col-xs-12 upload-image','accept'=>'image/*',  $req, $disabled, 'maxlength'=> $len])
                                    ."</span>
                                <a href='#' class='btn btn-danger fileinput-exists' data-dismiss='fileinput'>Remove</a>
                            </div>
                        </div>"
                    . $fieldinfo                  
                . "</div>
              </div>";                  
                break;     
            case "F":
                //if($label !==""){
                $field = "<div class='col-md-12 item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::file($attr_id.'[]', '', ['class' => 'form-control col-md-7 col-xs-12 upload-file', 
                                 'accept'=>'file_extension', $req, $disabled, 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
                break;    
            case "U":
            case "UA":
            case "UE":
            case "UI":                
                //if($label !==""){
                $field = "<div class='col-md-12 item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::url($attr_id.'[]', $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => $label, $req, $disabled, 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
                break;            
            case "hidden":
                //$field=$this->createFieldHidden($attr_id, $field_type);
                $field = Form::hidden($attr_id.'[]', $val, $attributes = array());
                //Form::number('len', $attributes->len, ['class' => 'form-control col-md-7 col-xs-12', 'required'])
                break;
            case "CL":
                $field = "<div class='col-md-12 item form-group ".$class."'>"
                    . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                        'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                    ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                . "<div class='cp-container'><div class='input-group form-group'>
                    <!--span class='input-group-addon'><i class='zmdi zmdi-invert-colors'></i></span-->
                    <div class='fg-line dropdown'>"
                      . Form::text($attr_id.'[]', $defaultValue, ['class' => 'form-control cp-value', 'data-toggle'=>'dropdown', $req, $disabled])
                                                
                       . "<div class='dropdown-menu'>
                        <div class='color-picker' data-cp-default= $defaultValue ></div>
                      </div>

                      <i class='cp-value'></i>
                    </div>"
                    .$fieldinfo.
                    "</div>
                  </div>"
                    . "</div>
                </div>";               
                break;  
            default:
                $field="";
        }
        
        return $field;
        //Form::number('len', $attributes->len, ['class' => 'form-control col-md-7 col-xs-12', 'required'])
        //$this->createFieldHidden($attr_id, $label, $desc, $field_type, $len, $class, $req);
        
        
    }
    
    public function editVariation($id){

        $productid = $id;
        $product = Products::find($productid);        
        $flag = 'edit-variation';
        
        $productvariation = ProductVariationAttributes::where('status','=','1')->get();
        foreach($productvariation as $variation){
            $variationids[$variation->attr_id] = $variation->desc;
        }
            
        $variationfields = ProductVariationFields::where('status','=','1')->get();
        foreach($variationfields as $key=>$fields){
            if(array_key_exists($fields->attr_id, $product->product_data)){
                $varfields[$fields->attr_id] = $fields->desc;
                $attrForCats[] = $fields->attr_id;
            }
        }
            
        ksort($varfields);
        foreach($product->product_data as $key=>$value){
            if(array_key_exists($key, $varfields)){
                $prodvarfields[$key] = $value;
            }
        }

        $attrAssoc = $this->fetchAttributesAssoc();
        sort($attrForCats); 
        // Get all the Products to show the color, Price, Size of the Products on the top of the page.
        $productvars = Products::where('_id','=',$id)->orWhere('product_variation_id','=',$id)->get();
        
        $varproducts = Products::Where('product_variation_id','=', $id)->where('type','temporary')->get();
        
        foreach($varproducts as $prod){
            $variationProductForm[] = $this->createVariationProductForm($attrAssoc, $attrForCats, $prod);
        }
        
        return view('backend.catalog.products.verify_variation',compact('productid','productvars','variationids','flag','product','varfields','prodvarfields','variationProductForm','varproducts'));
        
    }


//    public function editProductVariation($id){
//        if(Auth::user()){
//             try {
//                $formFields= array();
//                $product = Products::find($id);
//                $userid = Auth::user()->id;
//                $purpose = $product->purpose;
//                $productaction = "edit-product-variation";
//                if(!empty($product)){
//                    $prod_cats = $product->cat_ids;
//                    //Fetch Ancestors of aall the selected categories
//                    $catAnsForAttr = $this->fetchAncestorsForAll($prod_cats);
//                    //Fetch Attr association/classifiction
//                    $attrAssoc = $this->fetchAttributesAssoc();
//                    //Fetch Attributes
//                    $attrForCats = $this->fetchAttributesIds($catAnsForAttr);
//                    sort($attrForCats);
//
//                    $prod_cats_name = array();
//                    foreach ($prod_cats as $prod_cat){
//                        $prod_cats_name[] = $this->fetchCatAncestors($prod_cat);
//                    }
//                   //Create Add Product form fields
//                    $formFields = $this->createProductForm($prod_cats,"", $attrAssoc, $attrForCats, $userid, $product, $productaction,$purpose); 
//                    
//                    return view('backend.catalog.products.edit_product', compact('formFields','id','flag','productaction','purpose'));
//                }
//                 
//             } catch (\Exception $e){
//                $error = "An error occured. ".
//                "Line Number: ".$e->getLine()." ".
//                "File Name: ".$e->getFile()." ".
//                "Error Description: ".$e->getMessage();
//                return view('errors.custom_error')->withErrors($error);
//            }
//        }
//    }
    
}