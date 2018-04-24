<?php

namespace Gdoox\Http\Controllers\SellerReview;

use Gdoox\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use DB;
use Gdoox\Models\Categories;
use Gdoox\Models\ProductReviews;
use Gdoox\Models\SellerReviews;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Gdoox\Models\NavigationMenu;


class SellerReviewController extends Controller {
     use \Gdoox\Helpers\backend\dashboard\RolesUsers;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(){
        try{
            Session::forget('message');
            if(Auth::user()){
                $userid= Auth::id();
                $role = $this->getRoleName(Auth::user()->id);
                $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'MARKETING')->where('lang','en')->get();
                $route = Route::getCurrentRoute()->getName();
                
                $fm_data = DB::collection('field_master')->where('title', '=', 'review_form_info')->where('lang','=','en')->first();
                $all_seller_reviews= SellerReviews::where('userid','=',$userid)->paginate(25);
                return view('sellerreview.index',compact('fm_data','all_seller_reviews','nav_menu','route')); 
            }
            else {
                Session::flash('message', 'Please Login First');
                return redirect('auth/login');  
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        try {
            Session::forget('message');
            $fm_data = DB::collection('field_master')->where('title', '=', 'review_form_info')->where('lang','=','en')->first();
            return view('sellerreview.create',compact('fm_data'));
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request){
        try {
        // rules for validation
            $fm_data = DB::collection('field_master')->where('title', '=', 'review_form_info')->where('lang','=','en')->first();
            $data= Request::all();

            $rules = array(
                'review_title' => 'required',
                'review' => 'required',
                'name' => 'required',
            );
            $validator = Validator::make(Request::all(), $rules);

            // process the validation
            if ($validator->fails()) {
                return Redirect::route('write_review')
                    ->withErrors($validator)
                    ->withInput(Request::all());                        
            } 
            else {
            $review= new SellerReviews();   
            if(Auth::user()){
                    $userid= Auth::id();
                    $review->userid = $userid;
                }
                else {
                     $review->userid = '';
                }
       
                $review->shopid = $data['shopid'];
                $review->product_id = $data['product_id'];
                $review->review_title = $data['review_title'];
                $review->rating= (int)$data['rating'];
                $review->review = $data['review'];
                $review->name = $data['name'];
                $review->lang = 'en';
                
                if($review->save()){
                    $get_reviews = SellerReviews::Where('product_id','=',$data['product_id'])->where('shopid','=',$data['shopid'])->first();
                    Session::flash('message', 'Seller Review Added Successfully!"');
                    return view('sellerreview.show',compact('fm_data','get_reviews'));      
                }
                else {   
                     Session::flash('message', 'Something went wrong, Please try Again!"');  
                }   
            }   
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id){
        try {
            Session::forget('message');
            $fm_data = DB::collection('field_master')->where('title', '=', 'review_form_info')->where('lang','=','en')->first();
            $get_reviews = SellerReviews::Where('_id','=',$id)->first();
            return view('sellerreview.show',compact('fm_data','get_reviews'));
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id){
        try{
            Session::forget('message');
            $fm_data = DB::collection('field_master')->where('title', '=', 'review_form_info')->first();
            $reviews = SellerReviews::Where('_id','=',$id)->first();
            return view('sellerreview.edit',compact('fm_data','reviews'));
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
     public function update(Request $request, $id){
         try{
            Session::forget('message');
            $data= Request::all();
         
            $review= SellerReviews::where('_id', '=', $id)->where('lang', '=', 'en')->first();
            $review->review_title = $data['review_title'];
            $review->review = $data['review'];
            $review->rating = $data['rating'];


            if($review->save()){
                Session::flash('message', 'Seller Reviews Updated Successfully!"');
                return Redirect::route('sellerreview.show', $id);
            }
            else {
                Session::flash('message', 'Reviews Could Not be Updated, Please try Again!"');
                return Redirect::route('sellerreview.edit', $id);
            }
         }
         catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
            
            
         
        // rules for validation 
//        $rules = array(
//            'cat_id'       => 'required',
//            'name'      => 'required',
//            'slug'      => 'required',
//            'parent'      => 'required_if:isroot,0'
//        );
//        $validator = Validator::make(Request::all(), $rules);
//
//        // process the validation
//        if ($validator->fails()) {
//            return Redirect::route('categories.edit', $id)
//                ->withErrors($validator)
//                ->withInput(Request::all());                        
//        } else {
            // store
            // redirect     
//        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function sellerReview($shopid, $prodid){
        try{
            $fm_data = DB::collection('field_master')->where('title', '=', 'review_form_info')->where('lang','=','en')->first();
            return view('sellerreview.create',compact('fm_data'))->with('product_id',$prodid)->with('shopid',$shopid);
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
//    public function allSellerReviews($shopid){ 
//            $fm_data = DB::collection('field_master')->where('title', '=', 'review_form_info')->where('lang','=','en')->first();
//            $total_seller_reviews= SellerReviews::where('shopid','=',$shopid)->get();
//            return view('sellerreview.create',compact('fm_data','total_seller_reviews'))->with('product_id',$prodid)->with('shopid',$shopid);
//    }
    
//    public function sellerReviewDetails($userid,$shopid, $prodid){
//        $fm_data = DB::collection('field_master')->where('title', '=', 'review_form_info')->where('lang','=','en')->first();
//        $get_reviews= SellerReviews::where('userid','=',$userid)->where('shopid','=',$shopid)->where('product_id','=',$prodid)->first();
//       // return view('sellerreview.show',compact('fm_data','get_reviews'));
//        
//        return view('sellerreview.viewsellerreview',compact('fm_data','get_reviews'));
//    }
    
    public function allSellerReviews($shopid){
        try {
            $get_reviews= SellerReviews::orderBy('created_at', 'asc')->where('shopid','=',$shopid)->paginate(2);
            $seller_all_reviews= SellerReviews::orderBy('created_at', 'asc')->where('shopid','=',$shopid)->get();
            $fm_data = DB::collection('field_master')->where('title', '=', 'review_form_info')->where('lang','=','en')->first();
            $seller_avg_rating= SellerReviews::where('shopid','=',$shopid)->avg('rating');
            $seller_rating_1= SellerReviews::where('shopid','=',$shopid)->where('rating','=',1)->count('rating');
            $seller_rating_2= SellerReviews::where('shopid','=',$shopid)->where('rating','=',2)->count('rating');
            $seller_rating_3= SellerReviews::where('shopid','=',$shopid)->where('rating','=',3)->count('rating');
            $seller_rating_4= SellerReviews::where('shopid','=',$shopid)->where('rating','=',4)->count('rating');
            $seller_rating_5= SellerReviews::where('shopid','=',$shopid)->where('rating','=',5)->count('rating');

            return view('sellerreview.viewsellerreview',compact('fm_data','get_reviews','seller_avg_rating',
            'seller_rating_1','seller_rating_2','seller_rating_3','seller_rating_4','seller_rating_5','seller_all_reviews'));
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
