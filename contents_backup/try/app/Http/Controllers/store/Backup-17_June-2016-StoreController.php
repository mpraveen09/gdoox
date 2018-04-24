<?php

namespace Gdoox\Http\Controllers\store;
use Gdoox\Helpers\UUID;
use Carbon\Carbon;
use DB;
use Mail;
use DateTime;
use Gdoox\User;
use Gdoox\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Gdoox\Models\PersonalSiteDetail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\Categories;
use Gdoox\Models\Attributes;
use Gdoox\Models\AttributesAssoc;
use Gdoox\Models\AttributesType;
use Gdoox\Models\DropdownOptions;
use Gdoox\Models\CategoryAttribute;
use Gdoox\Models\SiteLogo;
use Gdoox\Models\Products;
use Gdoox\SubUser;
use Gdoox\Models\EcomShops;
use Gdoox\Models\BusinessInfo;
use Gdoox\Models\ShoppingCart;
use Gdoox\Models\WishList;
use Gdoox\Models\CmsSite;
use Gdoox\Models\ProductPromotionalBanner;
use Gdoox\Models\ProductReviews;
use Gdoox\Models\SellerReviews;
use Gdoox\Models\SiteHeaderImage;
use Gdoox\Models\BusinessEcommerceCompany;
use Illuminate\Support\Facades\Auth;
use Gdoox\Models\DropdownOption;
use Gdoox\Models\SocialInfo;
use Gdoox\Models\ProductCatalog;
use Gdoox\Models\CertificationLogos;
use Gdoox\Models\BusinessPartner;
use Gdoox\Models\SharedProducts;
use Gdoox\Models\ProductVariationAttributes;
use Form;
use Image;
use Input;

