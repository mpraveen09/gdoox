<?php

namespace Gdoox\Http\Controllers\backend\dashboard;

use DB;
use Input;
use File;
use Response;
use Gdoox\Http\Requests;
use Maatwebsite\Excel\Excel;
use Illuminate\Http\Request;
use Gdoox\Models\CategoryUpload;
use Gdoox\Models\CategoryAttribute;
use Gdoox\Models\TmpCategoryUpload;
use Gdoox\Models\CategoryFile;
use Gdoox\Models\TmpCategoryAttribute;
use Gdoox\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Gdoox\Models\TempDropdownOptions;
use Gdoox\Models\Attributes;
use Illuminate\Support\Facades\Redirect;

class ImportDropdownOptionsController extends Controller
{
  use \Gdoox\Helpers\backend\dashboard\ImageUpload;
  use \Gdoox\Helpers\backend\dashboard\AttributesCategoriesUpload;
  use \Gdoox\Helpers\backend\dashboard\RolesUsers;
   
   public function __construct(Excel $excel){
        $this->excel = $excel; 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
      try {
            return view('backend.dashboard.dropdown_uploads.create',compact('path'));
      }
      catch (\Exception $e){
          $error = "An error occured. ".
            "Line Number: ".$e->getLine()." ".
            "File Name: ".$e->getFile()." ".
            "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request){
        try {
            $data = $request->all();             
            $file = $data['file'];
            
            $ext = strtolower($file->getClientOriginalExtension());
            $validator = Validator::make(array('extention' => $ext), array('extention' => 'in:et,xls,xlsx'));

            if ($validator->fails()) {
                $errors = $validator->getMessageBag()->toArray();
                return $errors;
                $result = ['success' => false , 'errors' => $errors];                   
                return $result;//Response::json($result);
            }
            else {
                $file_name = $file->getClientOriginalName();
                $path = Auth::user()->directory_path."/dropdown_option_files/";
                if(File::exists($path.$file_name)){
                     $errors = ['error' => 'File already exist'];
                     $result = ['success' => false , 'errors' => $errors];                   
                     return $result;
                 }
                 
                $permission = 0777;
                $new_name = preg_replace('/.[^.]*$/', '', $file_name).".";
                $filename = $this->upload($file, $new_name, $path, $permission, true);
                ob_end_clean();
                if($filename){
                    chmod($path.$filename, $permission);
                    $inputFileType = \PHPExcel_IOFactory::identify($path.$filename);
                    $objReader = \PHPExcel_IOFactory::createReaderForFile($path.$filename);
                    
                    $worksheetList = $objReader->listWorksheetNames($path.$filename);
                    $sheetname = $worksheetList[2];
                    $objReader->setLoadSheetsOnly(array($sheetname));
                    $objReader->setReadDataOnly(true);

                    $objPHPExcel = $objReader->load($path.$filename);
                    $sheetData = $objPHPExcel->getActiveSheet()->toArray(false, false, false,false);
                    
                    $dropdown_options = array();   
                    for($i=0; $i<count($sheetData); $i++ ){
                        foreach ($sheetData[1] as $key=>$value) {
                            if(!empty($sheetData[$i][$key])){
                                $dropdown_options[$key][] = $sheetData[$i][$key];
                                // echo $key."====>".$sheetData[$i][$key]; echo "<br />";
                            }
                        }
                    }
                    
                    $options = array();
                    if(!empty($dropdown_options)){
                        foreach ($dropdown_options as $k=>$v) {
                            if($k > 0){
                                if(isset($v[1])){
                                    if($v[1] === 'EN' || $v[1] === 'IT'){
                                        $options[] = array(
                                            'attr_id'=>$v[0],
                                            'lang'=>  strtolower($v[1]),
                                            "type"=>"drop_options",
                                            "options"=>$v
                                        );
                                    }
                                }
                            }
                        }
                    }
                    
                    $saved = 0;
                    $avlbl_data = count($options);
                    if(!empty($options)){
                        foreach($options as $kk => $option){
                            $label = Attributes::where('attr_id','=',(string)$option['attr_id'])->first();
                            array_splice($option['options'], 0, 2);
                            $data = new TempDropdownOptions();
                            $data->lang = $option['lang'];
                            if(!empty($label)){
                                $data->label = $label->label;
                            }
                            $data->attr_id = $option['attr_id'];
                            $data->type = $option['type'];
                            $data->options = $option['options'];
                            $data->save();
                            $saved++;
                        }
                    }
                    if($avlbl_data === $saved){
                        $message = "All the Dropdown Options saved successfully";
                    }
                    else {
                        $remaining = $avlbl_data-$saved;
                        $message = $remaining." entries could not be saved.";
                    }
                    
                    return Redirect::route('import.dropdown.options')->with('message',$message);
                }
            }  
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }


//    public function store(Request $request){
//      try{
//          if($request->ajax()){
//            $file = $request->file('file');
//            $ext = strtolower($file->getClientOriginalExtension());
//            $validator = Validator::make(array('extention' => $ext), array('extention' => 'in:et,xls,xlsx'));
//         
//            if ($validator->fails()) {
//                $errors = $validator->getMessageBag()->toArray();
//                return $errors;
//                $result = ['success' => false , 'errors' => $errors];                   
//                return $result;//Response::json($result);
//            }
//            else {
//                $name = $request->file('file');
//                $col="g";//$request->col;
//                $row ='1048576';
//                $file_name = $name->getClientOriginalName();
//                $path = Auth::user()->directory_path."/category_files/";
//                if(File::exists($path.$file_name)){
//                     $errors = ['error' => 'File already exist'];
//                     $result = ['success' => false , 'errors' => $errors];                   
//                     return $result;
//                 }
//                $permission = 0777;
//                $n_name = $request->file('file')->getClientOriginalName();
//                $new_name = preg_replace('/.[^.]*$/', '', $n_name).".";
//                $filename = $this->upload($name, $new_name, $path, $permission, true);
//                if($filename){
//                    $result = ['success' => true , 'errors' => false, 'upload' => true, 'col' => $col, 'row' => $row, 'filename' => $filename];                   
//                    return $result;
//               }
//             }
//          }
//      }
//      catch (\Exception $e){
//          $error = "An error occured. ".
//                          "Line Number: ".$e->getLine()." ".
//                          "File Name: ".$e->getFile()." ".
//                          "Error Description: ".$e->getMessage();
//          return view('errors.custom_error')->withErrors($error);
//      }
//        
//    }
    /*
     * 
     */
    /*
     * 
     */
    public function _cat_attr(Request $request){
      try {
        $path = Auth::user()->directory_path."/dropdown_option_files/";
       
        $categories = $this->CategoryImport($path.$request->filename, $path, $request->col, $request->row);
        if(!empty($request->confirm)){
            $confirm = $request->confirm;
        }
        else {
          $confirm = 2;
        }
        
        $import_cats = $this->ImportCategoriestmp($categories, $confirm);
//      echo $confirm; die;
        if($import_cats == 2){
            return Redirect::route('category-upload-create', ['term' => $import_cats, 'col' => $request->col, 'row' => $request->row, 'filename' => $request->filename]);
        }
        
        $cat_attributes = $this->CategoryAttributeImport($path.$request->filename);
                 
        $import_attrs = $this->ImportCatAttributestmp($cat_attributes);
        
        $tmp_categories = TmpCategoryUpload::where('filename', $path.$request->filename)->get();
        $fm_data = DB::collection('field_master')->where('_id', '=', 'cat_attrib_en')->get();
        $term = 3;
        $col = $request->col;
        $filename = $request->filename;
        
        return view('backend.dashboard.category_uploads.create',compact('fm_data', 'term', 'tmp_categories', 'col', 'filename','nav_menu','route'));
        }
      catch (Exception $ex) {
          $error = "An error occured. ".
                          "Line Number: ".$e->getLine()." ".
                          "File Name: ".$e->getFile()." ".
                          "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }
    /*
     * Update Categories temp to cat_categories
     */
    public function updatecategories(Request $request){
      try{
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('menu','GDOOX PLATFORM MANAGEMENT TEAM')->where('user',$role)->where('lang','en')->get();            
            $route = Route::getCurrentRoute()->getName();
        
            $name= $request->file;
            $path =Auth::user()->directory_path."/category_files/";
            $col=$request->col;
            $row='1048576';
  //Final categories  
        if(isset($request->done)){
            $categories = $this->CategoryImport($path.$name, $path, $col, $row);
            $this->ImportCategories($categories);
            $cat_attributes = $this->CategoryAttributeImport($path.$name);
            $this->ImportCatAttributes($cat_attributes);
            return Redirect::route('category-upload-create')->with('message', 'Categories Created');
        }
        elseif(isset($request->cancel)){
          $categories = $this->CategoryImport($path.$name, $path, $col, $row);
          $cat_attributes = $this->CategoryAttributeImport($path.$name);
          $this->deletecategories($categories, $cat_attributes);
          
          return Redirect::route('category-upload-create');
        }
 //end final categories       
        $categories = $this->CategoryImport($path.$name, $path, $col, $row);
        $confirm = $request->confirm;
        $this->ImportCategoriestmp($categories, $confirm);
        $cat_attributes = $this->CategoryAttributeImport($path.$name);
        $this->ImportCatAttributestmp($cat_attributes);
        
   //view Import categories
        $fm_data = DB::collection('field_master')->where('_id', '=', 'cat_attrib_en')->get();
        $categories = TmpCategoryUpload::where('lang', 'en')->get();
        $cat_attributes = TmpCategoryAttribute::get();
        $term = 3;
        $filename = $name;
        return view('backend.dashboard.category_uploads.create',compact('fm_data', 'term', 'categories', 'cat_attribute', 'name', 'filename', 'col','nav_menu','route'));
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                          "Line Number: ".$e->getLine()." ".
                          "File Name: ".$e->getFile()." ".
                          "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }
    /*
     * Delete Categories from temp while cancel 
     */
    
    public function deletecategories($categories, $cat_attributes){
        try{
          foreach ($categories as $category){
            $temp = TmpCategoryUpload::where('cat_id', '=', $category['cat_id'])->where('lang', "=", strtolower($category['lang'] ))->first();
            if(!empty($temp))
              $temp->delete();
          }
          foreach ($cat_attributes as $cat_attrib){
            $temp = TmpCategoryAttribute::where('cat_id', '=', $cat_attrib['cat_id'])->first();
            $temp->delete();
          }
        }       
        catch (\Exception $e){
          $error = "An error occured. ".
                          "Line Number: ".$e->getLine()." ".
                          "File Name: ".$e->getFile()." ".
                          "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }

    }
    /*
     * 
     */
    
     public function ImportCategories($cat_upload){
        try{
         foreach ($cat_upload as $category){
           if(!empty($category['name'])){
              DB::collection('cat_categories')->where('cat_id', '=', $category['cat_id'] )->where('lang', "=", strtolower($category['lang'] ) )->update($category, array('upsert'=>true));
              $tmp = TmpCategoryUpload::where('cat_id','=', $category['cat_id'] )->where('lang', "=", strtolower($category['lang'] ) )->first();
              $tmp->delete();
           }
          }
      } 
      catch (\Exception $e){
          $error = "An error occured. ".
                          "Line Number: ".$e->getLine()." ".
                          "File Name: ".$e->getFile()." ".
                          "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }
    /*
     * 
     */
    public function ImportCatAttributes($cat_attributes){
      try{
        foreach ($cat_attributes as $cat_attrib ){
          DB::collection('cat_attributes_relation')->where('cat_id', '=', $cat_attrib['cat_id'])->update($cat_attrib, array('upsert' => true));
          $temp = TmpCategoryAttribute::where('cat_id', '=', $cat_attrib['cat_id'])->first();
          $temp->delete();
        }
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                          "Line Number: ".$e->getLine()." ".
                          "File Name: ".$e->getFile()." ".
                          "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }
    /*
     * Import Categories to temp database
     */
    public function ImportCategoriestmp($categories, $confirm){
        try{
          foreach ($categories as $category){
            if(!empty($category['name'])){
              $data = CategoryUpload::where('cat_id', '=', $category['cat_id'] )->where('lang', "=", strtolower($category['lang']) )->first();
              if(!empty($data)){
                if($confirm == 0){
                    DB::Collection('tmp_cat_categories')->where('cat_id', '=', $category['cat_id'] )->update($category, ['upsert' => true]);
                }
                elseif($confirm == 1){
                    DB::Collection('tmp_cat_categories')->insert($category);
                }
                else{
                  $term = 2;
                  return $term;
                }
             }
             else {
                 DB::Collection('tmp_cat_categories')->insert($category);
             }  
          }
        }
      } 
      catch (\Exception $e){
          $error = "An error occured. ".
                          "Line Number: ".$e->getLine()." ".
                          "File Name: ".$e->getFile()." ".
                          "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }
    /*
     * Import Category Attributes relation in the temp database
     */
    public function ImportCatAttributestmp($cat_attributes){
      try{
        foreach ($cat_attributes as $cat_attrib ){
            $data = CategoryAttribute::where('cat_id', '=', $cat_attrib['cat_id'])->first();           
            if(count($data) > 0){
                DB::Collection('tmp_cat_attributes_relation')->insert($cat_attrib);
            }
            else{
                DB::Collection('tmp_cat_attributes_relation')->insert($cat_attrib);
            }
        }
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