<?php
namespace Gdoox\Http\Controllers\backend;

use DB;
use Illuminate\Http\Request;

use Gdoox\Http\Requests;
use Gdoox\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
/* Change */
class FieldMasterController extends Controller
{
      //@------------------------ Creating Form Fields for profile field master---------------------------------------------
    public function create_fields($fm_data ){
   
        $field_data="";
        foreach ($fm_data[0] as $fm_key=>$fm_value)
        {
             
            if(!empty($fm_value['label'])){
                  $label=$fm_value['label'];
            }
            if(is_array($fm_key)){
              $name[]=$fm_key;
            }  
            $name=$fm_key;
            
           
            if(!empty($fm_value['type'])){
               $type=$fm_value['type'];
            switch($type){
               case 'text':
                   $field_data .= "<div class='form-group clearfix'>";
                   $field_data.="<label for='".$label."' class='col-md-4 control-label'>$label</label>";  
                   $field_data .= "<div class='col-md-6'>";
                   $field_data.="<input type='".$type."' name='".$name."' class='form-control'>";
                   $field_data.="</div>";
                   $field_data.="</div>";
                   break;
                case 'password':
                   $field_data .= "<div class='form-group clearfix'>";
                   $field_data.="<label for='".$label."' class='col-md-4 control-label'>$label</label>";  
                   $field_data .= "<div class='col-md-6'>";
                   $field_data.="<input type='".$type."' name='".$name."' class='form-control'>";
                   $field_data.="</div>";
                   $field_data.="</div>";
                   break;  
               case 'email':
                   $field_data .= "<div class='form-group clearfix'>";
                   $field_data.="<label for='".$label."' class='col-md-4 control-label'>$label</label>";  
                   $field_data .= "<div class='col-md-6'>";
                   $field_data.="<input type='".$type."' name='".$name."' class='form-control'>";
                   $field_data .= "</div>";
                   $field_data.="</div>";
                   break;
               case 'select':
                   if(!empty($fm_value['option'])){
                        $fm_select_option=$fm_value['option'];
                   }
                   $field_data .= "<div class='form-group clearfix'>";
                   $field_data.="<label for='".$label."' class='col-md-4 control-label'>$label</label>";  
                   $field_data.="<div class='col-md-6'>";
                   $field_data.="<$type name='".$name."' class='form-control'>";
                  
                   foreach($fm_select_option as $fm_select_key =>$fm_select_value){
                       $field_data.="<option value='".$fm_select_key."'>$fm_select_value</option>";
                   }   
                   
                   $field_data.="</$type>";
                   $field_data .= "</div>";
                   $field_data.="</div>";
                   break;
                case 'checkbox':
                  if(!empty($fm_value['value'])){
                      $fm_check_option=$fm_value['value'];
                  }
                  $field_data .= " <div class='form-group clearfix'>";
                  if(!empty($label)){
                  $field_data.="<label for='".$label."' class='col-md-4 control-label'>$label</label>"; 
                  }
                  $field_data.="<div class='checkbox'>";
                   foreach($fm_check_option as $fm_check_key =>$fm_check_value){
                        $field_data .= "<label class='col-md-6 col-md-offset-4'>";
                        $field_data.="<input name='".$name."' type='".$type."' value='".$fm_check_key."'>";
                       
                        $field_data.="$fm_check_value</label>";
                  }
                  $field_data.="</div>";
                  $field_data.="</div>";
                   break;
             
                 case 'radio':
                    if(!empty($fm_value['value'])){
                          $fm_radio_option=$fm_value['value'];
                    }
            
                   $field_data .= " <div class='form-group clearfix'>";
                   $field_data.="<label for='".$label."' class='col-md-4 control-label'>$label</label>";
                    foreach($fm_radio_option as $fm_radio_key =>$fm_radio_value){
                        $field_data .= "<label class='col-md-8 col-md-offset-4'>";
                        $field_data.="<input name='".$name."' type='".$type."' value='".$fm_radio_key."'>";
                       
                        $field_data.="$fm_radio_value</label>";
                   }
                   $field_data.="</div>";
                   break;
                   case 'textarea':
                   $field_data .= " <div class='form-group clearfix'>";
                   if(!empty($label)){
                        $field_data.="<label for='".$label."' class='col-md-4 control-label'>$label</label>";
                   }
                   else{
                     $field_data.="<div class='col-md-4 control-label'></div>";
                   }
                   $field_data .= "<div class='col-md-6'>";
                   $field_data.="<textarea rows='5' cols='55' id='textarea' name='".$name."'></textarea>";
                   $field_data.="</div>";
                   $field_data.="</div>";
                   break;
                case 'button':
                  if(!empty($fm_value['value'])){
                    $value=$fm_value['value'];
                  }
                   $field_data .= "<div class='form-group clearfix'>";
                   $field_data.="<div class='col-md-6 col-md-offset-4'>";
                   $field_data.="<$type name='".$name."' class='btn btn-primary '>$value<div class='ripple-wrapper'></div></'".$type."'>";
                   $field_data.="</div>";
                    $field_data.="</div>";
                   break;
            }
          }
           
          
       }         
      return $field_form_data="<form action='' method='' name='' class='form-horizontal'>".$field_data."</form>";
 
    }

}
