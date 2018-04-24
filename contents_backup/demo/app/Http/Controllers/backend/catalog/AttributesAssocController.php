<?php

namespace Gdoox\Http\Controllers\backend\catalog;


use Gdoox\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Gdoox\Models\AttributesAssoc;

use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


class AttributesAssocController extends Controller {
    use \Gdoox\Helpers\backend\dashboard\RolesUsers;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
      try {
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('menu','GDOOX PLATFORM MANAGEMENT TEAM')->where('user',$role)->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            $lang = session('app_language');
            
            $attributes = AttributesAssoc::where('lang', '=', $lang)->get();
            return view('backend.catalog.attributes.assoc.index', compact('attributes','nav_menu','route'));
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
        $role = $this->getRoleName(Auth::user()->id);            
        $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('menu','GDOOX PLATFORM MANAGEMENT TEAM')->where('user',$role)->where('lang','en')->get();
        $route = Route::getCurrentRoute()->getName();
        
        return view('backend.catalog.attributes.assoc.create',compact('route','nav_menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request){
      try {
        $rules = array(
            'id'=> 'required',
            'label' => 'required'
        );
        $validator = Validator::make(Request::all(), $rules);

        // process the validation
        if ($validator->fails()) {
            return Redirect::route('attributesassoc.create')
                ->withErrors($validator)
                ->withInput(Request::all());            
        } else {
            //store
            $attributes = new AttributesAssoc;
            $attributes->id = Request::get('id');
            $attributes->label = Request::get('label');
            $attributes->type = 'attr_assoc';
            $attributes->lang = 'en';            
            if($attributes->save()){
                Session::flash('message', '"Attributes Classification" created Successfully.');
                return Redirect::route('attributesassoc.show', Request::get('id'));
            }
            else {
                return redirect()->back()->with('message','Attributes Classification could not be created. Please try Again.');
            }

            // redirect
            
//          return Redirect::to('backend/catalog/attributesassoc/');
            
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
            $role = $this->getRoleName(Auth::user()->id);           
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('menu','GDOOX PLATFORM MANAGEMENT TEAM')->where('user',$role)->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();

            $attributes= AttributesAssoc::where('_id', '=', $id)->first();
            return view('backend.catalog.attributes.assoc.show', compact('attributes','nav_menu','route'));
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
            $role = $this->getRoleName(Auth::user()->id);            
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('menu','GDOOX PLATFORM MANAGEMENT TEAM')->where('user',$role)->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
            
            $attributes = AttributesAssoc::where('_id', '=', $id)->first();
            return view('backend.catalog.attributes.assoc.edit', compact('attributes','nav_menu','route'));
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
          $rules = array(
                'id' => 'required',
                'label' => 'required'
            );
            $validator = Validator::make(Request::all(), $rules);

            // process the validation
            if ($validator->fails()) {
                return Redirect::route('attributesassoc.edit', $id)
                    ->withErrors($validator)
                    ->withInput(Request::all());            
            } else {
                // store
                $attributes = AttributesAssoc::where('_id', '=', $id)->first();
                $attributes->id = Request::get('id');
                $attributes->label = Request::get('label');
                if($attributes->save()){
                    Session::flash('message', '"Attributes Classification" updated Successfully.');
                    return Redirect::route('attributesassoc.show', $id);
                }
                else {
                    return redirect()->back()->with('message','Attributes Classification could not be updated. Please try Again!');
                }
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
