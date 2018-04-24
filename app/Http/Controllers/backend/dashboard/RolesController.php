<?php

namespace Gdoox\Http\Controllers\backend\dashboard;

use Illuminate\Http\Request;
use DB;
use Auth;
use Gdoox\Models\FieldMaster;
use Gdoox\Role;
use Gdoox\Http\Requests;
use Gdoox\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class RolesController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    
    public $language;
    public function __construct() {
		if (session()->has('app_language')) {
			//
		}else{
			session(['app_language' => 'en']);
		}  		
        $this->language = session('app_language');
    }

    public function index() {
         if(Auth::user()){ 
            $roles = Role::get();
            $fm_data =  FieldMaster::where('title', '=', 'roles')->where('lang','=',$this->language)->first();
            
            return view('backend.dashboard.users.roles.index',compact('roles','fm_data'));
         }
         else {
             return redirect('auth/login')->with('message',"You must be login!"); 
         }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $required="*";
        $fm_data =  FieldMaster::where('title', '=', 'roles')->where('lang','=', $this->language)->first();

        return view('backend.dashboard.users.roles.create',compact('fm_data', 'required'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        if(Auth::user()){
            $rules = array(
            'name' => 'required|max:255|unique:roles',
            'level' => 'required|unique:roles',
             );
            $validator = Validator::make($request->all(), $rules);

            // process the validation
            if ($validator->fails()) {
                return Redirect()->back()->withErrors($validator)->withInput($request->all());                        
            }
            else {
                $role=new Role();
                $role->name = $request->input('name');
                $role->level = $request->input('level');
                $role->permission = $request->input('permission');   
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
