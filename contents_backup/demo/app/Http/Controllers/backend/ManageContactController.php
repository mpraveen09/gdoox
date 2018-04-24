<?php

namespace Gdoox\Http\Controllers\backend;
use DB;
use Illuminate\Http\Request;

use Gdoox\Http\Requests;
use Gdoox\Http\Controllers\Controller;

class ManageContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function manage_forms_templates()
    {
        //
              $address_data = DB::collection('manage_contacts')->where('_id', '=', 'manage_forms_templates_en')->get();
              $address_book=$this->manage_address($address_data);
              return view('backend.manage_contact.manage_forms_templates', compact('address_book'));
    }
    
      public function manage_compaigns()
    {
        //
              $message_data = DB::collection('manage_contacts')->where('_id', '=', 'manage_compaigns_en')->get();
              $message=$this->manage_message($message_data);
              return view('backend.manage_contact.manage_compaigns',compact('message'));
    }
    
     /*=======================@ #Manage Message, Compaigns =====================*/
    public function manage_message($msg_data){
     // print_r($msg_data);
             $data="";
              /*=====================@#Managing more than one company showrooms=========================*/
             $data.="<div class='form-group clearfix'>";
             
             if(!empty($msg_data[0]['campaigns']['cmpny_shwrm']['label'])){
                      
                    $data.="<label class='col-md-10'>". $msg_data['0']['campaigns']['cmpny_shwrm']['label']."</label>";
                
              }
              
               if(!empty($msg_data[0]['campaigns']['cmpny_shwrm']['type'])){
                      $data.="<div class='col-md-4'>";
                      $data.="<".$msg_data[0]['campaigns']['cmpny_shwrm']['type']." name='' class='form-control' >";//=========@#Select box=======
                      $data.="<option value='' disabled  selected>Selection by name</option>";
                      
                       foreach($msg_data[0]['campaigns']['cmpny_shwrm']['option'] as $select_key =>$select_value){
                             
                                $data.="<option value='".$select_key."'>$select_value</option>"; //===============@#selectbox options
                         
                      }   

                      $data.="</".$msg_data[0]['campaigns']['cmpny_shwrm']['type'].">";
                      $data.="</div>";
               }
               $data.="</div>";
               
               /*=====================@#Managing your messages=========================*/
               $data.="<div class='form-group clearfix'>";
               if(!empty($msg_data[0]['campaigns']['manage_msg']['label'])){
                      
                    $data.="<label class='col-md-10'>". $msg_data['0']['campaigns']['manage_msg']['label']."</label>";
                
              }
              
               if(!empty($msg_data[0]['campaigns']['manage_msg']['type'])){
                      $data.="<div class='col-md-4'>";
                      $data.="<".$msg_data[0]['campaigns']['manage_msg']['type']." name='' class='form-control' Multiple>";//=========@#Select box=======
                      $data.="<option value='' disabled  selected>Internal Messages</option>";
                      
                       foreach($msg_data[0]['campaigns']['manage_msg']['option'] as $select_key =>$select_value){
                             
                                $data.="<option value='".$select_key."'>$select_value</option>"; //===============@#selectbox options
                         
                      }   

                      $data.="</".$msg_data[0]['campaigns']['manage_msg']['type'].">";
                      $data.="</div>";
               }
               $data.="</div>";
                /*=====================@#Managing your messages2=========================*/
               $data.="<div class='form-group clearfix'>";
               if(!empty($msg_data[0]['campaigns']['manage_msg2']['label'])){
                      
                    $data.="<label class='col-md-10'>". $msg_data['0']['campaigns']['manage_msg2']['label']."</label>";
                
              }
            
              
               if(!empty($msg_data[0]['campaigns']['manage_msg2']['type'])){
                      $data.="<div class='col-md-4'>";
                      $data.="<".$msg_data[0]['campaigns']['manage_msg2']['type']." name='' class='form-control' Multiple>";//=========@#Select box=======
                      $data.="<option value='' disabled  selected>Internal Messages</option>";
                      
                       foreach($msg_data[0]['campaigns']['manage_msg2']['option'] as $select_key =>$select_value){
                             
                                $data.="<option value='".$select_key."'>$select_value</option>"; //===============@#selectbox options
                         
                      }   

                      $data.="</".$msg_data[0]['campaigns']['manage_msg2']['type'].">";
                      $data.="</div>";
               }
               $data.="</div>";
                /*=====================@#Managing your messages3=========================*/
               $data.="<div class='form-group clearfix'>";
               if(!empty($msg_data[0]['campaigns']['manage_msg3']['label'])){
                      
                    $data.="<label class='col-md-10'>". $msg_data['0']['campaigns']['manage_msg3']['label']."</label>";
                
              }
              
               if(!empty($msg_data[0]['campaigns']['manage_msg3']['type'])){
                      $data.="<div class='col-md-4'>";
                      $data.="<".$msg_data[0]['campaigns']['manage_msg3']['type']." name='' class='form-control' Multiple>";//=========@#Select box=======
                      $data.="<option value='' disabled  selected>Internal Messages</option>";
                      
                       foreach($msg_data[0]['campaigns']['manage_msg3']['option'] as $select_key =>$select_value){
                             
                                $data.="<option value='".$select_key."'>$select_value</option>"; //===============@#selectbox options
                         
                      }   

                      $data.="</".$msg_data[0]['campaigns']['manage_msg3']['type'].">";
                      $data.="</div>";
               }
               $data.="</div>";
               
               /*=========@#submit button=========*/ 
              $data.="<div class='form-group clearfix'>";
              if(!empty($msg_data[0]['campaigns']['btn']['type'])){
                      $data.="<div class='col-md-4'>";
                      $data.="<input type='".$msg_data[0]['campaigns']['btn']['type']."' class='btn btn-primary' value='".$msg_data[0]['campaigns']['btn']['value']."'>";
                      $data.="</div>";
              }
              $data.="</div>";    
               
               
               return $data;
               
    }
    
    /*===================@ #Manage Contact, Address Form & Template =============*/
    public function manage_address($add_data){
             $data="";
              /*=====================@#Managing Address Book=========================*/
             $data.="<div class='form-group clearfix'>";
             
             if(!empty($add_data[0]['manage']['label'])){
                      
                    $data.="<label class=''>". $add_data['0']['manage']['label']."</label>";
                
              }
               
              if(!empty($add_data[0]['manage']['type'])){//======@ #address book table
                
                       $result=$add_data[0]['manage']['data'];
                       $data.="<table  class='table table-bordered'>";
                       $data.="<tr>";        
                      
                       foreach($result as $data_key=>$data_val){

                               $data.="<th>$data_key</th>";//=====@ #table fields============
                                  
                       }
                       
                       $data.="</tr>";
                       $data.="<tr>";
                       
                       foreach($result as $data_key=>$data_val){

                               $data.="<td>$data_val</td>";//======@table cell rows=============
                                  
                       }
                       
                       $data.="</tr>";
                       $data.="</table>";
                                 
             }
             $data.="</div>";
             
             /*================@ #Import your Contact List in your Address Book================*/
             $data.="<div class='form-group clearfix'>";
             
             if(!empty($add_data[0]['import']['label'])){
                      
                    $data.="<label class='col-md-4'>". $add_data['0']['import']['label']."</label>";
                
              }
              
               if(!empty($add_data[0]['import']['type'])){
                      $data.="<div class='col-md-3'>";
                      $data.="<".$add_data[0]['import']['type']." name='' class='form-control' multiple>";//=========@#Select box=======

                       foreach($add_data[0]['import']['option'] as $select_key =>$select_value){
                             
                                $data.="<option value='".$select_key."'>$select_value</option>"; //===============@#selectbox options
                         
                      }   

                      $data.="</".$add_data[0]['import']['type'].">";
                      $data.="</div>";
               }
               $data.="</div>";
               
              /*===================@ #Verify your imported Contact================*/
               $data.="<div class='form-group clearfix'>";
              if(!empty($add_data[0]['verify']['label'])){
                      
                    $data.="<label class='col-md-4'>". $add_data['0']['verify']['label']."</label>";
                
              }
              
              if(!empty($add_data[0]['verify']['type'])){
                      $data.="<div class='col-md-4'>";
                      $data.="<textarea rows='5' cols='60' id='textarea'></textarea>";
                      $data.="</div>";
              }
              $data.="</div>";    
              
              /*===================@ #Organize your contacts===================*/
              $data.="<div class='form-group clearfix'>";
             
             if(!empty($add_data[0]['organize']['label'])){
                      
                    $data.="<label class='col-md-4'>". $add_data['0']['organize']['label']."</label>";
                
              }
              
               if(!empty($add_data[0]['organize']['type'])){
                      $data.="<div class='col-md-3'>";
                      $data.="<".$add_data[0]['organize']['type']." name='' class='form-control' multiple>";

                       foreach($add_data[0]['organize']['option'] as $select_key =>$select_value){
                             
                                $data.="<option value='".$select_key."'>$select_value</option>";
                         
                      }   

                      $data.="</".$add_data[0]['organize']['type'].">";
                      $data.="</div>";
               }
               $data.="</div>";
               
               /*===================@ #Create a Customer Folfer===================*/
              $data.="<div class='form-group clearfix'>";
              if(!empty($add_data[0]['custom_folder']['label'])){
                      
                    $data.="<label class='col-md-4'>". $add_data['0']['custom_folder']['label']."</label>";
                
              }
              
              if(!empty($add_data[0]['custom_folder']['type'])){
                      $data.="<div class='col-md-4'>";
                      $data.="<input type='".$add_data[0]['custom_folder']['type']."' class='' placeholder='Customer folder name'>";
                      $data.="</div>";
              }
              $data.="</div>";    
              
              /*===================@ #Create a Supplier group===================*/
              $data.="<div class='form-group clearfix'>";
              if(!empty($add_data[0]['supplier_grp']['label'])){
                      
                    $data.="<label class='col-md-4'>". $add_data['0']['supplier_grp']['label']."</label>";
                
              }
              
              if(!empty($add_data[0]['supplier_grp']['type'])){
                      $data.="<div class='col-md-4'>";
                      $data.="<input type='".$add_data[0]['supplier_grp']['type']."' class='' placeholder='Supplier Group Name'>";
                      $data.="</div>";
              }
              $data.="</div>";    
              
               /*===================@ # Create a Team===================*/
              $data.="<div class='form-group clearfix'>";
              if(!empty($add_data[0]['team']['label'])){
                      
                    $data.="<label class='col-md-4'>". $add_data['0']['team']['label']."</label>";
                
              }
              
              if(!empty($add_data[0]['team']['type'])){
                      $data.="<div class='col-md-4'>";
                      $data.="<input type='".$add_data[0]['team']['type']."' class='' placeholder='Team Name'>";
                      $data.="</div>";
              }
              $data.="</div>";    
              
              /*=========@#submit button=========*/ 
              $data.="<div class='form-group clearfix'>";
              if(!empty($add_data[0]['btn']['type'])){
                      $data.="<div class='col-md-4 col-md-offset-4'>";
                      $data.="<input type='".$add_data[0]['btn']['type']."' class='btn btn-primary' value='".$add_data[0]['btn']['value']."'>";
                      $data.="</div>";
              }
              $data.="</div>";    
               
              
              return $data;
    }
}
