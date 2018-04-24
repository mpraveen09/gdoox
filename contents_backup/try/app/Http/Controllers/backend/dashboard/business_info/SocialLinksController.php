<?php

namespace Gdoox\Http\Controllers\backend\dashboard\business_info;

use Illuminate\Http\Request;
use Gdoox\Models\BusinessEcommerceCompany;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Gdoox\Models\FieldMaster;
use Gdoox\Http\Requests;
use Gdoox\Http\Controllers\Controller;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;

class SocialLinksController extends Controller
{
  use \Gdoox\Helpers\backend\dashboard\HelperFunctions;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if(Auth::user()){
          try {
                $term = 0;
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '48')->where('group','create_ecommerce_site')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();

                $sites=  BusinessEcommerceCompany::where('user_id', Auth::user()->id)->project(['slug','ecomm_company_name'])->get();
                $fm_data =  FieldMaster::where('title', '=', 'social_info')->where('lang', '=', 'en')->first();
                
                if(!empty($_GET['site_slug'])){
                    $social=  BusinessEcommerceCompany::where('slug', $_GET['site_slug'])->first();
                    $site_slug = $_GET['site_slug'];
                    $site_name = $this->Company($_GET['site_slug']);
                    $term = 1;
                }
                $social_links=  BusinessEcommerceCompany::where('user_id', Auth::user()->id)->get();
                return view('backend.dashboard.business_info.social_links.index', compact('route','nav_menu','sites', 'fm_data', 'term', 'site_slug', 'site_name', 'social', 'social_links'));
          }
          catch (\Exception $e){
              $error = "An error occured. ".
                    "Line Number: ".$e->getLine()." ".
                    "File Name: ".$e->getFile()." ".
                    "Error Description: ".$e->getMessage();
              return view('errors.custom_error')->withErrors($error);
            }
        }
        else {
              return redirect('auth/login')->with('message',"You must be login!"); 
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function create($id)
//    {
//        if(Auth::user()){
//          try{
//            $site=  BusinessEcommerceCompany::where('_id', $id)->where('sociallinks', 'exists', true)->first();
//
//            if(!empty($site)){
//                return Redirect::route('sociallink.edit', $id);
//            }
//            $fm_data =  FieldMaster::where('title', '=', 'social_info')->where('lang', '=', 'en')->first();
//
//            return view('backend.dashboard.business_info.social_links.create', compact('id', 'fm_data'));
//          }
//          catch (\Exception $e){
//              $error = "An error occured. ".
//                              "Line Number: ".$e->getLine()." ".
//                              "File Name: ".$e->getFile()." ".
//                              "Error Description: ".$e->getMessage();
//              return view('errors.custom_error')->withErrors($error);
//          }
//        }
//        else{
//                return redirect('auth/login')->with('message',"You must be login!"); 
//        }
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
//            print_r($request->all());
//            die;
            $sociallinks = array('facebook' => $request->facebook, 'linkedin' => $request->linkedin, 'twitter' => $request->twitter, 'pinterest'=> $request->pinterest, 'google_plus'=>$request->google_plus);

              $social=  BusinessEcommerceCompany::where('slug', $request->site_slug)->first();
              $social->sociallinks = $sociallinks;
              if($social->save()){
                  return Redirect::route('sociallink.index')->with('message', 'Social info saved');
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
        else{
                return redirect('auth/login')->with('message',"You must be login!"); 
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function edit($id)
//    {
//      try{
//         $site=  BusinessEcommerceCompany::where('_id', $id)->where('sociallinks', 'exists', true)->first();
//         $fm_data =  FieldMaster::where('title', '=', 'social_info')->where('lang', '=', 'en')->first();
//
//         return view('backend.dashboard.business_info.social_links.edit', compact('id', 'site', 'fm_data'));
//      }
//      catch (\Exception $e){
//          $error = "An error occured. ".
//                          "Line Number: ".$e->getLine()." ".
//                          "File Name: ".$e->getFile()." ".
//                          "Error Description: ".$e->getMessage();
//          return view('errors.custom_error')->withErrors($error);
//      }
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, $id)
//    {
//      try{
//          $sociallinks = array('facebook' => $request->facebook, 'linkedin' => $request->linkedin, 'twitter' => $request->twitter, 'pinterest'=> $request->pinterest, 'googleplus'=>$request->google);
//          $social=  BusinessEcommerceCompany::where('_id', $id)->first();
//          $social->sociallinks = $sociallinks;
//          if($social->save()){
//              return Redirect::route('sociallink.index')->with('message', 'Social info updated');
//          }
//      }
//      catch (\Exception $e){
//          $error = "An error occured. ".
//                          "Line Number: ".$e->getLine()." ".
//                          "File Name: ".$e->getFile()." ".
//                          "Error Description: ".$e->getMessage();
//          return view('errors.custom_error')->withErrors($error);
//      }
//  }
}
