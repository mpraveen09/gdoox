<?php

namespace Gdoox\Http\Controllers\backend\catalog;

use Gdoox\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Gdoox\Models\Categories;
use Gdoox\Models\Attributes;
use Gdoox\Models\CategoryAttribute;
use Illuminate\Support\Facades\Route;
use Gdoox\Models\NavigationMenu;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(){
        try{
            $term= Request::input('term');
            
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('group','category_management')->where('parent', '23')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            $categories = Categories::where('lang', '=', 'en')->orderBy('cat_id')->paginate(50);
            return view('backend.catalog.categories.index', compact('categories','nav_menu','route'))->with('term',$term);
        }
        catch (\Exception $e){
            $error = "An error occured. ".
                    "Line Number: ".$e->getLine()." ".
                    "File Name: ".$e->getFile()." ".
                    "Error Description: ".$e->getMessage();
            return view('errors.custom_error')->withErrors($error);
        }
    }
    
    public function categorySearch(){
        try {
          $term= Request::input('term');
          $categories= Categories::where('lang', '=', 'en')->where('name', 'like', '%'.addslashes($term).'%')->orderBy('cat_id')->paginate(50);
          return view('backend.catalog.categories.index', compact('categories'))->with('term',$term);
        }
        catch (\Exception $e){
            $error = "An error occured. ".
                            "Line Number: ".$e->getLine()." ".
                            "File Name: ".$e->getFile()." ".
                            "Error Description: ".$e->getMessage();
            return view('errors.custom_error')->withErrors($error);
        }
    }

    
    public function autoCatSearch() {
        try {
            if(Request::ajax()){
                $input = Request::all();
                $categories= Categories::where('name', 'like', '%'.$input['term'].'%')->where('lang', '=', 'en')->project( array('cat_id','name'))->get();
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
        catch (Exception $e) {
              return Response::json ( array (
                  'error' => true,
                  'data' => $e
              ), 200 );
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
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('group','category_management')->where('parent', '23')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            $categories_= Categories::where('lang', '=', 'en')->where('leaf', '!=', '1')->where('leaf', '!=', 1)->orderBy('name')->get();
            $categorieslist = array();
            foreach ($categories_ as $category) {
                $categorieslist[$category->cat_id] = $category->cat_id . ' - ' . $category->name;
            }        

            return view('backend.catalog.categories.create')->with(compact('categorieslist','route','nav_menu'));
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
        // rules for validation 
        $rules = array(
            'cat_id'       => 'required',
            'name'      => 'required',
            'slug'      => 'required',
            'parent'      => 'required_if:isroot,0'
        );
        $validator = Validator::make(Request::all(), $rules);

        // process the validation
        if ($validator->fails()) {
            return Redirect::route('categories.create')
                ->withErrors($validator)
                ->withInput(Request::all());                        
        } else {
            // store
            $categories= new Categories;
            
            $categories->cat_id      = Request::get('cat_id');
            $categories->name      = Request::get('name');
            $categories->slug      = Request::get('slug');
            $categories->parent      = Request::get('parent');
            $categories->lang      = 'en';
            $categories->type      = 'cat';
            
            if(Request::get('isroot') === '1' && Request::get('isroot') === 1){
                $categories->parent = '0'; //set as root cat with no parent
            } else {
                if(Request::get('leaf') === '1' && Request::get('leaf') === 1){
                    $categories->leaf      = Request::get('leaf');
                }
            }
            $categories->save();

            // redirect
            Session::flash('message', 'Successfully Create New "Category!"');
            return Redirect::route('categories.show', Request::get('cat_id'));
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
        $categories= Categories::where('cat_id', '=', $id)->where('lang', '=', 'en')->first();
        $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('group','category_management')->where('parent', '23')->where('lang','en')->get();
        $route = Route::getCurrentRoute()->getName();
        
        return view('backend.catalog.categories.show', compact('categories','nav_menu','route','subroute'));
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
    public function edit($id)
    {
      try{
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('group','category_management')->where('parent', '23')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
        
            $categories= Categories::where('cat_id', '=', $id)->where('lang', '=', 'en')->first();

            $categories_= Categories::where('lang', '=', 'en')->where('leaf', '!=', '1')->where('leaf', '!=', 1)->orderBy('name')->get();
            foreach ($categories_ as $category) {
                $categorieslist[$category->cat_id] = $category->cat_id . ' - ' . $category->name;
            }        

            return view('backend.catalog.categories.edit')->with(compact('categories','categorieslist','nav_menu','route'));
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
        // rules for validation 
        $rules = array(
            'cat_id'       => 'required',
            'name'      => 'required',
            'slug'      => 'required',
            'parent'      => 'required_if:isroot,0'
        );
        $validator = Validator::make(Request::all(), $rules);

        // process the validation
        if ($validator->fails()) {
            return Redirect::route('categories.edit', $id)
                ->withErrors($validator)
                ->withInput(Request::all());                        
        } else {
            // store
            $categories= Categories::where('cat_id', '=', $id)->where('lang', '=', 'en')->first();
            
            $categories->name   = Request::get('name');
            $categories->slug   = Request::get('slug');
            $categories->leaf   = Request::get('leaf');
            $categories->parent = Request::get('parent');
            
            if(Request::get('isroot') === '1' && Request::get('isroot') === 1){
                $categories->parent = '0'; //set as root cat with no parent
                $categories->unset('leaf');
            }
            $categories->save();

            // redirect
            Session::flash('message', 'Successfully updated "Attribute!"');
            return Redirect::route('categories.show', $id);
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
    
//    public function assignAttributes($id){
//        
//        $assign_attr = Request::all();
//        if(!empty($assign_attr))
//        {
//            $rules = array(
//               'attributes' => 'required',
//            );
//
//            $validator = Validator::make(Request::all(), $rules);
//            if ($validator->fails()) {
//                  Session::flash('error', 'Please Select Atleast One Attribute.');
//                return Redirect::route('categories.assign',$id);
//
//            }
//            
//            $attributes= Attributes::where('lang', '=', 'en')->where('label','!=','')->orderBy('_id')->get();
//            $unselected_attr = array_diff($assign_attr['top_attr'], $assign_attr['attributes']);
//            
//            $values = CategoryAttribute::where('cat_id','=',$id)->first();
// 
//            foreach($unselected_attr as $unselected){
//                if (in_array($unselected, $values->attr_ids)) {
//                    CategoryAttribute::where('cat_id','=',$id)->pull(array('attr_ids' => (int)$unselected));
//                }
//                else
//                {
//                  // No Action 
//                }
//            }
//            
//            foreach($assign_attr['attributes'] as $assign)
//            { 
//                if (in_array($assign, $values->attr_ids)) {   
//                    // No Action
//                }
//                else
//                {
//                    CategoryAttribute::where('cat_id','=',$id)->push(array('attr_ids' => (int)$assign));   
//                } 
//            }
//            
//            $attr= array();
//            
//            $new_values = CategoryAttribute::where('cat_id','=',$id)->first();
//            if(!empty($new_values))
//            {
//                foreach($new_values->attr_ids as $attribute)
//                {
//                    $attr[$attribute]=$attribute;
//                }
//            }
//            Session::flash('message', 'Category assigned to Selected Attributes Successfully');
//            return view('backend.catalog.categories.assign_attr')
//                    ->with(compact('attributes','attr'))->with('id',$id); 
//        }
//        else {
//        Session::forget('message');
//        $attributes= Attributes::where('lang', '=', 'en')->where('label','!=','')->orderBy('_id')->get();
//        
//        $values= CategoryAttribute::where('cat_id','=', $id)->first();
//        $attr= array();
//        if(!empty($values))
//        {
//            foreach($values->attr_ids as $attribute)
//            {
//                $attr[$attribute]=$attribute;
//            }
//        }
//        
//        return view('backend.catalog.categories.assign_attr')
//            ->with(compact('attributes','attr'))->with('id',$id);
//        }
//    }
    
    public function updateAssignedAttributes($id)
    {
        // Used before, now changed the functionality and 
        // used the code in assignAttributes function using condition to assign Attributes 
    }
    
    
    // Autocomplete Search functionality on the Assign Attribute to Categories Page using Ajax
    public function attrSearch()
    { 
      try{
        $term= Request::input('term');
        $id= Request::input('id');
        if(strpos($term, "-->")){
            $term = addslashes(trim(substr($term, strpos($term, "-->")+4 ))) ;
        }
        
        $attr= array();
        
        $new_values = CategoryAttribute::where('cat_id','=',$id)->first();

        foreach($new_values->attr_ids as $attribute)
        {
            $attr[$attribute]=$attribute;
        }
        
        $attributes= Attributes::where('label', 'like', '%'.$term.'%')->orWhere('desc','like','%'.$term.'%')->where('lang', '=', 'en')->orderBy('_id')->get();
        return view('backend.catalog.categories.assign_attr', compact('attributes','attr'))->with('id',$id);
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                          "Line Number: ".$e->getLine()." ".
                          "File Name: ".$e->getFile()." ".
                          "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }
    
    
     public function assignAttributes($id){
       try{
         // Every time when the new attributes is assigned or changed the if loop will be executed.
        $assign_attr = Request::all();

        if(!empty($assign_attr))
        {
            $rules = array(
               'attributes' => 'required',
            );

            $validator = Validator::make(Request::all(), $rules);
            if ($validator->fails()) {
                  Session::flash('error', 'Please Select Atleast One Attribute.');
                return Redirect::route('categories.assign',$id);
            }

            $values = CategoryAttribute::where('cat_id','=',$id)->first();
            
            $values->attr_ids = $assign_attr['attributes'];
            $attributes= Attributes::orderBy('_id', 'asc')->where('lang', '=', 'en')->where('label','!=','')->get();
            if($values->save())
            {
                $attr= array();
                $new_values = CategoryAttribute::where('cat_id','=',$id)->first();
                if(!empty($new_values))
                {
                    foreach($new_values->attr_ids as $attribute)
                    {
                        $attr[$attribute]=$attribute;
                    }
                }
                Session::flash('message', 'Category assigned to Selected Attributes Successfully');
                return view('backend.catalog.categories.assign_attr')
                        ->with(compact('attributes','attr'))->with('id',$id); 
            }
            else {
                    $attr= array();
                    $new_values = CategoryAttribute::where('cat_id','=',$id)->first();
                    if(!empty($new_values))
                    {
                        foreach($new_values->attr_ids as $attribute)
                        {
                            $attr[$attribute]=$attribute;
                        }
                    }
                    Session::flash('message', 'Something went wrong! Category could not be assigned to Selected Attributes');
                    return view('backend.catalog.categories.assign_attr')
                            ->with(compact('attributes','attr'))->with('id',$id); 
            }
            
        }
        // Else loop will execute first time when the page is loaded.
        else {
        Session::forget('message');
        $attributes= Attributes::orderBy('_id', 'asc')->where('lang', '=', 'en')->where('label','!=','')->get();
        
        $values= CategoryAttribute::where('cat_id','=', $id)->first();
        $attr= array();
        if(!empty($values))
        {
            foreach($values->attr_ids as $attribute)
            {
                $attr[$attribute]=$attribute;
            }
        }
        
        return view('backend.catalog.categories.assign_attr')
            ->with(compact('attributes','attr'))->with('id',$id);
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
