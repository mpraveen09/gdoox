<?php

namespace Gdoox\Http\Controllers\userreview;

use Gdoox\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use DB;
use Gdoox\Models\Categories;
use Gdoox\Models\Products;
use Gdoox\Models\ProductReviews;
use Auth;


class UserReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(){
        try {
            Session::forget('message');
            if(Auth::user()){
                $userid= Auth::id();
                $fm_data = DB::collection('field_master')->where('title', '=', 'review_form_info')->where('lang','=','en')->first();
                $all_user_reviews= ProductReviews::where('userid','=',$userid)->paginate(25);
            }
            else {
                Session::flash('message','Please Login'); 
            }

            return view('userreview.index',compact('fm_data','all_user_reviews'));
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
    public function create(){
        try {
            Session::forget('message');
            $product_id= $data['product_id'];
            $shopid= $data['shopid']; 
            return view('userreview.create',compact('fm_data'))->with('product_id',$product_id)->with('shopid',$shopid);
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
            Session::forget('message');
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
    //            return Redirect::route('write_review')
    //                ->withErrors($validator)
    //                ->withInput(Request::all());                        
            } 
            else 
            {
                $review= new ProductReviews();   
                if(Auth::user())
                    {
                        $userid= Auth::id();
                        $review->userid = $userid;
                    }
                    else {
                         $review->userid = '';
                    }

                    $review->shopid = $data['shopid'];
                    $review->product_id = $data['product_id'];
                    $review->review_title = $data['review_title'];
                    $review->review = $data['review'];
                    $review->thumb = $data['thumb'];
                    $review->rating = (int)$data['rating'];
                    $review->name = $data['name'];
                    $review->lang = 'en';

                    if($review->save()){
                        $get_reviews = ProductReviews::Where('product_id','=',$data['product_id'])->where('shopid','=',$data['shopid'])->first();
                        Session::flash('message', 'Review Added Successfully!"');
                        return view('userreview.show',compact('fm_data','get_reviews'));      
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
        try{
            $fm_data = DB::collection('field_master')->where('title', '=', 'review_form_info')->where('lang','=','en')->first();
            $get_reviews = ProductReviews::Where('_id','=',$id)->first();
            return view('userreview.show',compact('fm_data','get_reviews'));
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
        try {
            $fm_data = DB::collection('field_master')->where('title', '=', 'review_form_info')->first();
            $reviews = ProductReviews::Where('_id','=',$id)->first();
            return view('userreview.edit',compact('fm_data','reviews')); 
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
         try {
              $data= Request::all();
    //        rules for validation 
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
                $review= ProductReviews::where('_id', '=', $id)->where('lang', '=', 'en')->first();
                $review->review_title = $data['review_title'];
                $review->review = $data['review'];
                $review->rating = (int)$data['rating'];
                $review->name = $data['name'];
                
                
                if($review->save()){
                    Session::flash('message', 'Reviews Updated Successfully!"');
                    return Redirect::route('userreview.show', $id);
                }
                else {
                    Session::flash('message', 'Reviews Could Not be Updated, Please try Again!"');
                    return Redirect::route('userreview.edit', $id);
                }
         }
         catch(\Exception $e){
             $errors = $this->errorMessage($e);
             return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
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
    
     public function writeReview($shopid, $prodid){
         try {
            $fm_data = DB::collection('field_master')->where('title', '=', 'review_form_info')->where('lang','=','en')->first();
            $thumb= Products::where('_id','=',$prodid)->first();
            return view('userreview.create',compact('fm_data'))->with('product_id',$prodid)->with('shopid',$shopid)->with('thumb',$thumb->thumb);
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
