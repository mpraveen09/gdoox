<?php

namespace Gdoox\Http\Controllers\cms;
use DB;
use Gdoox\Http\Controllers\Controller;
use Gdoox\User;
use Gdoox\SubUser;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

use Gdoox\Models\Products;
use Gdoox\Models\CmsSite;
use Gdoox\Models\BusinessInfo;
use Gdoox\Models\BusinessEcommerceCompany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Gdoox\Models\NavigationMenu;
use Form;
use Image;
use Input;

class ContentManagementController extends Controller {
    use  \Gdoox\Helpers\backend\dashboard\HelperFunctions;    
    
    public function __construct() {
        $this->middleware('subuserpermission'); 
    }
/*
 * Index for list all site pages
 */
    public function index(){
      if(Auth::user()){    
        try {
            $term = 0;
            $pagesite = array();
            $pages = array();
            $count = array();
            
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '48')->where('group','create_ecommerce_site')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();

            $esites = Request::get('sub_user_sites');// if sub user have permission
            
            if(!empty($esites)){
                foreach ($esites as $esite){
                  $pagesite['sitename'][] = $this->SiteName($esite);
                  $pagesite['slug'][]=$esite;
                }
            }
            else {
                $esites = BusinessEcommerceCompany::where('user_id','=', Auth::user()->id)->get(); // main user site
                if($esites->count()){
                    foreach($esites as $esite){
                      $pagesite['sitename'][] = $esite->ecomm_company_name;
                      $pagesite['slug'][] = $esite->slug;
                    }
                }
            }
            
            if(!empty($pagesite)){
              for($i=0; $i<count($pagesite['slug']); $i++){
                 $count[] = CmsSite::where('type','!=','temp')->where('slug', $pagesite['slug'][$i])->count();
                 $pages[] = CmsSite::where('type','!=','temp')->where('slug', $pagesite['slug'][$i])->get();
              }
            }
            
            if(!empty($_GET['slug'])){
                $term = 1;
                $site_slug = $_GET['slug'];
                $sites = array();
                $temp = CmsSite::where('type','temp')->where('page_id', 'exists', false)->where('user_id', Auth::user()->id)->get();
                Session::forget('message');
                $userid = Auth::id();
                $site_ecom = Request::get('sub_user_sites');
                if(!empty($site_ecom)){
                  foreach ($site_ecom as $value){
                    $sites[$value] = $this->SiteName($value);
                  }
                }
                else {
                    $site_ecom = BusinessEcommerceCompany::where('user_id','=',$userid)->get();
                    foreach ($site_ecom as $value) {
                        $sites[$value->slug] = $value->ecomm_company_name;
                }
              }
            }
            
            if(!empty($_GET['id'])){
              $term = 2;
              $userid= Auth::id();
              $sites = array();
              $site_ecom = Request::get('sub_user_sites');
                if(!empty($site_ecom)){
                    foreach ($site_ecom as $value){
                      $sites[$value] = $this->SiteName($value);
                    }
                }
                else {
                    $site_ecom = BusinessEcommerceCompany::where('user_id','=',$userid)->get();
                    foreach ($site_ecom as $value) {
                        $sites[$value->slug] = $value->ecomm_company_name;
                    }
                }
              $temp= CmsSite::where('page_id', $_GET['id'])->where('type','temp')->where('page_id', 'exists', true)->get();
              $status= array();
              $status['1'] = 'Publish';
              $status['0'] = 'Pending';
              $sitepages = CmsSite::where('_id','=', $_GET['id'])->first();
            }
           
          return view('cms.index', compact('nav_menu','route','pages', 'sites', 'pagesite', 'count', 'term', 'temp', 'sitepages', 'status', 'site_ecom', 'site_slug'));
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
          return redirect('auth/login')->withErrors("Please Login First");         
      }
    }
    
