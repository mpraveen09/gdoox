<?php

namespace Gdoox\Http\Controllers\exceptions;
use Gdoox\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;

use Gdoox\Models\Exceptions;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Gdoox\Models\FieldMaster;
use Illuminate\Support\Facades\Auth;


class ExceptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(){
        if(Auth::user()){
            $exceptions = Exceptions::where('status','=','1')->paginate(25);
            return view('exceptions.index')->with('exceptions',$exceptions);
        }
        else {
            return redirect('auth/login')->with('message',"Please Login!"); 
        }
    }

    public function create(){
        if(Auth::user()){
            return view('exceptions.create');
        }
        else {
            return redirect('auth/login')->with('message',"Please Login!"); 
        }
    }
    
    public function store(){
        $data = Request::all();
        $errors = new Exceptions();
        
        $errors->subject = $data['subject'];
        $errors->description = $data['description'];
        $errors->controller = $data['controller'];
        $errors->status = '1';
        
        if($errors->save()){
            return Redirect::route('dash-board')->with('message',"Error Report Added Successfully.");
        }
        else {
            Session::flash('message', 'Error Report Could not be added! Please Try Again');
            return Redirect::route('exceptions.create')->with(Request::all());
        }
    }
    
    public function show($id){
        
    }
    
    public function edit(){
        
    }
    
    public function update($param) {
        
    } 
}


