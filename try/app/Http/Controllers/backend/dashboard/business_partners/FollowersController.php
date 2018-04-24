<?php

namespace Gdoox\Http\Controllers\backend\dashboard\business_partners;

use Illuminate\Http\Request;
use Gdoox\Models\Follower;
use Illuminate\Support\Facades\Auth;
use Gdoox\User;
use Illuminate\Support\Facades\Redirect;
use Gdoox\Models\BusinessEcommerceCompany;
use Gdoox\Http\Requests;
use Gdoox\Http\Controllers\Controller;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;

class FollowersController extends Controller
{
    use \Gdoox\Helpers\backend\dashboard\HelperFunctions;
    use \Gdoox\Helpers\backend\dashboard\RolesUsers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($shop_id){
        if(Auth::user()){
          try {
              
                $role = $this->getRoleName(Auth::user()->id);
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'CREATE E-COMMERCE SITE (CMS/DAM)')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
            
                $follower_data = new Follower();
                $follower_data->follower_id = Auth::user()->id;
                $follower_data->follower_name = Auth::user()->username;
                $follower_data->follower_email = Auth::user()->email;
                $follower_data->follower_company = $this->GetCompany(Auth::user()->id);
                $follower_data->follower_site = $this->getSite(Auth::user()->id);
                
                $follower_data->site_slug = $shop_id;
                $follower_data->site_owner_id =  $this->SiteUserId($shop_id);
                $follower_data->site_owner_email =  $this->SiteUserEmail($shop_id);
                if($follower_data->save()){
                    return view('backend.dashboard.business_partners.business_followers.index',compact('follower_data','nav_menu','route'));
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
            return Redirect::route('follower.edit', $shop_id ); 
      }
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $follower_data = new Follower();
        $follower_data->follower_id = "";
        $follower_data->follower_name = $request->follower_name;
        $follower_data->follower_email = $request->follower_email;
        $follower_data->site_slug = $request->shop_id;
        $follower_data->site_owner_id =  $this->SiteUserId($follower_data->site_slug);
        $follower_data->site_owner_email =  $this->SiteUserEmail($follower_data->site_slug);
        if($follower_data->save()){
            return Redirect::route('site', $follower_data->site_slug)->with('message', 'Thank you for showing interest in Gdoox Business App.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function followers(){
        if(Auth::user()){
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'CREATE E-COMMERCE SITE (CMS/DAM)')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();

            $followers = Follower::where('site_owner_id', Auth::user()->id)->get();
            
            return view('backend.dashboard.business_partners.business_followers.followers',compact('route','nav_menu','followers'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($shop_id) {
        $role = $this->getRoleName(Auth::user()->id);
        $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'CREATE E-COMMERCE SITE (CMS/DAM)')->where('lang','en')->get();
        $route = Route::getCurrentRoute()->getName();
        
        return view('backend.dashboard.business_partners.business_followers.edit',compact('shop_id','nav_menu','route'));
    }
}
