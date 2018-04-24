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
use DB;
use File;
use Form;
use Image;
use Input;
use UUID;

//updated by deep 19 sep 2016
class BackupProductsController extends Controller
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
            if($status==='error'){
                return redirect()->back()->withErrors('You can not enable this product without product image and product quantity. Please edit this product and fill these fields.');
            }
            else {
                return Redirect::route('products/list')->with('message', "Product has been ".$_GET['status']);
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
            if($status==='error'){
                return redirect()->back()->withErrors('You can not enable this product without product image and product quantity. Please edit this product and fill these fields.');
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

        if(empty($product->thumb) || empty($product->product_data[8])){
            $status = 'error';
        }
        else {
            if($_GET['status'] === "enabled"){
                DB::collection('products')->where('_id', $id)->update(['status'=>$_GET['status'], 'disable_edit'=>'Yes']);
            }
            else {
                DB::collection('products')->where('_id', $id)->update(['status'=>$_GET['status']]);
            }
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
            $rules = array(
                'prod_cats' => 'required',
                'prod_cats_name' => 'required',
                'userid'  => 'required'
            );

            $validator = Validator::make(Request::all(), $rules);
            if ($validator->fails()) {
                return Redirect::route('select_cat.index')
                    ->withErrors($validator);                        
            } else {
                //Process Add Product request

                //Fetch Ancestors of aall the selected categories
                $catAnsForAttr = $this->fetchAncestorsForAll($input['prod_cats']);
                //Fetch Attr association/classifiction
                $attrAssoc = $this->fetchAttributesAssoc();
                //Fetch Attributes 
                $attrForCats = $this->fetchAttributesIds($catAnsForAttr);
                sort($attrForCats);

                //Create Add Product form fields
                $productForm = $this->createProductForm($input['prod_cats'], $input['prod_cats_name'], $attrAssoc, $attrForCats, $input['userid']);

                return view('backend.catalog.products.add', compact('productForm'));
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
        $product = Products::find($id);
        
        $userid = Auth::user()->id;
//        var_dump($product);
//        return;
        
        if( !empty($product) ){
          $prod_cats = $product->cat_ids;
          
          //Fetch Ancestors of aall the selected categories
          $catAnsForAttr = $this->fetchAncestorsForAll($prod_cats );
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
          $productForm = $this->createProductForm($prod_cats, $prod_cats_name, $attrAssoc, $attrForCats, $userid, $product);
          
          return view('backend.catalog.products.add', compact('productForm'));
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
   //        ;
    }    
    
    function createProductForm($prod_cats, $prod_cats_name, $attrAssoc, $attrForCats, $userid, $product=''){
      $formFields = array();
 
      if($prod_cats_name){
            $formFields[] = '<div class="card">';
            $formFields[] = '<div class="card-header bgm-green"><h2>You have selected the following categories</h2></div>';
            $formFields[] = '<div style="padding: 26px 178px" class="card-body card-padding">';
            foreach($prod_cats_name as $prod_cats_name_){
                $formFields[]='<h6><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> &nbsp;&nbsp; '.$prod_cats_name_.'</h6>';
            }
            $formFields[] = '</div></div>';
            
            $formFields[] = '<div class="card">';
            $formFields[] = '<div class="card-header bgm-red"><h2>What do you want to do</h2></div>';
            $formFields[] = '<div class="card-body card-padding"><label class="radio-inline m-r-20">';   
            $formFields[] = Form::radio('prod_type', 'sell',false, ['required']) . ' &nbsp; <font size="2"><b>I Want to sell my product or service</b></font>';
            $formFields[] = '</label><label class="radio-inline m-r-20">';
            $formFields[] = Form::radio('prod_type', 'buy',false, ['required']) . ' &nbsp; <font size="2"><b>I Want to Buy product I need for my business</b></font>';
            $formFields[] = '</label></div></div>';
      }
    
      
      foreach($prod_cats as $prod_cat){
          $formFields[] = $this->createProductFormFields("cat_id[]", "", "", "hidden", "", "", "","", $prod_cat);
      }

      $formFields[] = $this->createProductFormFields("userid", "", "", "hidden", "", "", "","", $userid);
      
      foreach ($attrAssoc as $k=>$v) {
        $formFieldsTemp = array();
        
        foreach($attrForCats as $attrForCatk => $attrForCat){
          $attributes = Attributes::where('attr_id', strval($attrForCat) )->where('class', '=', $k)->where('lang', '=', 'en')->first();
 
          if(count($attributes)){
                $attr_id = $attributes->attr_id;

                if (strpos($attr_id,';') !== false || strpos($attr_id,'/') !== false) {
                    $disabled = "disabled";
                } else {
                  $disabled = "";
                }

            if($attr_id === '2' || $attr_id === 2){
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

                  $formFieldsTemp[]= $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, $attributes->field_type, $attributes->len, "attr_".$attributes->class, $attributes->req,$opt, "",$disabled, $fieldinfo, $product,$attr_id);
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
                                <div class='col-md-6 col-sm-6 col-xs-12'>
                                    <input type='text' id='seo_title' name='seo_title' class='form-control' placeholder='SEO Title'>    
                                </div>
                            </div>
            
                            <div class='form-group clearfix'>
                                <label for='seo_description' class='control-label col-md-3 col-sm-3 col-xs-12'>SEO Description</label>
                                <div class='col-md-6 col-sm-6 col-xs-12'>
                                    <input type='text' id='seo_description' name='seo_description' class='form-control' placeholder='SEO Description'>  
                                </div>
                            </div>
            
                            <div class='form-group clearfix'>
                                <label for='seo_keywords' class='control-label col-md-3 col-sm-3 col-xs-12'>SEO Keywords</label>
                                <div class='col-md-6 col-sm-6 col-xs-12'>
                                    <input type='text' id='seo_keywords' name='seo_keywords' class='form-control' placeholder='SEO Keywords'> 
                                </div>
                            </div>
                        <br />
                   </div>";
      
      
            $formFields[]= '<div class="card">
                <div class="card-header bgm-bluegray"><h2>Product Images</h2></div>  
                <div class="item form-group">
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
        return $formFields;
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
    
    function createProductFormFields($attr_id, $label="", $desc="", $field_type="", $len="", $class="", $req="",$opt, $val="",$disabled="", $fieldinfo ="", $product="", $curr_attr=""){
      
      if(!empty($product) && !empty($product->product_data[$curr_attr]) ){
        $value = $product->product_data[$curr_attr] ;
        $defaultValue = str_replace('–', '-', $value);
      }
      else {
         $defaultValue="";
      }
      
        //$this->createProductFormFields($attr_id, $label, $desc, $field_type, $len, $class, $req);
        if($req==="M" || $req==="required"){ $req="required";}else{ $req=""; }
//        $req="";
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
            case "Y":            // Year
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
    
//    function createFieldHidden($attr_id, $field_type){
//        
//    }

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
      try{
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
        $product->purpose = Request::get('prod_type');
        $product->cat_ids = Request::get('cat_id');
        $product->postdate = $input['attr_id'][1];
        $product->desc = $input['attr_id'][3];
        $product->thumb = "";
        $product->thumb_path = "";
        
        
        $product_attr = array();
        $product_images = array();
        $path = Auth::user()->directory_path."/products/".date('m')."/".date('d')."/";
        $permission = 0777;
        
        foreach($input['product_images'] as $key => $val){
            if(gettype($val) === "object"){
                $image = $val->getClientOriginalName();
                $extension = $val->getClientOriginalExtension();
                $size = $val->getSize();
                $mime = $val->getMimeType();
                if(substr($mime, 0, 5) == 'image') {
                    if(!File::exists($path)) {
                        $target_dir = $this->make_directory($path, $permission, true);
                    }
                   
                    $filename = "prod-" . $this->randomString() . "-". time().".".$extension;  
                 // $val->move( $target_dir, $filename);
                    $val->move($path, $filename);
                    $product_images[] = $path.$filename;
                }
            }
        }    

        foreach($input['attr_id'] as $attr_id => $attr_val){
//      $attributes= Attributes::where('attr_id', '=', strval($attr_id) )->where('lang', '=', 'en')->project( array('label') )->first();
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
                return Redirect::route('products/variation',['productid'=>$productids->_id])->with('message','The Product is Successfully Created.');
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
            else{
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
//        $currentid=$input['category_id'];
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
 
    public function editEcosystemProduct($id){
      if(Auth::user()){
        try {
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '36')->where('group','business_ecosystem')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                
                $product = Products::find($id);
                $attrAssoc = $this->fetchAttributesAssoc();
                
                //Fetch Attributes 
                $multItemAttr = ProductHiddenAttributes::where('type','multiitem')->first();
                $attrForCats = $multItemAttr->attr_ids;
                sort($attrForCats);
        
                $formFields = array();
                $formFields[] = $this->createProductFormFields("userid", "", "", "hidden", "", "", "","", Auth::user()->id);
                foreach ($attrAssoc as $k=>$v) {
                    $formFieldsTemp = array();

                    foreach($attrForCats as $attrForCatk => $attrForCat){
                      $attributes = Attribute::where('attr_id', strval($attrForCat) )->where('class', '=', $k)->where('lang', '=', 'en')->first();
                      if(!empty($attributes)){
                        $attr_id = $attributes->attr_id;
                        if (strpos($attr_id,';') !== false || strpos($attr_id,'/') !== false) {
                            $disabled = "disabled";
                        }
                        else {
                          $disabled = "";
                        }
                        
                        if($attr_id === '2' || $attr_id === 2){
                          $sites = $this->getSites(Auth::user()->id);
                          
                          $siteslug= array();
                          foreach ($sites as $key => $value) {
                              $siteslug[$key]= $value;
                          }
                          
                          $formFieldsTemp[] = $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, "TD", $attributes->len, "attr_".$attributes->class, $attributes->req, $siteslug, "",$disabled,'',$product,$attr_id);
                        }
                        else {
                                $opt = array();
                                if($attributes->field_type === "TD" || $attributes->field_type === "TM" ){
                                    $dropopt =  DropdownOptions::where('_id', $attributes->dropdown_list )->where('lang', '=', 'en')->first();
                                    if(count($dropopt )){
                                        foreach ($dropopt->options as $dropopt_) {
                                            $opt[$dropopt_]=$dropopt_;
                                        }
                                    }
                                }

                                //field type and length
                                $a_type= AttributesType::where('lang', '=', 'en')->Where('id', '=', $attributes->field_type)->project(array('label'))->first();
                                $fieldinfo = "<br/><small><i>";
                                $fieldinfo .= $a_type->label;
                                if(!empty($attributes->len)){
                                    $fieldinfo .= " (Length ". $attributes->len . ")";
                                }
                                $fieldinfo .= "</i></small>";

                                $formFieldsTemp[]= $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, $attributes->field_type, $attributes->len, "attr_".$attributes->class, $attributes->req, $opt, "", $disabled, $fieldinfo, $product, $attr_id);
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
                    return view('backend.catalog.products.ecosys_edit_product', compact('nav_menu','route','formFields','id'));
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
    
    public function storeEcosysProductDetails($id){
      if(Auth::user()){
        try {
                $data = Request::all();
                $product =  Products::find($id);
                $product->userid = $data['userid'];
                $product->shopid = $data['attr_id'][2];
                $product->postdate = $data['attr_id'][1];
                $product->desc = $data['attr_id'][3];
                $product->product_data = $data['attr_id'];

                if($product->save()){
                    Session::flash('message', 'Product Details Updated Successfully');
                    return Redirect::route("ecosys.product.index", ['site_slug'=>$data['attr_id'][2]]);
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
//                $product = Products::find($id);
//                $userid = Auth::user()->id;
//                
//                if(!empty($product)){
//                    $prod_cats = $product->cat_ids;
//
//                    //Fetch Ancestors of aall the selected categories
//                    $catAnsForAttr = $this->fetchAncestorsForAll($prod_cats );
//                    //Fetch Attr association/classifiction
//                    $attrAssoc = $this->fetchAttributesAssoc();
//                    //Fetch Attributes 
//                    $attrForCats = $this->fetchAttributesIds($catAnsForAttr);
//                    sort($attrForCats);
//
//                    $prod_cats_name = array();
//                    foreach ($prod_cats as $prod_cat){
//                      $prod_cats_name[] = $this->fetchCatAncestors($prod_cat);
//                    }
//
//                   //Create Add Product form fields
//                    $formFields = $this->createProductForm($prod_cats, "", $attrAssoc, $attrForCats, $userid, $product);
//                    return view('backend.catalog.products.edit_product', compact('formFields','id'));
//                  }
                
        
                $formFields = array();
                
//                $formFields[] = $this->createProductFormFields("userid", "", "", "hidden", "", "", "","", Auth::user()->id);
//                foreach ($attrAssoc as $k=>$v) {
//                    $formFieldsTemp = array();
//
//                    foreach($attrForCats as $attrForCatk => $attrForCat){
//                        $attributes = Attribute::where('attr_id', strval($attrForCat) )->where('class', '=', $k)->where('lang', '=', 'en')->first();
//          
//                        if(!empty($attributes)){
//                        $attr_id = $attributes->attr_id;
//                        if (strpos($attr_id,';') !== false || strpos($attr_id,'/') !== false) {
//                            $disabled = "disabled";
//                        }
//                        else {
//                          $disabled = "";
//                        }
//                        
//                        if($attr_id === '2' || $attr_id === 2){
//                          $sites = $this->getSites(Auth::user()->id);
//                          
//                          $siteslug= array();
//                          foreach ($sites as $key => $value) {
//                              $siteslug[$key]= $value;
//                          }
//                          
//                          $formFieldsTemp[] = $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, "TD", $attributes->len, "attr_".$attributes->class, $attributes->req, $siteslug, "",$disabled,'',$product,$attr_id);
//                        }
//                        else {
//                                $opt = array();
//                                if($attributes->field_type === "TD" || $attributes->field_type === "TM" ){
//                                    $dropopt =  DropdownOptions::where('_id', $attributes->dropdown_list )->where('lang', '=', 'en')->first();
//                                    if(count($dropopt )){
//                                        foreach ($dropopt->options as $dropopt_) {
//                                            $opt[$dropopt_] = $dropopt_;
//                                        }
//                                    }
//                                }
//
//                                //field type and length
//                                $a_type= AttributesType::where('lang', '=', 'en')->Where('id', '=', $attributes->field_type)->project(array('label'))->first();
//                                $fieldinfo = "<br/><small><i>";
//                                $fieldinfo .= $a_type->label;
//                                if(!empty($attributes->len)){
//                                    $fieldinfo .= " (Length ". $attributes->len . ")";
//                                }
//                                $fieldinfo .= "</i></small>";
//
//                                $formFieldsTemp[]= $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, $attributes->field_type, $attributes->len, "attr_".$attributes->class, $attributes->req, $opt, "", $disabled, $fieldinfo, $product, $attr_id);
//                            }                   
//                        }           
//                    }
//
//                    if(!empty($formFieldsTemp)){
//                       $formFields[] = '<div class="card">';
//                       $formFields[] = '<div class="card-header bgm-bluegray"><h2>'.$v.'</h2></div>';// "<hr/><h4>$v</h4><hr/>";
//                       $formFields[] = '<div class="card-body card-padding">';
//                       foreach ($formFieldsTemp as $formFieldsTempV) {
//                           $formFields[] = $formFieldsTempV;
//                       }
//                       $formFields[] = '</div></div>';
//                     }
//                  }
                  
                    $formFields[]= "<div class='card'>
                        <div class='card-header bgm-bluegray'><h2>SEO Details</h2></div>  
                            <div class='form-group clearfix'>
                                <label for='seo_title' class='control-label col-md-3 col-sm-3 col-xs-12'>SEO Title</label>
                                <div class='col-md-6 col-sm-6 col-xs-12'>
                                    <input type='text' value='".$product->seo_title."' id='seo_title' name='seo_title' class='form-control' placeholder='SEO Title'>    
                                </div>
                            </div>
            
                            <div class='form-group clearfix'>
                                <label for='seo_description' class='control-label col-md-3 col-sm-3 col-xs-12'>SEO Description</label>
                                <div class='col-md-6 col-sm-6 col-xs-12'>
                                    <input type='text' value='".$product->seo_description."' id='seo_description' name='seo_description' class='form-control' placeholder='SEO Description'>  
                                </div>
                            </div>
            
                            <div class='form-group clearfix'>
                                <label for='seo_keywords' class='control-label col-md-3 col-sm-3 col-xs-12'>SEO Keywords</label>
                                <div class='col-md-6 col-sm-6 col-xs-12'>
                                    <input type='text' value='".$product->seo_keywords."' id='seo_keywords' name='seo_keywords' class='form-control' placeholder='SEO Keywords'> 
                                </div>
                            </div>
                        <br />
                   </div>";
                  
                    $formFields[] = '<div class="card">
                        <div class="card-header bgm-bluegray"><h2>Product Images</h2></div>';
                            if (isset($product->product_images)) {
                                $formFields[] = '<div class="card-body card-padding-sm">';                  
                                    $formFields[] = '<div class="row">';
                                        foreach($product->product_images as $key=>$val){
                                            $formFields[] = '<div class="col-md-3 col-sm-6 col-xs-6">
                                                        <img width="200" height="200" src="'.asset($val).'" alt="">
                                                        <div class="delete_image" data_product_id="'.$product->_id.'" data_img-name="'.$val.'"><a href="">Delete This Image</a></div>
                                                    </div>';
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
                $product->userid = $data['userid'];
                $product->shopid = $data['attr_id'][2];
                $product->postdate = $data['attr_id'][1];
                $product->desc = $data['attr_id'][3];
                $product->product_data = $data['attr_id'];
                
                $product_images = array();
                if (isset($product->product_images)) {
                    foreach($product->product_images as $key=>$val){
                        $product_images[] = $val;
                    }
                }
                
        
                foreach($data['product_images'] as $key => $val){
                    if(gettype($val) === "object"){
                        $image = $val->getClientOriginalName();
                        $extension = $val->getClientOriginalExtension();
                        $size = $val->getSize();
                        $mime = $val->getMimeType();
                        if(substr($mime, 0, 5) == 'image') {
                            $path = Auth::user()->directory_path."/products/".date('m')."/".date('d')."/";
                            $permission = 0777;
                            $filename = "prod-" . $this->randomString() . "-". time().".".$extension;  
                            $target_dir = $this->make_directory($path, $permission, true);
                            // $val->move( $target_dir, $filename);
                            $val->move( $path, $filename);
                            $product_images[] = $path.$filename;
                        }
                    }
                }
                
                $product->product_images = $product_images;

                if($product->save()){
                    Session::flash('message', 'Product Details Updated Successfully');
                    return Redirect::route("products/list");
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
        try {
            if(Auth::user()){
                $request = Request::all();
                $image_name = $request['image_name'];
                $productid = $request['product_id'];
                if(DB::collection('products')->where('_id', $productid)->pull('product_images', $image_name)){
                    return 'success';
                }
                else {
                    return 'failure';
                }
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Chat!");
            }
        }
        catch (\Exception $e) {
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
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
            $productid = $data['product_id'];
            return view('backend.catalog.products.verify_variation',compact('productid'));
        }
        else {
            return redirect('auth/login')->with('message',"Please Login to Chat!");
         }
    }
    
    public function createVariation(){
        $data = Request::all();
        $productid = $data['productid'];     
        
        $productdata = Products::where('_id','=', $productid)->first();

        $product = new Products();
        $product->userid = Auth::user()->id;
        $product->desc = $productdata->desc;
        $product->company_id = $productdata->company_id;
        $product->postedby = $productdata->postedby;
        $product->purpose = $productdata->purpose;
        $product->thumb = $productdata->thumb;
        $product->thumb_path = $productdata->thumb_path;
        $product->product_variation_id = $productid;
        $product->product_images = $productdata->product_images;
        $product->postdate = $productdata->postdate;
        $product->product_id = $productid;
        $product->product_data = $productdata->product_data;
        $product->shopid = $productdata->shopid;
        $product->postedby = $productdata->postedby;
        $product->purpose = $productdata->sell;
        $product->cat_ids = $productdata->cat_ids;
        $product->status = "enabled";
        $product->disable_edit="Yes";
        $product->duplicate = '';
        
        if($product->save()){
            $productid = Products::where('product_variation_id','=', $productid)->where('shopid','=',$productdata->shopid)->where('userid','=',Auth::user()->id)->first();
            return Redirect::route('product.edit', $productid->_id);
        }
        else {
            return redirect()->back()->with('message','Product could not be Duplicated! Please try Again');
        }
    }
    
    
    
}
