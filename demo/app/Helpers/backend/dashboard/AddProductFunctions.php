<?php
namespace Gdoox\Helpers\backend\dashboard;

use DB;
use Gdoox\Http\Requests;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use Gdoox\Models\BusinessInfo;
use Gdoox\Models\Attribute;
use Illuminate\Support\Facades\Auth;
use Gdoox\Models\Products;
use Gdoox\Models\BusinessEcommerceCompany;
use Gdoox\Models\AttributesAssoc;
use Gdoox\Models\CategoryAttribute;
//use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Gdoox\Models\EcomShops;
use Gdoox\Models\AttributesType;
use Form;
use Image;
use Input;
use UUID;

trait AddProductFunctions {

    function createProductForm($prod_cats, $prod_cats_name, $attrAssoc, $attrForCats, $userid, $product=''){
        $lang = session('app_language');
        
        $formFields = array();
        $formFields[] = '<div class="card">';
        $formFields[] = '<div class="card-header bgm-green"><h2>You have selected the following categories</h2></div>';
        $formFields[] = '<div style="padding: 26px 178px" class="card-body card-padding">';
      
        foreach($prod_cats_name as $prod_cats_name_){
            $formFields[]='<h6><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> &nbsp;&nbsp; '.$prod_cats_name_.'</h6>';
        }

        $formFields[] = '</div></div>';
        $formFields[] = '<div class="card">';
        $formFields[] = '<div class="card-header bgm-red"><h2>What do you want to do</h2></div>';
        $formFields[] = '<div class="card-body card-padding"><label class="radio-inline m-r-20">';   
        $formFields[] = Form::radio('prod_type', 'sell',false, ['required']) . ' &nbsp; <font size="2"><b>I Want to sell my product or service</b></font>';
        $formFields[] = '</label><label class="radio-inline m-r-20">';
        $formFields[] = Form::radio('prod_type', 'buy',false, ['required']) . ' &nbsp; <font size="2"><b>I Want to Buy product I need for my business</b></font>';
        $formFields[] = '</label></div></div>';

        foreach($prod_cats as $prod_cat){
            $formFields[]= $this->createProductFormFields("cat_id[]", "", "", "hidden", "", "", "","", $prod_cat);
        }

        $formFields[] = $this->createProductFormFields("userid", "", "", "hidden", "", "", "","", $userid);

      foreach ($attrAssoc as $k=>$v) {
        $formFieldsTemp=array();

        foreach($attrForCats as $attrForCatk => $attrForCat){
          $attributes= Attributes::where('attr_id', strval($attrForCat) )->where('class', '=', $k)->where('lang', '=', $lang)->first();
          if(count($attributes)){
            $attr_id=$attributes->attr_id;

            if (strpos($attr_id,';') !== false || strpos($attr_id,'/') !== false) {
                $disabled="disabled";
            }else{
              $disabled="";
            }

            if($attr_id === '2' || $attr_id === 2){
              $siteslug = $this->getSites($userid);
              
              $formFieldsTemp[]= $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, "TD", $attributes->len, "attr_".$attributes->class, $attributes->req,$siteslug, "",$disabled,'',$product,$attr_id);
            }else{

              $opt = array();
              if($attributes->field_type === "TD" || $attributes->field_type === "TM" ){
                  //echo $attributes->dropdown_list ;
                  $dropopt =  DropdownOptions::where('attr_id', (int)$attributes->attr_id )->where('lang', '=', $lang)->first();
                  if(count($dropopt )){
                      foreach ($dropopt->options as $dropopt_) {
                          $opt[$dropopt_] = $dropopt_;
                      }
                  }
              }

              //field type and length
              $a_type = AttributesType::where('lang', '=', $lang)->Where('id', '=', $attributes->field_type)->project(array('label'))->first();
              $fieldinfo = "<br/><small><i>";
              $fieldinfo .= $a_type->label;
              if(!empty($attributes->len)){
                $fieldinfo .= " (Length ". $attributes->len . ")";
              }
              $fieldinfo .= "</i></small>";

              $formFieldsTemp[]= $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, $attributes->field_type, $attributes->len, "attr_".$attributes->class, $attributes->req,$opt, "",$disabled, $fieldinfo, $product,$attr_id);
            }                    
          }                  
        }

