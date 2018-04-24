@extends('layout.backend.master')
@extends('layout.backend.userinfo')
@section('right_col')
  
  <?php echo Form::open(array('action'=>'InvestorsController@UpdateInstitutionalInvestor'));?>
 
    <?php   echo Form::hidden('inst_id',$inst_data[0]['_id']);?>
   
  <h3 class="page-header">Edit Private Investor</h3>
  
  <div class=" col-md-12 ">
     
 <?php
 //print_r($field_master_data); die;
//@--------------------------------Checks Message is exist--------------------------------
    echo "<div class='form-group  col-md-9 clearfix'>";
    echo Form::label($field_master_data[0]['edit_txt']['label'], null, array("class"=>"col-lg-4 control-label"));
    echo "<div class='col-md-8'>";
    echo Form::text("edit_txt", $inst_data[0]['edit_txt'], array("required","class"=>"form-control"));
    echo "</div>";
    echo "</div>";
        
    echo "<div class='text-left col-md-3'>";
    echo "</div>";
   
//@--------------------------------Checks First Name is exist--------------------------------
    echo "<div class='form-group  col-md-9 clearfix'>";
    echo Form::label( $field_master_data[0]['fst_name']['label'], null, array("class"=>"col-lg-4 control-label"));
    echo "<div class='col-md-8'>";
    echo Form::text("fst_name", $inst_data[0]['fst_name'], array("required","class"=>"form-control"));
    echo "</div>";
    echo "</div>";
      
     echo "<div class='text-left col-md-3'>";
     echo "</div>";

 //@--------------------------------Checks Last Name is exist--------------------------------
    echo "<div class='form-group  col-md-9 clearfix'>";
    echo Form::label( $field_master_data[0]['lst_name']['label'], null, array("class"=>"col-lg-4 control-label"));
    echo "<div class='col-md-8'>";
    echo Form::text("lst_name", $inst_data[0]['lst_name'], array("required","class"=>"form-control"));
    echo "</div>";
    echo "</div>";
      
     echo "<div class='text-left col-md-3'>";
     echo "</div>";
          
 //@--------------------------------Checks Last Name is exist--------------------------------
    echo "<div class='form-group  col-md-9 clearfix'>";
    echo Form::label( $field_master_data[0]['scnd_name']['label'], null, array("class"=>"col-lg-4 control-label"));
    echo "<div class='col-md-8'>";
    echo Form::text("scnd_name", $inst_data[0]['scnd_name'], array("required","class"=>"form-control"));
    echo "</div>";
    echo "</div>";
      
     echo "<div class='text-left col-md-3'>";
     echo "</div>";
  
//@--------------------------------Checks Initials is exist--------------------------------
    echo "<div class='form-group  col-md-9 clearfix'>";
    echo Form::label( $field_master_data[0]['initials']['label'], null, array("class"=>"col-lg-4 control-label"));
    echo "<div class='col-md-8'>";
    echo Form::text("initials", $inst_data[0]['initials'], array("required","class"=>"form-control"));
    echo "</div>";
    echo "</div>";
      
     echo "<div class='text-left col-md-3'>";
     echo "</div>";
     
//@--------------------------------Checks Street address of business is exist--------------------------------
    echo "<div class='form-group  col-md-9 clearfix'>";
    echo Form::label( $field_master_data[0]['strt_add_of_bsns']['label'], null, array("class"=>"col-lg-4 control-label"));
    echo "<div class='col-md-8'>";
    echo Form::text("strt_add_of_bsns", $inst_data[0]['strt_add_of_bsns'], array("required","class"=>"form-control"));
    echo "</div>";
    echo "</div>";
      
     echo "<div class='text-left col-md-3'>";
     echo "</div>";

 //@--------------------------------Checks if key "city" is exist--------------------------------
     echo "<div class='form-group  col-md-9 clearfix'>";
     echo Form::label( $field_master_data[0]['city_of_bsns']['label'], null, array("class"=>"col-lg-4 control-label"));
     echo "<div class='col-md-8'>";
     echo Form::text("city_of_bsns", $inst_data[0]['city_of_bsns'], array("required","class"=>"form-control"));
     echo "</div>";
     echo "</div>";
     
     echo "<div class='text-left col-md-3'>";
     echo "</div>";    

//@--------------------------------Checks if key "cntry_of_busns" is exist--------------------------------
    echo "<div class='form-group  col-md-9 clearfix'>";
    echo Form::label( $field_master_data[0]['country_of_bsns']['label'], null, array("class"=>"col-lg-4 control-label"));
    echo "<div class='col-md-8'>";
    echo Form::select("country_of_bsns",$field_master_data[0]['country_of_bsns']['option'], $inst_data[0]['country_of_bsns'], array("required","class"=>"form-control"));
    echo "</div>";
    echo "</div>";
        
    echo "<div class='text-left col-md-3'>";
    echo "</div>";
          
