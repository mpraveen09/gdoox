<?php

namespace Gdoox\Http\Controllers\crm;
use Gdoox\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Gdoox\Models\CrmFieldMaster;
use Gdoox\Models\DropdownOption;
use Gdoox\Models\CrmContacts;
use Gdoox\Models\CrmContactsGroup;
use Gdoox\Models\TempCrmContacts;
use Gdoox\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Gdoox\Models\CrmCustomFieldMaster;
use Gdoox\Models\NavigationMenu;
use Route;
// use PHPExcel;

use Form;
use Image;
use Input;
use UUID;

class CrmContactsController extends Controller {
    use  \Gdoox\Helpers\backend\dashboard\RolesUsers;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    
    private $language;
    public function __construct(Excel $excel){
         $this->excel = $excel;
		if (session()->has('app_language')) {
			//
		}else{
			session(['app_language' => 'en']);
		}  		
         $this->language = session('app_language');
    }
 
    public function index() {
        try {
           if(Auth::user()) {
                $limit = 50;
                $userid = Auth::id();
                $data = Request::all();

                $name_val = $department_val = $group_val = '';
                $contact_group = array();
                list($route, $nav_menus) = $this->navigationTabs();

                $formfields = CrmFieldMaster::where('title','=','crm_contacts')->where('lang','=','en')->first();
                $department = array("Accounts"=>"Accounts","Admin"=>"Admin","HR"=>"HR","Marketing"=>"Marketing","Sales"=>"Sales");
                $group_name = CrmContactsGroup::where('flag','=','1')->project(array('group_name'))->get();

                if(!empty($group_name)) {
                    foreach($group_name as $name) {
                        $contact_group[$name->group_name] = $name->group_name;
                    }
                }

                if(!empty($data)){
                    $builder = CrmContacts::query();  
                    if(!empty($data['name'])) {
                         $name = $data['name'];
                         $builder->where('first_name','like', '%'.$name.'%')->orWhere('last_name','like','%'.$name.'%');
                    }

                    if(!empty($data['department'])) {
                         $department = $data['department'];
                         $builder->where('department','=', $department);
                    }

                    if(!empty($data['group'])) {
                         $group = $data['group'];
                         $builder->where('contact_group_name','=', $group);
                    }
                    $contacts = $builder->orderBy('_id')->paginate($limit);
                }
                else {
                    $contacts = CrmContacts::where('flag','=','1')->where('user_id','=', $userid)->where('first_name','!=','false')->paginate($limit);
                }
                return view('crm.crm_contacts.index', compact('contacts','formfields','department','contact_group','name_val','department_val','group_val','route', 'nav_menus', 'sub_nav_menu'));
           }
           else {
                return redirect('auth/login')->with('message',"Please Login!"); 
           }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        // Session::flash('message', "Oops! Something went Wrong. Please try Again");
        // return Redirect::back();
        }  
    }

