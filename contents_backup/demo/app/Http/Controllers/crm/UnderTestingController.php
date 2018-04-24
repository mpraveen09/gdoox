<?php

namespace Gdoox\Http\Controllers\crm;


use Gdoox\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Gdoox\Models\CrmFieldMaster;
use Gdoox\Models\CrmUsers;
use Gdoox\Models\DropdownOption;
use Gdoox\Models\CrmDropdownOptions;
use Gdoox\Models\CrmGroups;
use Gdoox\Models\BusinessInfo;
use Gdoox\Models\NavigationMenu;
use Gdoox\UserRole;
use Gdoox\Role;
use Gdoox\User;
use Route;
use Form;
use Image;
use Input;
use UUID;

class UnderTestingController extends Controller { 
    use  \Gdoox\Helpers\backend\dashboard\RolesUsers;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(){
        try {        
            return view('crm.under_testing.index');
        }
        catch(\Exception $e) {
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
       }  
    }
    
    
    
    /**
     * Show the form for adding a new product.
     *
     * @return Response
     */    
    public function create(){

    }    


    /*
    * Edit product
    */
    public function edit($id){
        
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(){
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id){
        
    }
    

/*
 * Update product
 */
  public function update($id){
    
  } 
  
    public function errorMessage($e){
        $error = "An error occured. ".
            "Line Number: ".$e->getLine()." ".
            "File Name: ".$e->getFile()." ".
            "Error Description: ".$e->getMessage(); 
        return $error;
    }
}
