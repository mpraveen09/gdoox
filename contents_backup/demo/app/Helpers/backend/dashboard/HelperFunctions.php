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
//use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Gdoox\Models\EcomShops;
use Form;
use Image;
use Input;
use UUID;

trait HelperFunctions{
  /*

   * 
   * Generating random alpha numric string key
   *    */  
  public function randomString($length=6){
    // Random characters
    $characters = array("A","B","C","D","F","G","H","J","K","L","M","N",
    "P","Q","R","S","T","V","W","X","Y","Z",
    "0", "1","2","3","4","5","6","7","8","9");

    // set the array
    $keys = array();

    // set length

    // loop to generate random keys and assign to an array
    while(count($keys) < $length) {
      $x = mt_rand(0, count($characters)-1);
      if(!in_array($x, $keys)) {
           $keys[] = $x;
        }
    }

    // extract each key from array
    $random_chars='';
    foreach($keys as $key){
       $random_chars .= $characters[$key];
    }

    // display random key
    return $random_chars;
  }
  /*
   * @Importing users from excel
   */
    public function UsersImport($fileName, $col, $row){
         $inputFileType = \PHPExcel_IOFactory::identify($fileName);
         $objReader = \PHPExcel_IOFactory::createReader( $inputFileType);
//       $objReader->setLoadSheetsOnly('Sheet2');
         $objPHPExcel = $objReader->load($fileName);
         $highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
         
         $sheetData = $objPHPExcel->getActiveSheet()->rangetoArray("A2:".$col.$highestRow, false, false, false,false);

         $sheetData1 = array_filter(array_map('array_filter', $sheetData));
//       echo "<pre>", print_r(array_filter($sheetData)); die;
         $user = array();
         
         foreach ($sheetData1 as $data){
             $user[] = ['name'=>$data[0],'email'=>$data[1]];
         }  
         return $user;
    }
    /*
     * To find the Company name
     * 
     */
    
    public function getCompanyName($company_id){
        $company =  BusinessInfo::where('_id', $company_id)->first();
        return $company->company_name;
    }
    
    /*
     * 
     * Get the company of e-commerce site
     */
    public function Company($siteslug){
      $site = BusinessEcommerceCompany::where('slug', $siteslug)->first();
      if(!empty($site)){
          return $site->company;
      }
      else {
          return '-';
      }
    }
    /*
     * Get Company Id
     */
    public function CompanyId($siteslug){
      $data = BusinessEcommerceCompany::where('slug', $siteslug)->first();
      return $data->company_id;
    }
    /*
     *all companies of a user 
     */
    public function userCompanies($user_id){
      $company_names = array();
      $companies = BusinessInfo::where('user_id', $user_id)->get();
      foreach ($companies as $company){
        $company_names[$company->company_name] = $company->company_name;
      }
      return $company_names;
    }
    
    /*
     * 
     * Get the company of USER 
     */
    public function GetCompany($userid){
      $site = BusinessInfo::where('user_id',$userid)->where('type', 'business')->first();
      if(!empty($site->company_name)){
          return $site->company_name;
      }
      else {
          return "-";
      }
    }
        /*
     * 
     * Get the sitename of e-commerce site
     */
    public function SiteName($siteslug){
      $site = BusinessEcommerceCompany::where('slug',$siteslug)->first();
      return $site->ecomm_company_name;
    }
    /*
     * Get User id Based in site slug
     * 
     */
    public function SiteUser($siteslug){
      $site= BusinessEcommerceCompany::where('slug',$siteslug)->first();
      
      return $site->user_id;
    }
    /*
     * Get User email Based in site userid
     * 
     */
    public function SiteUserEmail($siteslug){
      $site= BusinessEcommerceCompany::where('slug',$siteslug)->first();
      
      return $site->email;
    }
    /*
     * Get User id Based in site userid
     * 
     */
    public function SiteUserId($siteslug){
      $site= BusinessEcommerceCompany::where('slug',$siteslug)->first();
      
      return $site->user_id;
    }
    
    /*
     * 
     * Product Name
     */

    public function productName($product_id){
      $product =  Products::where('_id', $product_id)->first();
      if(!empty($product)){
          if(isset($product->desc)){
                $product->desc;
          }
          else {
              return "NA";
          }
      }
    }
     /*
     * 
     * Site Name using product id
     */

    public function productSiteName($product_id){
      $product=  Products::where('_id', $product_id)->first();
      
      return $product->shopid;
    }
    
    /*
     *Fetch attribute Fields
     */
    
    public function FetchAttributes($attrib_id){
      $attributes=  Attribute::where('lang', 'en')->where('attr_id', $attrib_id)->first();
      return $attributes;
    }
    
   function createProductFormFields($attr_id, $label="", $desc="", $field_type="", $len="", $class="", $req="",$opt, $val="",$disabled="", $fieldinfo ="", $product="", $curr_attr=""){
      if(!empty($product) && !empty($product->product_data[$curr_attr])){
            $value = $product->product_data[$curr_attr] ;
            $defaultValue = str_replace('–', '-', $value);
      } else {
            $defaultValue="";
      }
      
        //$this->createProductFormFields($attr_id, $label, $desc, $field_type, $len, $class, $req);
        if($req==="M" || $req==="required"){ $req="required";}else{ $req=""; }
        switch ($field_type) {
            case "TD":
                //if($label !==""){
                $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::select($attr_id, $opt, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12'.$defaultValue, 'placeholder' => '---', $req, $disabled])
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
                // echo $attr_id; exit;
                //if($label !==""){
                if($attr_id == "attr_id['16']"){
                    $field = "<div id='old_price_div'><div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::text($attr_id, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => $label, $req, $disabled, 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div></div>"; 
                }
                else {
                    $field = "<div class='item form-group ".$class."'>"
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::text($attr_id, $defaultValue, ['class' => 'form-control col-md-7 col-xs-12', 
                                'placeholder' => $label, $req, $disabled, 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>"; 
                }                   
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
                        . Form::label($attr_id, $label, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', 
                            'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title' => $desc]) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::file($attr_id, '', ['class' => 'form-control col-md-7 col-xs-12 upload-image', 
                               'accept'=>'image/*',  $req, $disabled, 'maxlength'=> $len])
                            . $fieldinfo                    
                        . "</div>
                    </div>";                    
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
    /*
     * GET USER SITES
     */
    public function getSites($userid){
      $data = EcomShops::where('user_id', $userid)->get();
      $sites = array();
      foreach ($data as $site){
            $sites[$site->slug] = $site->slug;
      }  
      return $sites;
    }
    
    /*
     * GET USER SITE
     */
    public function getSite($userid){
      $data = EcomShops::where('user_id', $userid)->where('type','business')->first();
      $flag = FALSE;
      if(!empty($data)){
          return $data->slug;
      }
      else {
          return $flag;
      }
    }
    
    /*
     * Team Member of site admin or site admin's premission
     */
    public function siteAdminPermission($userid){
      $sitedata = EcomShops::where('site_admin_id', $userid)->get();
      $site_permission = array();
      if($sitedata->count()){
        foreach ($sitedata as $data){
          $site_permission = $data->permission;
        }
      }
//      print_r($site_permisson);
//      die;
      return $site_permission;
    }
}