class BackupStoreController extends Controller
{
    use \Gdoox\Helpers\backend\dashboard\RolesUsers;
    use \Gdoox\Helpers\backend\dashboard\HelperFunctions;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(){
        try {
            $limit = 20;
            $frm_date= '';
            $t_date='';
            $company_name ='';
            $country_name ='';
            $currency_name='';     
            $filtered_cat= array();
            $prod_cats = array();
            $prod_cats_count = array();
            $products_counts = array(); 
            $products_list= array();
            $country = array();
            $projections = array('cat_ids', 'shopid', 'desc', 'postdate', 'product_data', 'thumb', '_id', 'thumb_path');
            $term = Request::all();

            if(!empty($term['from_date']) && !empty($term['to_date'])){
               $rules = array('to_date' => 'after:from_date');
               $validator = Validator::make(Request::all(), $rules);
               if ($validator->fails()) {
                   return Redirect::route('marketplace')->withErrors($validator);                        
               }
            }


            if(array_key_exists('cat_id', $term)){
                $filtered_cat = $term['cat_id'];
            }
            $maximum_product_price = Products::max('product_data.15');
            $minimum_product_price = Products::min('product_data.15');
            
            if(!empty($term['min_price'])){
                $min_price= $term['min_price'];
            }
            else{ $min_price = $minimum_product_price;}

            if(!empty($term['max_price'])){
                $max_price = $term['max_price'];
            }
            else{ $max_price = $maximum_product_price;}

            // New Query Search Filter According to Conditions
           $builder = Products::query();
           $option =  DropdownOptions::where('attr_id', "14" )->where('lang', '=', 'en')->first();
           $builder->whereIn('product_data.14', $option->options);

            if(!empty($term['sale_type'])){
                $builder->where('product_data.14', $term['sale_type']);
            }
            if(array_key_exists('cat_id', $term)) {
                $builder->whereIn('cat_ids', $filtered_cat);
            }

            if(!empty($term['from_date'])){
               $frm_date = $term['from_date'];
               $from_date = date('Y-m-d',strtotime($term['from_date']));
               if(empty($term['to_date'])){
                   $to_date = date('Y-m-d');
               }
            }
            
            if(!empty($term['to_date'])){
              $t_date= $term['to_date'];
              $to_date= date('Y-m-d',strtotime($term['to_date']));
              if(empty($term['from_date'])){
                   $from_date= date('Y-m-d');
               }
            }
            

            if(!empty($from_date) && !empty($to_date)){
                $builder->whereBetween('postdate', array($from_date, $to_date));
            }

            if(!empty($term['company_name'])){
                 $company_name = $term['company_name'];
                 $builder->whereIn('shopid', $term['company_name']);
            }

            if(!empty($term['country_name'])){
                 $country_name= $term['country_name'];
                 $builder->whereIn('product_data.35', $term['country_name']);
            }
            

            if(!empty($term['currency_name'])){
                $currency_name=$term['currency_name'];
                if(!empty($term['min_price']) && !empty($term['max_price'])){
                    $builder->whereBetween('product_data.15', array($term['min_price'], $term['max_price']))->where('product_data.13','=', $term['currency_name']);
                }
                else {
                    $builder->where('product_data.13','=', $term['currency_name']);
                }
            } 

            $users = User::where('name', '=', 'John')->orWhere(function($query){
                $query->where('votes', '>', 100)->where('title', '<>', 'Admin');
            })->get();


            if(!empty($term['min_price']) && !empty($term['max_price'])){
                 $builder->whereBetween('product_data.15', array($term['min_price'], $term['max_price']));
            }
            
            if(!empty($term['keyword'])){
                $key_val = $term['keyword'].'%';
                $builder->where('desc','like', $key_val)->orWhere('product_data.3','like',$key_val)->orWhere('product_data.6','like',$key_val)->orWhere('product_data.7','like',$key_val);
            }
            
            $products = $builder->orderBy('_id')
                ->where('product_type', '!=', 'opportunities')
                ->where('postdate', '<=', date("Y-m-d"))
                ->where('status', '=', 'enabled')
                ->where('share_status.flag','!=', '0')
                ->paginate($limit, $projections);

            foreach ($products as $product) {
                foreach ($product->cat_ids as $cat) {
                      $catinfo = Categories::where("cat_id","=",$cat)->where("lang", "=", "en")->project(array('name'))->first();
                      $prod_cats[$cat]= $catinfo->name;
                      $prod_cats_count[$cat][] = $cat;
                }
            }
            
            foreach ($prod_cats as $cat_id => $cat_name) {
                $products_counts[$cat_id] = count($prod_cats_count[$cat_id]);
            }

            foreach ($prod_cats as $cat_id => $cat_name) {
               $sub_cat_id= explode('-', $cat_id);
               $categories= Categories::where('lang', '=', 'en')->Where('parent', '=', 0)->Where('cat_id', '=', $sub_cat_id[0])->project( array('name') )->first();
               $products_list[$sub_cat_id[0]]['name']= $categories->name;
               $products_list[$sub_cat_id[0]]['values'][$cat_id]= $cat_name;    
          }

           
            $countries =  DropdownOptions::where('attr_id','=','35')->first();
            if(!empty($countries)){
                foreach($countries->options as $countryname){
                  $country[$countryname] = $countryname;
                }
            }

           // $currency= array();
            $currencies= DropdownOptions::where('attr_id','=','13')->first();
            if(!empty($currencies)){
                foreach($currencies->options as $key=>$cur){
                    $currency[$cur] = $cur;
                }
            }

            $companies= BusinessEcommerceCompany::where('slug', '!=', '')->get();
            if(!empty($companies)){
                foreach($companies as $company){
                  $com[$company->slug] = $company->ecomm_company_name;
                }
            }

            return view('store.index', compact('products', 'products_counts', 'products_list', 'filtered_cat', 'com', 
                  'country', 'currency', 'maximum_product_price', 'minimum_product_price'))
                  ->with('min_price', $min_price)->with('max_price', $max_price)->with('country_name', $country_name)
                  ->with('currency_name', $currency_name)
                  ->with('company_name', $company_name)->with('frm_date', $frm_date)->with('t_date', $t_date);
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    public function siteHome($shopid) {
        try {

        $limit = 20;
        $keyword=''; 
        $frm_date= '';
        $t_date='';
        $company_name= ''; 
        $currency_name='';
        $country_name='';
        $prod_cats = array();
        $prod_cats_count = array();
        $products_counts = array();   
        $products_list= array();
        $projections = array('cat_ids', 'desc', 'postdate', 'product_data', 'thumb', '_id', 'thumb_path');
        
        $term = Request::all();
        $personalsitedetails = PersonalSiteDetail::where('slug', '=', $shopid)->first();
        $siteimages= SiteHeaderImage::where('site_slug', $shopid)->where('status', "1")->get();
        $site_menu= FieldMaster::where('title', '=', 'personal_site_menu')->first();

        if(!empty($personalsitedetails)){
          $sitetype = "personal";
          $storename = PersonalSiteDetail::where('slug', '=', $shopid)->where('type', '=', 'personal')->first();
          $sitelogo=  User::where('_id', $personalsitedetails->user_id)->first();
          $owner=  $this->GetUserName($personalsitedetails->user_id);
//        $business = $storename;
//        $business->company_image = $business->site_image;
//        $business->company_logo = $business->site_logo;

//        CMS page links
          $cmspages = CmsSite::where('slug', '=', $shopid)->Where('status', '=', '1')
                  ->project( array('page_title') )->orderBy('sort_order', 'asc')->get();

//        Session::flash('message', 'This is non-ecommerce website.');
           return view('site.personal.index', compact('owner', 'site_menu', 'storename', 'sitetype',  
                   'personalsitedetails', 'business', 'shopid', 'cmspages', 'sitelogo', 'siteimages'));
        }
            
        $sitelogo=  SiteLogo::where('shop_id', $shopid)->first();
        $certificationlogo=  CertificationLogos::where('site_slug', $shopid)->where('status', "1")->get();
        // Site/Business Name and Pages
        $storename= EcomShops::where('slug', '=', $shopid)->first();
        if(empty($storename)){
              Session::flash('message', 'Requested site not present.');
              return Redirect::route('marketplace');      
        }
        $business = BusinessInfo::where('company_name', '=', $storename->company)->first();
        //CMS page links
        $cmspages = CmsSite::where('slug', '=', $shopid)->Where('status', '=', '1')->project( array('page_title') )
            ->orderBy('sort_order', 'asc')->get();

        //    Search Filter
        if(!empty($term['from_date']) && !empty($term['to_date'])){
           $rules = array('to_date' => 'after:from_date');
            $validator = Validator::make(Request::all(), $rules);
            if ($validator->fails()) {
                return Redirect::route('marketplace')->withErrors($validator);                        
            }
         }
        //    End Search Filter

        $filtered_cat= array();
        $builder = Products::query();
        $option =  DropdownOptions::where('attr_id', "14" )->where('lang', '=', 'en')->first();
        $builder->whereIn('product_data.14', $option->options);

        if(!empty($term['sale_type'])){
            $builder->where('product_data.14', $term['sale_type']);
        }
        if(array_key_exists('cat_id', $term)){
            $filtered_cat = $term['cat_id'];
            $builder->whereIn('cat_ids', $filtered_cat);
        }
        else{}

        if(array_key_exists('keyword', $term)){
            $keyword= trim($term['keyword']);
            $builder->where("desc", "like", '%' . $keyword . '%');
        }
        
        $maximum_product_price = Products::where('shopid', '=', $shopid)->max('product_data.15');
        $minimum_product_price = Products::where('shopid', '=', $shopid)->min('product_data.15');

        if(!empty($term['min_price'])){
            $min_price = $term['min_price'];
        }
        else { 
            $min_price = $minimum_product_price;
        }

        if(!empty($term['max_price'])){
            $max_price= $term['max_price'];
        }
        else { 
            $max_price=$maximum_product_price;
        }
        
        if(!empty($term['from_date'])){
           $frm_date= $term['from_date'];
           $from_date= date('Y-m-d',strtotime($term['from_date']));
           if(empty($term['to_date'])){
               $to_date= date('Y-m-d');
           }
        }
        

        if(!empty($term['to_date'])){
           $t_date= $term['to_date'];
           $to_date= date('Y-m-d',strtotime($term['to_date']));
           if(empty($term['from_date'])){
                $from_date= date('Y-m-d');
            }
        }
        

        if(!empty($from_date) && !empty($to_date)){
            $builder->whereBetween('postdate', array($from_date, $to_date));
        }

        if(!empty($term['company_name'])){
             $company_name= $term['company_name'];
             $builder->whereIn('shopid', $term['company_name']);
        }
        

        if(!empty($term['country_name'])){
             $country_name= $term['country_name'];
             $builder->whereIn('product_data.35', $term['country_name']);
        }
        

        if(!empty($term['currency_name'])){
            $currency_name=$term['currency_name'];
            if(!empty($term['min_price']) && !empty($term['max_price'])){
                $builder->whereBetween('product_data.15', array($term['min_price'], $term['max_price']))
                        ->where('product_data.13','=', $term['currency_name']);
            }
            else {
                $builder->where('product_data.13','=', $term['currency_name']);
            }
        }
        

         if(!empty($term['min_price']) && !empty($term['max_price'])){
              $builder->whereBetween('product_data.15', array($term['min_price'], $term['max_price']));
         }

        $products = $builder->orderBy('_id')
            ->where("shopid","=", $shopid)
            ->where('postdate', '<=', date("Y-m-d"))
            ->where('status', '!=', 'disabled')
            ->where('product_type', '!=', 'opportunities')
            ->paginate($limit, $projections);
        
        

        foreach ($products as $product) {
            foreach ($product->cat_ids as $cat) {
                $catinfo = Categories::where("cat_id", "=", $cat)->where("lang", "=", "en")
                        ->project(array('name'))->first();
                if(!empty($catinfo)){
                  $prod_cats[$cat]= $catinfo->name;
                  $prod_cats_count[$cat][]= $cat;
                }
            }
        }

        
        foreach ($prod_cats as $cat_id => $cat_name) {
            $products_counts[$cat_id]= count($prod_cats_count[$cat_id]);
        }

        foreach ($prod_cats as $cat_id => $cat_name) {
             $sub_cat_id= explode('-', $cat_id);
             $categories= Categories::where('lang', '=', 'en')->Where('parent', '=', 0)
                     ->Where('cat_id', '=', $sub_cat_id[0])->project( array('name') )->first();
             $products_list[$sub_cat_id[0]]['name'] = $categories->name;
             $products_list[$sub_cat_id[0]]['values'][$cat_id] = $cat_name;    
        }

        $countries=  DropdownOptions::where('attr_id','=','35')->first();
        foreach($countries->options as $countryname){
          $country[$countryname]=$countryname;
        }
        $currencies= DropdownOptions::where('attr_id','=','13')->first();
        foreach($currencies->options as $key=>$cur){
          $currency[$cur]= $cur;
        }

        if(Auth::user()){      
          $createdby =  User::where('_id',Auth::user()->id)->first();
          $subuser= SubUser::where('parent_id', $createdby->parent_id)->get();
          if(count($subuser)>0){
              for($i=0;$i<count($subuser);$i++){
                  if(!empty($subuser[$i]->permission)){
                    foreach($subuser[$i]->permission as $key=>$val){
                        $site[]=$key; 
                        $permission[]=$val;
                    }
                  }
                  $subid[]=isset($subuser[$i]->sub_user_id)?$subuser[$i]->sub_user_id:"";
                  if(isset($subid[$i])){
                      $sitesubuser[]=  $this->GetUserName($subid[$i]);
                  }
              }
          }
        }
        if(empty($site)){
          $site=array();
        }
        
        $owner =  $this->GetUserName($storename->user_id);
        // $site_menu= FieldMaster::where('title','=','personal_site_menu')->first();
        $banner = array();
        if(!empty($_GET['preview'])){
          $banner = SiteHeaderImage::where('_id', $_GET['id'])->first();
        }
        
        if(Auth::user()) {
           $ecommerce_sites = $this->ecommerceSites($shopid);
           $eco_system_sites = $this->ecosystemSites($shopid);
       }
        
        return view('site.index', compact('sitesubuser', 'subid', 'site', 'subuser', 'owner', 'site_menu', 
                'certificationlogo', 'products', 'storename', 'business', 'products_counts', 'products_list', 
                'shopid', 'filtered_cat', 'keyword', 'cmspages', 'sitelogo', 'siteimages', 'com', 'country', 
                'currency', 'maximum_product_price', 'minimum_product_price', 'banner','ecommerce_sites','eco_system_sites'))
                ->with('min_price', $min_price)->with('max_price', $max_price)
                ->with('country_name', $country_name)
                ->with('currency_name', $currency_name)
                ->with('company_name', $company_name)
                ->with('frm_date', $frm_date)
                ->with('t_date', $t_date);
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    /**
     * Show the form for adding a new product.
     *
     * @return Response
     */    
    public function add(Request $request){ 
        try{
            $input = Request::all();
            $rules = array(
                'prod_cats' => 'required',
                'prod_cats_name' => 'required',
            );

            $validator = Validator::make(Request::all(), $rules);
            if ($validator->fails()) {
                return Redirect::route('select_cat.index')
                    ->withErrors($validator);                        
            }
            else {
                $catAnsForAttr = $this->fetchAncestorsForAll($input['prod_cats']);
                //Fetch Attr association/classifiction
                $attrAssoc = $this->fetchAttributesAssoc();
                //Fetch Attributes
                $attrForCats = $this->fetchAttributesIds($catAnsForAttr);
                sort($attrForCats);
                $productForm = $this->createProductForm($input['prod_cats'], $input['prod_cats_name'], $attrAssoc, $attrForCats);

                return view('backend.catalog.products.add', compact('productForm'));
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }     

    function createProductForm($prod_cats, $prod_cats_name, $attrAssoc, $attrForCats){
        $formFields = array();
        $formFields[] = "<hr/><h4>You have selected the following categories:</h4><hr/>";
        foreach($prod_cats_name as $prod_cats_name_){
            $formFields[]='<h6><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> &nbsp;&nbsp; '.$prod_cats_name_.'</h6>';
        }
        $formFields[] = "<hr/><h4>What do you want to do:</h4><hr/>";
        $formFields[]= Form::radio('prod_type', 'sell', ['required']) . ' &nbsp; I Want to sell my product or service';
        $formFields[]= "<br/>";
        $formFields[]= Form::radio('prod_type', 'buy', ['required']) . ' &nbsp; I Want to Buy product I need for my business';
        foreach($prod_cats as $prod_cat){
            $formFields[]= $this->createProductFormFields("cat_id[]", "", "", "hidden", "", "", "","", $prod_cat);
        }
        foreach ($attrAssoc as $k=>$v) {
            $formFields[] = "<hr/><h4>$v</h4><hr/>";
            foreach($attrForCats as $attrForCatk => $attrForCat){
                $attributes= Attributes::where('attr_id', strval($attrForCat))->where('class', '=', $k)->where('lang', '=', 'en')->first();
                if(count($attributes)){
                    $attr_id=$attributes->attr_id;
                    $opt=array();
                    if($attributes->field_type === "TD" || $attributes->field_type === "TM" ){
                        $dropopt =  DropdownOptions::where('attr_id', $attributes->attr_id )->where('lang', '=', 'en')->first();
                        if(count($dropopt )){
                            foreach ($dropopt->options as $dropopt_) {
                                $opt[$dropopt_]=$dropopt_;
                            }
                        }
                    }
                    $formFields[] = $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, $attributes->field_type, $attributes->len, $attributes->class, $attributes->req,$opt, "");
                }                  
            }
        }
        
        return $formFields;
    }
    
    function createProductFormFields($attr_id, $label="", $desc="", $field_type="", $len="", $class="", $req="",$opt, $val=""){
        //$this->createProductFormFields($attr_id, $label, $desc, $field_type, $len, $class, $req);
        if($req==="M" || $req==="required"){ $req="required";}else{ $req=""; }
        $req="";
        switch ($field_type) {
            case "TD":
                $field = "<div class='item form-group'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'data-original-title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::select($attr_id, $opt, null, ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => '---', $req, 'maxlength'=> $len])
                        . "</div>
                    </div>";                    
                break;
            case "TM":
                $field = "<div class='item form-group'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'data-original-title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::select($attr_id, $opt, null, ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => '---', $req, 'maxlength'=> $len, 'multiple'])
                        . "</div>
                    </div>";                    
                break;    
            case "T":
                $field = "<div class='item form-group'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'data-original-title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::text($attr_id, '', ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => $label, $req, 'maxlength'=> $len])
                        . "</div>
                    </div>";                    
                break;      
            case "N":
                //if($label !==""){
                $field = "<div class='item form-group'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'data-original-title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::number($attr_id, '', ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => $label, $req, 'maxlength'=> $len])
                        . "</div>
                    </div>";                    
                break; 
            case "D":
                //if($label !==""){
                $field = "<div class='item form-group'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'data-original-title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::date($attr_id, '', ['class' => 'form-control col-md-7 col-xs-12', 
                                 $req, "min"=> date("Y-m-d"), 'maxlength'=> $len])
                        . "</div>
                    </div>";                    
                break;             
            case "H":
                $field = "<div class='item form-group'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'data-original-title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::time($attr_id, '', ['class' => 'form-control col-md-7 col-xs-12', 
                                 $req, 'maxlength'=> $len])
                        . "</div>
                    </div>";                    
                break;             
            case "I":
                $field = "<div class='item form-group'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'data-original-title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::file($attr_id, '', ['class' => 'form-control col-md-7 col-xs-12 upload-image', 
                               'accept'=>'image/*',  $req, 'maxlength'=> $len])
                        . "</div>
                    </div>";                    
                break;     
            case "F":
                $field = "<div class='item form-group'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'data-original-title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::file($attr_id, '', ['class' => 'form-control col-md-7 col-xs-12 upload-file', 
                                 'accept'=>'file_extension', $req, 'maxlength'=> $len])
                        . "</div>
                    </div>";                    
                break;    
            case "U":
            case "UA":
            case "UE":
            case "UI":                
                //if($label !==""){
                $field = "<div class='item form-group'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'data-original-title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::url($attr_id, '', ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => $label, $req, 'maxlength'=> $len])
                        . "</div>
                    </div>";                    
                break;            
            case "hidden":
                $field = Form::hidden($attr_id, $val, $attributes = array());
                break;
            default:
                $field="";
        }        
        return $field;
    }
    
    function fetchAttributesIds($catAnsForAttr){
        $attrArr = array();
        foreach ($catAnsForAttr as $cat) {
            $attrTmp = CategoryAttribute::Where('cat_id', '=', $cat)->project( array('attr_ids') )->first();//->take(1)->get();
            if(count($attrTmp)){
                foreach($attrTmp->attr_ids as $attr){
                    $attrArr[$attr] = $attr;
                }
            }
        }
        return $attrArr;        
    }
    
    function fetchAttributesAssoc(){
        $attrAssoc = array();
        $attrAssocTmp = AttributesAssoc::where('lang', '=', 'en')->project( array('id','label') )->get();
        foreach($attrAssocTmp as $v){
            $attrAssoc[$v->id] = $v->label;
        }
        return $attrAssoc;
    }
    
    function fetchAncestorsForAll($prod_cats){
        $catAnsForAttr = array();
        foreach ($prod_cats as $cat) {
            $catAnsForAttrTemp=$this->fetchCategoryAnscestors($cat);
            foreach ($catAnsForAttrTemp as $k => $v) {
                $catAnsForAttr[$k]=$v;
            }
            
        }
        return $catAnsForAttr;
    }
    
    function fetchCategoryAnscestors($currentid){
        $parent = 0;
        //$currentid=$cat;
        $cat_hierachy = array();
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

            if(Auth::user()){
                $product->userid = Auth::user()->id;            
                $product->postedby = Auth::user()->name;            
            } 

            $product->purpose = Request::get('prod_type');
            $product->cat_ids = Request::get('cat_id');
            $product->postdate = $input['attr_id'][1];
            $product->desc = $input['attr_id'][3];
            $product->thumb = "";
            $product->shared_in = "";
            $product_attr=array();
            foreach($input['attr_id'] as $attr_id => $attr_val){
              if(gettype($attr_val) === "object"){
                $tstamp=time();
                $filename = "prod-" . $this->randomString() . "-". $tstamp;  
//                \UUID::v4();
                $target_dir = base_path()."/public/uploads/product_img/";
                $imageFileType = pathinfo(basename($_FILES['attr_id']['name'][$attr_id]),PATHINFO_EXTENSION);                
                $target_file = $target_dir . $filename . "." . $imageFileType;
                if (move_uploaded_file($_FILES['attr_id']["tmp_name"][$attr_id], $target_file)) {
                    $product->thumb = asset('uploads/product_img/' .  $filename  . "." . $imageFileType ) ;
                    $product_attr[$attr_id]= asset('uploads/product_img/' .  $filename  . "." . $imageFileType ) ;
                } 
                else {
                    $product_attr[$attr_id]="";
                }                
              }
              else {
                  $product_attr[$attr_id] = $attr_val;
              }
          }   
          $product->product_data = $product_attr;
          $product->save();
          Session::flash('message', 'Successfully Create New Product');

          return Redirect::route('products/list');
      }
      catch(\Exception $e){
          $errors = $this->errorMessage($e);
          return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
      }
  }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($shopid, $id, $size=""){
        try {
            $term = Request::all();
            $limit = 20;
            $keyword = '';
            $product_promo = ProductPromotionalBanner::where('_id', $id)->first();

            if(empty($product_promo)){
                $product_promo = array();
            }

            if(!empty($term['cat_id']) || !empty($term['keyword'])){
                $filtered_cat = array();
                if(array_key_exists('cat_id', $term)){
                    $filtered_cat = $term['cat_id'];
                }
                
                if(array_key_exists('keyword', $term)){
                    $keyword = $term['keyword'];
                }

                $projections = array('cat_ids', 'shopid', 'desc', 'postdate', 'product_data', 'thumb', '_id', 'product_type', 'thumb_path');

                if(!empty($filtered_cat) && empty($keyword)){
                    $products = Products::where('postdate', '<=', date("Y-m-d"))->whereIn('cat_ids', $filtered_cat)->paginate($limit, $projections);
                }
                elseif (!empty($filtered_cat) && !empty($keyword)) {
                    $products = Products::where('postdate', '<=', date("Y-m-d"))->where("desc","like",'%'.$keyword.'%')->whereIn('cat_ids', $filtered_cat)->paginate($limit, $projections);
                } 
                elseif (!empty($keyword)) {
                    $products = Products::where('postdate', '<=', date("Y-m-d"))->where('desc','like','%'.$keyword.'%')->paginate($limit, $projections);
                }
                else {
                    $products= Products::where('postdate', '<=', date("Y-m-d"))->paginate($limit, $projections);
                }
                $all_categories= Products::where('postdate', '<=', date("Y-m-d"))->project(array('cat_ids'))->get();
                $prod_cats = array();
                $prod_cats_count = array();
                foreach ($all_categories as $product) {
                    foreach ($product->cat_ids as $cat) {
                        $catinfo = Categories::where("cat_id","=",$cat)->where("lang","=","en")->project(array('name'))->first();
                        $prod_cats[$cat]= $catinfo->name;
                        $prod_cats_count[$cat][]= $cat;
                    }
                }
                $products_counts = array();     
                foreach ($prod_cats as $cat_id => $cat_name) {
                    $products_counts[$cat_id]= count($prod_cats_count[$cat_id]);
                }
                $products_list = array();
                foreach ($prod_cats as $cat_id => $cat_name) {
                     $sub_cat_id= explode('-', $cat_id);
                     $categories= Categories::where('lang', '=', 'en')->Where('parent', '=', 0)->Where('cat_id', '=', $sub_cat_id[0])->project( array('name') )->first();
                     $products_list[$sub_cat_id[0]]['name']= $categories->name;
                     $products_list[$sub_cat_id[0]]['values'][$cat_id]= $cat_name;    
                }
                $storename= EcomShops::where('slug', '=', $shopid)->first();
                $business = BusinessInfo::where('company_name', '=', $storename->company)->first();
                $siteimages= SiteHeaderImage::where('site_slug', $shopid)->where('status',"1")->get();
                $sitelogo=  SiteLogo::where('shop_id', $shopid)->first();
                $cmspages = CmsSite::where('slug', '=', $shopid)->Where('status', '=', '1')->project( array('page_title') )->orderBy('sort_order', 'asc')->get();

                return view('site.index', compact('sitelogo', 'siteimages', 'products', 'cmspages', 'storename', 'business', 
                            'products_counts', 'products_list', 'filtered_cat', 'keyword'))->with('shopid', $shopid);  
            }
            else {
                    $builder = Products::query();
                    if(!empty($size)){
                        $builder->where('product_data.725','=',$size);
                    }
                    
                    $builder->where('_id','=',$id);
                    $product = $builder->orderBy('_id')->first();
                    
                    $attrAssoc = $this->fetchAttributesAssoc();
                    $productTabs = $this->createProductTabs($attrAssoc, $product);
                    
                    //  Product Reviews Section          
                    $avg_rating = ProductReviews::where('product_id','=',$id)->where('shopid','=',$shopid)->avg('rating');
                    $rating_1 = ProductReviews::where('product_id','=',$id)->where('shopid','=',$shopid)->where('rating','=',1)->count('rating');
                    $rating_2 = ProductReviews::where('product_id','=',$id)->where('shopid','=',$shopid)->where('rating','=',2)->count('rating');
                    $rating_3 = ProductReviews::where('product_id','=',$id)->where('shopid','=',$shopid)->where('rating','=',3)->count('rating');
                    $rating_4 = ProductReviews::where('product_id','=',$id)->where('shopid','=',$shopid)->where('rating','=',4)->count('rating');
                    $rating_5 = ProductReviews::where('product_id','=',$id)->where('shopid','=',$shopid)->where('rating','=',5)->count('rating');
                    $all_reviews= ProductReviews::where('product_id','=',$id)->where('shopid','=',$shopid)->paginate(25);
                    //  End Product Reviews Section
                    // Seller Reviews Section
                    $seller_avg_rating = SellerReviews::where('product_id','=',$id)->where('shopid','=',$shopid)->avg('rating');
                    $seller_rating_1 = SellerReviews::where('product_id','=',$id)->where('shopid','=',$shopid)->where('rating','=',1)->count('rating');
                    $seller_rating_2 = SellerReviews::where('product_id','=',$id)->where('shopid','=',$shopid)->where('rating','=',2)->count('rating');
                    $seller_rating_3 = SellerReviews::where('product_id','=',$id)->where('shopid','=',$shopid)->where('rating','=',3)->count('rating');
                    $seller_rating_4 = SellerReviews::where('product_id','=',$id)->where('shopid','=',$shopid)->where('rating','=',4)->count('rating');
                    $seller_rating_5 = SellerReviews::where('product_id','=',$id)->where('shopid','=',$shopid)->where('rating','=',5)->count('rating');
                    // End Seller Reviews Section
                    $cookie_val = $_COOKIE['gdoox_shopping_cart'];
                    if(Auth::user()){
                        $userid = Auth::id();
                        $total = ShoppingCart::where('userid','=', $userid)->orwhere('cart_id','=', $cookie_val)->where('status','=','0')->count('product_id');
                        $wishlist_item = WishList::Where('userid','=',$userid)->where('product_id','=',$id)->where('shopid','=',$shopid)->first();
                        $review = ProductReviews::where('userid','=',$userid)->where('product_id','=',$id)->where('shopid','=',$shopid)->first();
                        $seller_reviews = SellerReviews::where('userid','=',$userid)->where('product_id','=',$id)->where('shopid','=',$shopid)->first();
                    }
                    else {
                        $total = ShoppingCart::where('cart_id','=', $cookie_val)->where('status','=','0')->count('product_id'); 
                    }
            
                    session(['cart_items' => $total]);
                    $business = "";
                    $storename = EcomShops::where('slug', '=', $shopid)->first();
                    if(!empty($storename)){
                        $business = BusinessInfo::where('company_name', '=', $storename->company)->first();
                    }


                    $siteimages = SiteHeaderImage::where('site_slug',$shopid)->where('status',"1")->get();
                    $sitelogo = SiteLogo::where('shop_id', $shopid)->first();
                    //CMS page links
                    $cmspages = CmsSite::where('slug', '=', $shopid)->Where('status', '=', '1')->project( array('page_title') )->orderBy('sort_order', 'asc')->get();
                    $certificationlogo = CertificationLogos::where('site_slug', $shopid)->where('status',"1")->get();

                    if(Auth::user()){     
                      $createdby =  User::where('_id',Auth::user()->id)->first();
                      $subuser = SubUser::where('parent_id', $createdby->parent_id)->first();

                      if(!empty($subuser->permission)){
                        foreach($subuser->permission as $key=>$val){
                            $site[] = $key;
                            $permission[] = $val;
                        }
                      }
                      $subid=isset($subuser->sub_user_id)?$subuser->sub_user_id:"";
                      $sitesubuser=  $this->GetUserName($subid);
                      if(empty($site)){
                          $site = array();
                      }
                    }
                    $owner = "";
                    if(!empty($storename)){
                        $owner =  $this->GetUserName($storename->user_id);
                    }
            
            
                    $site_menu= FieldMaster::where('title','=','personal_site_menu')->first();

                    $multi_items = array();
                    if(!empty($product->multi_item_products)){
                        foreach($product->multi_item_products as $multi_product){
                            $multi_items[] = Products::where('_id', $multi_product)->first();
                        }
                    }
                    
                    if(Auth::user()) {
                        $ecommerce_sites = $this->ecommerceSites($shopid);
                        $eco_system_sites = $this->ecosystemSites($shopid);
                    }
                    
                    $prodstore = array();
                    $prods = Products::where('original_id','=',$product->original_id)->get();
                    $prodstore[$product->old_slug] = $product->old_slug;
                    
                    foreach($prods as $prod){
                        $prodstore[$prod->shopid] = $prod->shopid;
                    }
                    
                    $ecosites = array();
                    $type = array('Internal','External');
                    $eco_system_sites = BusinessPartner::whereIn('type',$type)->Where('inviter_id','=', Auth::user()->id)->where('status','=','Accepted')->get();
                    if(!empty($eco_system_sites)){
                        foreach($eco_system_sites as $eco_sites){
                            $ecosites[$eco_sites->company_site_slug] = $eco_sites->company_site_slug;
                        }
                    }
                    
                    
                    $productVariations = $this->getProductAttributes($product, $id);
            
            if(isset($cookie_val)){
                return view('site.show', compact('sitesubuser', 'subuser', 'owner', 'site_menu', 'site', 'certificationlogo',
                  'sitelogo', 'productTabs', 'product', 'storename', 'business',
                  'wishlist_item', 'shopid', 'cmspages', 'review', 'avg_rating',
                  'rating_1', 'rating_2', 'rating_3', 'rating_4', 'rating_5', 'all_reviews',
                  'seller_rating_1', 'seller_rating_2', 'seller_rating_3', 'seller_rating_4', 'seller_rating_5', 
                  'seller_all_reviews', 'seller_reviews', 'seller_avg_rating', 'siteimages',
                  'product_promo', 'multi_items','ecommerce_sites','eco_system_sites','prodstore','ecosites','productVariations','size'))->with(json_encode(Session::get('cart_items')));
              }   
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    function createProductTabs($attrAssoc, $product){
        $prodTabData = array();
        $prodTabData[] = '<ul id="prodTab" class="nav nav-tabs bar_tabs" role="tablist">';
        $ft = 1;
        foreach ($attrAssoc as $k=>$v) {
            if($ft===1){
                $prodTabData[] = '<li role="presentation" class="active"><a href="#tab_content_'.$k.'" id="tab_'.$k.'" role="tab" data-toggle="tab" aria-expanded="true">'.$v.'</a></li>';
            }
            else {
                $prodTabData[] = '<li role="presentation" class=""><a href="#tab_content_'.$k.'" id="tab_'.$k.'" role="tab" data-toggle="tab" aria-expanded="true">'.$v.'</a></li>';
            }
            $ft=0;
        }
        $prodTabData[] = '</ul>';
        $prodTabData[] = '<div id="prodTabContent" class="tab-content">';
        $ft=1;
        foreach ($attrAssoc as $k=>$v) {
            if($ft===1) {
                $prodTabData[] = '<div role="tabpanel" class="tab-pane fade active in" id="tab_content_'.$k.'" aria-labelledby="tab_'.$k.'">';
            }
            else {
                $prodTabData[] = '<div role="tabpanel" class="tab-pane fade" id="tab_content_'.$k.'" aria-labelledby="tab_'.$k.'">';
            }
            $ft=0;
            
            $prodTabData[]='<div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">';
            $prodTabData[]='<table class="table table-striped responsive-utilities jambo_table"><tbody>';
            
            foreach($product->product_data as $attr_k => $attr_v) {
              if($attr_v !== "") {
                  $attributes= Attributes::where('attr_id', strval($attr_k) )->where('class', '=', $k)->where('lang', '=', 'en')->first();
                  if(count($attributes)) {
                      $prodTabData[]="<tr>";
                      $prodTabData[]="<td class='col-md-3'>";
                      $prodTabData[]= $attributes->label;
                      $prodTabData[]="</td>";
                      $prodTabData[]="<td>";
                      if($attributes->field_type === "I" || $attributes->field_type === "UI" ){
                          if($attr_v !==""){
                              $prodTabData[]= '<img src="'.asset($attr_v).'" alt="" />';
                          }
                      }
                      elseif($attributes->field_type === "F" || $attributes->field_type === "U" || $attributes->field_type === "UA" || $attributes->field_type === "UE" ){
                          if($attr_v !==""){
                              $prodTabData[]= '<a href="'.asset($attr_v).'" target="_blank">'.asset($attr_v).'</a>';
                          }
                      }
                      elseif($attributes->field_type === "TM" ){
                        if(!empty($attr_v) ){
                          $prodTabData[]= implode(", ", $attr_v);
                        }
                      }
                      else {
                          $prodTabData[] = $attr_v;
                      }
                      $prodTabData[]="</td>";
                      $prodTabData[]="</tr>";
                  }    
                }
            }

            $prodTabData[] = '</tbody></table>';  
            $prodTabData[] = '</div><!-- .table-responsive -->';
            $prodTabData[] = '</div>';
        }
        
//            $prodTabData[] = '<div role="tabpanel" class="tab-pane fade in" id="tab_content_PM" aria-labelledby="tab_PM">
//                    <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
//                        <table class="table table-striped responsive-utilities jambo_table">
//                            <tbody>
//                                <tr><td><a href="{!! route('."multi_item.list".', $product->id) !!}" class="">Add to multi-item</a></td></tr>
//                                <tr><td><a href="{!! route('."cross_selling.list".', $product->id) !!}" class="">Add to cross-selling</a></td></tr>
//                                <tr><td><a href="{!! route('."up_selling.list".', $product->id) !!}" class="">Add to up-selling</a></td></tr>
//                                <tr><td><a href="{!! route('."bundle/combo.list".', $product->id) !!}" class="">Add to bundle/combo</a><br/></td></tr>
//                                <tr><td><a href="{!! route('."import_product.detail".', $product->id) !!}" class="">Export this product</a><br/></td></tr>   
//                            </tbody>
//                        </table> 
//                    </div>
//            </div>';
            
        $prodTabData[] = '</div>';

        return $prodTabData; 
    }

    public function randomString(){
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

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    
    public function autoShopCategorySearch() {
        try{
            if(Request::ajax()){
                    $input = Request::all();
                    $products= Products::where('postdate', '<=', date("Y-m-d"))->where('desc', 'like', '%'.$input['term'].'%')->where('shopid','=',$input['shopid'])->project( array('cat_ids','shopid','desc'))->get();
                    $i = 0;
                    foreach($products as $products){
                            $response[$i]['attribute'] = $products['desc'];
                            $response[$i]['cat_ids'] = $products['cat_ids'];
                            $i++;
                    }
                    echo json_encode($response);
                }
            } 
            catch (Exception $e) {
                  return Response::json (array(
                      'error' => true,
                      'data' => $e
                  ), 200 );
            }
        }
        
    public function autoShopAllCategorySearch() {
        try{
            if(Request::ajax()){
                    $input = Request::all();
                    $products= Products::where('postdate', '<=', date("Y-m-d"))->where('desc', 'like', '%'.$input['term'].'%')->project( array('cat_ids','shopid','desc'))->get();
                    $i = 0;
                    foreach($products as $products){
                            $response[$i]['attribute'] = $products['desc'];
                            $response[$i]['cat_ids'] = $products['cat_ids'];
                            $i++;
                    }
                    echo json_encode($response);
                }
            } 
            catch (Exception $e) {
                  return Response::json (array(
                      'error' => true,
                      'data' => $e
                  ), 200 );
            }
    }
    

    public function addToCart(){
        
        $input = Request::all();
        if(Auth::user()){
            $userid= Auth::id();
        }
        
        $product = Products::find($input['product_id']);
        // $cookie_val = Cookie::get('gdoox_shopping_cart');
        $cookie_val = $_COOKIE['gdoox_shopping_cart'];
        $find_product = ShoppingCart::where('product_id','=',$input['product_id'])->where('cart_id','=',$cookie_val)->first();
        
        if(isset($find_product)){
            $find_product->qty= $find_product->qty + 1;
            $find_product->save();
            
            if(isset($userid)){
                $total = ShoppingCart::where('cart_id','=', $cookie_val)->orWhere('userid','=',$userid)->where('status','=','0')->count('product_id');
            }
            else { 
                $total = ShoppingCart::where('cart_id','=', $cookie_val)->where('status','=','0')->count('product_id');
            }
        }
        else {
                $cart= new ShoppingCart(); 
                $cart->product_id = $input['product_id'];
                $cart->product_name = $product->product_name;
                $cart->userid = "";
                $cart->shopid = $input['shopid'];
                $cart->company_id = $this->CompanyId($input['shopid']);
                $cart->desc = $product->desc;
                $cart->thumb = $product->thumb;
             // $cart->price = '1000';
                $cart->price = $product->product_data[15];
                $cart->product_data = array('13'=>$product->product_data[13],'15'=>$product->product_data[15],'16'=>$product->product_data[16]);
                $cart->qty = 1;
                $cart->status = '0';


                if(isset($cookie_val))
                {
                    $cart->cart_id = $cookie_val;
                    if($cart->save())
                    {
                        if(isset($userid))
                        {
                            $total = ShoppingCart::where('cart_id','=', $cookie_val)->orWhere('userid','=',$userid)->where('status','=','0')->count('product_id');    
                        }
                        else {
                            $total = ShoppingCart::where('cart_id','=', $cookie_val)->where('status','=','0')->count('product_id');
                        }             
                    }
                    else
                    {
                        echo "Product Could not be Added, please try Again";
                        exit;
                    } 
                }   
        }
        session(['cart_items' => $total]);
        return json_encode(Session::get('cart_items'));
    }
    
    public function listCart(){
       
        if(Auth::user()){
            $userid= Auth::id();
        }
        
        $cookie_val = $_COOKIE['gdoox_shopping_cart'];
        
        if(isset($userid)){
              $product_list = ShoppingCart::where('cart_id','=',$cookie_val)->orWhere('userid','=',$userid)->get(array('shopid', 'product_id'));
        }
        else {
              $product_list = ShoppingCart::where('cart_id','=',$cookie_val)->get(array('shopid', 'product_id'));
        }
        $i = 0;
        $response = array();
        foreach($product_list as $product){
                $response[ $product->shopid ][] = $product->product_id;
        }
        
        $user_tree_array="";
        foreach($response as $k => $v){
            $user_tree_array .= '<div style="padding:5px 20px"><a href="'. route('view_cart') . '/' .$k .'">View Cart - ' . $k .' -- '. count($v).' item(s)</a></div>';
        }
        
        return $user_tree_array;//json_encode($user_tree_array);
        
    }
    
  /*
   * Site Pages
   */
    public function pages($shopid, $pagename, $id){  
       try{      //when personal site present
//         echo $shopid; die;
           
           if(Auth::user()) {
                $ecommerce_sites = $this->ecommerceSites($shopid);
                $eco_system_sites = $this->ecosystemSites($shopid);
          }
          $storename = PersonalSiteDetail::where('slug', '=', $shopid)->first();
          $siteimages= SiteHeaderImage::where('site_slug',$shopid)->where('status',"1")->get();
          $sitelogo=  SiteLogo::where('shop_id', $shopid)->first();
          if(!empty($storename)){
              $business = $storename;
              $business->company_image = $business->site_image;
              $business->company_logo = $business->site_logo;
              //CMS page links
              $cmspages = CmsSite::where('slug', '=', $shopid)->Where('status', '=', '1')
                          ->project( array('page_title') )->orderBy('sort_order', 'asc')->get();
              $cmspage_selected = CmsSite::find($id);

              return view('site.page', compact('storename','business','shopid','cmspages', 'cmspage_selected','sitelogo','siteimages'));
          }

          $storename= EcomShops::where('slug', '=', $shopid)->first();
          $certificationlogo=  CertificationLogos::where('site_slug', $shopid)->where('status',"1")->get();
          $business = BusinessInfo::where('company_name', '=', $storename->company)->first();
          $owner=  $this->GetUserName($storename->user_id);
          $site_menu= FieldMaster::where('title','=','personal_site_menu')->first();
          //CMS page links
            $cmspages = CmsSite::where('slug', '=', $shopid)->Where('status', '=', '1')->project( array('page_title', 'description') )->orderBy('sort_order', 'asc')->get();
//            $ecommerce_sites = array();
//            $eco_system_sites = array();
//            if(Auth::user()){
//                $ecommerce_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('slug','!=',$shopid)->where('type','=','business')->get();
//                $eco_system_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('type','=','business_ecosystem')->get();
//            }
          
          $cmspage_selected = CmsSite::find($id);
          return view('site.page', compact('eco_system_sites','ecommerce_sites','sitesubuser','subuser','subid','owner','site_menu','site','certificationlogo','storename','business','shopid','cmspages', 'cmspage_selected','sitelogo','siteimages'));
       }
        catch (\Exception $e){
            $error = "An error occured. ".
                             "Line Number: ".$e->getLine()." ".
                             "File Name: ".$e->getFile()." ".
                             "Error Description: ".$e->getMessage();
             return view('errors.custom_error')->withErrors($error);
        }
    }
    
    public function autoSearchAllCategory() {
        try{
            if(Request::ajax()){
                $input = Request::all();
                $products= Products::where('postdate', '<=', date("Y-m-d"))->where('desc', 'like', '%'.$input['term'].'%')->project( array('cat_ids','shopid','desc'))->get();
                $i = 0;
                foreach($products as $products){
                        $response[$i]['attribute'] = $products['desc'];
                        $response[$i]['cat_ids'] = $products['cat_ids'];
                        $i++;
                }
                echo json_encode($response);
            }
        } 
          catch (Exception $e) {
                return Response::json (array(
                    'error' => true,
                    'data' => $e
                ), 200 );
          }
        }
    
   /*
    * Contact us Page
    */
    public function ContactPage($shopid){
        try {
            if(Auth::user()) {
                $ecommerce_sites = $this->ecommerceSites($shopid);
                $eco_system_sites = $this->ecosystemSites($shopid);
            }
          $storename = PersonalSiteDetail::where('slug', '=', $shopid)->first();
          $siteimages= SiteHeaderImage::where('site_slug',$shopid)->where('status',"1")->get();
          $sitelogo=  SiteLogo::where('shop_id', $shopid)->first();
//          $ecommerce_sites = array();
//          $eco_system_sites = array();
//          if(Auth::user()){
//              $ecommerce_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('slug','!=',$shopid)->where('type','=','business')->get();
//              $eco_system_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('type','=','business_ecosystem')->get();
//          }
          if(!empty($storename)){
              $fm_data=  FieldMaster::where('title', 'personal_sites')->where('lang','en')->first();
              $business = $storename;
              $business->company_image = $business->site_image;
              $business->company_logo = $business->site_logo;
              $sitetype="personal";
              $cmspages = CmsSite::where('slug', '=', $shopid)->Where('status', '=', '1')->project( array('page_title', 'description') )->orderBy('sort_order', 'asc')->get();

              return view('site.contactpage', compact('eco_system_sites','ecommerce_sites','storename','business','shopid','cmspages', 'cmspage_selected','fm_data','sitetype','sitelogo','siteimages'));
          }
          $fm_data =  FieldMaster::where('title', 'business_info')->where('lang','en')->first();
          $certificationlogo =  CertificationLogos::where('site_slug', $shopid)->where('status',"1")->get();
          $storename = EcomShops::where('slug', '=', $shopid)->first();

          $business = BusinessInfo::where('company_name', '=', $storename->company)->first();


          if(Auth::user()){      
            $createdby =  User::where('_id',Auth::user()->id)->first();
            $subuser= SubUser::where('parent_id', $createdby->parent_id)->get();
            for($i=0;$i<count($subuser);$i++){
                if(!empty($subuser[$i]->permission)){
                  foreach($subuser[$i]->permission as $key=>$val){
          //            print_r($val);
                      $site[]=$key; 
                      $permission[]=$val;
                  }
                }
                $subid[]=isset($subuser[$i]->sub_user_id)?$subuser[$i]->sub_user_id:"";
            }
            if(isset($subid[$i])){
                $sitesubuser[]=  $this->GetUserName($subid[$i]);
            }
            if(empty($site)){
              $site=array();
            }

          }
      //    print_r($site); die;
            $owner=  $this->GetUserName($storename->user_id);
      //      echo $owner; die;
            $site_menu= FieldMaster::where('title','=','personal_site_menu')->first();

            $sitetype="business";
            //CMS page links
            $cmspages = CmsSite::where('slug', '=', $shopid)->Where('status', '=', '1')
                        ->project( array('page_title', 'description') )->orderBy('sort_order', 'asc')->get();
            return view('site.contactpage', compact('ecommerce_sites','eco_system_sites','sitesubuser','subuser','subid','owner','site_menu','site','certificationlogo','storename','business','shopid','cmspages', 'cmspage_selected','fm_data','sitetype','sitelogo','siteimages'));
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
     * Send Message
     */  
     public function sendmessage(){
         try{
                $contactdata=Request::all();
                $data = array(
                    'title' => $contactdata['title'],
                    'email'=>$contactdata['email'],    
                    'msg' =>$contactdata['message']
                );

                $subject="E-commerce site contact form";
                Mail::send('emails.contactpage', $data, function($message) use($data){
                     $message->to($data['email'])->subject("Site contact form");
                });

                return redirect()->back()->with('message',"Your message has been sent.");
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
      * Product Catalog Page
      */
    public function ProductCatalog($shopid){
        try{
            
            if(Auth::user()) {
                $ecommerce_sites = $this->ecommerceSites($shopid);
                $eco_system_sites = $this->ecosystemSites($shopid);
            }
            
            $sitelogo=  SiteLogo::where('shop_id', $shopid)->first();
            $siteimages= SiteHeaderImage::where('site_slug', $shopid)->where('status',"1")->get();
            $storename= EcomShops::where('slug', '=', $shopid)->first();
            $fm_data=  FieldMaster::where('title', 'business_info')->where('lang','en')->first();
            $productcatalog=  ProductCatalog::where('site_slug', $shopid)->where('status','1')->get();
            $cmspages = CmsSite::where('slug', '=', $shopid)->Where('status', '=', '1')
                        ->project( array('page_title', 'description') )->orderBy('sort_order', 'asc')->get();
            $certificationlogo=  CertificationLogos::where('site_slug', $shopid)->where('status',"1")->get();
            $business = BusinessInfo::where('company_name', '=', $storename->company)->first();
//            $ecommerce_sites = array();
//            $eco_system_sites = array();
//            if(Auth::user()){
//                $ecommerce_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('slug','!=',$shopid)->where('type','=','business')->get();
//                $eco_system_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('type','=','business_ecosystem')->get();
//            }
            if(Auth::user()){      
              $createdby =  User::where('_id',Auth::user()->id)->first();
              $subuser= SubUser::where('parent_id', $createdby->parent_id)->get();
              for($i=0;$i<count($subuser);$i++){
                  if(!empty($subuser[$i]->permission)){
                    foreach($subuser[$i]->permission as $key=>$val){
            //            print_r($val);
                        $site[]=$key; 
                        $permission[]=$val;
                    }
                  }
                  $subid[]=isset($subuser[$i]->sub_user_id)?$subuser[$i]->sub_user_id:"";
                  if(isset($subid[$i])){
                      $sitesubuser[]=  $this->GetUserName($subid[$i]);
                  }
              }
              if(empty($site)){
                $site=array();
              }
            }
            $owner=  $this->GetUserName($storename->user_id);
            $site_menu= FieldMaster::where('title','=','personal_site_menu')->first();

            return view('site.product_catalog', compact('eco_system_sites','ecommerce_sites','storename','sitesubuser','subid','subuser','owner','site_menu','site','certificationlogo','cmspages','productcatalog','shopid','fm_data','sitelogo','siteimages', 'business'));
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
     * show product catalog
     */
    public function showproductcatalog($shopid,$id){
        try{
            if(Auth::user()) {
                $ecommerce_sites = $this->ecommerceSites($shopid);
                $eco_system_sites = $this->ecosystemSites($shopid);
            }
            
            $sitelogo=  SiteLogo::where('shop_id', $shopid)->first();
            $siteimages= SiteHeaderImage::where('site_slug', $shopid)->where('status',"1")->get();
            $storename= EcomShops::where('slug', '=', $shopid)->first();
            $fm_data=  FieldMaster::where('title', 'business_info')->where('lang','en')->first();
            $productcatalog=  ProductCatalog::where('site_slug', $shopid)->where('status','1')->get();
            $cmspages = CmsSite::where('slug', '=', $shopid)->Where('status', '=', '1')
                      ->project( array('page_title', 'description') )->orderBy('sort_order', 'asc')->get();
            $get_catalog = ProductCatalog::Where('_id','=',$id)->first();

           $certificationlogo=  CertificationLogos::where('site_slug', $shopid)->where('status',"1")->get();
           $business = BusinessInfo::where('company_name', '=', $storename->company)->first();
              
               
               if(Auth::user()){      
                $createdby =  User::where('_id',Auth::user()->id)->first();
                $subuser= SubUser::where('parent_id', $createdby->parent_id)->get();
                for($i=0;$i<count($subuser);$i++){
                    if(!empty($subuser[$i]->permission)){
                      foreach($subuser[$i]->permission as $key=>$val){
              //            print_r($val);
                          $site[]=$key; 
                          $permission[]=$val;
                      }
                    }
                    $subid[]=isset($subuser[$i]->sub_user_id)?$subuser[$i]->sub_user_id:"";
                    if(isset($subid[$i])){
                        $sitesubuser[]=  $this->GetUserName($subid[$i]);
                    }
                }
                    if(empty($site)){
                      $site=array();
                    }
              }
            $owner=  $this->GetUserName($storename->user_id);
            $site_menu= FieldMaster::where('title','=','personal_site_menu')->first();

              return view('site.show_product_catalog', compact('ecommerce_sites','eco_system_sites','storename', 'subid','sitesubuser', 'subuser','owner', 'site_menu', 'site', 'certificationlogo', 'cmspages', 'productcatalog', 'shopid', 'fm_data', 'sitelogo', 'siteimages', 'get_catalog', 'business'));
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
     * Business Info page
     */
    
    public function BusinessInfoPage($shopid){
        try{
            $storename = PersonalSiteDetail::where('slug', '=', $shopid)->where('type','=','personal')->first();
            $sitelogo=  SiteLogo::where('shop_id', $shopid)->first();
            $siteimages= SiteHeaderImage::where('site_slug', $shopid)->where('status',"1")->get();
//            $ecommerce_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('slug','!=',$shopid)->where('type','=','business')->get();
//            $eco_system_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('type','=','business_ecosystem')->get();
            if(Auth::user()) {
                $ecommerce_sites = $this->ecommerceSites($shopid);
                $eco_system_sites = $this->ecosystemSites($shopid);
            }
            if(!empty($storename)){
                $fm_data=  FieldMaster::where('title', 'personal_sites')->where('lang','en')->first();
                $business = $storename;
                $business->company_image = $business->site_image;
                $business->company_logo = $business->site_logo;
                $sitetype="personal";
                $cmspages = CmsSite::where('slug', '=', $shopid)->Where('status', '=', '1')->project( array('page_title', 'description') )->orderBy('sort_order', 'asc')->get();

                return view('site.businessinfopage', compact('ecommerce_sites','eco_system_sites','storename','business','shopid','cmspages', 'cmspage_selected','fm_data','sitetype','sitelogo','siteimages'));
            }
            $fm_data=  FieldMaster::where('title', 'business_info')->where('lang','en')->first();
            $certificationlogo=  CertificationLogos::where('site_slug',$shopid)->where('status',"1")->get();
            $storename= EcomShops::where('slug', '=', $shopid)->first();
            $business = BusinessInfo::where('company_name', '=', $storename->company)->first();
            $sitetype="business";
            $cmspages = CmsSite::where('slug', '=', $shopid)->Where('status', '=', '1')
                  ->project( array('page_title', 'description') )->orderBy('sort_order', 'asc')->get();
            if(Auth::user()){      
              $createdby =  User::where('_id',Auth::user()->id)->first();
              $subuser= SubUser::where('parent_id', $createdby->parent_id)->get();
              for($i=0;$i<count($subuser);$i++){
                  if(!empty($subuser[$i]->permission)){
                    foreach($subuser[$i]->permission as $key=>$val){
                        $site[] = $key;
                        $permission[]=$val;
                    }
                  }
                  $subid[]=isset($subuser[$i]->sub_user_id)?$subuser[$i]->sub_user_id:"";
                  if(isset($subid[$i])){
                      $sitesubuser[]=  $this->GetUserName($subid[$i]);
                  }
              }
              if(isset($subid[$i])){
                  $sitesubuser[]=  $this->GetUserName($subid[$i]);
              }
              if(empty($site)){
                $site=array();
              }
            }
            $owner=  $this->GetUserName($storename->user_id);
            $site_menu= FieldMaster::where('title','=','personal_site_menu')->first();
            return view('site.businessinfopage', compact('ecommerce_sites','eco_system_sites','sitesubuser','subid','subuser','owner','site_menu','site','certificationlogo','storename','business','shopid','cmspages', 'cmspage_selected','fm_data','sitetype','sitelogo','siteimages'));
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
     * Job Detail page
     */
    
    public function JobDetailPage($shopid) {
        try {
//            $ecommerce_sites = array();
//            $eco_system_sites = array();
//            if(Auth::user()){
//                $ecommerce_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('slug','!=',$shopid)->where('type','=','business')->get();
//                $eco_system_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('type','=','business_ecosystem')->get();
//            }
            if(Auth::user()) {
                $ecommerce_sites = $this->ecommerceSites($shopid);
                $eco_system_sites = $this->ecosystemSites($shopid);
            }
            $personalsitedetails = PersonalSiteDetail::where('slug', '=', $shopid)->where('type','personal')->first();
            $owner=  $this->GetUserName($personalsitedetails->user_id);
            $sitelogo=  User::where('_id', $personalsitedetails->user_id)->first();
            $siteimages= SiteHeaderImage::where('site_slug',$shopid)->where('status',"1")->get();
            $site_menu= FieldMaster::where('title','=','personal_site_menu')->first();
            if(!empty($personalsitedetails)){
                $fm_data=  FieldMaster::where('title', 'job_details')->where('lang','en')->first();
                $sitetype="personal";
                $cmspages = CmsSite::where('slug', '=', $shopid)->Where('status', '=', '1')->project( array('page_title', 'description') )->orderBy('sort_order', 'asc')->get();

      //          return view('site.personal.jobdetails', compact('owner','personalsitedetails','shopid','cmspages','fm_data','sitetype','sitelogo','siteimages'));
                return view('site.personal.jobdetails', compact('ecommerce_sites','eco_system_sites','owner','site_menu','personalsitedetails','shopid','cmspages','fm_data','sitetype','sitelogo','siteimages'));
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
     * Personal Site details contact page
     */
    
    public function PersonalContact($shopid){
      try{
//          $ecommerce_sites = array();
//          $eco_system_sites = array();
//          if(Auth::user()){
//              $ecommerce_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('slug','!=',$shopid)->where('type','=','business')->get();
//              $eco_system_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('type','=','business_ecosystem')->get();
//          }
          
            if(Auth::user()) {
                $ecommerce_sites = $this->ecommerceSites($shopid);
                $eco_system_sites = $this->ecosystemSites($shopid);
            }
          $personalsitedetails = PersonalSiteDetail::where('slug', '=', $shopid)->where('type','personal')->first();
          $sitelogo=  User::where('_id', $personalsitedetails->user_id)->first();
          $siteimages= SiteHeaderImage::where('site_slug',$shopid)->where('status',"1")->get();
          $social= SocialInfo::where('user_id',$personalsitedetails->user_id)->first();
          $owner=  $this->GetUserName($personalsitedetails->user_id);
          $site_menu= FieldMaster::where('title','=','personal_site_menu')->first();
          if(!empty($personalsitedetails)){
              $fm_data = FieldMaster::where('title', '=', 'personal_sites_new')->first();
              $sitetype="personal";
              $cmspages = CmsSite::where('slug', '=', $shopid)->Where('status', '=', '1')->project( array('page_title', 'description') )->orderBy('sort_order', 'asc')->get();
              return view('site.personal.contact', compact('ecommerce_sites','eco_system_sites','owner','site_menu','personalsitedetails','shopid','cmspages','fm_data','sitetype','sitelogo','siteimages','social'));
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
    *PersonalContactEnquiry
     */  
     public function PersonalContactEnquiry(){
        $contactdata=Request::all();
        $data = array(
                    'title' => $contactdata['title'],
                    'email'=>$contactdata['email'],    
                    'msg' =>$contactdata['message']
                    );
        $subject="Personal site contact form";
        Mail::send('emails.contactpage', $data, function($message) use($data){
             $message->to($data['email'])->subject("Personal Site contact form");
        });
        
        return redirect()->back()->with('message',"Your message has been sent.");
     }

     /*
      * 
      * 
      */
     public function ComputerSkills($shopid){
//        $ecommerce_sites = array();
//        $eco_system_sites = array();
//        if(Auth::user()){
//            $ecommerce_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('slug','!=',$shopid)->where('type','=','business')->get();
//            $eco_system_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('type','=','business_ecosystem')->get();
//        }
         
         if(Auth::user()) {
           $ecommerce_sites = $this->ecommerceSites($shopid);
           $eco_system_sites = $this->ecosystemSites($shopid);
       }
        $storename = PersonalSiteDetail::where('slug', '=', $shopid)->where('type','=','personal')->first();
        $personalsitedetails = PersonalSiteDetail::where('slug', '=', $shopid)->first();
        $sitelogo=User::where('_id', $personalsitedetails->user_id)->first();
        $siteimages= SiteHeaderImage::where('site_slug',$shopid)->where('status',"1")->get();
        $owner=  $this->GetUserName($personalsitedetails->user_id);
        $site_menu= FieldMaster::where('title','=','personal_site_menu')->first();
        if(!empty($storename)){
          $fm_data=  FieldMaster::where('title', 'personal_sites_new')->where('lang','en')->first();
          $sitetype="personal";
          $cmspages = CmsSite::where('slug', '=', $shopid)->Where('status', '=', '1')->project( array('page_title', 'description') )->orderBy('sort_order', 'asc')->get(); 
  //          return view('site.computerskills', compact('owner','personalsitedetails','storename','business','shopid','cmspages', 'cmspage_selected','fm_data','sitetype','sitelogo','siteimages'));
          return view('site.computerskills', compact('eco_system_sites','ecommerce_sites','ecommerce_sites','eco_system_sites','owner','site_menu','personalsitedetails','storename','business','shopid','cmspages', 'cmspage_selected','fm_data','sitetype','sitelogo','siteimages'));
        }
        else {

        }
      }
    
    
    public function OtherSkills($shopid){
//        $ecommerce_sites = array();
//        $eco_system_sites = array();
//        if(Auth::user()){
//            $ecommerce_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('slug','!=',$shopid)->where('type','=','business')->get();
//            $eco_system_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('type','=','business_ecosystem')->get();
//        }
        if(Auth::user()) {
           $ecommerce_sites = $this->ecommerceSites($shopid);
           $eco_system_sites = $this->ecosystemSites($shopid);
       }
        $storename = PersonalSiteDetail::where('slug', '=', $shopid)->where('type','=','personal')->project('other_info')->first();
        $personalsitedetails = PersonalSiteDetail::where('slug', '=', $shopid)->first();
        $sitelogo=  User::where('_id', $personalsitedetails->user_id)->first();
        $siteimages= SiteHeaderImage::where('site_slug',$shopid)->where('status',"1")->get();
        $owner=  $this->GetUserName($personalsitedetails->user_id);
        $site_menu= FieldMaster::where('title','=','personal_site_menu')->first();
      
      if(!empty($storename)){
          $fm_data=  FieldMaster::where('title', 'personal_sites_new')->where('lang','en')->first();
          $sitetype="personal";
          $cmspages = CmsSite::where('slug', '=', $shopid)->Where('status', '=', '1')->project( array('page_title', 'description') )->orderBy('sort_order', 'asc')->get();

//          return view('site.otherskills', compact('owner','personalsitedetails','storename','business','shopid','cmspages', 'cmspage_selected','fm_data','sitetype','sitelogo','siteimages'));
          return view('site.otherskills', compact('eco_system_sites','ecommerce_sites','owner','site_menu','personalsitedetails','storename','business','shopid','cmspages', 'cmspage_selected','fm_data','sitetype','sitelogo','siteimages'));
      }
    }
    
    public function OtherInfo($shopid){
//        $ecommerce_sites = array();
//        $eco_system_sites = array();
//        if(Auth::user()){
//            $ecommerce_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('slug','!=',$shopid)->where('type','=','business')->get();
//            $eco_system_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('type','=','business_ecosystem')->get();
//        }
        
        if(Auth::user()) {
           $ecommerce_sites = $this->ecommerceSites($shopid);
           $eco_system_sites = $this->ecosystemSites($shopid);
        }
        $storename = PersonalSiteDetail::where('slug', '=', $shopid)->where('type','=','personal')->project('other_info')->first();
        $personalsitedetails = PersonalSiteDetail::where('slug', '=', $shopid)->first();
        $sitelogo=  User::where('_id', $personalsitedetails->user_id)->first();
        $siteimages= SiteHeaderImage::where('site_slug', $shopid)->where('status',"1")->get();
        $owner=  $this->GetUserName($personalsitedetails->user_id);
        $site_menu= FieldMaster::where('title','=','personal_site_menu')->first();
        if(!empty($storename)){
            $fm_data=  FieldMaster::where('title', 'personal_sites_new')->where('lang','en')->first();
            $sitetype="personal";
            $cmspages = CmsSite::where('slug', '=', $shopid)->Where('status', '=', '1')->project( array('page_title', 'description') )->orderBy('sort_order', 'asc')->get();    
  //            return view('site.otherinfo', compact('owner','personalsitedetails','storename','business','shopid','cmspages', 'cmspage_selected','fm_data','sitetype','sitelogo','siteimages'));
            return view('site.otherinfo', compact('eco_system_sites','ecommerce_sites','owner','site_menu','personalsitedetails','storename','business','shopid','cmspages', 'cmspage_selected','fm_data','sitetype','sitelogo','siteimages'));
        }  
    }
    
    public function UserLanguages($shopid){
//        $ecommerce_sites = array();
//        $eco_system_sites = array();
//        if(Auth::user()){
//            $ecommerce_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('slug','!=',$shopid)->where('type','=','business')->get();
//            $eco_system_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('type','=','business_ecosystem')->get();
//        }
        if(Auth::user()) {
           $ecommerce_sites = $this->ecommerceSites($shopid);
           $eco_system_sites = $this->ecosystemSites($shopid);
       }
        $storename = PersonalSiteDetail::where('slug', '=', $shopid)->where('type','=','personal')->project('professional_skills')->first();
        $personalsitedetails = PersonalSiteDetail::where('slug', '=', $shopid)->first();
        $sitelogo= User::where('_id', $personalsitedetails->user_id)->first();
        $siteimages= SiteHeaderImage::where('site_slug', $shopid)->where('status',"1")->get();

        $owner=  $this->GetUserName($personalsitedetails->user_id);

        $site_menu= FieldMaster::where('title','=','personal_site_menu')->first();

        if(!empty($storename)){
          $fm_data=  FieldMaster::where('title', 'personal_sites_new')->where('lang','en')->first();
          $sitetype="personal";
          $cmspages = CmsSite::where('slug', '=', $shopid)->Where('status', '=', '1')->project( array('page_title', 'description') )->orderBy('sort_order', 'asc')->get();    

          return view('site.userlanguages', compact('eco_system_sites','ecommerce_sites','owner','site_menu','personalsitedetails','storename','business','shopid','cmspages', 'cmspage_selected','fm_data','sitetype','sitelogo','siteimages'));

        }  
    }
    
    public function EducationAndTraining($shopid) {
//        $ecommerce_sites = array();
//        $eco_system_sites = array();
//        if(Auth::user()){
//            $ecommerce_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('slug','!=',$shopid)->where('type','=','business')->get();
//            $eco_system_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('type','=','business_ecosystem')->get();
//        }
        if(Auth::user()) {
           $ecommerce_sites = $this->ecommerceSites($shopid);
           $eco_system_sites = $this->ecosystemSites($shopid);
       }
        $storename = PersonalSiteDetail::where('slug', '=', $shopid)->where('type','=','personal')->project('professional_skills')->first();
        $personalsitedetails = PersonalSiteDetail::where('slug', '=', $shopid)->first();
        $sitelogo=  User::where('_id', $personalsitedetails->user_id)->first();
        $siteimages= SiteHeaderImage::where('site_slug', $shopid)->where('status',"1")->get();
        $owner=  $this->GetUserName($personalsitedetails->user_id);

        $site_menu= FieldMaster::where('title','=','personal_site_menu')->first();


        if(!empty($storename)){
            $fm_data=  FieldMaster::where('title', 'personal_sites_new')->where('lang','en')->first();
            $sitetype="personal";
            $cmspages = CmsSite::where('slug', '=', $shopid)->Where('status', '=', '1')->project( array('page_title', 'description') )->orderBy('sort_order', 'asc')->get();    

//            return view('site.educationandtraining', compact('owner','personalsitedetails','storename','business','shopid','cmspages', 'cmspage_selected','fm_data','sitetype','sitelogo','siteimages'));

            return view('site.educationandtraining', compact('eco_system_sites','ecommerce_sites','owner','site_menu','personalsitedetails','storename','business','shopid','cmspages', 'cmspage_selected','fm_data','sitetype','sitelogo','siteimages'));

        }  
    }
    
    public function AboutUs($shopid) {
        try{
            if(Auth::user()) {
                $ecommerce_sites = $this->ecommerceSites($shopid);
                $eco_system_sites = $this->ecosystemSites($shopid);
            }
//            $ecommerce_sites = array();
//            $eco_system_sites = array();
//            if(Auth::user()){
//                $ecommerce_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('slug','!=',$shopid)->where('type','=','business')->get();
//                $eco_system_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('type','=','business_ecosystem')->get();
//            }
            $storename = PersonalSiteDetail::where('slug', '=', $shopid)->where('type','=','personal')->project('about_us')->first();
            $personalsitedetails = PersonalSiteDetail::where('slug', '=', $shopid)->first();
            $sitelogo=  User::where('_id', $personalsitedetails->user_id)->first();
            $owner=  $this->GetUserName($personalsitedetails->user_id);
            $siteimages= SiteHeaderImage::where('site_slug', $shopid)->where('status',"1")->get();
            $site_menu= FieldMaster::where('title','=','personal_site_menu')->first();
            if(!empty($storename)){
                $fm_data=  FieldMaster::where('title', 'personal_sites_new')->where('lang','en')->first();
                $sitetype="personal";
                $cmspages = CmsSite::where('slug', '=', $shopid)->Where('status', '=', '1')->project( array('page_title', 'description') )->orderBy('sort_order', 'asc')->get();    
    //            return view('site.aboutus', compact('owner','personalsitedetails','storename','business','shopid','cmspages', 'cmspage_selected','fm_data','sitetype','sitelogo','siteimages'));
                return view('site.aboutus', compact('eco_system_sites','ecommerce_sites','owner','site_menu','personalsitedetails','storename','business','shopid','cmspages', 'cmspage_selected','fm_data','sitetype','sitelogo','siteimages'));
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

    public function competencies($shopid){
//        $ecommerce_sites = array();
//        $eco_system_sites = array();
//        if(Auth::user()){
//            $ecommerce_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('slug','!=',$shopid)->where('type','=','business')->get();
//            $eco_system_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('type','=','business_ecosystem')->get();
//        }
        if(Auth::user()) {
           $ecommerce_sites = $this->ecommerceSites($shopid);
           $eco_system_sites = $this->ecosystemSites($shopid);
       }
        $storename = PersonalSiteDetail::where('slug', '=', $shopid)->where('type','=','personal')->first();
        $personalsitedetails = PersonalSiteDetail::where('slug', '=', $shopid)->first();
        $sitelogo=  User::where('_id', $personalsitedetails->user_id)->first();
        $siteimages= SiteHeaderImage::where('site_slug', $shopid)->where('status',"1")->get();
        $site_menu= FieldMaster::where('title','=','personal_site_menu')->first();
        $owner=  $this->GetUserName($personalsitedetails->user_id);
        if(!empty($storename)){
            $fm_data=  FieldMaster::where('title', 'personal_sites_new')->where('lang','en')->first();
            $sitetype="personal";
            $cmspages = CmsSite::where('slug', '=', $shopid)->Where('status', '=', '1')->project( array('page_title', 'description') )->orderBy('sort_order', 'asc')->get();    
            return view('site.personal.competencies', compact('eco_system_sites','ecommerce_sites','owner','site_menu','personalsitedetails','storename','business','shopid','cmspages', 'cmspage_selected','fm_data','sitetype','sitelogo','siteimages'));
        }  
    }

    public function underdev() {
        return view('underdev');
    }
    
    public function involvedPartners($shopid){
//      $ecommerce_sites = array();
//      $eco_system_sites = array();
//      if(Auth::user()){
//          $ecommerce_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('slug','!=',$shopid)->where('type','=','business')->get();
//          $eco_system_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('type','=','business_ecosystem')->get();
//      }
       if(Auth::user()) {
           $ecommerce_sites = $this->ecommerceSites($shopid);
           $eco_system_sites = $this->ecosystemSites($shopid);
       }
      $sitelogo=  SiteLogo::where('shop_id', $shopid)->first();
      $siteimages= SiteHeaderImage::where('site_slug', $shopid)->where('status',"1")->get();
      $site_menu= FieldMaster::where('title','=','personal_site_menu')->first();
      $storename= EcomShops::where('slug','=',$shopid)->where('type','=','business_ecosystem')->first();
      $business = BusinessInfo::where('company_name', '=', $storename->company)->first();
        if(!empty($storename)){
          foreach($storename->partner_sites as $key=>$partner)
          {
            $company = EcomShops::where('slug','=',$partner)->first();
            if(!empty($company->company)){
                $involved_partners[]= BusinessInfo::where('company_name','=',$company->company)->get();
            }
            else{
                $involved_partners=array();
            }
          }
        }
        else{
            $involved_partners=array();
        }
      
        $fm_data=  FieldMaster::where('title', 'business_info')->where('lang','en')->first();
        $certificationlogo=  CertificationLogos::where('site_slug', $shopid)->where('status',"1")->get();
        $sitetype="business_ecosystem";
        
        $cmspages = CmsSite::where('slug', '=', $shopid)->Where('status', '=', '1')
                  ->project( array('page_title', 'description') )->orderBy('sort_order', 'asc')->get();
        
        if(Auth::user()){      
          $createdby =  User::where('_id',Auth::user()->id)->first();
          $subuser= SubUser::where('parent_id', $createdby->parent_id)->get();
          for($i=0;$i<count($subuser);$i++){
              if(!empty($subuser[$i]->permission)){
                foreach($subuser[$i]->permission as $key=>$val){
                    $site[]=$key; 
                    $permission[]=$val;
                }
              }
              $subid[]=isset($subuser[$i]->sub_user_id)?$subuser[$i]->sub_user_id:"";
              if(isset($subid[$i])){
                  $sitesubuser[]=  $this->GetUserName($subid[$i]);
              }
          }
          if(isset($subid[$i])){
              $sitesubuser[]=  $this->GetUserName($subid[$i]);
          }
        }
      
      return view('site.involved_partners', compact('eco_system_sites','ecommerce_sites','involved_partners','sitesubuser','subid','subuser','owner','site_menu','site','certificationlogo','storename','business','shopid','cmspages', 'cmspage_selected','fm_data','sitetype','sitelogo','siteimages', 'business'));
    }
    
    public function ecommerceSites($shopid){
        $ecommerce_sites = array();
        if(Auth::user()){
            $ecommerce_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('slug','!=',$shopid)->where('type','=','business')->get();  
            return $ecommerce_sites;
        }
    }
    
    public function ecosystemSites($shopid){
        $eco_system_sites = array();
        if(Auth::user()){
            $eco_system_sites = BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->where('type','=','business_ecosystem')->get();
            return $eco_system_sites;
        }
    }
    
    public function changeProductShareStatus(){
        $data = Request::all();
        $success = array();
        $share = array("flag"=>"1");
        $unshare = array("flag"=>"0");
        
        $productcount = 0;
        $status = $data['status'];
        $product_id = $data['product_id'];
        $shopid = $data['shopid'];
        
        if($status==='only_in_my_site'){
                $i = 0;
                DB::collection('products')->where('original_id', $product_id)->push('share_status','');
                DB::collection('products')->where('_id', $product_id)->push('share_status','');
                
                $getproducts = Products::where('original_id','=',$product_id)->orWhere('_id','=',$product_id)->get();
                
                if(!empty($getproducts)){
                    $productcount = $getproducts->count();
                    foreach ($getproducts as $prod) {
                        if($prod->shopid==$shopid){
                            $prod->share_status = $share;
                            $prod->share_in = 'only_in_my_site';

                            if($prod->save()){
                                $i++;
                            }
                        }
                        else {
                            $prod->share_status = $unshare;
                            $prod->share_in = '';
                            if($prod->save()){
                                $i++;
                            }
                        } 
                    }
                }
                else {
                    
                }

                
                if($productcount == $i){
                    $success['site']='only_in_my_site';
                    $success['status']='true';
                }
                else {
                    $success['site']='only_in_my_site';
                    $success['status']='false';
                }
                return json_encode($success);
        }
        elseif($status==='only_in_shared_site') {
                $i = 0;
                DB::collection('products')->where('original_id', $product_id)->push('share_status','');
                DB::collection('products')->where('_id', $product_id)->push('share_status','');
            
                $getproducts = Products::where('original_id','=',$product_id)->orWhere('_id','=',$product_id)->get();
                
                if(!empty($getproducts)){
                    $productcount = $getproducts->count();
                }

                foreach ($getproducts as $prod) {
                    if($prod->shopid==$shopid){
                        $prod->share_status = $unshare;
                        $prod->share_in = '';
                        if($prod->save()){
                            $i++;
                        }
                    }
                    else {
                        $prod->share_status = $share;
                        $prod->share_in = 'only_in_shared_site';
                        if($prod->save()){
                            $i++;
                        }
                    }
                }
                
                if($productcount == $i){
                    $success['site']='only_in_shared_site';
                    $success['status']='true';
                }
                else {
                    $success['site']='only_in_shared_site';
                    $success['status']='false';
                }  
                
                return json_encode($success);
        }
        elseif($status==='only_in_this_site'){
            $stores = $data['stores'];
            DB::collection('products')->where('original_id', $product_id)->orWhere('_id','=',$product_id)->push('share_status','');
            
            $changestatus = Products::where('original_id','=',$product_id)->orWhere('_id','=',$product_id)->get();
            foreach($changestatus as $stat){
                $stat->share_status = $unshare;
                $stat->save();
            }
            
            $getproducts = Products::whereIn('shopid',$stores)->get();
            
                if(!empty($getproducts)){
                    $productcount = $getproducts->count();
                }

                foreach ($getproducts as $prod) {
                    $prod->share_status = $sharestatus;
                    $prod->share_in = 'only_in_this_site';
                    if($prod->save()){
                        $i++;
                    }
                }
                
                if($productcount == $i){
                    $success['site']='only_in_this_site';
                    $success['status']='true';
                }
                else {
                    $success['site']='only_in_this_site';
                    $success['status']='false';
                }
                return json_encode($success);
        }
    }
    
    public function shareUnsharedProduct(){
        $data = Request::all();
        $success = array();
        
        $sitecount = 0;
        $j = 0;
        $product_id = $data['product_id'];
        $status = $data['status'];
        $type = array('Internal','External');
        
        if($status==='share_product_in_shared_site'){
           
            $eco_system_sites = BusinessPartner::whereIn('type',$type)->Where('inviter_id','=', Auth::user()->id)->where('status','=','Accepted')->get();
            
            $sitecount = $eco_system_sites->count();
            
            if(!empty($eco_system_sites)){
                foreach($eco_system_sites as $site){
                    $check = SharedProducts::where('store_id','=',$site->company_site_slug)->where('product_id','=',$product_id)->where('inviter_id','=',Auth::user()->id)->where('type','=','Ecosystem')->first();
                  
                    if(empty($check)){
                        $shareproduct = new SharedProducts();
                        $shareproduct->product_id = $product_id;
                        $shareproduct->invitee_id = $site->invitee_id;
                        $shareproduct->inviter_id = $site->inviter_id;
                        $shareproduct->store_id = $site->company_site_slug;
                        $shareproduct->share_status = "shared";
                        $shareproduct->type = "Ecosystem";
                        $shareproduct->imported = "no";
                        if($shareproduct->save()){
                            $j++;
                        }
                    }
                }

                if($sitecount==$j) {
                    $success['site']='only_in_shared_site';
                    $success['status']='true';
                }
            }
            else {
                $success['site']='only_in_shared_site';
                $success['status']='no_shared_site';
            }    
        }
        elseif($status==='share_product_in_these_sites') {
            $stores = $data['stores'];
            $eco_system_sites = BusinessPartner::whereIn('company_site_slug',$stores)->whereIn('type',$type)->Where('inviter_id','=', Auth::user()->id)->where('status','=','Accepted')->get();
            
            if(!empty($eco_system_sites)){
                $sitecount = $eco_system_sites->count();
                foreach($eco_system_sites as $site){
                    $check = SharedProducts::where('store_id','=',$site->company_site_slug)->where('product_id','=',$product_id)->where('inviter_id','=',Auth::user()->id)->where('type','=','Ecosystem')->first();
                    if(empty($check)){
                        $shareproduct = new SharedProducts();
                        $shareproduct->product_id = $product_id;
                        $shareproduct->invitee_id = $site->invitee_id;
                        $shareproduct->inviter_id = $site->inviter_id;
                        $shareproduct->store_id = $site->company_site_slug;
                        $shareproduct->share_status = "shared";
                        $shareproduct->type = "Ecosystem";
                        $shareproduct->imported = "no";
                        
                        if($shareproduct->save()){
                            $j++;
                        }
                    } 
                }
            }
            
            if($sitecount==$j) {
                $success['site']='shared_to_sites';
                $success['status']='true';
            }
            else {
                $success['site']='shared_to_sites';
                $success['status']='false';
            }
        }       
        return json_encode($success);
    }


    public function errorMessage($e){
        $error = "An error occured. ".
            "Line Number: ".$e->getLine()." ".
            "File Name: ".$e->getFile()." ".
            "Error Description: ".$e->getMessage(); 
        return $error;
    }
    
    public function getProductAttributes($product,$id){
        $variationid = array();
        $prodvariations = array();
        $prodSizes = array();
        $prodColor = array();
        $productdata = array();
         // echo "<pre>";
        $productvariation = ProductVariationAttributes::where('status','=','1')->get();
        foreach($productvariation as $variation){
            $variationid[$variation->attr_id] = $variation->desc;
        }
        
        foreach($product->product_data as $key=>$value){
            if(!empty($value)){ // Discuss what to do.
                if(array_key_exists($key, $variationid)){
                    $prodvariations[$key] = $value;
                }
            }
        }
        
        $fkey = key($prodvariations);

//      Check $prodvariations exists or not. Set $id as $varid if nor exists
        if(!empty($product->product_variation_id)){
            $varid = $product->product_variation_id;
        }
        else {
            $varid = $id;
        }
        
        // Get the Product Colors
        $products = Products::where('_id','=',$varid)->orWhere('product_variation_id','=',$varid)->where('status','=','enabled')->get();
        
        // Get all the available sizes of the Product.
        $productSizes = Products::where('_id','=',$varid)->orWhere('product_variation_id','=',$varid)->where('status','=','enabled')->where('product_data.'.$fkey,'=',$product->product_data[$fkey])->get();
        
       // Remove the first key=>value fot the array to get the secondary and other selection parameters.
        unset($prodvariations[$fkey]);
        
//        print_r($prodvariations);
//        exit;
        
        foreach($prodvariations as $key=>$val){
            $productvars[] = Products::where('_id','=',$varid)->orWhere('product_variation_id','=',$varid)->where('status','=','enabled')->where('product_data.'.$key,'=',$val)->get();
        }
        
       
//        print_r($productvars);
//        exit;
        
        
        // Getting all the other variations except the first variations
        foreach($productvars as $productvar) {
            foreach($productvar as $var){
                foreach($var->product_data as $key=>$value){
                    if(!empty($value)){
                        if(in_array($value,$prodvariations)){
                            $filters[] = $value;
                        }
                    }
                }
            }
        }
        
//        echo "<pre>";
//        print_r($filters);
//        exit;
        
        
        foreach ($productSizes as $prodsizes){
            foreach($prodsizes->product_data as $key=>$val){
                if($key===725){
                    $prodSizes[$key][$prodsizes->_id] = $val;   
                }
            }
        }
        
        
       // echo "<pre>";
       // print_r($products);
        // exit;
        
        $prodColor[$product->_id] = $product->product_data['73'];
        foreach($products as $product){
            foreach($product->product_data as $key=>$val){
                if(!is_array($val)){
                    if($key===73){
                        if(!in_array($val, $prodColor)){
                            $prodColor[$product->_id] = $val;
                        } 
                    }
                }
            }
        }
//        echo "<pre>";
//        print_r($prodColor);
//        exit;
        
        $productdata['Color'][73] = $prodColor;
        $productdata['Size'] =  $prodSizes;
        
//        echo "<pre>";
//        print_r($productdata);
//        exit;
        
        return $productdata;
        
//        echo "<pre>";
//        print_r($prodSizes);
//        exit;

//        foreach($products as $product){
//            foreach($product->product_data as $key=>$value){
//                if(array_key_exists($key, $variationid)){
//                        if(!empty($value)){
//                            $prodvariations[$key][$product->_id] = $value;
//                            if(isset($prodvariations[$key])){
//                                if(!in_array($value, $prodvariations[$key])){
//                                    $prodvariations[$key][$product->_id] = $value;
//                                }
//                            }
//                            else {
//                                $prodvariations[$key][$product->_id] = $value;
//                            }
//                        }
//                }
//            }
//        }
       
    }
    
    public function getSizes(){
        
    }
}