    /*
     * Show Site pages
     */
    public function pages($slug){
      try{
         
        $sitepages=  CmsSite::where('type','!=','temp')->where('slug', $slug)->paginate(25);

        return view('cms.pages',compact('sitepages'));
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                           "Line Number: ".$e->getLine()." ".
                           "File Name: ".$e->getFile()." ".
                           "Error Description: ".$e->getMessage();
           return view('errors.custom_error')->withErrors($error);
      }
    }

    public function store(){
      try{
        $sites= array();
        $data = Request::all();        
        $rules = array(
                'page_title' => 'required|max:200',
                'site_name' => 'required',
          );
         $validator = Validator::make(Request::all(), $rules);
         if($validator->fails()){
               return redirect()->back()->withErrors($validator)->withInput(Request::all());                        
         }
         else{
            $userid= Auth::id();
            $pages= new CmsSite();
            $pages->user_id = $userid;
            $pages->updated_by = $userid;
            $pages->page_title= addslashes($data['page_title']);
            $pages->description= addslashes($data['information']);
            
            if(!empty($data['seo_title'])){
                $pages->seo_title= $data['seo_title'];
            }
            else {
                $pages->seo_title = addslashes($data['page_title']);
            }
            
            if(!empty($data['seo_description'])){
                $pages->seo_description= $data['seo_description'];
            }
            else {
                $pages->seo_description= substr(strip_tags(addslashes($data['information'])),0,150);
            }

            $pages->seo_keywords = $data['seo_keywords'];
            
            
            $pages->slug = $data['site_name'];
            $pages->company_id = $this->CompanyId($data['site_name']);
            $pages->sort_order = $data['sort_order'];
            $pages->status = $data['status'];
            if(isset($data['type'])){
               $pages->type='temp';
               if($pages->save()){
                    return Redirect::route('cms.page', [$data['site_name'], preg_replace('/[^a-zA-Z]+/', '', $pages->page_title), $pages->id]);
               }
            }
            else {
              if($pages->save()){
                 Session::flash('message', 'The Page has been created.');
                 return Redirect::route('cms.index');
              }
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
  
    public function update($id){
      if(Auth::user()){
          try {
            $data = Request::all();
            $rules = array(
                    'page_title' => 'required|max:200|',
                    'site_name' => 'required',
              );
             $validator = Validator::make(Request::all(), $rules);
            if($validator->fails()){
               return redirect()->back()->withErrors($validator)->withInput(Request::all());                        
            }
            else {
              $pages= CmsSite::find($id);
              if(!empty($pages->type) && !empty($pages->page_id)){

                 if(isset($data['type'])){
                    $pages->user_id = $data['user_id'];
                    $pages->updatedby_id = Auth::user()->id;
                    $pages->page_title= addslashes($data['page_title']);
                    $pages->description= addslashes($data['information']);
                    $pages->slug = $data['site_name'];
                    if(!empty($data['seo_title'])){
                        $pages->seo_title= $data['seo_title'];
                    }
                    else {
                        $pages->seo_title = addslashes($data['page_title']);
                    }

                    if(!empty($data['seo_description'])){
                        $pages->seo_description= $data['seo_description'];
                    }
                    else {
                        $pages->seo_description= substr(strip_tags(addslashes($data['information'])),0,150);
                    }

                    $pages->seo_keywords = $data['seo_keywords'];
                    $pages->sort_order = $data['sort_order'];
                    $pages->status = $data['status'];
                    if($pages->save()){
                          return Redirect::route('cms.page', [$data['site_name'], preg_replace('/[^a-zA-Z]+/', '', $pages->page_title), $pages->id]);
                    }
               }
               
                $newpages=CmsSite::where('_id', $pages->page_id)->first();
                $newpages->user_id = Auth::user()->id;
                $newpages->updatedby_id = Auth::user()->id;
                $newpages->page_title= addslashes($data['page_title']);
                $newpages->description= addslashes($data['information']);
                
                if(!empty($data['seo_title'])){
                    $pages->seo_title= $data['seo_title'];
                }
                else {
                    $pages->seo_title = addslashes($data['page_title']);
                }

                if(!empty($data['seo_description'])){
                    $pages->seo_description= $data['seo_description'];
                }
                else {
                    $pages->seo_description= substr(strip_tags(addslashes($data['information'])),0,150);
                }

                $pages->seo_keywords = $data['seo_keywords'];
                
                $newpages->slug = $data['site_name'];
                $newpages->sort_order = $data['sort_order'];
                $newpages->status = $data['status'];
                if($newpages->save()){
                    CmsSite::where('_id', $id)->delete();

                    return Redirect::route('cms.index')->with('message','Page updated.');
                }
            }
            else if(isset($data['type'])){
                $temppage= new CmsSite();
                $temppage->user_id = Auth::user()->id;
                $temppage->updatedby_id = Auth::user()->id;
                $temppage->page_title= addslashes($data['page_title']);
                $temppage->description= addslashes($data['information']);
                if(!empty($data['seo_title'])){
                $pages->seo_title= $data['seo_title'];
                }
                else {
                    $pages->seo_title = addslashes($data['page_title']);
                }

                if(!empty($data['seo_description'])){
                    $pages->seo_description= $data['seo_description'];
                }
                else {
                    $pages->seo_description= substr(strip_tags(addslashes($data['information'])),0,150);
                }
                
                $pages->seo_keywords = $data['seo_keywords'];
                $temppage->slug = $data['site_name'];
                $temppage->sort_order = $data['sort_order'];
                $temppage->status = $data['status'];
                $temppage->type = $data['type'];
                $temppage->page_id=$pages->id;
                if($temppage->save()){
                return Redirect::route('cms.page', [$temppage->slug, preg_replace('/[^a-zA-Z]+/', '', $temppage->page_title), $temppage->id]);
            }
            }

            $userid= Auth::id();
            $pages->user_id = $data['user_id'];
            $pages->updatedby_id = $userid;
            $pages->page_title= addslashes($data['page_title']);
            $pages->description= addslashes($data['information']);
            if(!empty($data['seo_title'])){
                $pages->seo_title= $data['seo_title'];
            }
            else {
                $pages->seo_title = addslashes($data['page_title']);
            }
            
            if(!empty($data['seo_description'])){
                $pages->seo_description= $data['seo_description'];
            }
            else {
                $pages->seo_description= substr(strip_tags(addslashes($data['information'])),0,150);
            }

            $pages->seo_keywords = $data['seo_keywords'];
            $pages->slug = $data['site_name'];
            $pages->sort_order = $data['sort_order'];
            $pages->status = $data['status'];
            $pages->type = null;
            if($pages->save()){
              Session::flash('message', 'The Page has been updated');
              return Redirect::route('cms.index');
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
      else{
           return redirect('auth/login')->withErrors("Please Login First");         
      }
    }
    
    public function show(){
        if(Auth::user()){
          try{
            $userid= Auth::id();
            $pages= CmsSite::where('user_id','=',$userid)->where('status','=','0')->get();
            
            return view('cms.show',compact('pages'));
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
                return redirect('auth/login')->withErrors("Please Login First");         
         }
        }
    
    /*
     * Store the temporary data to orignal
     */
    public function storetemp($shopid, $pagename, $id){
      try{
        $tempdata=  CmsSite::where('_id', $id)->where('type', 'temp')->first();
        if(!empty($tempdata->page_id)){
          $pages=CmsSite::where('_id',$tempdata->page_id)->first();
          $pages->user_id = Auth::user()->id;
          $pages->updatedby_id = Auth::user()->id;
          $pages->page_title= $tempdata->page_title;
          $pages->description= $tempdata->description;
          $pages->slug = $tempdata->slug;
          $pages->company_id = $this->CompanyId($tempdata->slug);
          $pages->sort_order = $tempdata->sort_order;
          $pages->status = $tempdata->status;
          $pages->type = null;
          if($pages->save()){
            CmsSite::where('_id', $id)->delete();

            return Redirect::route('cms.index')->with('message','Page updated.');
          }
        }
        CmsSite::where('_id', $id)->unset('type');

        return Redirect::route('cms.index')->with('message','Page created.');
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
