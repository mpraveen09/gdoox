<?php

namespace Gdoox\Http\Controllers\backend\dashboard;

use DB;
use Auth;
use Gdoox\Models\DropdownOption;
use Gdoox\Models\FieldMaster;
use Gdoox\Models\PaymentMethod;
use Illuminate\Http\Request;
use Gdoox\Http\Requests;
use Gdoox\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;

class PaymentMethodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    private $language;
    public function __construct(){
         $this->language = session('app_language');
    }
    
    public function index(){
        $fm_data = FieldMaster::where('title','payment_method')->where('lang', $this->language)->first();
        $payment_method_data = PaymentMethod::where('user_id', Auth::user()->id)->paginate(20);
        
        $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '47')->where('group','create_ecommerce_site')->where('lang','en')->get();
        $route = Route::getCurrentRoute()->getName();
                
        return view('backend.dashboard.payment_methods.index', compact('nav_menu','route','fm_data', 'payment_method_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $required = "*";
        $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '47')->where('group','create_ecommerce_site')->where('lang','en')->get();
        $route = Route::getCurrentRoute()->getName();
        
        $fm_data = FieldMaster::where('title','payment_method')->where('lang', $this->language)->first();
        $payment_methods = DropdownOption::where('name','payment_method')->where('lang', $this->language)->first();
        foreach($payment_methods->options as $method){
           $payment_method[$method] = $method;
        }

        return view('backend.dashboard.payment_methods.create', compact('route','nav_menu','fm_data', 'payment_method','required'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
         if(Auth::user()){
            $rules = array(
                'method_name' => 'required|unique:payment_methods',
                );
              $validator = Validator::make($request->all(), $rules);

              if($validator->fails()){
                  return Redirect('dashboard/payment-methods/create')->withErrors($validator)->withInput($request->all());                        
              }
              else {
                DB::collection('payment_methods')->insert($request->all());
                return redirect()->action('backend\dashboard\PaymentMethodsController@index')->with('message', "Payment Method Created");
              }
         }   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '47')->where('group','create_ecommerce_site')->where('lang','en')->get();
        $route = Route::getCurrentRoute()->getName();
        
        $payment_method = PaymentMethod::where('_id',$id)->first();
        $fm_data =  FieldMaster::where('title', '=', 'payment_method')->where('lang', $this->language)->first();
         
        return view('backend.dashboard.payment_methods.show',compact('nav_menu','route','fm_data', 'payment_method'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $required= "*";
        
        $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('parent', '47')->where('group','create_ecommerce_site')->where('lang','en')->get();
        $route = Route::getCurrentRoute()->getName();
        
        $fm_data = FieldMaster::where('title','payment_method')->where('lang', $this->language)->first();
        $pay_method = PaymentMethod::where('_id',$id)->first();
        $payment_methods = DropdownOption::where('name','payment_method')->where('lang', $this->language)->first();
        
        foreach($payment_methods->options as $method){
           $payment_method[$method]=$method;
        }

        return view('backend.dashboard.payment_methods.edit', compact('route','nav_menu','fm_data', 'payment_method','required','pay_method'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
         $data = $request->all();
         $save = PaymentMethod::where('_id', $id)->update($data,  array('upsert' => false));
        // var_dump($save);
        if($save){
            return redirect()->action('backend\dashboard\PaymentMethodsController@index')->with('message',"Updated");
        }
        else {
            return redirect()->action('backend\dashboard\PaymentMethodsController@index')->with('message',"some error");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
