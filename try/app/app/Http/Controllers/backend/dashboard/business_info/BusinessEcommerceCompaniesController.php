<?php

namespace Gdoox\Http\Controllers\backend\dashboard\business_info;

use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Gdoox\Http\Requests;
use Gdoox\User;
use Gdoox\SubUser;
use Gdoox\Models\DropdownOption;
use Gdoox\Models\BusinessPartner;
use Gdoox\Models\BusinessInfo;
use Gdoox\Models\BusinessEcommerceCompany;
use Illuminate\Support\Facades\Validator;
use Gdoox\Models\FieldMaster;
use Illuminate\Support\Facades\Redirect;
use Gdoox\Http\Controllers\Controller;

class BusinessEcommerceCompaniesController extends Controller
{
      use \Gdoox\Helpers\backend\dashboard\RolesUsers;
      use \Gdoox\Helpers\backend\dashboard\ImageUpload;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(Auth::user()){
        try{
          $term = 0;
          $estores=  BusinessEcommerceCompany::Where('user_id','=', Auth::user()->id)->paginate(25);
          $companies = BusinessInfo::Where('user_id','=',  Auth::user()->id)->paginate(25);
          $fm_data =  FieldMaster::where('title', '=', 'business_ecommerce_company')->where('lang','=', 'en')->first();
          $markets =  DropdownOption::where('name','market')->where('lang', 'en')->first();
          foreach($markets->options as $marketname)
          {
            $market[$marketname]=$marketname;
          }
          $required="*";
          if(!empty($_GET['company'])){
            $ecom = $_GET['company'];
            if($this->hasRole('multi-site-admin') || $this->hasRole('admin') || $this->hasRole('superadmin')){
                $term = 1;
            }
            else{
                if(count($estores)>=1){
                    $term = 0;
                    return redirect()->back()->withErrors('You do not have permission to create more than one site.');
                }
                else{
                  $term = 1;
                }
            }
         }
         if(!empty($_GET['id'])){
            $term = 2;
            $ecompany=  BusinessEcommerceCompany::where('_id', $_GET['id'])->first();
            $ecom = $ecompany->company;
         }
          return view('backend.dashboard.business_info.business_ecommerce_companies.index',compact('companies', 'ecompany', 'fm_data', 'required','estores','site', 'market', 'ecom', 'term'));
        }
        catch (\Exception $e){
            $error = "An error occured. ".
                            "Line Number: ".$e->getLine()." ".
                            "File Name: ".$e->getFile()." ".
                            "Error Description: ".$e->getMessage();
            return view('errors.custom_error')->withErrors($error);
        }
       }
       else{
               return redirect('auth/login')->with('message',"You must be login!"); 
       }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function create()
//    {
//      if(Auth::user()){
//        try{
//         $fm_data =  FieldMaster::where('title', '=', 'business_ecommerce_company')->where('lang','=', 'en')->first();
//         $company=  BusinessInfo::where('user_id', Auth::user()->id)->lists('company_name');
//         $estores=  BusinessEcommerceCompany::where('user_id','=',  Auth::user()->id)->paginate(25);
//        $markets=  DropdownOption::where('name','market')->where('lang', 'en')->first();
//        foreach($markets->options as $marketname)
//        {
//          $market[$marketname]=$marketname;
//        }
//         $required="*";
//         if(count($company)){
//              foreach($company as $com){
//                 $ecom[$com]=$com;
//             }    
//              if($this->hasRole('multi-site-admin') || $this->hasRole('admin') || $this->hasRole('superadmin')){
//                  return view('backend.dashboard.business_info.business_ecommerce_companies.create',compact( 'fm_data', 'required', 'market', 'ecom'));
//              }
//              else{
//                  if(count($estores)>=1){
//                      return Redirect::route('ecomm-index')->withErrors('You do not have permission to create more than one site.');
//                  }
//                  else{
//                      return view('backend.dashboard.business_info.business_ecommerce_companies.create',compact( 'fm_data', 'market', 'required','ecom'));
//                  }
//              }
//
//             return view('backend.dashboard.business_info.business_ecommerce_companies.create',compact( 'fm_data', 'market',  'required','ecom'));
//         }
//         else{
//            return Redirect::route('business-info-create')->withErrors("You do'nt have created company. Please create company first");
//         }
//        }
//        catch (\Exception $e){
//            $error = "An error occured. ".
//                            "Line Number: ".$e->getLine()." ".
//                            "File Name: ".$e->getFile()." ".
//                            "Error Description: ".$e->getMessage();
//            return view('errors.custom_error')->withErrors($error);
//        }
//      }else{
//                return redirect('auth/login')->with('message',"You must be login!"); 
//      }
//         
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         if(Auth::user()){
           try{
              $rules = array(
                'ecomm_company_name' => 'required|max:255|unique:business_ecommerce_companies',
                'policy_doc' => 'mimes:doc,docx,pdf'
                 );
              $validator = Validator::make($request->all(), $rules);

              if($validator->fails()){

                  return Redirect()->back()->withErrors($validator)->withInput($request->all());                        
              }
              else{
                  $data=$request->all();
                   if(!empty($data['policy_doc'])){
                      $path = Auth::user()->directory_path."/return_policy_docs/";
                      $permission = 0777;
                      $new_doc_name = "gdoox_".$data['slug']."_return_policy.";
                      $data['policy_doc'] = $this->upload($data['policy_doc'], $new_doc_name, $path, $permission, true);
                      $data['doc_path'] = $path;
                   }
                    $company_id=  BusinessInfo::where('company_name', $data['company'])->first();
                  $data['company_id']=$company_id->id;
                   DB::collection('business_ecommerce_companies')->insert($data);
                   
                  return Redirect::route('ecomm-index')->with('message', "E-commerce store created");                   
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function show($id)
//    {
//      if(Auth::user()){
//         try{
//            $ecompany=  BusinessEcommerceCompany::where('_id',$id)->first();
//            $fm_data =  FieldMaster::where('title', '=', 'business_ecommerce_company')->where('lang','=', 'en')->first();
//
//            return view('backend.dashboard.business_info.business_ecommerce_companies.show',compact( 'fm_data', 'ecompany'));
//         }
//          catch (\Exception $e){
//              $error = "An error occured. ".
//                              "Line Number: ".$e->getLine()." ".
//                              "File Name: ".$e->getFile()." ".
//                              "Error Description: ".$e->getMessage();
//              return view('errors.custom_error')->withErrors($error);
//          }
//        }
//        else{
//            return redirect('auth/login')->with('message',"You must be login!"); 
//        }
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function edit($id)
//    {
//        if(Auth::user()){
//          try{
//            $ecompany=  BusinessEcommerceCompany::where('_id',$id)->first();
//            $markets=  DropdownOption::where('name','market')->where('lang', 'en')->first();
//            foreach($markets->options as $marketname)
//            {
//              $market[$marketname]=$marketname;
//            }
//            $company=  BusinessInfo::where('user_id', Auth::user()->id)->orWhere('user_id',  $createdby->parent_id)->lists('company_name');
//            $fm_data =  FieldMaster::where('title', '=', 'business_ecommerce_company')->where('lang','=', 'en')->first();
//            $required="*";
//            foreach($company as $com){
//                $ecom[$com]=$com;
//            }       
//           return view('backend.dashboard.business_info.business_ecommerce_companies.edit',compact( 'fm_data', 'required', 'market', 'ecompany', 'ecom'));
//          }
//          catch (\Exception $e){
//              $error = "An error occured. ".
//                              "Line Number: ".$e->getLine()." ".
//                              "File Name: ".$e->getFile()." ".
//                              "Error Description: ".$e->getMessage();
//              return view('errors.custom_error')->withErrors($error);
//          }
//         }
//         else{
//           return redirect()->back()->withErrors('You dont have access to this site.');
//         }
//    }

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
          $data= $request->all();
          $rules = array(
            'ecomm_company_name' => 'required|max:255',
            'policy_doc' => 'mimes:doc,docx,pdf'
             );
          $validator = Validator::make($request->all(), $rules);

          if($validator->fails()){

              return Redirect()->back()->withErrors($validator)->withInput($request->all());                        
          }
          else{
            if(!empty($data['policy_doc'])){
               $path = Auth::user()->directory_path."/return_policy_docs/";
               $permission = 0777;
               $new_doc_name = "gdoox_".$data['slug']."_return_policy.";
               $data['policy_doc'] = $this->upload($data['policy_doc'], $new_doc_name, $path, $permission, true);
               $data['doc_path'] = $path;
            }
           $save= BusinessEcommerceCompany::where('_id', $id)->where('type', 'business')->update($data,  array('upsert' => false));
          // var_dump($save);
           if($save){
                  return Redirect::route('ecomm-index')->with('message',"Your e-store updated");
            }
            else{
                  return Redirect::route('ecomm-index')->with('message',"some error");
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