//@--------------------------------Checks if key "zip" is exist--------------------------------
    echo "<div class='form-group  col-md-9 clearfix'>";
    echo Form::label( $field_master_data[0]['zip']['label'], null, array("class"=>"col-lg-4 control-label"));
    echo "<div class='col-md-8'>";
    echo Form::text("zip", $inst_data[0]['zip'], array("required","class"=>"form-control"));
    echo "</div>";
    echo "</div>";
  
  //@--------------------------------Checks if key "ph_no1" is exist--------------------------------
     echo "<div class='form-group  col-md-9 clearfix'>";
     echo Form::label( $field_master_data[0]['ph_no1']['label'], null, array("class"=>"col-lg-4 control-label"));
     echo "<div class='col-md-8'>";
     echo Form::text("ph_no1", $inst_data[0]['ph_no1'], array("class"=>"form-control"));
     echo "</div>";
     echo "</div>";
     
     echo "<div class='text-left col-md-3'>";
     echo "</div>";
     
//@--------------------------------Checks if key "ph_no2" is exist--------------------------------
    echo "<div class='form-group  col-md-9 clearfix'>";
    echo Form::label( $field_master_data[0]['ph_no2']['label'], null, array("class"=>"col-lg-4 control-label"));
    echo "<div class='col-md-8'>";
    echo Form::text("ph_no2", $inst_data[0]['ph_no2'], array("class"=>"form-control"));
    echo "</div>";
    echo "</div>";
    
    echo "<div class='text-left col-md-3'>";
    echo "</div>";
     
//@--------------------------------Checks if key "fax_no" is exist--------------------------------
     echo "<div class='form-group  col-md-9 clearfix'>";
     echo Form::label( $field_master_data[0]['fax_no']['label'], null, array("class"=>"col-lg-4 control-label"));
     echo "<div class='col-md-8'>";
     echo Form::text("fax_no", $inst_data[0]['fax_no'], array("class"=>"form-control"));
     echo "</div>";
     echo "</div>";
     
     echo "<div class='text-left col-md-3'>";
     echo "</div>";
     
     
//@--------------------------------Checks if key "mob" is exist--------------------------------
    echo "<div class='form-group  col-md-9 clearfix'>";
    echo Form::label( $field_master_data[0]['mob']['label'], null, array("class"=>"col-lg-4 control-label"));
    echo "<div class='col-md-8'>";
    echo Form::text("mob", $inst_data[0]['mob'], array("required","class"=>"form-control"));
    echo "</div>";
    echo "</div>";
     
    echo "<div class='text-left col-md-3'>";
    echo "</div>";
  
    //@--------------------------------Checks if key "msm" is exist--------------------------------
     echo "<div class='form-group  col-md-9 clearfix'>";
     echo Form::label( $field_master_data[0]['msm']['label'], null, array("class"=>"col-lg-4 control-label"));
     echo "<div class='col-md-8'>";
     echo Form::text("msm", $inst_data[0]['msm'], array("required","class"=>"form-control"));
     echo "</div>";
     echo "</div>";
     
     echo "<div class='text-left col-md-3'>";
     echo "</div>";
      

//@--------------------------------Checks if key "skype" is exist--------------------------------
    echo "<div class='form-group  col-md-9 clearfix'>";
    echo Form::label( $field_master_data[0]['skype']['label'], null, array("class"=>"col-lg-4 control-label"));
    echo "<div class='col-md-8'>";
    echo Form::text("skype", $inst_data[0]['skype'], array("class"=>"form-control"));
    echo "</div>";
    echo "</div>";
     
     echo "<div class='text-left col-md-3'>";
     echo "</div>";
 
//@--------------------------------Checks if key "bsns_email" is exist--------------------------------
     echo "<div class='form-group  col-md-9 clearfix'>";
     echo Form::label( $field_master_data[0]['bsns_email']['label'], null, array("class"=>"col-lg-4 control-label"));
     echo "<div class='col-md-8'>";
     echo Form::text("bsns_email", $inst_data[0]['bsns_email'], array("class"=>"form-control"));
     echo "</div>";
     echo "</div>";
//@--------------------------------Availale Docs is exist--------------------------------
//    echo "<div class='form-group  col-md-9 clearfix'>";
//    $checkbox_org="";
//    echo "<div class='col-md-8'>";
//    foreach( $field_master_data[0]['avail_docs']['value'] as $check_key=>$check_value){
//         $checkbox_org.= "<div class=' checkbox '>";
//         $checkbox_org.="<label>";
//         $checkbox_org.= Form::checkbox("avail_docs[]",$check_key,  in_array($check_key,$inst_data[0]['avail_docs']  ));
//         $checkbox_org.= $check_value;
//         $checkbox_org.="</label>";
//         $checkbox_org.= "</div>";
//    }
//    echo "</div>";
//    echo "</div>";
//@--------------------------------Checks if key "btn" is exist--------------------------------
    echo "<div class='form-group  col-md-10 col-md-offset-4 clearfix'>";
    echo "<div class='col-md-4'>";
    echo Form::submit("Update", array("class"=>"btn-primary btn-lg btn-block btn"));
    echo "</div>";
    echo "</div>";
     
    ?>
     </div>
<?php echo Form::close();?>
@endsection