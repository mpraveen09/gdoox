<?php

namespace Gdoox\Http\Controllers\backend\dashboard\business_info\business_verification_logs;

use DB;
use Response;
use Input;
use Illuminate\Support\Facades\Redirect;
use Gdoox\Models\FieldMaster;
use Illuminate\Support\Facades\Auth;
use Gdoox\Models\BusinessVerificationLog;
use Gdoox\Models\BusinessInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Gdoox\Http\Requests;
use Gdoox\Http\Controllers\Controller;

class VerifyDocumentController extends Controller
{
    use \Gdoox\Helpers\backend\dashboard\ImageUpload;
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
         
         return view('backend.dashboard.business_info.business_verification_logs.verify_documents.edit', compact('fm_data', 'company', 'required'));
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                          "Line Number: ".$e->getLine()." ".
                          "File Name: ".$e->getFile()." ".
                          "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }
    
    /*
     * @param image $docs
     * @ return rules for validation
     */
    public function rules($docs)
    {
      try{
        $rules = [
                  'company_name' => 'required|unique:business_verification_logs',
                  'vat_fiscal_id'=>'required',
        ];

        foreach($docs as $key => $val)
        {
          $rules['docs.'.$key] =  'mimes:jpeg,jpg,pdf';
        }

        return $rules;
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
         $data=$request->all();
//         echo "<pre>"; print_r($data['docs']); die;
         
         $rules= $this->rules($data['docs']);
//          print_r($rules); die;
         $validator = Validator::make($request->all(), $rules);
         if ($validator->fails()) {
             return Redirect()->back()->withErrors($validator)->withInput($request->all());                        
         }
         else {
              $business=['status' => 'Inactive',
//                                    'verify'=>'Verify/Activate',
                                    'vat_fiscal_id' => $request->input('vat_fiscal_id')
                                    ];
              DB::collection('business_info')->where('_id', $request->input('company_id'))->update($business);
              $path =Auth::user()->directory_path."/company_docs";
              $permission = 0777;
              $document = $this->uploadDocuments($path, $permission, true, $data['docs'], $data['doc_name'], $doc = []);
              $verify_data = ['user_id' => $data['user_id'],
                                        'doc' => $document,
                                        'company_name' => $data['company_name'],
                                        'company_id' => $data['company_id'],
                                        'vat_fiscal_id' => $data['vat_fiscal_id'],
                                        'verification_check' => 'No',
                                        'checked_by' => '',
                                        'verification' => false,
                                        'ext' => $this->Extension($data['docs']),
                                        'doc_path' => $path
                                        ];
         
              DB::collection('business_verification_logs')->insert($verify_data);
             return Redirect::route('ecomm-index')->with('message',"Your Business documents has been submitted. Your busines will verify after few days and you will get verification email.");                        
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

    /*
     * Fetchingl country of business using ajax
     * 
     */
//    public function fetchCountry(){
//        try{
//            if($request->ajax()){
//                $input = $request->all();
//                //echo Request::input('company_name'); 
//                $rules = array  (
//                    'company_name' => 'required',
//                );
//                
//                $validator = Validator::make($request->all(), $rules);
//                if ($validator->fails()) {
//                      return Response::json ( array (
//                          'error' => true,
//                          'data' => 'Validation error'
//                      ), 200 );
//                }
//
//                $countries = BusinessInfo::where('company_name', $request->input('company_name'))->lists('country');
//                foreach($countries as $cont)
//                {
//                    $country=$cont;
//                }
//                return Response::json ( array (
//                    'error' => false,
//                    'data' => $country
//                ), 200 );
//            }
//        } catch (Exception $e) {
//              return Response::json ( array (
//                  'error' => true,
//                  'data' => $e
//              ), 200 );
//        }
//    }
}
