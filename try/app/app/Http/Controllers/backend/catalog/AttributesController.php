<?php

namespace Gdoox\Http\Controllers\backend\catalog;

use Gdoox\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Gdoox\Models\Attributes;
use Gdoox\Models\CategoryAttribute;
use Gdoox\Models\AttributesAssoc;
use Gdoox\Models\AttributesType;
use Gdoox\Models\DropdownOptions;
use \Gdoox\Models\Categories;
use Illuminate\Support\Facades\Route;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Auth;



class AttributesController extends Controller
{
    use \Gdoox\Helpers\backend\dashboard\RolesUsers;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(){
      try {
            Session::forget('message');
            $term = Request::input('term');
            
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('menu','GDOOX PLATFORM MANAGEMENT TEAM')->where('user',$role)->where('lang','en')->get();            
            $route = Route::getCurrentRoute()->getName();
            
            $attributes= Attributes::where('lang', '=', 'en')->orderBy('_id')->paginate(50);
            return view('backend.catalog.attributes.index', compact('attributes','nav_menu','route'))->with('term',$term);
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
  }
    
    public function attributeSearch(){
      try {
        $term= Request::input('term');
        if(strpos($term, "-->")){
            $term = addslashes(trim(substr($term, strpos($term, "-->")+4 ))) ;
        }
        
        $attributes= Attributes::where('label', 'like', '%'.$term.'%')->orWhere('desc','like','%'.$term.'%')->where('lang', '=', 'en')->orderBy('_id')->paginate(50);
        return view('backend.catalog.attributes.index', compact('attributes'))->with('term',$term);
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                          "Line Number: ".$e->getLine()." ".
                          "File Name: ".$e->getFile()." ".
                          "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
         
    }
    
    public function autoAttrSearch() {
        try{
            if(Request::ajax()){
                $input = Request::all();
                $attributes= Attributes::where('label', 'like', '%'.$input['term'].'%')->orWhere('desc','like','%'.$input['term'].'%')->where('lang', '=', 'en')->project( array('attr_id','label','desc'))->get();
                $i = 0;
                foreach($attributes as $attributes){
                        $response[$i]['attribute'] = $attributes['label'].' --> '.$attributes['desc'].'';
                        $response[$i]['attr_id'] = $attributes['attr_id'];
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
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(){
      try{
        
        $role = $this->getRoleName(Auth::user()->id);
        $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('menu','GDOOX PLATFORM MANAGEMENT TEAM')->where('user',$role)->where('lang','en')->get();
        $route = Route::getCurrentRoute()->getName();
        
        $a_assocs= AttributesAssoc::where('lang', '=', 'en')->get();//all(array('id','label'));
        $a_assocs_ = array();
        $a_types_ = array();
        foreach ($a_assocs as $a_assoc) {
            $a_assocs_[$a_assoc->id] = $a_assoc->id . ' - ' . $a_assoc->label;
        }        
        $a_types= AttributesType::where('lang', '=', 'en')->get();//all(array('id','label'));
        foreach ($a_types as $a_type) {
            $a_types_[$a_type->id] = $a_type->id . ' - ' . $a_type->label;
        } 
        $dd_opts= DropdownOptions::where('lang', '=', 'en')->orWhere('lang', '=', 'EN')->get();
        foreach ($dd_opts as $dd_opt) {
            if(!empty($dd_opt->name) ){
                $dd_opts_[$dd_opt->id] = $dd_opt->name;
            }else{
                $dd_opts_[$dd_opt->id] = substr(  implode(", ", $dd_opt->options), 0,50 ) . '...';//substr( implode(", ", $dd_opt->options), 0, 50 );
            }
        } 
        
        return view('backend.catalog.attributes.create')
                ->with(compact('a_assocs_','a_types_','dd_opts_','nav_menu','route'));
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
    public function store(Request $request)
    {
      try{
        $rules = array(
            'attr_id'       => 'required',
            'label'      => 'required',
            'desc'      => 'required',
            'field_type'      => 'required',
//            'len'      => 'required|numeric|min:1',
            'class'      => 'required',
            'req'      => 'required',
            'drop_options'=> 'required_if:field_type,TD,TM'
        );
        $validator = Validator::make(Request::all(), $rules);

        // process the validation
        if ($validator->fails()) {
            return Redirect::route('attributes.create')
                ->withErrors($validator)
                ->withInput(Request::all());                        
        } else {
            // store
            $attributes= new Attributes;
            $attributes->attr_id       = Request::get('attr_id');
            $attributes->label      = Request::get('label');
            $attributes->desc      = Request::get('desc');
            $attributes->field_type      = Request::get('field_type');
            $attributes->len = Request::get('len');
            $attributes->class = Request::get('class');
            $attributes->req      = Request::get('req');
            $attributes->dropdown_list      = Request::get('drop_options');
            $attributes->type      = 'attr';
            $attributes->lang      = 'en';            
            $attributes->save();
            // redirect
            Session::flash('message', 'Successfully Create New "Attribute!"');
            return Redirect::route('attributes.show', Request::get('attr_id'));
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
          
        $role = $this->getRoleName(Auth::user()->id);
        $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('menu','GDOOX PLATFORM MANAGEMENT TEAM')->where('user',$role)->where('lang','en')->get();
        $route = Route::getCurrentRoute()->getName();
        
        $attributes= Attributes::where('attr_id', '=', $id)->where('lang', '=', 'en')->first();
        return view('backend.catalog.attributes.show', compact('attributes','nav_menu','route'));
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
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('menu','GDOOX PLATFORM MANAGEMENT TEAM')->where('user',$role)->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();

            $attributes = Attributes::where('attr_id', '=', $id)->where('lang', '=', 'en')->first();

            $a_assocs = AttributesAssoc::where('lang', '=', 'en')->get();//all(array('id','label'));
            $a_assocs_ = array();
            foreach ($a_assocs as $a_assoc) {
              $a_assocs_[$a_assoc->id] = $a_assoc->id . ' - ' . $a_assoc->label;
            }        
            $a_types = AttributesType::where('lang', '=', 'en')->get();//all(array('id','label'));
            foreach ($a_types as $a_type) {
              $a_types_[$a_type->id] = $a_type->id . ' - ' . $a_type->label;
            } 
            $dd_opts = DropdownOptions::where('lang', '=', 'en')->orWhere('lang', '=', 'EN')->get();
            foreach ($dd_opts as $dd_opt) {
                if(!empty($dd_opt->name) ){
                    $dd_opts_[$dd_opt->id] = $dd_opt->name;
                }else{
                    $dd_opts_[$dd_opt->id] = substr(  implode(", ", $dd_opt->options), 0,50 ) . '...';//substr( implode(", ", $dd_opt->options), 0, 50 );
                }
            } 
            return view('backend.catalog.attributes.edit',compact('route','nav_menu','attributes','a_assocs_','a_types_','dd_opts_'));
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
    public function update(Request $request, $id) {
      try {
        // rules for validation 
        $rules = array(
            'attr_id'=> 'required',
            'label' => 'required',
            'desc' => 'required',
            'field_type' => 'required',
//          'len' => 'required|numeric|min:1',
            'class' => 'required',
            'req' => 'required',
            'drop_options'=> 'required_if:field_type,TD,TM'
        );
        $validator = Validator::make(Request::all(), $rules);

        // process the validation
        if ($validator->fails()) {
            return Redirect::route('attributes.edit', $id)
                ->withErrors($validator)
                ->withInput(Request::all());                        
        } else {
            // store
            $attributes= Attributes::where('attr_id', '=', $id)->where('lang', '=', 'en')->first();   
            $attributes->attr_id = Request::get('attr_id');
            $attributes->label = Request::get('label');
            $attributes->desc = Request::get('desc');
            $attributes->field_type = Request::get('field_type');
            $attributes->len = Request::get('len');
            $attributes->class = Request::get('class');
            $attributes->req = Request::get('req');
            $attributes->dropdown_list = Request::get('drop_options');  
            $attributes->save();
            // redirect
            Session::flash('message', 'Successfully updated "Attribute!"');
            return Redirect::route('attributes.show', $id);
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
    
    public function assignCategories($id){
       try{
        if(!empty($assign_cat))
        {
            $categories= Categories::where('parent','=',0)->where('lang','=','en')->where('slug','!=','')->get();
            $rules = array(
               'category' => 'required',
            );
            $validator = Validator::make(Request::all(), $rules);
            if ($validator->fails()) {
                  Session::flash('error', 'Please Select Atleast One Category.');
                return Redirect::route('attributes.assign',$id);
            }
            $unselected_cat = array_diff($assign_cat['top_cat'], $assign_cat['category']);
            foreach($unselected_cat as $unselected){
                $unselect = CategoryAttribute::where('cat_id','=',$unselected)->first();
                if (in_array($id, $unselect->attr_ids)) {   
                   CategoryAttribute::where('cat_id','=',$unselected)->pull(array('attr_ids' => (int)$id));
                }
                else
                {
                  // No Action 
                }
            }
            foreach($assign_cat['category'] as $assign)
            {
                $get_cat = CategoryAttribute::where('cat_id','=',$assign)->first();
                if (in_array($id, $get_cat->attr_ids)) {   
                    // No Action( Attribute is already assigned to the Category)
                }
                else
                {
                    CategoryAttribute::where('cat_id','=',$assign)->push(array('attr_ids' => (int)$id));  
                }

                $assigned_cat= CategoryAttribute::where('attr_ids','=', (int)$id)->project(array('cat_id'))->get();
                $cat= array();
                foreach($assigned_cat as $category)
                {
                    $cat[$category->cat_id] = $category->cat_id;
                } 
            }
            Session::flash('message', 'Attribute assigned to Selected Categories Successfully');
            return view('backend.catalog.attributes.assign_cat')
            ->with(compact('categories','attributes','cat'))->with('id',$id);
        }
        else {
            Session::forget('message');
            $categories= Categories::where('parent','=',0)->where('lang','=','en')->where('slug','!=','')->get();
            $assigned_cat= CategoryAttribute::where('attr_ids','=', (int)$id)->project(array('cat_id'))->get();

            $cat= array();

            foreach($assigned_cat as $category)
            {
                $cat[$category->cat_id] = $category->cat_id;
            }

            return view('backend.catalog.attributes.assign_cat')
                ->with(compact('categories','attributes','cat'))->with('id',$id); 
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
