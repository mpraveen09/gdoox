<?php

namespace Gdoox\Http\Controllers\backend\catalog;


use Gdoox\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Gdoox\Models\DropdownOptions;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


class DropdownOptionsController extends Controller {
    use \Gdoox\Helpers\backend\dashboard\RolesUsers;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    
    private $language;
    public function __construct() {
        $this->language = session('app_language');
    }
    
    public function index(){
      try {
            $role = $this->getRoleName(Auth::user()->id); 
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('menu','GDOOX PLATFORM MANAGEMENT TEAM')->where('user',$role)->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            $dropdownoptions = DropdownOptions::where('lang','=', $this->language)->get();
            return view('backend.catalog.attributes.dropdownoptions.index', compact('dropdownoptions','nav_menu','route'));
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
    public function create() {
        $role = $this->getRoleName(Auth::user()->id); 
        $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('menu','GDOOX PLATFORM MANAGEMENT TEAM')->where('user',$role)->where('lang','en')->get();
        $route = Route::getCurrentRoute()->getName();
            
        return view('backend.catalog.attributes.dropdownoptions.create',compact('route','nav_menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request){
        try{
          // rules for validation 
          $rules = array(
              'name'       => 'required',
              'options'      => 'required'
          );
          $validator = Validator::make(Request::all(), $rules);

          // process the validation
          if ($validator->fails()) {
              return Redirect::route('dropdownoptions.create')
                  ->withErrors($validator)
                  ->withInput(Request::all());            
          } else {
              //store
              $dropdownoptions= new DropdownOptions;

              $dropdownoptions->name       = Request::get('name');
              $dropdownoptions->options      = array_map('trim', explode("\n", Request::get('options')) );
              $dropdownoptions->type      = 'drop_options';
              $dropdownoptions->lang      = 'en';            
              $dropdownoptions->save();

              // redirect
              Session::flash('message', 'Successfully Create New "Dropdown List!"');
  //            return Redirect::to('backend/catalog/dropdownoptions/');
              return Redirect::route('dropdownoptions.show', Request::get('name'));
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
            
            $dropdownoptions = DropdownOptions::where('_id', '=', $id)->first();
            return view('backend.catalog.attributes.dropdownoptions.show', compact('dropdownoptions','nav_menu','route'));
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
            
            $dropdownoptions = DropdownOptions::where('_id', '=', $id)->first();
            return view('backend.catalog.attributes.dropdownoptions.edit', compact('dropdownoptions','nav_menu','route'));
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
        try {
          // rules for validation 
          $rules = array(
              'name' => 'required',
              'options' => 'required'
          );
          $validator = Validator::make(Request::all(), $rules);

          // process the validation
          if ($validator->fails()) {
  //            return Redirect::to('backend/catalog/dropdownoptions/' . $id . '/edit')
  //                ->withErrors($validator);
              return Redirect::route('dropdownoptions.edit', $id)
                  ->withErrors($validator)
                  ->withInput(Request::all());            
          } else {
              // store
              $dropdownoptions= DropdownOptions::where('_id', '=', $id)->first();
              $dropdownoptions->name = Request::get('name');
              $dropdownoptions->options = array_map('trim', explode("\n", Request::get('options')) );
              $dropdownoptions->save();

              // redirect
              Session::flash('message', 'Successfully updated "Attributes Classification!"');
  //            return Redirect::to('backend/catalog/dropdownoptions/');
              return Redirect::route('dropdownoptions.show', Request::get('name'));
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
