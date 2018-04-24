<?php

namespace Gdoox\Http\Controllers\backend\catalog\products\classifications;

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
use Gdoox\Models\ProductInventory;
use DB;
use File;
use Form;
use Image;
use Input;
use UUID;

use Gdoox\Models\BusinessEcommerceCompany;

use Gdoox\Models\ProductClassificationsLabels;
use Gdoox\Models\ProductClassificationsItems;

class ProductClassificationsLabelsController extends Controller
{
    use \Gdoox\Helpers\backend\dashboard\ImageUpload;
    use  \Gdoox\Helpers\backend\dashboard\HelperFunctions; 
    use \Gdoox\Helpers\backend\dashboard\RolesUsers;
    
    private $language;
    public function __construct() {
        $this->middleware('subuserpermission'); 
		if (session()->has('app_language')) {
			//
		}else{
			session(['app_language' => 'en']);
		}  		
        $this->language = session('app_language');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(){
      try {
          if(Auth::user()){
              
            $createdby = User::where('_id',Auth::user()->id)->first();
            
            $ProductClassifications = ProductClassificationsLabels::Where('user_id',  $createdby->child_of)->orWhere('user_id','=',  Auth::user()->id)->get();

            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'PRODUCT MANAGEMENT')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            return view('backend.catalog.products.classifications.index', compact('ProductClassifications','nav_menu','route'));
            

            // Code for getting the Navigation Menu
//            $role = $this->getRoleName(Auth::user()->id);
//            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'PRODUCT MANAGEMENT')->where('lang','en')->get();
//            $route = Route::getCurrentRoute()->getName();
            // End Code for getting the Navigation Menu
//            
//            $classifypost = DropdownOption::where('name','Classify Post')->where('lang', $this->language)->first();
//            if($classifypost){
//                foreach($classifypost->options as $clasifyp){
//                    $classify[$clasifyp] = $clasifyp;
//                }
//            }
//
//            if($route==='select_cat_to_sell.index'){
//                $purpose = 'sell';
//            }
//            else {
//                $purpose = 'buy';
//            }

//            $estores =  BusinessEcommerceCompany::Where('user_id',  $createdby->child_of)->orWhere('user_id','=',  Auth::user()->id)->get();
            
            
//            if(count($estores)>0) {
//                $lang = session('app_language');
//                return view('backend.catalog.products.select_cat', compact('categories','nav_menu','route','purpose','classify'));
//                return view('backend.catalog.products.classifications.index', compact('ProductClassifications','estores'));
//            }
//            else {
//                return redirect()->back()->withErrors("You don't have e-commerce site, therefore  you can not add the labels" );
//            }              
            
            
              
          }else{
              return redirect('auth/login')->with('message',"You must be login!"); 
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
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(){
      try {
          if(Auth::user()){
              
            $createdby = User::where('_id',Auth::user()->id)->first();

            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'PRODUCT MANAGEMENT')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
//            $lang = session('app_language');
            $user_id=Auth::user()->id;
            if(!empty($createdby->child_of)){
                $user_id=$createdby->child_of;
            }
            
            return view('backend.catalog.products.classifications.create', compact('user_id','nav_menu','route'));
              
          }else{
              return redirect('auth/login')->with('message',"You must be login!"); 
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
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request){
      try {
        if(Auth::user()){
            $input = Request::all();
            
            $ProductClassifications = ProductClassificationsLabels::Where('user_id',  $input['user_id'])
                    ->where('name', $input['cust_label'])->first();
            if(!empty($ProductClassifications)){
                Session::flash('message', 'You already have this label, create a new one.');
                return Redirect::route('classifications_labels.create')->withInput(Request::all());                        
            }

            $prod_classify = new ProductClassificationsLabels;

            $prod_classify->user_id = $input['user_id'];
            $prod_classify->name = $input['cust_label'];
            $prod_classify->type = 'product_classification';

            if($prod_classify->save()){
                Session::flash('message', 'Successfully Create New Label');
                return Redirect::route('classifications_labels.index');
            }
            else {
                return redirect()->back()->with('message','There is an error. Please try Again');
            }
            
            
        }else{
            return redirect('auth/login')->with('message',"You must be login!"); 
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
      try{
//        $categories= Categories::where('_id', '=', $id)->first();
//        
//        $role = $this->getRoleName(Auth::user()->id); 
//        $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('menu','GDOOX PLATFORM MANAGEMENT TEAM')->where('user',$role)->where('lang','en')->get();
//        $route = Route::getCurrentRoute()->getName();
//        
//        return view('backend.catalog.categories.show', compact('categories','nav_menu','route','subroute'));
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id){
      try{
        if(Auth::user()){
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'PRODUCT MANAGEMENT')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            $ProductClassifications = ProductClassificationsLabels::find($id);
            if(empty($ProductClassifications)){
                Session::flash('message', 'Label not found, create a new one.');
                return Redirect::route('classifications_labels.create')->withInput(Request::all());                        
            }
            return view('backend.catalog.products.classifications.edit', compact('ProductClassifications','nav_menu','route'));
        }else{
            return redirect('auth/login')->with('message',"You must be login!"); 
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
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
      try{
        
        if(Auth::user()){
            $input = Request::all();

            $ProductClassifications = ProductClassificationsLabels::where('_id','<>',  $id)
                    ->where('name', $input['cust_label'])->first();
            if(!empty($ProductClassifications)){
                Session::flash('message', 'You already have label with this name, create a new one.');
                return Redirect::route('classifications_labels.edit',$id)->withInput(Request::all());                        
            }
            $prod_classify = ProductClassificationsLabels::find($id);
            $prod_classify->name = $input['cust_label'];

            if($prod_classify->save()){
                Session::flash('message', 'Successfully updated Label');
                return Redirect::route('classifications_labels.index');
            }
            else {
                return redirect()->back()->with('message','There is an error. Please try Again');
            }
            
            
        }else{
            return redirect('auth/login')->with('message',"You must be login!"); 
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
   
 public function addProductsLabel($pid){
      try {
          if(Auth::user()){
              
            $createdby = User::where('_id',Auth::user()->id)->first();
            
            $ProductClassifications = ProductClassificationsLabels::Where('user_id',  $createdby->child_of)->orWhere('user_id','=',  Auth::user()->id)->get();
            $pc=[];
            if(!empty($ProductClassifications)){
                foreach ($ProductClassifications as $ProductClassification){
                    $pc[$ProductClassification->_id] = $ProductClassification->name;
                }
            }
            
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'PRODUCT MANAGEMENT')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();

            
            //$ProductClass = ProductClassificationsItems::Where('user_id',  $createdby->child_of)->orWhere('user_id','=',  Auth::user()->id)->get();
            $ProductClass = ProductClassificationsItems::Where('product_id',  $pid)->first();
            $pci="";
            if(!empty($ProductClass)){
                $pci=$ProductClass->class_label_id;
            }
            $product = Products::find($pid);
        
            return view('backend.catalog.products.classifications.assign', compact('ProductClassifications','nav_menu','route','product','pc','pci'));
          }else{
              return redirect('auth/login')->with('message',"You must be login!"); 
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
 
  public function storeProductsLabel(Request $request){
      try {
          if(Auth::user()){
              
              $input = Request::all();

              $ProductClass = ProductClassificationsItems::Where('product_id',  $input['product_id'])->first();
              if(!empty($ProductClass)){
                  $newprodlabel = ProductClassificationsItems::find($ProductClass->_id);
              }else{
                  $newprodlabel = new ProductClassificationsItems;
              }
              
              if(!empty($input)){
                foreach ($input as $k => $v){
                  if($k !== "_token"){
                      $newprodlabel->$k = $v;
                  }
                }

                if($newprodlabel->save()){
                    Session::flash('message', 'Successfully Assign Label to the Product');
                    return Redirect::route('products/list');
                }
                else {
                    Session::flash('message', 'There is some error, Please try again.');
                    return redirect()->back()->withInput(Request::all());
                }                  
                  
              }else{
                Session::flash('message', 'There is some error, Please try again.');
                return redirect()->back()->withInput(Request::all());
//                return Redirect::route('products/list');                          
              }

          }else{
              return redirect('auth/login')->with('message',"You must be login!"); 
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
 
 public function productsInLabel($clid) {
    try {
      if(Auth::user()){
        
//        $createdby = User::where('_id',Auth::user()->id)->first();
            
        //$ProductClassifications = ProductClassificationsLabels::Where('user_id',  $createdby->child_of)->orWhere('user_id','=',  Auth::user()->id)->get();
          
        $role = $this->getRoleName(Auth::user()->id);
        $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'PRODUCT MANAGEMENT')->where('lang','en')->get();
        $route = Route::getCurrentRoute()->getName();
        
        $ProdInClass = ProductClassificationsItems::Where('class_label_id',  $clid)->get();
        $pic=[];
        if(!empty($ProdInClass)){
            foreach($ProdInClass as $ProdInClass_){
                $pic[]=$ProdInClass_->product_id;
            }
            
//            $product = Products::whereIn('_id', $pic)->get();
            $products = Products::whereIn('_id', $pic)->where(function($query)
                {
                    $createdby = User::where('_id',Auth::user()->id)->first();
                    $query->Where('userid', '=',  $createdby->child_of)
                          ->orWhere('userid','=',  Auth::user()->id);
                })
                ->get();
//            var_dump($product); 

        }else{

//            return view('backend.catalog.products.classifications.showprod', compact('nav_menu','route','product'));
        }
        
        return view('backend.catalog.products.classifications.showprod', compact('products','nav_menu','route'));

//        var_dump($ProdInClass); 
      }else{
              return redirect('auth/login')->with('message',"You must be login!"); 
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
 
 
    
}