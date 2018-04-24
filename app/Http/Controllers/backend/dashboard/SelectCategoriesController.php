<?php

namespace Gdoox\Http\Controllers\backend\dashboard;

use Gdoox\Http\Controllers\Controller;

use DB;
use Gdoox\Models\BusinessInfo;
use Auth;
//use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


use Gdoox\Models\Categories;

class SelectCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    private $language;
    public function __construct() {
		if (session()->has('app_language')) {
			//
		}else{
			session(['app_language' => 'en']);
		}  		
        $this->language = session('app_language');
    }

    public function index(){
        try {
            $categories = Categories::where('lang', '=', $this->language)->Where('parent', '=', 0)->orderBy('name')->project( array('cat_id', 'name') )->get();
            $businessinfo = BusinessInfo::where('user_id', Auth::user()->id)->where('type','personal')->first();

            if(count($businessinfo)>0){
                return Redirect::route('personal-site-edit',[$businessinfo->id]);
            }
            return view('backend.dashboard.personal_sites.select_cat', compact('categories'));
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
                
                $cat_id = array();
                $categories_temp = array();
                $categories_ = Categories::where('lang','=',$this->language)->Where('name', 'like', '%'.addslashes($input['term']).'%')->orderBy('name')->project( array('cat_id','name') )->get();
//                var_dump($categories_);
//                echo "<br/><br/><br/><br/>";
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
//                print_r($categories_temp);
//                print_r($cat_id);
             //  exit;
                
                $user_tree_array = "";
                
                if(count($cat_id)){
                  foreach ($cat_id as $key=>$val) {
                    // $user_tree_array .= '<li data-cat_id="'.$key.'">' . $categories_temp[$val].'</li>';
                    // $user_tree_array .= $key."=>". $categories_temp[$val];
                     if(!empty($categories_temp[$val])){
                         $user_tree_array .= '<li data-cat_id="'.$key.'">' . $categories_temp[$val].'</li>';
                     } else {
                         $category_temp = Categories::where('lang','=',$this->language)->Where('cat_id', '=', $val)->project( array('cat_id','name') )->first();                               
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
            $input = Request::all();
            $categories = Categories::where('name', 'like', '%'.$input['term'].'%')->where('lang','=',$this->language)->project( array('cat_id','name'))->get();
            $i = 0;
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
                $currentid=$input['category_id'];
                $cat_hierachy="";
                do {
                    $sql = Categories::where('lang','=',$this->language)->Where('cat_id', '=', $currentid)->orderBy('name')->project( array('name','parent') )->first();//->take(1)->get();
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

        $sql = Categories::where('lang', '=', $this->language)->Where('parent', '=', $parent)->orderBy('name')->project( array('cat_id', 'name') )->get();
        
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
                $data=$request->all();
                $site=new BusinessInfo();
                $cat_id[]=$data['prod_cats'];
                $cat_name[]=$data['prod_cats_name'];
                $site->user_id=$data['userid'];
                $site->type='personal';
                $site->status=0;

                foreach($cat_name as $category){
                    $site['category_name']= $category; 
                }

                foreach($cat_id as $category_id){
                    $site['category_id']=$category_id;
                }

                $site->save();

                return redirect()->route('personal-site-edit',[$site->id]);
         }
         catch(\Exception $e){
             $errors = $this->errorMessage($e);
             return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
         }
     }
     
     public function edit(){
         try {
            $categories = Categories::where('lang', '=', $this->language)->Where('parent', '=', 0)->orderBy('name')->project( array('cat_id', 'name') )->get();
    //      $site_info = BusinessInfo::where('_id', $id)->where('type','personal')->first();
            return view('backend.dashboard.personal_sites.cat_edit', compact('categories'));
         }
         catch(\Exception $e){
             $errors = $this->errorMessage($e);
             return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
         }
     }
     
     public function update(Request $request){
         try{
                $data=$request->all();
                $cat_id[]=$data['prod_cats'];
                $cat_name[]=$data['prod_cats_name'];
          
                if(Auth::user()){
                   $userid= Auth::id();
                   $selected_cat = BusinessInfo::where('user_id', '=', $userid)->Where('type', '=', 'personal')->first();
                }
         //
        // print_r($selected_cat);
//          foreach($cat_name as $category){
//              $cat[]=implode(', ',$category);
//          }
          
          
         // $data['category_name']= implode(', ', $cat);
          
          
//          foreach($cat_id as $category_id){
//              $catID[]=implode(', ',$category_id);
//          }
//          

//          $data['category_id']= implode(', ', $catID);

//          var_dump($selected_cat);
//          return;
            foreach ($selected_cat['category_name'] as $value) {
                $data['prod_cats_name'][]=$value;
            }
            
            foreach ($selected_cat['category_id'] as $value) {
                $data['prod_cats'][]=$value;
            }
            
//            foreach ($selected_cat as $value) {
//                array_push($data['prod_cats'], $value['category_id']);
//               // $data['category_id']= $value['category_id'];
//            }
            
//            foreach($cat_id as $key=>$category_id){
//                 array_push($data['prod_cats'], $key);
//                //$data['category_id']= $category_id;
//            }
//         
//            foreach($cat_name as $key=>$category_name){
//                array_push($data['prod_cats_name'], $key);
//               // $data['category_name']= $category; 
//            }
             $cat_id_key= 'category_id';
             $cat_name_key= 'category_name';
             
             $data[$cat_id_key] = $data['prod_cats'];
             unset($data['prod_cats']);
             
             $data[$cat_name_key] = $data['prod_cats_name'];
             unset($data['prod_cats_name']);
            
          DB::collection('business_info')->where('type', 'personal')->where('user_id',Auth::user()->id)->update($data);
          $site=  BusinessInfo::where('type', 'personal')->where('user_id',Auth::user()->id)->first();
          return redirect()->route('personal-site-edit',[$site->id]);
         }
         
         catch(\Exception $e){
             $errors = $this->errorMessage($e);
             return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
         }
     }
     
    public function categorySearch(){
        try {
            $term= Request::input('term');
            $site=  BusinessInfo::where('type', 'personal')->where('user_id',Auth::user()->id)->first();
            $categories = Categories::where('lang','=',$this->language)->where('name', 'like', '%'.addslashes($term).'%')->orderBy('cat_id')->paginate(50);

            return view('backend.dashboard.personal_sites.cat_edit', compact('categories'))->with('term',$term);
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
