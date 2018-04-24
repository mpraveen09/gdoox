<?php

namespace Gdoox\Http\Controllers\backend\dashboard;

use DB;
use Gdoox\Models\BusinessInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\EcomShops;
use Gdoox\Models\DropdownOption;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Gdoox\Http\Controllers\Controller;
use Gdoox\Models\BusinessSectors;

class SearchBusinessInfoController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        try {
            if(Auth::guest() || Auth::user()){
                $category = array();
                $search = Request::all();
                $fm_data=  FieldMaster::where('title','business_info')->where('lang','en')->first();
                if(!empty($fm_data)){
                    $category['company_name'] = $fm_data->labels['company_name'];
                    $category['street_add']= $fm_data->labels['street_add'];
                    $category['city']= $fm_data->labels['city'];
                    $category['country']= $fm_data->labels['country'];
                    $category['zip']= $fm_data->labels['zip'];
                    $category['desc']= $fm_data->labels['desc'];
                    $category['org_type']= $fm_data->labels['org_type']; 
                    $category['actvity_type']= $fm_data->labels['actvity_type'];
                    $category['operation']= $fm_data->labels['operation'];
                    $category['ecomm_company_name']= 'Site Name';
                    $category['category_name']= 'Business Category';
                    $category['all']= 'All';
                }
                if($search){
                    $term['term']='1';
                    $search_val = $search['keyword'];
      //                  $estore=  EcomShops::where('user_id',  Auth::user()->id);

                    if($search['filter']=='all'){
                        $sites=  EcomShops::where('ecomm_company_name', 'like', '%'.$search_val.'%')->orWhere('slug', 'like', '%'.$search_val.'%')->get();
                        if($sites->count()){
                            foreach($sites as $site){
                                $company_id[] = $site->company_id;
                            }
                        }
                        
                        $id=isset($company_id)?$company_id:array();
                        $business_info = BusinessInfo::with('searchstore')
                            ->whereIn('_id', $id)
                            ->orWhere('ecomm_company_name', 'like', '%'.$search_val.'%')
                            ->orWhere('slug', 'like', '%'.$search_val.'%')
                            ->orWhere('company_name', 'like', '%'.$search_val.'%')
                            ->orWhere('street_add', 'like', '%'.$search_val.'%')
                            ->orWhere('city', 'like', '%'.$search_val.'%')
                            ->orWhere('country', 'like', '%'.$search_val.'%')
                            ->orWhere('desc', 'like', '%'.$search_val.'%')
                            ->orWhere('org_type', 'like', '%'.$search_val.'%')
                          ->paginate(25);
                    }  
                    elseif($search['filter'] == 'category_name') {
                            $ids = array();
                            $cat_id = array();
                            $comp_ids = array();

                            $cat_ids = Categories::where('name','like','%'.addslashes($search['keyword']).'%')->orderBy('name')->project( array('cat_id','name') )->get();

                            if(count($cat_ids)){
                                foreach ($cat_ids as $cat) {
                                    if (strpos($cat->cat_id,'-') !== false) {
                                         $index = strpos($cat->cat_id,'-');
                                         $parent_id = substr($cat->cat_id, 0, $index);
                                         $cat_id[$parent_id] = $parent_id;                  
                                    }
                                    else {
                                         $cat_id[$cat->cat_id] = $cat->cat_id;//$cat->name;      
                                    }         
                                }
                            }


                            $business_sect = BusinessSectors::where('category_name','like','%'.$search_val.'%')
                                ->where('user_id', '!=', Auth::user()->id)->where('type','=','business_sectors')->project( array('category_id','category_name') )->get();

                            if(count($business_sect)){
                                foreach($business_sect as $cats){
                                    foreach ($cats->category_id as $key => $value) {
                                        if (strpos($value,'-') !== false) {
                                            $index = strpos($value,'-');
                                            $parent_id = substr($value, 0, $index);
                                            $cat_id[$parent_id] = $parent_id;                  
                                        }
                                        else {
                                             $cat_id[$value] = $value;//$cat->name;      
                                        }
                                    }
                                }
                            }

                            if(!empty($cat_id)){
                                foreach($cat_id as $key=>$val){
                                    $comp = Products::where('cat_ids', 'like', $val.'%')->where('userid', '!=', Auth::user()->id)->where('status','=','enabled')->project('company_id','shopid','userid')->get();
                                    if(count($comp)){
                                        $companies[] = $comp;
                                    }
                                    else {
                                        $companies[] = '';
                                    }
                                }
                            }


                            if(!empty($companies)){
                                foreach($companies as $company){
                                    foreach($company as $comp){
                                        $comp_ids[$comp->company_id] = trim($comp->company_id);
                                    }
                                }
                            }

                            if(!empty($comp_ids)){
                                foreach($comp_ids as $key=>$val){
                                    $ids[] =  $val;
                                }
                            }

                            $business_info = BusinessInfo::whereIn('_id', $ids)->where('user_id', '!=', Auth::user()->id)->where('status','=','Active')->paginate(25);
                        }
                    
//                    elseif($search['filter']=='category_name') {
//                        $interest = BusinessSectors::where('category_name','like','%'.$search_val.'%')
//                          ->where('user_id', '!=', Auth::user()->id)->where('type','=','business_sectors')->get();
//                        
//                        $ids = array();
//                        foreach($interest as $val){
//                           $ids[] = trim($val->user_id);
//                        }
//
//                        $business_info = BusinessInfo::with('searchstore')->whereIn('user_id', $ids)
//                         ->where('status','=','Active')->paginate(25);
//                    }
                    
                    else {
                        $business_info = BusinessInfo::with('searchstore')->where('status','=','Active')->where($search['filter'],'like','%'.trim($search_val).'%')->paginate(25);
                    }

                     return view('backend.dashboard.search_business_info.index',compact('fm_data','business_info','term','category','search_val'));
                  // return view('backend.dashboard.search_business_info.index',compact('fm_data'))->with('business_info',$business_info)->with('term',$term)->with('category',$category)->with('estore',$estore);
                }
                else {   
                    $term['term']='0';
                    $search_val= '';
                    return view('backend.dashboard.search_business_info.index',compact('fm_data','category','term','search_val'));
                }
             }
             else {
                   return redirect('auth/login')->with('message',"You must be login!"); 
             }
        }
        catch(\Exception $e){
             $errors = $this->errorMessage($e);
             return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
         }
    }
    
    public function show($id){
        try{
            $fm_data = FieldMaster::where('title', '=', 'business_info')->where('lang', 'en')->first();
            $business=  BusinessInfo::where('_id', $id)->first(); 
            return view('backend.dashboard.search_business_info.show',compact('business','fm_data'));
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