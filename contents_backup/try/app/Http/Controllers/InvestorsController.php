<?php

namespace Gdoox\Http\Controllers;
use DB;
use Auth;
use Illuminate\Http\Request;

use Gdoox\Http\Requests;
use Gdoox\Http\Controllers\Controller;

class InvestorsController extends \Gdoox\Http\Controllers\backend\FieldMasterController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function instituional_investors(){
        try{
            $field_master_data = DB::collection('investors')->where('_id', '=', 'institutional_investors_en')->get();
            $field_data=$this->create_fields($field_master_data);
            return view('investor.institutional_investors')->with('field_data',$field_data);
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
      
    }
  /**
     * Display a listing of the resource.
     *
     * @return View all Institutional Investors Page
     */
  public function View_InstitutionalInvestors(){
      try {
            $inst_data = DB::collection('institutional_investors')->paginate(5);
            return view('investor.View_InstitutionalInvestors',compact('inst_data'));
      }
      catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
  }
  
   /**
     * Display a listing of the resource.
     *
     * @return save data into collections
     */
  public function InsertInstitutionalInvestors(Request $request){
      try{
            $data=$request->all();
            DB::collection('institutional_investors')->insert($data);
            return redirect()->action('InvestorsController@View_InstitutionalInvestors');
      }
      catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
  }
   
    /**
     * Display a listing of the resource.
     *
     * @return Edit Form
     */
    public function EditInstitutionalInvestor($id){
      try{
            $field_master_data = DB::collection('investors')->where('_id', '=', 'institutional_investors_en')->get();
            $inst_data= DB::collection('institutional_investors')->where('_id', '=', $id)->get();
           //print_r($inst_data);
            return view('investor.EditInstitutionalInvestor',compact('field_master_data','inst_data'));
      }
      catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Update data
     */
    public function UpdateInstitutionalInvestor(Request $request){
      try{
            $id=$request['inst_id'];
            $fields_data=$request->all();
       
            if( DB::collection('institutional_investors')->where('_id', '=', $id)->update($fields_data)){
                 return redirect()->action('InvestorsController@View_InstitutionalInvestors');
            }
            else {
                $message="someError!";
                return $message;
            }
        }
        catch(\Exception $e){
              $errors = $this->errorMessage($e);
              return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
   

    /**
     * Display a listing of the resource.
     *
     * @return Delete  
      */
    public function DeleteInstitutionalInvestor($id){
        try {
            if (Auth::user()) {
                   DB::collection('institutional_investors')->where('_id', '=', $id)->delete();
            }
            return redirect()->action('InvestorsController@View_InstitutionalInvestors');
        }
        catch(\Exception $e){
              $errors = $this->errorMessage($e);
              return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    public function ViewInstitutionalInvestor($id){
        try{
            $view=DB::collection('institutional_investors')->find($id);
            if(!empty($view['_id'])){
                  return view('investor.ViewInstitutionalInvestor',compact('view'));
            }
            else{
                   return response()->view('errors.404', [], 404);
            }
        }
        catch(\Exception $e){
              $errors = $this->errorMessage($e);
              return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    /*=======================#@Private Investors Form===================================*/
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function private_investors(){
        try{
            $field_master_data = DB::collection('investors')->where('_id', '=', 'private_investors_en')->get();
            $field_data=$this->create_fields($field_master_data);
            return view('investor.private_investors')->with('field_data',$field_data);
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    /**
     * Display a listing of the resource.
     *	Untitled Document.json
nbproject/private/

     * @return View Personal Profile Page
     */
  public function View_PrivateInvestors(){
      try{
        // $profile_data=DB::collection('profiles')->get();
        $private_investor_data = DB::collection('private_investors')->paginate(5);
        return view('investor.View_PrivateInvestors',compact('private_investor_data'));
      }
      catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
  }
      /**
     * Display a listing of the resource.
     *
     * @return save data into collections
     */
  public function InsertPrivateInvestors(Request $request){
      try {
            $data=$request->all();
            DB::collection('private_investors')->insert($data);
            return redirect()->action('InvestorsController@View_PrivateInvestors');
      }
      catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
  }
   
    /**
     * Display a listing of the resource.
     *
     * @return Edit Form
     */
    public function EditPrivateInvestor($id){
      try {
            $field_master_data = DB::collection('investors')->where('_id', '=', 'private_investors_en')->get();
            $private_data= DB::collection('private_investors')->where('_id', '=', $id)->get();
            return view('investor.EditPrivateInvestor',compact('field_master_data','private_data'));
      }
      catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Update data
     */
    public function UpdatePrivateInvestor(Request $request){
      try{
            $id=$request['private_id'];
            $fields_data=$request->all();

            if( DB::collection('private_investors')->where('_id', '=', $id)->update($fields_data)){
                return redirect()->action('InvestorsController@View_PrivateInvestors');
            }
            else{
              $message="someError!";
              return $message;
            }
      }
      catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Delete  
      */
    public function DeletePrivateInvestor($id){
        try{
            if (Auth::user()) {
                DB::collection('private_investors')->where('_id', '=', $id)->delete();
            }
            return redirect()->action('InvestorsController@View_PrivateInvestors');
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    public function ViewPrivateInvestor($id){
        try{
            $view=DB::collection('private_investors')->find($id);
            if(!empty($view['_id'])){
                  return view('investor.ViewPrivateInvestor',compact('view'));
            }
            else{
                return response()->view('errors.404', [], 404);
            }
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
