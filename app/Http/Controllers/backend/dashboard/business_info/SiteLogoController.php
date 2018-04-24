<?php

namespace Gdoox\Http\Controllers\backend\dashboard\business_info;

use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Gdoox\Http\Requests;
use Gdoox\User;
use Gdoox\SubUser;
use Gdoox\Models\BusinessInfo;
use Gdoox\Models\BusinessEcommerceCompany;
use Illuminate\Support\Facades\Validator;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\SiteLogo;
use Illuminate\Support\Facades\Redirect;
use Gdoox\Http\Controllers\Controller;

class SiteLogoController extends Controller
{
  use \Gdoox\Helpers\backend\dashboard\ImageUpload;
  use \Gdoox\Helpers\backend\dashboard\HelperFunctions;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      try{
        $createdby=  User::where('_id',Auth::user()->id)->first();
        $siteuser=User::where('_id', Auth::user()->id)->first();
        $subuser= SubUser::where('parent_id', $createdby->parent_id)->first();
        if(!empty($subuser->permission)){
            foreach($subuser->permission as $key=>$val){
                $site[]=$key;
            }
        }
        if(!empty($siteuser) || (!empty($site))){
        
            $fm_data =  FieldMaster::where('title', '=', 'business_ecommerce_company')->where('lang','=', 'en')->first();
            $ecommsite=  BusinessEcommerceCompany::Where('user_id',  $createdby->parent_id)->orWhere('user_id','=',  Auth::user()->id)->paginate(25);
            $personalsite=  BusinessInfo::where('user_id', Auth::user()->id)->orWhere('user_id',  $createdby->parent_id)->where('type', 'personal')->get();
            $sitename=isset($site)?$site:array();
            $estores=array();
            foreach ($ecommsite as $value) {
               if(in_array($value->slug,$sitename) || $value->user_id==Auth::user()->id){
                 if(isset($value->ecomm_company_name)){
                      $estores['site_name'][]= $value->ecomm_company_name;
                      $estores['slug'][]= $value->slug;
                 }
               }
             }
             foreach ($personalsite as $value) {
               if(isset( $value->site_name)){
                    $estores['site_name'][] = $value->site_name;
                    $estores['slug'][]= $value->slug;
               }
             }
//             echo "<pre>";print_r($estores); 
//             die;
            return view('backend.dashboard.business_info.business_ecommerce_companies.site_logo.index', compact('fm_data','required','estores','site'));
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
    
//    public function addCatalog($id)
//    {          
//         $get_catalog = ProductCatalog::Where('shopid','=',$id)->get();
//         return view('backend.productcatalog.addcatalog', compact('get_catalog'))->with('shopid',$id);
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      try{
         $esites = SiteLogo::Where('shop_id','=',$id)->get();
//         $esites=$esite->site_images;
//         echo"<pre>"; print_r($esite); die;
         return view('backend.dashboard.business_info.business_ecommerce_companies.site_logo.create', compact('esites','id'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      try{
        $logodata=$request->all();
        $rules = array(
        'site_logo' => 'required|mimes:jpg,png,gif,jpeg',
         );
        $validator = Validator::make($request->all(), $rules);

        // process the validation
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());                        
        }
        else {
            $logo= SiteLogo::where('shop_id',$logodata['shop_id'])->first();
//            print_r($logo); die;
            if(isset($logo->site_logo)){
                return redirect()->back()->withErrors("You can select only one logo for a site.");                        
            }
            $site_logo=$this->UploadSIteLogo('site_logo');
            $logodata['site_logo']=$this->image;
            if($site_logo === false){
                return redirect()->back()->withErrors($validator)->withInput($request->all());                        
            }
            else{
              $logodata['company_id'] = $this->CompanyId($logodata['shop_id']);
              DB::Collection('site_logo')->insert($logodata);
              $logo= SiteLogo::where('shop_id',$logodata['shop_id'])->first();
              return Redirect::route('site.logo.create',$logo->shop_id)->with('message','Site logo uploaded successfully.');
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
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      try{
        $logodata= SiteLogo::where('_id',$id)->first();
        return view('backend.dashboard.business_info.business_ecommerce_companies.site_logo.edit',compact('logodata'));   
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
        $data= $request->all();
        if(isset($data['site_logo'])){
            $site_logo=$this->UploadSIteLogo('site_logo');
            $data['site_logo']=$this->image;
        }
//        print_r($data); die;
        DB::Collection('site_logo')->where('_id', $id)->update($data);
        return Redirect::route('site.logo.create',$data['shop_id'])->with('message',"Updated Successfully.");   
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
