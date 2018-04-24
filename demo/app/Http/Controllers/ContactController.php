<?php

namespace Gdoox\Http\Controllers;

use Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
//use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
  
    public function sendEmail(){
        $input = Request::all();
        $rules = array(
            'name' => 'required',				
            'email' => 'required',				
        );
        
        $data['error'] = false;
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {       
              $data['error'] = true;
              $data['message'] = 'All fields are mandatory.';
              return View::make('contact', array('data' => $data));
        }
            
        $data = $input;
        Mail::send('emails.newsignup', ['data' => $data], function ($message)  use ($data) {
            $message->from($data['email'], $data['name']);
            //$message->from("join@gdoox.com", "Gdoox");
            $message->to("join@gdoox.com");
            $message->subject("New Signup on GDoox.com");
            
        });
        
        Mail::send('emails.thanks', ['data' => $data], function ($message)  use ($data) {
            // $message->from($data['email'], $data['name']);
            $message->from("join@gdoox.com", "GDoox");
            $message->to($data['email'], $data['name']);
            $message->subject("Thanks for your signup on GDoox.com");
            
        }); 
              
        return View::make('thanks', array('data' => $data));
        
    }
}