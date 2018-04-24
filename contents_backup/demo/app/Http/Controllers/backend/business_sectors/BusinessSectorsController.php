<?php

namespace Gdoox\Http\Controllers\backend\business_sectors;

use Gdoox\Http\Controllers\Controller;

use DB;
//use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Gdoox\Models\Categories;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\BusinessSectors;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class BusinessSectorsController extends Controller
{
      use \Gdoox\Helpers\backend\dashboard\RolesUsers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    private $language;
    public function __construct() {
        $this->language = session('app_language');
    }
    
    public function index(){
        try {
            $required="*";
            $selected_cat = array();
            
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('menu','PERSONAL PROFILE')->where('user',$role)->where('lang','en')->get();            
            $route = Route::getCurrentRoute()->getName();
                
            $site_info = BusinessSectors::where('user_id', Auth::user()->id)->where('type','business_sectors')->first();
            $fm_data = FieldMaster::where('title', 'personal_sites')->where('lang', $this->language)->first();
            
            if(!empty($site_info)){
                foreach($site_info->category_id as $key=>$val){
                    $selected_cat[$val] = $site_info->category_name[$key];
                }
            }

            $categories = Categories::where('lang','=',$this->language)->Where('parent','=', 0)->orderBy('name')->project( array('cat_id', 'name') )->get();
            return view('backend.business_sectors.index', compact('nav_menu','route','categories','selected_cat','fm_data','site_info','required'));
              // return view('backend.business_sectors.select_cat', compact('categories'));
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    public function create(){
        try {
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('menu','PERSONAL PROFILE')->where('user',$role)->where('lang','en')->get();            
            $route = Route::getCurrentRoute()->getName();
            
            $categories = Categories::where('lang', '=', $this->language)->Where('parent', '=', 0)->orderBy('name')->project(array('cat_id', 'name'))->get();
            return view('backend.business_sectors.create', compact('categories','nav_menu','route'));
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }


/*
 * 
 * Search Category
 */
    public function searchCategory() {
        try {
            if(Request::ajax()){
                $input = Request::all();
                $rules = array(
                    'term' => 'required',
                );
                
                $validator = Validator::make(Request::all(), $rules);
                if ($validator->fails()) {
                      return Response::json (array(
                          'error' => true,
                          'data' => 'Validation error'
                      ), 200 );
                }
                
                $cat_id= array();
                
                $categories_temp= array();
                
                $categories_ = Categories::where('lang','=',$this->language)->Where('name', 'like', '%'.addslashes($input['term']).'%')->orderBy('name')->project( array('cat_id','name') )->get();
                foreach ($categories_ as $cat) {
                    $categories_temp[$cat->cat_id]= $cat->name ;
                   
                    if (strpos($cat->cat_id,'-') !== false) {
                         $index = strpos($cat->cat_id,'-');
                         $parent_id = substr($cat->cat_id, 0, $index);
                         $cat_id[$parent_id]= $parent_id;                  
                    }
                    else {
                         $cat_id[$cat->cat_id]= $cat->cat_id;//$cat->name;      
                    }         
                }
                
                $user_tree_array = "";
                
                if(count($cat_id)){
                  foreach ($cat_id as $key=>$val) {
                    // $user_tree_array .= '<li data-cat_id="'.$key.'">' . $categories_temp[$val].'</li>';
//                            $user_tree_array .= $key."=>". $categories_temp[$val];
                     if(!empty($categories_temp[$val])){
                         $user_tree_array .= '<li data-cat_id="'.$key.'">' . $categories_temp[$val].'</li>';
                     } else {
                         $category_temp = Categories::where('lang','=',$this->language)->where('cat_id','=',$val)->project(array('cat_id','name'))->first();                               
                         $user_tree_array .= '<li data-cat_id="'.$key.'">' . $category_temp->name .'</li>';
                     }
                  }
                }
                else {
                    $user_tree_array= 'No Matching Categories Found';
                }
                return $user_tree_array;
                
               // print_r($user_tree_array); 
                // exit;
            }
        } 
        catch (Exception $e) {
              return Response::json ( array (
                  'error' => true,
                  'data' => $e
              ), 200 );
        }
    }
    
    public function searchProductCategory() {
        if(Request::ajax()){
            $i = 0;
            $input = Request::all();
            $categories= Categories::where('name','like','%'.$input['term'].'%')->where('lang','=',$this->language)->project( array('cat_id','name'))->get();

            $response = array();
            foreach($categories as $categories){
                $response[$i]['name'] = $categories['name'];
                $response[$i]['cat_id'] = $categories['cat_id'];
                $i++;
            }
            echo json_encode($response);
        }
    }
    
    public function fetchCatAncestors(){
        try{
            if(Request::ajax()){
                $input = Request::all();
                $rules = array(
                    'category_id' => 'required',
                );
                
                $validator = Validator::make(Request::all(), $rules);
                if ($validator->fails()) {
                      return Response::json ( array (
                          'error' => true,
                          'data' => 'Validation error'
                      ), 200 );
                }
                
                $parent = 0;
                $currentid = $input['category_id'];
                $cat_hierachy = "";
                do {
                    $sql = Categories::where('lang','=', $this->language)->Where('cat_id', '=', $currentid)->orderBy('name')->project( array('name','parent') )->first();//->take(1)->get();
                    if(count($sql)){
                        if($cat_hierachy === ""){
                            $cat_hierachy = $sql->name ;
                        } else {
                            $cat_hierachy = $sql->name . " / " . $cat_hierachy;
                        }
                        if(!empty($sql->parent)){
                            $currentid = $sql->parent;
                            $parent = 1;
                        } else {
                            $parent = 0;
                        }
                    } else {
                        $parent = 0;
                    }
                } while($parent <> 0);
                
                $cat_data = '<div class="prod_cats"><span class="glyphicon glyphicon-trash" aria-hidden="true"  data-cat_id="'. $input['category_id'] .'"></span> &nbsp;&nbsp;&nbsp; '
                        . '<input name="prod_cats[]" value="'. $input['category_id'] .'" type="hidden" />'
                        .'<input name="prod_cats_name[]" value="'. $cat_hierachy .'" type="hidden" />'. $cat_hierachy .'</div>';
        
                return Response::json ( array (
                    'error' => false,
                    'data' => $cat_data
                ), 200 );
            }
        } catch (Exception $e) {
              return Response::json ( array (
                  'error' => true,
                  'data' => $e
              ), 200 );
        }     
    }  
        
    //Recursive php function
    function category_tree($parent, $user_tree_array = '',$last=0){
        if (!is_array($user_tree_array))
            $user_tree_array = array();
            $sql = Categories::where('lang','=',$this->language)->Where('parent', '=', $parent)->orderBy('name')->project( array('cat_id', 'name') )->get();
        
            if(count($sql)){
                $user_tree_array[]= '<ul>';
                foreach ($sql as $row) {
                    $user_tree_array[]= '<li data-cat_id="'.$row->cat_id.'">' . $row->name;
                    $user_tree_array=$this->category_tree($row->cat_id,$user_tree_array);
                    $user_tree_array[]= '</li>';
                }
                $user_tree_array[]= '</ul>';
            }
            return $user_tree_array;  
    }     

    function fetchCategoryTreeList($parent = 0, $user_tree_array = '') {
        if (!is_array($user_tree_array))
        $user_tree_array = array();

        $sql = Categories::where('lang','=',$this->language)->where('parent', '=', $parent)->orderBy('name')->project( array('cat_id', 'name') )->get();
        
        if (count($sql) > 0) {
            $user_tree_array[] = "<ul>";
            foreach ($sql as $row) {
                $user_tree_array[] = "<li data-catid='" . $row->cat_id . "'>" . $row->name."</li>";
                $user_tree_array = $this->fetchCategoryTreeList($row->cat_id, $user_tree_array);
            }
            $user_tree_array[] = "</ul>";
        }
        return $user_tree_array;        
     }
     
     public function store(Request $request){
         try{
                $userid = '';
                $data = $request->all();
                if(Auth::user()){
                    $userid= Auth::id();
                    $get_user= BusinessSectors::where('user_id','=',$userid)->first();  
                }
                if(empty($get_user)){
                    $business = new BusinessSectors();
                    $cat_id[] = $data['prod_cats'];
                    $cat_name[] = $data['prod_cats_name'];
                    $business->user_id = $userid;
                    $business->type = 'business_sectors';
                    $business->status = 0;

                    foreach($cat_name as $category){
                        $business['category_name'] = $category; 
                    }
                    foreach($cat_id as $category_id){
                        $business['category_id']=$category_id;
                    }

                    $business->save();
                }
                else {
                    if(Auth::user()){
                        $userid = Auth::id();
                        $cat_id[] = $data['prod_cats'];
                        $cat_name[] = $data['prod_cats_name'];
                        $selected_cat = BusinessSectors::where('user_id', '=', $userid)->where('type', 'business_sectors')->first();
                    }

                    foreach($cat_name as $category){
                        $business['category_name']= $category; 
                    }

                    foreach($cat_id as $category_id){
                        $business['category_id']=$category_id;
                    }

                    foreach ($selected_cat['category_name'] as $value) {
                        $business['category_name'][]=$value;
                    }

                    foreach ($selected_cat['category_id'] as $value) {
                        $business['category_id'][]=$value;
                    }

                    DB::collection('business_sectors')->where('type', 'business_sectors')->where('user_id',Auth::user()->id)->update($business);
                }
                return redirect()->route('business-sectors-index');
            }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
     }
     
     
     public function edit(){

     }
        
     
     public function update(Request $request, $id){
         try{
            $data = $request->all();
            $data_val = array();
            
            foreach ($data['category_id'] as $key=>$value) {
                $data_val['category_id'][] = $value;
                $cat_name = Categories::where('cat_id','=',$value)->where('lang','=',$this->language)->first();
                $data_val['category_name'][] = $data['cat_names'][$key];
            }
            
            DB::collection('business_sectors')->where('type','=','business_sectors')->where('user_id',Auth::user()->id)->update($data_val);
            return redirect()->route('business-sectors-index');
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
     }
     
    public function categorySearch(){
        try {
            $term = Request::input('term');
            $site =  BusinessInfo::where('type', 'personal')->where('user_id',Auth::user()->id)->first();
            $categories = Categories::where('lang','=',$this->language)->where('name', 'like', '%'.addslashes($term).'%')->orderBy('cat_id')->paginate(50);
            return view('backend.business_sectors.create', compact('categories'))->with('term',$term);
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    public function errorMessage($e){
            $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage(); 
            return $error;
    }
}
