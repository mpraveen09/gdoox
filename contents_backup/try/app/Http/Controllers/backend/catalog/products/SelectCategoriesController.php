<?php

namespace Gdoox\Http\Controllers\backend\catalog\products;


use Gdoox\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Gdoox\User;
use Illuminate\Support\Facades\Auth;
use Gdoox\Models\BusinessEcommerceCompany;
use Gdoox\Models\Categories;
use Illuminate\Support\Facades\Route;
use Gdoox\Models\NavigationMenu;
use Gdoox\Models\DropdownOption;


class SelectCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    
    private $language;
    public function __construct(){
         $this->language = session('app_language');
    }
    
    public function index(){
        try {
            
            $createdby = User::where('_id',Auth::user()->id)->first();
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '61')->where('group','product_management')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            $classifypost = DropdownOption::where('name','Classify Post')->where('lang', $this->language)->first();
            if($classifypost){
                foreach($classifypost->options as $clasifyp){
                    $classify[$clasifyp] = $clasifyp;
                }
            } 
            
            if($route==='select_cat_to_sell.index'){
                $purpose = 'sell';
            }
            else {
                $purpose = 'buy';
            }

            $estores=  BusinessEcommerceCompany::Where('user_id',  $createdby->child_of)->orWhere('user_id','=',  Auth::user()->id)->paginate(25);
            if(count($estores)>0){
                $categories = Categories::where('lang', $this->language)->Where('parent', '=', 0)->orderBy('name')->project( array('cat_id', 'name') )->get();

    //        $aa=count($categories_);
    //        foreach ($categories_ as $d){ 
    //        }
    //        $categories="";
    //        $sql = Categories::where('lang', '=', 'en')->Where('parent', '=', $parent)->orderBy('name')->project( array('cat_id', 'name') )->get();
    //        $categories = $this->category_tree(0);
    //        foreach ($categories as $r) {
    //          echo  $r;
    //        }
    //                
    //        return;
    //        $categories = $this->fetchCategoryTreeList();
    //        foreach ($categories as $r) {
    //          echo  $r;
    //        }       
    //        return;

                return view('backend.catalog.products.select_cat', compact('categories','nav_menu','route','purpose','classify'));
            }
            else {
                  return redirect()->back()->withErrors("You do'nt have e-commerce site, so you can not add the product" );
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
        
    }
    
    public function searchCategory() {
//        try{
//            if(Request::ajax()){
                
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
                
                $categories_ = Categories::where('lang', $this->language)->Where('name', 'like', '%'.addslashes($input['term']).'%')->orderBy('name')->project( array('cat_id','name') )->get();

//              var_dump($categories_);
//              echo "<br/><br/><br/><br/>";
                foreach ($categories_ as $cat) {
                    $categories_temp[$cat->cat_id] = $cat->name ;
                    if (strpos($cat->cat_id,'-') !== false) {
                         $index = strpos($cat->cat_id,'-');
                         $parent_id = substr($cat->cat_id, 0, $index);
                         $cat_id[$parent_id] = $parent_id;                  
                    }
                    else {
                         $cat_id[$cat->cat_id] = $cat->cat_id;//$cat->name;      
                    }         
                }
                
                $user_tree_array = "";
                
                if(count($cat_id)){
                  foreach ($cat_id as $key=>$val) {
                    // $user_tree_array .= '<li data-cat_id="'.$key.'">' . $categories_temp[$val].'</li>';
                    // $user_tree_array .= $key."=>". $categories_temp[$val];
                     if(!empty($categories_temp[$val])){
                         $user_tree_array .= '<li data-cat_id="'.$key.'">' . $categories_temp[$val].'</li>';
                     }
                     else {
                         $category_temp = Categories::where('lang', '=', 'en')->Where('cat_id', '=', $val)->project( array('cat_id','name') )->first();                               
                         $user_tree_array .= '<li data-cat_id="'.$key.'">' . $category_temp->name .'</li>';
                     }
                  }
                }
                else {
                    $user_tree_array = 'No Matching Categories Found';
                }
                return $user_tree_array;
                
               // print_r($user_tree_array); 
                // exit;
//            }
//        } 
//        catch (Exception $e) {
//              return Response::json (array(
//                  'error' => true,
//                  'data' => "The category could not be Found! Please try another Keyword"
//              ), 200 );
//        }
    }
    
    public function searchProductCategory() {
        if(Request::ajax()){
            $i = 0;
            $input = Request::all();
            $categories = Categories::where('name', 'like', '%'.$input['term'].'%')->where('lang','=',$this->language)->project( array('cat_id','name'))->get();
           
            $response = array();
            foreach($categories as $categories){
                $response[$i]['name'] = $categories['name'];
                $response[$i]['cat_id'] = $categories['cat_id'];
                $i++;
            }
            echo json_encode($response);
        }
    }
    
    public function edit($id){
        // $attributes= AttributesAssoc::where('id', '=', $id)->where('lang', '=', 'en')->first();
        // return view('backend.catalog.attributes.assoc.edit', compact('attributes'));
    }
    
    public function store(){
//        $attributes= AttributesAssoc::where('id', '=', $id)->where('lang', '=', 'en')->first();
//        return view('backend.catalog.attributes.assoc.edit', compact('attributes'));

    }

    //Fetch sub cats of given parent
    //public function fetchSubCats(Request $request) {
    public function fetchSubCats() {
        try{
            if(Request::ajax()){
                $input = Request::all();
                $rules = array(
                    'parent' => 'required',
                );
                
                $validator = Validator::make(Request::all(), $rules);
                if ($validator->fails()) {
                      return Response::json ( array (
                          'error' => true,
                          'data' => 'Validation error'
                      ), 200 );
                }
                
                $term = strtolower(str_replace(' ', '', trim($input['term'])));
//              $term = $input['term'];
//              $cat_list = $this->category_tree($input['parent']);
                
                if($term==='') {
                     $cat_list = $this->category_tree($input['parent'], $term='',FALSE);
                }
                else {
                    $cat_list = $this->category_tree($input['parent'], $term ,TRUE);
                }

                $cat_data="";
                foreach ($cat_list as $cat) {
                  $cat_data .= $cat;
                }
                
                return Response::json (array(
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
    function category_tree($parent, $term, $flag = FALSE , $user_tree_array = '',$last=0){
      try {
        if (!is_array($user_tree_array))    
        $user_tree_array = array();
        
        if($flag === FALSE) {
            $sql = Categories::where('lang','=',$this->language)->Where('parent', '=', $parent)->orderBy('name')->project( array('cat_id', 'name') )->get();
            if(count($sql)){
                $user_tree_array[]= '<ul>';
                foreach ($sql as $row) {
                    $user_tree_array[] = '<li data-cat_id="'.$row->cat_id.'">' . $row->name;
                    $user_tree_array = $this->category_tree($row->cat_id, $term, $flag, $user_tree_array);
                    $user_tree_array[] = '</li>';
                }
                $user_tree_array[] = '</ul>';
            }  
        }
        elseif($flag === TRUE) {
            $sql = Categories::where('lang','=', $this->language)->Where('parent', '=', $parent)->Where('name', 'like', '%'.$term.'%')
                ->orderBy('name')
                ->project(array('cat_id', 'name'))
                ->get();
            
                if(count($sql)){
                    $user_tree_array[]= '<ul>';
                        foreach ($sql as $row) {
                            $user_tree_array[] = '<li data-cat_id="'.$row->cat_id.'">' . $row->name;
                            $user_tree_array = $this->category_tree($row->cat_id, $term, $flag, $user_tree_array);
                            $user_tree_array[] = '</li>';
                        }
                    $user_tree_array[] = '</ul>';
                }
                else {
                    $other_ids = Categories::where('lang', '=', $this->language)
                        ->Where('parent', '=', $parent)
                        ->orderBy('name')
                        ->project(array('cat_id', 'name'))
                        ->get();
                        
                    $user_tree_array = $this->checkchild($other_ids, $parent ,$term, $flag, $user_tree_array);                            
                    }
             }
        
        return $user_tree_array;  
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }

    
    public function checkchild($other_ids, $parent, $term, $flag, $user_tree_array){
            
        foreach($other_ids as $val){
            $level = Categories::where('lang', '=', $this->language)
                ->Where('parent', '=', $other_ids->cat_id)
                ->Where('name', 'like', '%'.$term.'%')
                ->orderBy('name')
                ->project(array('cat_id', 'name'))
                ->get();
            if(count($level)){
                $sql = Categories::where('lang', '=', $this->language)
                    ->Where('parent', '=', $parent)
                    ->Where('name', 'like', '%'.$term.'%')
                    ->orderBy('name')
                    ->project(array('cat_id', 'name'))
                    ->get();
                
                 $user_tree_array[]= '<ul>';
                        foreach ($sql as $row) {
                            $user_tree_array[] = '<li data-cat_id="'.$row->cat_id.'">' . $row->name;
                            // $user_tree_array = $this->category_tree($row->cat_id, $term, $flag, $user_tree_array);
                            $user_tree_array[] = '</li>';
                        }
                $user_tree_array[] = '</ul>';
            }
            else {
                 $other = Categories::where('lang', '=', $this->language)
                        ->Where('parent', '=', $other->cat_id)
                        ->orderBy('name')
                        ->project(array('cat_id', 'name'))
                        ->get();
                $this->checkchild($other, $parent, $term, $flag, $user_tree_array);
            }  
        }   
        return $user_tree_array;
    }

    

    //Recursive php function
//    function categorytree($parent, $term, $flag, $user_tree_array = '',$last=0){
//      try {
//        if (!is_array($user_tree_array)){   
//            $user_tree_array = array();
//            if($flag === TRUE){
//                $sql = Categories::where('lang', '=', 'en')->Where('parent', '=', $parent)->Where('name', 'like', '%'.$term.'%')->orderBy('name')->project( array('cat_id', 'name') )->get();
//            }
//            else {
//                $sql = Categories::where('lang', '=', 'en')->Where('parent', '=', $parent)->orderBy('name')->project( array('cat_id', 'name') )->get();
//            }
//            
//            if(count($sql)){
//                $user_tree_array[]= '<ul>';
//                foreach ($sql as $row) {
//                    $user_tree_array[] = '<li data-cat_id="'.$row->cat_id.'">' . $row->name;
//                    $user_tree_array = $this->categorytree($row->cat_id, $term, $flag = FALSE, $user_tree_array);
//                    $user_tree_array[]= '</li>';   
//                }
//                $user_tree_array[]= '</ul>';
//            }
//        return $user_tree_array;
//        }
//      }
//      catch (\Exception $e){
//          $error = "An error occured. ".
//                "Line Number: ".$e->getLine()." ".
//                "File Name: ".$e->getFile()." ".
//                "Error Description: ".$e->getMessage();
//          return view('errors.custom_error')->withErrors($error);
//      }
//    }  
    
    
    //public function fetchCatAncestors($currentid){
    public function fetchCatAncestors(){
        try{
            if(Request::ajax()){
                $input = Request::all();
                $rules = array(
                    'category_id' => 'required',
                );
                
                $validator = Validator::make(Request::all(), $rules);
                if ($validator->fails()) {
                    return Response::json (array(
                        'error' => true,
                        'data' => 'Validation error'
                    ), 200 );
                }
                
                $parent = 0;
                $currentid = $input['category_id'];
                $cat_hierachy = "";
                do{
                    $sql = Categories::where('lang', '=', $this->language)->Where('cat_id', '=', $currentid)->orderBy('name')->project( array('name','parent') )->first();//->take(1)->get();
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
        
     

//    function category_tree($parent, $user_tree_array = ''){
//        if (!is_array($user_tree_array))
//            $user_tree_array = array();
//        $sql = Categories::where('lang', '=', 'en')->Where('parent', '=', $parent)->orderBy('name')->project( array('cat_id', 'name') )->get();
//        foreach ($sql as $row) {
//            $i = 0;
//            if ($i == 0) $user_tree_array[]= '<ul>';
//            $user_tree_array[]= '<li data-cat_id="'.$row->cat_id.'">' . $row->name;
//            $user_tree_array=$this->category_tree($row->cat_id,$user_tree_array);
//            $user_tree_array[]= '</li>';
//            $i++;
//            if ($i > 0) $user_tree_array[]= '</ul>';
//        }
//        
//        return $user_tree_array;  
//    }    

    function fetchCategoryTreeList($parent = 0, $user_tree_array = '') {
      try{
        if (!is_array($user_tree_array))
        $user_tree_array = array();
//        $sql = "SELECT `cid`, `name`, `parent` FROM `category` WHERE 1 AND `parent` = $parent ORDER BY cid ASC";
        $sql = Categories::where('lang', '=', $this->language)->Where('parent', '=', $parent)->orderBy('name')->project( array('cat_id', 'name') )->get();
        
        //$query = mysql_query($sql);
        if (count($sql) > 0) {
            $user_tree_array[] = "<ul>";
            foreach ($sql as $row) {
//                var_dump($row->name);
                $user_tree_array[] = "<li data-catid='" . $row->cat_id . "'>" . $row->name."</li>";
                $user_tree_array = $this->fetchCategoryTreeList($row->cat_id, $user_tree_array);
            }
            $user_tree_array[] = "</ul>";
        }
        return $user_tree_array;  
      }
      catch (\Exception $e){
          $error = "An error occured. ".
            "Line Number: ".$e->getLine()." ".
            "File Name: ".$e->getFile()." ".
            "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
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
