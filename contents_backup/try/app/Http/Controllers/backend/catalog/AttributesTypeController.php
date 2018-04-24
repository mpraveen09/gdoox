<?php

namespace Gdoox\Http\Controllers\backend\catalog;

//use Illuminate\Http\Request;
//
//use Gdoox\Http\Requests;
use Gdoox\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Gdoox\Models\AttributesType;

use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;

class AttributesTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(){
      try{
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('group','attribute_management')->where('parent', '26')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            $attributes= AttributesType::where('lang', '=', 'en')->get();
            return view('backend.catalog.attributes.type.index', compact('attributes','nav_menu','route'));    
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
    public function create()
    {
        $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('group','attribute_management')->where('parent', '26')->where('lang','en')->get();
        $route = Route::getCurrentRoute()->getName();
        
        return view('backend.catalog.attributes.type.create',compact('nav_menu','route'));
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
        // rules for validation 
        $rules = array(
            'id'       => 'required',
            'label'      => 'required'
        );
        $validator = Validator::make(Request::all(), $rules);

        // process the validation
        if ($validator->fails()) {
            return Redirect::route('attributestype.create')
                ->withErrors($validator)
                ->withInput(Request::all());            
        } else {
            //store
            $attributes= new AttributesType;
            
            $attributes->id       = Request::get('id');
            $attributes->label      = Request::get('label');
            $attributes->type      = 'attr_type';
            $attributes->lang      = 'en';
            $attributes->save();

            // redirect
            Session::flash('message', 'Successfully Create New "Attributes Type!"');
//            return Redirect::to('backend/catalog/attributestype/');
            return Redirect::route('attributestype.show', Request::get('id'));
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
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('group','attribute_management')->where('parent', '26')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
        
            $attributes= AttributesType::where('id', '=', $id)->where('lang', '=', 'en')->first();
            return view('backend.catalog.attributes.type.show', compact('attributes','route','nav_menu'));
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
      try {
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('group','attribute_management')->where('parent', '26')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            $attributes= AttributesType::where('id', '=', $id)->where('lang', '=', 'en')->first();
            return view('backend.catalog.attributes.type.edit', compact('attributes','route','nav_menu'));
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
    public function update(Request $request, $id){
      try{
        // rules for validation 
        $rules = array(
            'id'       => 'required',
            'label'      => 'required'
        );
        $validator = Validator::make(Request::all(), $rules);

        // process the validation
        if ($validator->fails()) {
            return Redirect::route('attributestype.edit', $id)
                ->withErrors($validator)
                ->withInput(Request::all());            
        } else {
            // store
            $attributes = AttributesType::where('id', '=', $id)->where('lang', '=', 'en')->first();
            $attributes->id = Request::get('id');
            $attributes->label = Request::get('label');
            $attributes->save();

            // redirect
            Session::flash('message', 'Successfully updated "Attributes Type!"');
//            return Redirect::to('backend/catalog/attributestype/');
            return Redirect::route('attributestype.show', $id);
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