        if(!empty($formFieldsTemp)){
            $formFields[] = '<div class="card">';
            $formFields[] = '<div class="card-header bgm-bluegray"><h2>'.$v.'</h2></div>';// "<hr/><h4>$v</h4><hr/>";
            $formFields[] = '<div class="card-body card-padding">';
            foreach ($formFieldsTemp as $formFieldsTempV) {
                $formFields[] = $formFieldsTempV;
            }
            //$formFields[] = $formFieldsTemp[];
            $formFields[] = '</div></div>';
        } 
      } 
      
      $formFields[]= '<div class="card">
                    <div class="card-header bgm-bluegray"><h2>Product Images</h2></div>  
                    <div class="item form-group">
                        <div class="prod_images">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" data-toggle="tooltip" data-placement="bottom">Image</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                    <div>
                                        <span class="btn btn-info btn-file waves-effect">
                                            <span class="fileinput-new">Select image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input name="product_images[]" type="file" id="product_images">
                                        </span>
                                        <a href="#" class="btn btn-danger fileinput-exists waves-effect" data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>
                                <br>
                                <small><i>Image (uploaded from PC)</i></small>
                            </div>
                        </div>

                        <div id="images_div"></div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label class="control-label col-md-6 col-sm-6 col-xs-12" data-toggle="tooltip" data-placement="bottom"></label>
                            <div class="control-label col-md-3 col-sm-3 col-xs-12">
                                <button type="button" class="btn btn-round btn-primary add_images">Add More Images</button>
                            </div>
                        </div>
                    </div>
                    <br />
            </div>';
      return $formFields;
  }
    
    function getSites($userid){
      try{
        $sites = Request::get('sub_user_sites');
        if(!empty($sites)){
            foreach ($sites as $slug){
              $sites_[$slug] = $this->SiteName($slug);

            }
        }
        else{
            $sites = EcomShops::where('user_id', $userid )->get();
            $sites_=array();
            //$a_types= AttributesType::where('lang', '=', 'en')->get();//all(array('id','label'));
            foreach ($sites as $site) {
              $sites_[$site->slug] = $site->ecomm_company_name;
            }
        }
         return $sites_;
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                          "Line Number: ".$e->getLine()." ".
                          "File Name: ".$e->getFile()." ".
                          "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }
    
    function createProductFormFields($attr_id, $label="", $desc="", $field_type="", $len="", $class="", $req="",$opt, $val="",$disabled="", $fieldinfo ="", $product="", $curr_attr=""){
      if(!empty($product) && !empty($product->product_data[$curr_attr]) ){
        $value = $product->product_data[$curr_attr] ;
        $defaultValue = str_replace('–', '-', $value);
      }
      else {
         $defaultValue = "";
      }
      
        //$this->createProductFormFields($attr_id, $label, $desc, $field_type, $len, $class, $req);
        if($req==="M" || $req==="required"){ $req="required";}else{ $req=""; }
//        $req="";
        switch ($field_type) {
            case "TD":
                //if($label !==""){
                $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::select($attr_id, $opt, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => '---', $req, $disabled])
                            . $fieldinfo
                        . "</div>
                    </div>";                    
                break;
            case "TM":
                //if($label !==""){
                if(count($opt) > 20){
                  $hgt=250;
                }else{
                  $hgt=150;
                }
              
                $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::select($attr_id.'[]', $opt, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => '---', $req, $disabled, 'multiple', 'style'=>'height: '.$hgt.'px;'])
                            . $fieldinfo
                        . "</div>
                    </div>";                    
                break;    
            case "TA":
                //if($label !==""){
                $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::textarea($attr_id, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => $label, $req, $disabled, 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
                break;      
            case "T":
                //if($label !==""){
                $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::text($attr_id, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => $label, $req, $disabled, 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
                break;      
            case "Y":            // Year
            case "N":
                //if($label !==""){
                $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::number($attr_id, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => $label, $req, $disabled, 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
                break; 
            case "D":
                //if($label !==""){
                $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::date($attr_id, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                 $req, $disabled, "min"=> date("Y-m-d"), 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
                break; 
            case "H":
                //if($label !==""){
                $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::time($attr_id, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                 $req, $disabled, 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
                break;             
            case "I":
                //if($label !==""){
                $field = "<div class='item form-group ".$class."'>"
                            . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12','data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                            ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                                ."<div class='fileinput fileinput-new' data-provides='fileinput'>
                                    <div class='fileinput-preview thumbnail' data-trigger='fileinput'></div>
                                <div>
                                <span class='btn btn-info btn-file'>
                                    <span class='fileinput-new'>Select image</span>
                                    <span class='fileinput-exists'>Change</span>"
                                        . Form::file($attr_id, '', ['class' => 'form-control col-md-7 col-xs-12 upload-image','accept'=>'image/*',  $req, $disabled, 'maxlength'=> $len])
                                    ."</span>
                                <a href='#' class='btn btn-danger fileinput-exists' data-dismiss='fileinput'>Remove</a>
                            </div>
                        </div>"
                    . $fieldinfo                  
                . "</div>
              </div>";                  
                
               
                
//                $field = "<div class='item form-group ".$class."'>"
//                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
//                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
//                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
//                            . Form::file($attr_id, '', ['class' => 'form-control col-md-7 col-xs-12 upload-image', 
//                               'accept'=>'image/*',  $req, $disabled, 'maxlength'=> $len])
//                            . $fieldinfo                    
//                        . "</div>
//                    </div>";                    
                break;     
            case "F":
                //if($label !==""){
                $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::file($attr_id, '', ['class' => 'form-control col-md-7 col-xs-12 upload-file', 
                                 'accept'=>'file_extension', $req, $disabled, 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
                break;    
            case "U":
            case "UA":
            case "UE":
            case "UI":                
                //if($label !==""){
                $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::url($attr_id, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => $label, $req, $disabled, 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
                break;            
            case "hidden":
                //$field=$this->createFieldHidden($attr_id, $field_type);
                $field = Form::hidden($attr_id, $val, $attributes = array());
                //Form::number('len', $attributes->len, ['class' => 'form-control col-md-7 col-xs-12', 'required'])
                break;
            case "CL":
                $field = "<div class='item form-group ".$class."'>"
                    . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                        'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                    ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                . "<div class='cp-container'><div class='input-group form-group'>
                    <!--span class='input-group-addon'><i class='zmdi zmdi-invert-colors'></i></span-->
                    <div class='fg-line dropdown'>"
                      . Form::text($attr_id, '#03A9F4', ['class' => 'form-control cp-value', 'data-toggle'=>'dropdown', $req, $disabled])
                                                
                       . "<div class='dropdown-menu'>
                        <div class='color-picker' data-cp-default='#03A9F4'></div>
                      </div>

                      <i class='cp-value'></i>
                    </div>"
                    .$fieldinfo.
                    "</div>
                  </div>"
                    . "</div>
                </div>";               
                break;  
            default:
                $field="";
        }        
        return $field;
        //Form::number('len', $attributes->len, ['class' => 'form-control col-md-7 col-xs-12', 'required'])
        //$this->createFieldHidden($attr_id, $label, $desc, $field_type, $len, $class, $req);
        
        
    }
    
//    function createFieldHidden($attr_id, $field_type){
//        
//    }

    function fetchAttributesIds($catAnsForAttr){
        $attrArr = array();
        foreach ($catAnsForAttr as $cat) {
            $attrTmp = CategoryAttribute::Where('cat_id', '=', $cat)->project(array('attr_ids') )->first();//->take(1)->get();
            if(count($attrTmp)){
                foreach($attrTmp->attr_ids as $attr){
                    $attrArr[$attr]=$attr;
                }
            }
        }
        
        
        return $attrTmp; 
  }
    
    function fetchAttributesAssoc(){
        $attrAssoc = array();
        $lang = session('app_language');
        $attrAssocTmp = AttributesAssoc::where('lang', '=', $lang)->project( array('id','label') )->get();
        foreach($attrAssocTmp as $v){
            $attrAssoc[$v->id] = $v->label;
        }
        return $attrAssoc;
  }
    
    function fetchAncestorsForAll($prod_cats){
      try{
        $catAnsForAttr = array();
        foreach ($prod_cats as $cat) {
            $catAnsForAttrTemp=$this->fetchCategoryAnscestors($cat);
            foreach ($catAnsForAttrTemp as $k => $v) {
                $catAnsForAttr[$k]=$v;
            }
        }
        return $catAnsForAttr;
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                          "Line Number: ".$e->getLine()." ".
                          "File Name: ".$e->getFile()." ".
                          "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }
    
    function fetchCategoryAnscestors($currentid){
      try{
        $parent = 0;
        $lang = session('app_language');
        //$currentid=$cat;
        $cat_hierachy=array();
        do{
            $sql = Categories::where('lang', '=', $lang)->Where('cat_id', '=', $currentid)->project( array('cat_id','parent') )->first();//->take(1)->get();
            if(count($sql)){
                //array_push($cat_hierachy, $sql->cat_id); 
                $cat_hierachy[$sql->cat_id]= $sql->cat_id;
                if(!empty($sql->parent)){
                    $currentid = $sql->parent;
                    $parent = 1;
                }else{
                    $parent = 0;
                }
            }else{
                $parent = 0;
            }
        }while($parent <> 0);        
        
        return $cat_hierachy;
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                          "Line Number: ".$e->getLine()." ".
                          "File Name: ".$e->getFile()." ".
                          "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }

}