    /**
     * Show the form for adding a new product.
     *
     * @return Response
     */    
    public function create(){
        try {
            if(Auth::user()){
                list($route, $nav_menus) = $this->navigationTabs();
                $form_field = CrmFieldMaster::where('title','=','crm_contacts')->where('lang','=','en')->first();
                $custom_form_field = CrmCustomFieldMaster::where('title', '=', 'crm_custom_contacts')->where('user_id','=', Auth::user()->id)->where('lang', '=', 'en')->first();
                
                foreach($form_field->form_fields as $data){
                    $options = $this->getOptions($data['name']);
                    $createForm[] = $this->createForm($data['label'], $data['name'], $data['type'], $data['maxlength'], $data['required'],'', $options);
                }
                
                if(!empty($custom_form_field)){
                    foreach($custom_form_field->form_fields as $custom){
                        $createForm[] = $this->createForm($custom['label'], $custom['name'], $custom['type'], $custom['maxlength'], $custom['required'],'', '');
                    }
                }
                return view('crm.crm_contacts.create', compact('createForm','route', 'nav_menus', 'sub_nav_menu'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Add Contact!"); 
            }
        }
        catch (\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
         // return Redirect::route('crm_contacts.index')->with('message','Oops! Something went Wrong. Please Try Again'); 
        }
    }    

    function createForm($lbl_name, $field_name='', $field_type='', $field_max_val='', $required='', $value='', $options='') { 
        switch ($field_type) { 
                case "text":
                    $Fields = "<div class='item form-group'>"
                        . Form::label($lbl_name,'', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                        . Form::$field_type($field_name, $value, [$required,'class' => 'form-control col-md-7 col-xs-12','placeholder' =>$lbl_name ])
                        . "</div>
                         </div>";
                return $Fields;
                break;
                
                case "select":
                    if($field_name==='contact_group_name'){
                        if(empty($value) || $value===''){
                            $Fields = "<div class='item form-group'>"
                            . Form::label($lbl_name,'', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) 
                            ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::select('contact_group_name[]', $options, null, ['class' => 'selectpicker form-control col-md-7 col-xs-12','multiple', 'required'])
                            . "</div>
                            </div>";
                        }
                        else {
                            $Fields = "<div class='item form-group'>"
                            . Form::label($lbl_name,'', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) 
                            ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                            . Form::select('contact_group_name[]', $options, $value, ['class' => 'selectpicker form-control col-md-7 col-xs-12','multiple', 'required'])
                            . "</div>
                            </div>";
                        }   
                    }
                    else if($field_name==='alternate_country'){
                            $Fields = "<div class='item form-group'>"
                                . Form::label($lbl_name,'', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) 
                                ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                                . Form::select($field_name, $options, $value, ['class' => 'form-control col-md-7 col-xs-12', 'placeholder' => $lbl_name])
                                . "</div>
                             </div>";
                    }
                    else {
                        $Fields = "<div class='item form-group'>"
                        . Form::label($lbl_name,'', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                        . Form::select($field_name, $options, $value, ['class' => 'form-control col-md-7 col-xs-12', 'required', 'placeholder' => $lbl_name])
                        . "</div>
                     </div>";
                    }
                    return $Fields;
                break;
            
                case "date":
                    $Fields = "<div class='item form-group'>"
                        . Form::label($lbl_name,'', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                        . Form::$field_type($field_name, $value ,['class' => 'form-control col-md-7 col-xs-12','placeholder' =>$lbl_name ])
                        . "</div>
                         </div>";
                    return $Fields;
                break;
            
                case "textarea":
                    $Fields = "<div class='item form-group'>"
                        . Form::label($lbl_name,'', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                        . Form::$field_type($field_name, $value ,['class' => 'form-control col-md-7 col-xs-12','placeholder' =>$lbl_name ])
                        . "</div>
                         </div>";
                    return $Fields;
                break;
                
                case "checkbox":
                    $Fields = "<div class='item form-group'>"
                        . Form::label($lbl_name,'', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) 
                        ."<div class='col-md-6 col-sm-6 col-xs-12'>"
                        .'<input type="checkbox" id="isSelected">'
                        . "</div>
                         </div>";
                    return $Fields;
                break;
            
                case "lable":
                    $Fields = "<div class='item form-group'>"
                        . Form::label($lbl_name,'', ['class' => 'control-label col-md-2 col-sm-3 col-xs-12']) 
                        ."</div><hr>";
                    return $Fields;
                break;
            
                default:
                    $Fields='';
                    return $Fields;
                    break;
             }
    }

    public function getOptions($field) {
        try {
          if($field==='primary_add_country' || $field==='alternate_country') {
              $countries =  DropdownOption::where('name','countries')->where('type', 'drop_down')->where('lang', $this->language)->first();
              foreach($countries->options as $countryname){
                  $country[$countryname] = $countryname;
              }
              $options = $country;
          }

          elseif($field ==='department') {
              $department = array("Accounts"=>"Accounts","Admin"=>"Admin","HR"=>"HR","Marketing"=>"Marketing","Sales"=>"Sales");
              $options = $department;
          }

          elseif($field==='contact_group_name') {            
               $group_name = CrmContactsGroup::where('flag','=','1')->project(array('group_name'))->get();
               foreach($group_name as $name){
                      $contact_group[$name->group_name] = $name->group_name;
               }
              $options = $contact_group;
          }

          else {
              $options = '';
          }
          return $options;
        }
        catch (\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // return Redirect::route('crm_contacts.index')->with('message','Oops! Something went Wrong. Please Try Again');
        }
    }
    
  /*
   * Edit product
   */
    public function edit($id) {
        try {
            if(Auth::user()){
                $value = "";
                list($route, $nav_menus) = $this->navigationTabs();
                
                $userdata = CrmContacts::where('_id','=',$id)->first();
                $form_data = CrmFieldMaster::where('title','=','crm_contacts')->where('lang','=','en')->first();
                foreach($form_data->form_fields as $data){
                    $options = $this->getOptions($data['name']);
                    if(!empty($userdata->$data['name'])){
                        $value = $userdata->$data['name'];
                    }
                    
                    $createForm[] = $this->createForm($data['label'], $data['name'], $data['type'], $data['maxlength'], $data['required'],$value, $options);   
                }
                return view('crm.crm_contacts.edit', compact('createForm','id','route', 'nav_menus', 'sub_nav_menu'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Add Contact!");
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
           // return Redirect::route('crm_contacts.index')->with('message','Oops! Something went Wrong. Please Try Again');
        }
    }    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(){ 
        try {
        if(Auth::user()) {
            $request = Request::all();
            $data = new CrmContacts();
            
            $data->user_id = Auth::user()->id;
            $data->flag= '1';
            foreach($request as $key=>$val){
                $data->$key = $request[$key];
            }
            if($data->save()){
                Session::flash('message', 'Contact Created Successfully');
                return Redirect::route('crm_contacts.index');
            }
            else {
                Session::flash('message', 'Contact could not be Added! Please Try Again');
                return Redirect::route('crm_contacts.create')->with(Request::all());
            }
        }
        else {
                return redirect('auth/login')->with('message',"Please Login to Add Contact!"); 
            }
        }
        catch(\Exception $e) {
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
           // return Redirect::route('crm_contacts.index')->with('message','Oops! Something went Wrong. Please Try Again');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id){
        try {
            if(Auth::user()){
                list($route, $nav_menus) = $this->navigationTabs();
                
                $formfields = CrmFieldMaster::where('title','=','crm_contacts')->first();
                $customformfields = CrmCustomFieldMaster::where('user_id','=', Auth::user()->id)->where('title','=','crm_custom_contacts')->first();
                $userdata = CrmContacts::where('_id','=',$id)->first();
                
                return view('crm.crm_contacts.show', compact('formfields','userdata','customformfields','route', 'nav_menus', 'sub_nav_menu'));
            }
            else {
               return redirect('auth/login')->with('message',"Please Login to Create Contact!"); 
            }
        }
        catch(Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // return Redirect::route('crm_contacts.index')->with('message','Oops! Something went Wrong. Please Try Again');
        }
    }
    /*
     * Update product
     */
    public function update($id){
        try {
            if(Auth::user()){
                $request = Request::all();
                $data = CrmContacts::where('_id','=',$id)->first();
                
                foreach($request as $key=>$val){
                    $data->$key = $request[$key];
                }

                if($data->save()){
                    Session::flash('message', 'Contact Updated Successfully');
                    return Redirect::route('crm_contacts.index');
                }
                else {
                    Session::flash('message', 'Contact could not be Created! Please Try Again');
                    return Redirect::route('crm_contacts.edit',$id)->with(Request::all());
                }
            }
            else {
                return redirect('auth/login')->with('message',"Please Login to Create Contact!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // return Redirect::route('crm_contacts.index')->with('message','Oops! Something went Wrong. Please Try Again');
        }
    }

//  Function to show all the columns to be exported in the Excel.

    public function createColumns() {
        try {
            if(Auth::user()) {
                $userid = Auth::id();
                list($route, $nav_menus) = $this->navigationTabs();
                $formfields = CrmFieldMaster::where('title','=','crm_contacts')->where('lang','=','en')->first();
                $custom_fields = CrmCustomFieldMaster::where('title','=','crm_custom_contacts')->where('lang','=','en')->where('user_id','=',Auth::id())->first();
                return view('crm.crm_contacts.create_excel_file', compact('formfields','custom_fields','route', 'nav_menus', 'sub_nav_menu'));
            }
            else {
                return redirect('auth/login')->with('message',"Please Login!"); 
            }
        }
        catch(\Exception $e) {
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // return Redirect::route('crm_contacts.index')->with('message','Oops! Something went Wrong. Please Try Again'); 
        }
    }

    public function createExcel() {
        try {
            $data = Request::all();
            $file_name= 'Contacts_Details_'.date("d-m-Y").'_'.rand(1000, 10000);

            foreach($data as $key=>$value) {
                if($key!=='_token' && $key!=='select_all' && $key!=='same_as_primary') {
                    $header[$key]=$value.'('.$key.')';
                }
            }

            Excel::create($file_name, function($excel) use($header) {
                $excel->setTitle('CRM Customer Contact File');
                $excel->sheet('Sheetname', function($sheet) use($header) {
                    $sheet->fromArray($header);
                    // Call Cell manipulation methods
                    $sheet->row(1, function($row) {
                        $row->setBackground('#cce5ff');
                    });
                   
                    for($i = 2; $i<= 1000; $i++){
                        $sheet->setHeight($i, 15);
                    }
                    
                    // Row Set Height
                    $sheet->setHeight(1, 20);
                });      
            })->export('xls');

            Session::flash('message', 'Exported Successfully');
            return Redirect::route('crm_contacts.columns');
        }
        catch (\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // return Redirect::route('crm_contacts.index')->with('message','Oops! Something went Wrong. Please Try Again'); 
        }
    }
    
    public function saveCustomFields() {
        try {
            if(Auth::user()) {
                $request = Request::all();
                $check = CrmCustomFieldMaster::where('user_id','=',Auth::id())->first();

                $field_level1 = array();
                $field_level2 = array();

                $field_level2['label'] = $request['field_name'];
                $field_level2['name'] = $request['field_label'];
                $field_level2['type'] = 'text';
                $field_level2['required'] = $request['required'];
                $field_level2['length'] = $request['maxlength'];
                $field_level2['maxlength'] = $request['maxlength'];

                $field_level1[$request['field_label']] = $field_level2;

                if(!empty($check)) {
                    $merged_data = array_merge($check->form_fields, $field_level1);
                    $check->form_fields = $merged_data;
                    if($check->save()) {
                        Session::flash('message', 'Field Created Successfully');
                        return Redirect::route('crm_contacts.columns');
                        // return view('crm.crm_contacts.create_excel_file', compact('formfields','custom_fields'))->with('message', 'Field Created Successfully');  
                    }
                    else {
                        Session::flash('message', 'Field could not Created! Please try Again');
                        return Redirect::route('crm_contacts.columns');
                       // return view('crm.crm_contacts.create_excel_file', compact('formfields','custom_fields'))->with('message', 'Something went wrong! Field Could not be Created. Please try Again!');  
                    }
                }
                else {
                    $data = new CrmCustomFieldMaster();
                    $data->user_id = Auth::id();
                    $data->title = 'crm_custom_contacts';
                    $data->lang = 'en';
                    $data->form_fields = $field_level1;

                    if($data->save()) {
                        Session::flash('message', 'Field Created Successfully');
                        return Redirect::route('crm_contacts.columns');
                       // return view('crm.crm_contacts.create_excel_file', compact('formfields','custom_fields'))->with('message', 'Field Created Successfully');  
                    }
                    else {
                        Session::flash('message', 'Field could not Created! Please try Again');
                        return Redirect::route('crm_contacts.columns');
                       // return view('crm.crm_contacts.create_excel_file', compact('formfields','custom_fields'))->with('message', 'Something went wrong! Field Could not be Created. Please try Again!');  
                    }
                }
            }
            else {
                return redirect('auth/login')->with('message',"Please Login!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // Session::flash('message', "Oops! Something went Wrong. Please try Again");
            // return Redirect::back();
        }
    }
    
    // Function to Import Contacts in the Database
    
    public function uploadExcel(){
        try {
            if(Auth::user()){
                list($route, $nav_menus) = $this->navigationTabs();
                $formfields = CrmFieldMaster::where('title','=','crm_contacts')->where('lang','=','en')->first();  
                return view('crm.crm_contacts.import_contacts', compact('formfields','route','nav_menus','sub_nav_menu'));
            }
            else {
                return redirect('auth/login')->with('message',"Please Login!"); 
            }
        }
        catch(Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // Session::flash('message', "Oops! Something went Wrong. Please try Again");
            // return Redirect::back();
        }
    }
    
    public function importExcel() {
        try {
            $data = Request::all();
            $contact_group_name = array();
            $dbfields = array();
            list($route, $nav_menus) = $this->navigationTabs();
            
            $filename = Input::file('import_file')->getClientOriginalName();

            $rules = [
                'import_file' => 'required',
                'extentions' => 'in:et,xls,xlsx'
            ];

            $validator = Validator::make(Request::all(), $rules);

            if ($validator->fails()) {
                 return redirect()->back()->withErrors($validator)->withInput($request->all());                        
            }
            else {
                $path = Auth::user()->directory_path."/contacts/";

                if(!File::exists($path)) {
                    $result = File::makeDirectory($path, 0777, true, true);  
                }
                else {
                    if (!File::isWritable($path)){
                        chmod($path, 0777);
                    }
                }

                Input::file('import_file')->move($path,$filename);
                $fileName = $path.$filename;

                $inputFileType = \PHPExcel_IOFactory::identify($fileName);
                $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($fileName);
                $Columm = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
                $Row = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
                $sheetData = $objPHPExcel->getActiveSheet()->rangetoArray("A1:".$Columm.$Row, false, false, false,false);

                // Delete data if previously data was uploaded from this file
                TempCrmContacts::where('file_name', '=', $filename)->delete();
                $contactfields = CrmFieldMaster::where('title','=','crm_contacts')->first();
                $customcontactfields = CrmCustomFieldMaster::where('user_id','=',Auth::user()->id)->first();

                foreach ($sheetData[0] as $sheet) {
                    $start = strpos($sheet,'(');
                    if($start === FALSE){
                        $excelheader[$sheet] = $sheet;
                    }
                    else {
                        $end = strlen($sheet);
                        $length = $end-$start;
                        $data = substr($sheet, $start+1, $length-2);
                        $k = substr($sheet, 0, $start);
                        $excelheader[$data] = $k;
                    }
                }

                foreach($contactfields->form_fields as $key1=>$value1){
                    if($key1!=='same_as_primary'){
                        $dbfields[$key1] = $value1['label'];
                    }
                }

                if(!empty($customcontactfields)){
                    foreach($customcontactfields->form_fields as $key2=>$value2){
                        $dbfields[$key2] = $value2['label'];
                    }
                }

                foreach($excelheader as $key=>$value){
                    $keys[] = $key;
                }

                $matchingfields = array_intersect($dbfields,$excelheader);

                foreach($sheetData as $key=>$val){
                    if($key!==0) {
                        $values[] = $val;
                    }
                }

                // Saving the data to temp table in the database.
                foreach($values as $key=>$val) {
                    $contacts = new TempCrmContacts();
                    foreach($val as $k=>$v) {
                        if(array_key_exists($k, $keys)){
                            $contacts->$keys[$k] = $v;
                        }
                    }

                    $contacts->contact_group_name = $contact_group_name;
                    $contacts->user_id = Auth::user()->id;
                    $contacts->flag= '1';
                    $contacts->file_name = $filename;
                    $contacts->save();
                }
                
                return view('crm.crm_contacts.link_fields', compact('dbfields','excelheader','matchingfields','filename','route','nav_menus','sub_nav_menu'))->with('message', 'Contacts Imported Successfully');
            }
        }
        catch(\Exception $e) {
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
           // return Redirect::route('crm_contacts.index')->with('message','Oops! Something went Wrong. Please Try Again'.$e);
        }
    }
    
    public function importExcelData(){
        if(Auth::user()){
            $data = Request::all();
            $filename = $data['filename'];
            $fields = $data['matched_fields'];
            
            $contactfields = CrmFieldMaster::where('title','=','crm_contacts')->first();
            $customcontactfields = CrmCustomFieldMaster::where('user_id','=',Auth::user()->id)->first();
            foreach($contactfields->form_fields as $key1=>$value1){
                if($key1!=='same_as_primary'){
                    $dbfields[$key1] = $value1['label'];
                }
            }

            if(!empty($customcontactfields)){
                foreach($customcontactfields->form_fields as $key2=>$value2){
                    $dbfields[$key2] = $value2['label'];
                }
            }

            $exceldata = TempCrmContacts::where('file_name','=', $filename)->get();
            $flipped = array_flip($dbfields);
            $keyarray = array_combine($flipped, $fields);
            
            foreach($exceldata as $values){
                $data = new CrmContacts();
                foreach ($keyarray as $key=>$k){
                    if($k===''){
                        $data->$key = "";
                    }
                    else {
                        if(is_array($values->$key)){
                            $data->$key = $values->$k;
                        }
                        else {
                            $data->$key = $values->$k;
                        }
                    } 
                }
                
                $data->user_id = Auth::user()->id;
                $data->flag= '1';
                $data->file_name = $filename;
                $data->save();
            }
            
            TempCrmContacts::where('file_name', '=', $filename)->delete();
            return Redirect::route('crm_contacts.upload_excel')->with("message","Contacts Imported Successfully");
        }
        else {
            return redirect('auth/login')->with('message','Please Login');
        }
    }

    public function selectGroup(){
      try {
            if(Auth::user()) {
                $userid = Auth::id();
                $groups = array();
                list($route, $nav_menus) = $this->navigationTabs();
                $form_fields = CrmFieldMaster::where('title','=','crm_common_fields')->first();   
                $contact_groups = CrmContactsGroup::where('user_id','=',$userid)->get();
                
                foreach($contact_groups as $value){
                    $groups[$value->group_name] = $value->group_name;
                }
                
                return view('crm.crm_contacts.select_contact_group',compact('groups','form_fields','route', 'nav_menus', 'sub_nav_menu'));
            }
            else {
                return redirect('auth/login')->with('message','Please Login');
            }
      }
      catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // Session::flash('message', "Oops! Something went Wrong. Please try Again");
            // return Redirect::back();
        }
    }
  
    public function selectContact(){
        try {
              if(Auth::user()) {
                  $data =  Request::all();
                  $group = $data['group'];      
                  $userid = Auth::id();
                  list($route, $nav_menus) = $this->navigationTabs();
                  
                  $form_fields = CrmFieldMaster::where('title','=','crm_common_fields')->first();
                  $users = CrmContacts::where('user_id','=',$userid)->where('contact_group_name','!=',$group)->get();
                  
                  return view('crm.crm_contacts.select_contact',compact('users','form_fields','group','route','nav_menus','sub_nav_menu'));
              }
              else {
                  return redirect('auth/login')->with('message','Please Login');
              }
        }
        catch(\Exception $e){
              $errors = $this->errorMessage($e);
              return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
            // Session::flash('message', "Oops! Something went Wrong. Please try Again");
            // return Redirect::back();
          }
    }

    public function addContactToGroup(){
      try {
        if(Auth::user()) {
              $data = Request::all();
              list($route, $nav_menus) = $this->navigationTabs();
              if (array_key_exists("users",$data)){
                    $userid = Auth::id();
                    $group[] = $data['group_name'];

                    foreach($data['users'] as $key=>$val){   
                        $check = CrmContacts::where('_id','=', $val)->first();
                        if(!in_array($data['group_name'], $check->contact_group_name)){
                             CrmContacts::where('_id','=', $val)->push('contact_group_name', $data['group_name']);
                        }
                    }

                    $user_groups = CrmContactsGroup::where('user_id','=', $userid)->get();  
                    foreach($user_groups as $value){
                        $groups[$value->group_name] = $value->group_name;
                    }

                    $form_fields = CrmFieldMaster::where('title','=','crm_common_fields')->first();
                    Session::flash('message', "All the Selected Contacts added to the Selected Group");
                    return view('crm.crm_contacts.select_contact_group',compact('users','form_fields','groups','route','nav_menus','sub_nav_menu'))->with('message','All the Selected Contacts added to the Selected Group.');
                }
                else {
                     Session::flash('message', "Please Select atleat one User to Add to Group");
                     return Redirect::back();
                }
        }
        else {
            return redirect('auth/login')->with('message','Please Login');
        }
      }
      catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    public function exportExcel(){
        try {
            if(Auth::user()) {

                $userid = Auth::id();
                $data = Request::all();
                $name_val = $department_val = $group_val = '';
                $contact_group = array();

                list($route, $nav_menus) = $this->navigationTabs();

                $formfields = CrmFieldMaster::where('title','=','crm_contacts')->where('lang','=','en')->first();
                $department = array("Accounts"=>"Accounts","Admin"=>"Admin","HR"=>"HR","Marketing"=>"Marketing","Sales"=>"Sales");
                $group_name = CrmContactsGroup::where('flag','=','1')->project(array('group_name'))->get();

                 if(!empty($group_name)) {
                     foreach($group_name as $name) {
                         $contact_group[$name->group_name] = $name->group_name;
                     }
                 }
                 if(!empty($data)){
                     $builder = CrmContacts::query();  
                     if(!empty($data['name'])) {
                          $name = $data['name'];
                          $builder->where('first_name','like', '%'.$name.'%')->orWhere('last_name','like','%'.$name.'%');
                     }

                     if(!empty($data['department'])) {
                          $department = $data['department'];
                          $builder->where('department','=', $department);
                     }

                     if(!empty($data['group'])) {
                          $group = $data['group'];
                          $builder->where('contact_group_name','=', $group);
                     }
                     $contacts = $builder->orderBy('_id')->get();
                 }
                 else {
                     $contacts = CrmContacts::where('flag','=','1')->where('user_id','=', $userid)->where('first_name','!=','false')->get();
                 }
                 return view('crm.crm_contacts.export_contacts', compact('contacts','formfields','department','contact_group','name_val','department_val','group_val','route','nav_menus','sub_nav_menu'));
            }
            else {
                 return redirect('auth/login')->with('message',"Please Login!"); 
            }
        }
        catch(\Exception $e){
            $errors = $this->errorMessage($e);
            return Redirect::route('exceptions.create')->with('message','Oops! You are here because Something went Wrong.  Please report the Error')->withErrors($errors);
        }
    }
    
    public function deleteContact(){
        if(Auth::user()){
            $data = Request::all();
            $affectedRows = CrmContacts::whereIn('_id', $data['contact_id'])->delete();
            Session::flash('message', "The Contacts Deleted Successfully");
            return redirect()->route('crm_contacts.index')->with('message','The Contacts Deleted Successfully');
        }
        else {
            return redirect('auth/login')->with('message',"Please Login!"); 
        }
    }
    
    public function navigationTabs(){
        
        $role = $this->getRoleName(Auth::user()->id);
        $nav_menus = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'CRM')->where('lang','en')->get();
        $route = Route::getCurrentRoute()->getName();
        
        return array($route, $nav_menus);
    }

    public function errorMessage($e){
        $error = "An error occured. ".
            "Line Number: ".$e->getLine()." ".
            "File Name: ".$e->getFile()." ".
            "Error Description: ".$e->getMessage(); 
        return $error;
    }
}
