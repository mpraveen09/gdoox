<?php

namespace Gdoox\Http\Controllers\backend\dashboard\business_info\business_verification_logs;

use DB;
use Response;
use Gdoox\Models\FieldMaster;
use Illuminate\Support\Facades\Auth;
use Gdoox\Models\BusinessVerificationLog;
use Gdoox\Models\BusinessInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Gdoox\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Gdoox\Http\Controllers\Controller;

class VerifyFiscalVatController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      try{
         $fm_data =  FieldMaster::where('title', 'business_verification_log')->where('lang', 'en')->first();
         $company=BusinessInfo::where('_id', $id)->first();
         
         $required="*";
         
         return view('backend.dashboard.business_info.business_verification_logs.verify_fiscal_vat.edit', compact('fm_data', 'company', 'required'));
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      try{
        $rules = array(
            'company_name' => 'required|unique:business_verification_logs',
            'vat_fiscal_id'=>'required'
             );
         $validator = Validator::make($request->all(), $rules);
         if ($validator->fails()) {
             return Redirect()->back()->withErrors($validator)->withInput($request->all());                        
         }
         else {
              $business=['status'=>'Active',
                                    'verify'=>'Verified',
                                    'vat_fiscal_id'=>$request->input('vat_fiscal')];
              DB::collection('business_info')->where('_id', $request->input('company_id'))->update($business);
              
              $verify=new BusinessVerificationLog();
              $verify->company_name=$request->input('company_name');
              $verify->company_id= $request->input('company_id');
              $verify->user_id=$request->input('user_id');
              $verify->vat_fiscal_id=$request->input('vat_fiscal_id');
              $verify->verification=true;
              $verify->verification_check="Yes";
              $verify->checked_by="Auto";
              if($verify->save()){
                  return Redirect::route('ecomm-index')->with('message',"Verification Successful");                        
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