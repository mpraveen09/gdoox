<?php

namespace Gdoox\Http\Controllers;

use DB;
use Illuminate\Http\Request;

use Gdoox\Http\Requests;
use Gdoox\Http\Controllers\Controller;

class UserCompaniesController extends \Gdoox\Http\Controllers\backend\FieldMasterController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function ecomm_user_companies()
    {
        try{
            $field_master_data = DB::collection('user_companies')->where('_id', '=', 'ecommerce_en')->get();
            $tab_data = DB::collection('manage_ecomm_prod_tabs')->where('_id', '=', 'tab_en')->get();
            $field_data=$this->create_fields($field_master_data);
            $tabs=$this->manage_ecomm_product_tab($tab_data);
            return view('user_company.ecomm_user_companies',compact('field_data','tabs'));
        }
        catch(\Exception $e){
              $errors = $this->errorMessage($e);
              return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    /*====================@Managing tabs in ecomm_user_companies view file=====================================*/
    public function manage_ecomm_product_tab($tab_data){
       try{
          $data="";
          //echo "<pre>";print_r($tab_data);
          if(!empty($tab_data[0] ['tabs'])){
                
                  $data .= " <div class=' col-md-10  col-md-offset-2'>";
                 
                  if(!empty($tab_data[0] ['tabs']['label'])){
                  
                       $data.="<label for='".$tab_data[0] ['tabs']['label']."' class='col-md-12 col-md-offset-3'>".$tab_data[0] ['tabs']['label']."</label>";  
                                      
                  
                  
                   $data.="<div style='clear:both;'></div>";
                   $data .= "<div class='bs-component'>";
                   $data.="<ul style='margin-bottom: 15px;' class='nav nav-tabs'>";
                  
                   if(!empty($tab_data[0] ['tabs']['option'])){ 

                            foreach($tab_data[0] ['tabs']['option'] as $tb){
                     
                                 $data.="<li class='column-1'><a data-toggle='tab' href='#".$tb."' aria-expanded='false'>".$tb."<div class='ripple-wrapper'></div></a></li>";
 
                            }
                   }         
                   
                   $data.="</ul>";
                   $data.="</div>";
                   $data.="<div class='tab-content'  id=myTabContent'>" ;
                   
                   if(!empty($tab_data[0] ['tabs']['option'])){         
                           foreach($tab_data[0] ['tabs']['option'] as $tb){
                                  $data.="<div id='".$tb."' class='tab-pane fade'>";
                                  $data.=$this->tabSelectBox();  
                                  $data.="</div>";
                           }   
                           
                           $data.= "</div>";
                           $data.="<div class='btn btn-primary btn-xs' id='source-button' style='display: none;'>&lt; &gt;</div>";
                           $data.="</div>";
                           $data.="</div>";
                           
                  }
             }
         }
            return  $data;
       }
       catch(\Exception $e){
              $errors = $this->errorMessage($e);
              return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
      }
     
     /*====================@Tab Content select boxes===================================*/
      public function tabSelectBox(){
          try{
              $data="";
              $tabbox = DB::collection('manage_ecomm_prod_tabs')->where('_id', '=', 'products_tab_en')->get(); 
              
              $data .= "<div class='form-group clearfix'>";
              
              if(!empty($tabbox[0]['product']['sku'])){
                     
                     $data.="<label for='".$tabbox[0]['product']['sku']['label']."' class='col-md-4 control-label'>".$tabbox[0]['product']['sku']['label']."</label>"; 
                     $data .= "<div class='col-md-8'>";
                     $data.="<input type='".$tabbox[0]['product']['sku']['type']."' name='".$tabbox[0]['product']['sku']['label']."' class=''>";
                     $data.="</div>";
                                   
              }     
             
              $data.="</div>";
             //print_r($tabbox);
              if(!empty($tabbox[0]['product']['tab']['opt1'])){
                      
                      $data .= "<div class='form-group'>";
                     
                      if(!empty($tabbox[0]['product']['tab']['opt1']['label'])){
                             
                              $data.="<label for='".$tabbox[0]['product']['tab']['opt1']['label']."' class='col-md-4 control-label'>".$tabbox[0]['product']['tab']['opt1']['label']."</label>";  
                             
                      }
                      
                      $data.="<div class='col-md-2'>";
                      $data.="<".$tabbox[0]['product']['tab']['opt1']['type']." name='' class='form-control' multiple>";

                       foreach($tabbox[0]['product']['tab']['opt1']['option'] as $select_key =>$select_value){
                             
                                $data.="<option value='".$select_key."'>$select_value</option>";
                         
                      }   

                      $data.="</".$tabbox[0]['product']['tab']['opt1']['type'].">";
                      $data .= "</div>";
                      $data.="</div>";
              }
            
              if(!empty($tabbox[0]['product']['tab']['opt2'])){
                
                      $data .= "<div class='form-group'>";
                     
                      if(!empty($tabbox[0]['product']['tab']['opt2']['label'])){
                             
                              $data.="<label for='".$tabbox[0]['product']['tab']['opt2']['label']."' class='col-md-4 control-label'>".$tabbox[0]['product']['tab']['opt2']['label']."</label>";  
                             
                      }
                      
                      $data.="<div class='col-md-2'>";
                      $data.="<".$tabbox[0]['product']['tab']['opt2']['type']." name='' class='form-control' multiple>";

                       foreach($tabbox[0]['product']['tab']['opt2']['option'] as $select_key =>$select_value){
                             
                                $data.="<option value='".$select_key."'>$select_value</option>";
                         
                      }   

                      $data.="</".$tabbox[0]['product']['tab']['opt2']['type'].">";
                      $data .= "</div>";
                      $data.="</div>";
              }
              
              if(!empty($tabbox[0]['product']['tab']['opt3'])){
                      
                      $data .= "<div class='form-group'>";
                     
                      if(!empty($tabbox[0]['product']['tab']['opt3']['label'])){
                             
                              $data.="<label for='".$tabbox[0]['product']['tab']['opt3']['label']."' class='col-md-4 control-label'>".$tabbox[0]['product']['tab']['opt3']['label']."</label>";  
                             
                      }
                      
                      $data.="<div class='col-md-2'>";
                      $data.="<".$tabbox[0]['product']['tab']['opt3']['type']." name='' class='form-control' multiple>";

                       foreach($tabbox[0]['product']['tab']['opt3']['option'] as $select_key =>$select_value){
                             
                                $data.="<option value='".$select_key."'>$select_value</option>";
                         
                      }   

                      $data.="</".$tabbox[0]['product']['tab']['opt3']['type'].">";
                      $data .= "</div>";
                      $data.="</div>";
              }
              if(!empty($tabbox[0]['product']['tab']['opt4'])){
                      $data .= "<div class='form-group'>";
                     
                      if(!empty($tabbox[0]['product']['tab']['opt4']['label'])){
                             
                              $data.="<label for='".$tabbox[0]['product']['tab']['opt4']['label']."' class='col-md-4 control-label'>".$tabbox[0]['product']['tab']['opt4']['label']."</label>";  
                             
                      }
                      
                      $data.="<div class='col-md-2'>";
                      $data.="<".$tabbox[0]['product']['tab']['opt4']['type']." name='' class='form-control' multiple>";

                       foreach($tabbox[0]['product']['tab']['opt4']['option'] as $select_key =>$select_value){
                             
                                $data.="<option value='".$select_key."'>$select_value</option>";
                         
                      }   

                      $data.="</".$tabbox[0]['product']['tab']['opt4']['type'].">";
                      $data .= "</div>";
                      $data.="</div>";
              }
              if(!empty($tabbox[0]['product']['tab']['opt5'])){
                      $data .= "<div class='form-group'>";
                     
                      if(!empty($tabbox[0]['product']['tab']['opt5']['label'])){
                             
                              $data.="<label for='".$tabbox[0]['product']['tab']['opt5']['label']."' class='col-md-4 control-label'>".$tabbox[0]['product']['tab']['opt5']['label']."</label>";  
                             
                      }
                      
                      $data.="<div class='col-md-2'>";
                      $data.="<".$tabbox[0]['product']['tab']['opt5']['type']." name='' class='form-control' multiple>";

                       foreach($tabbox[0]['product']['tab']['opt5']['option'] as $select_key =>$select_value){
                             
                                $data.="<option value='".$select_key."'>$select_value</option>";
                         
                      }   

                      $data.="</".$tabbox[0]['product']['tab']['opt5']['type'].">";
                      $data .= "</div>";
                      $data.="</div>";
              }
              
              if(!empty($tabbox[0]['product']['tab']['opt6'])){//
                      $data .= "<div class='form-group'>";
                     
                      if(!empty($tabbox[0]['product']['tab']['opt6']['label'])){
                             
                              $data.="<label for='".$tabbox[0]['product']['tab']['opt6']['label']."' class='col-md-4 control-label'>".$tabbox[0]['product']['tab']['opt6']['label']."</label>";  
                             
                      }
                      
                      $data.="<div class='col-md-2'>";
                      $data.="<".$tabbox[0]['product']['tab']['opt6']['type']." name='' class='form-control' multiple >";

                       foreach($tabbox[0]['product']['tab']['opt6']['option'] as $select_key =>$select_value){
                             
                                $data.="<option value='".$select_key."'>$select_value</option>";
                         
                      }   

                      $data.="</".$tabbox[0]['product']['tab']['opt6']['type'].">";
                      $data .= "</div>";
                      $data.="</div>";
              }
             
              return $data;
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