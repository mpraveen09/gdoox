<?php

namespace Gdoox\Http\Controllers\backend\catalog\products;

use Illuminate\Http\Request;
use Gdoox\Http\Requests;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Excel;
use Exception;
use DB;
use Gdoox\User;
use Gdoox\Models\Products;
use Gdoox\Models\Categories;
use Gdoox\Models\Attributes;
use Gdoox\Models\AttributesAssoc;
use Gdoox\Models\CategoryAttribute;
use Gdoox\Models\AttributesType;
use Gdoox\Models\DropdownOptions;
use Gdoox\Models\EcomShops;
use Gdoox\Models\ImportProduct;
use Gdoox\Models\ExportProduct;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Gdoox\Http\Controllers\Controller;
use Gdoox\Models\NavigationMenu;
use Illuminate\Support\Facades\Route;
use Form;
use Image;
use Input;
use UUID;



class ImportProductsController extends Controller
{
    use \Gdoox\Helpers\backend\dashboard\AttributesCategoriesUpload;
    use \Gdoox\Helpers\backend\dashboard\HelperFunctions;
    use \Gdoox\Helpers\backend\dashboard\ImageUpload;
    use \Gdoox\Helpers\backend\dashboard\RolesUsers;
    
    private $language;
        
    public function __construct(Excel $excel) {
          $this->excel = $excel;
          $this->language = session('app_language');
    }

    /*
    * List Products
    */
    public function ListProduct(){
      if(Auth::user()){
        try {
          $term = 0;
          
            $role = $this->getRoleName(Auth::user()->id);
            $nav_menu = NavigationMenu::orderBy('sort_order','asc')->where('user',$role)->where('menu', 'PRODUCT MANAGEMENT')->where('lang','en')->get();
            $route = Route::getCurrentRoute()->getName();
          
            $products =  Products::where('userid', Auth::user()->id)->where('product_type', 'exists', false)->where('status', 'enabled')->paginate(30);
          
            if(isset($_GET['product_id'])){
                $term = 1;
                $product = Products::find($_GET['product_id']);
                $categories = $product->cat_ids;
                $cat = array();
                foreach ($categories as $category){
                      $cat['cat_id'][] = $category;
                      $cat_category =  Categories::where('cat_id', $category)->where('lang', $this->language)>first();
                      if(!empty($cat_category)){
                        $cat['name'][] = $cat_category->name; 
                      }
                }
                
                $attr = array();
                foreach($product->product_data as $key=>$value){
                      $attr['attr_id'][] = $key;
                      $attribute =  Attributes::where('attr_id', strval($key))->where('lang', $this->language)->first();
                      if(!empty($attribute)){
                        $attr['label'][] = $attribute->label;
                      }
                }
            }
            
            if(isset($_GET['export_id'])){
                $term = 2;  
                $this->export($_GET['export_id']);
            }
            
            $files = ExportProduct::where('user_id', Auth::user()->id)->get();  
            foreach($files as $file){
                $product_name[] = $this->productName($file->product_id);
            }
//          if(isset($_GET['action'])){
//            if($_GET['action'] == 'import'){
//              $term = 3;
//            }
//            elseif($_GET['action'] == 'import_info'){
//              $term = 4;
              $import_info = ImportProduct::where('user_id', Auth::user()->id)->get();
//            }
//          }
            if(isset($_GET['info_id'])){
                  $term = 5;
                  $product_details = $this->NewList($_GET['info_id']);
            }
          
          return view('backend.catalog.products.import_export.list_product', compact('nav_menu','route','products', 'product', 'cat', 'attr', 'term', 'files', 'product_name', 'import_info', 'product_details'));
        }
        catch (\Exception $e){
            $error = "An error occured. ".
                            "Line Number: ".$e->getLine()." ".
                            "File Name: ".$e->getFile()." ".
                            "Error Description: ".$e->getMessage();
            return view('errors.custom_error')->withErrors($error);
        }
      }
      else{
           return redirect('auth/login')->with('message',"You must be login!"); 
      }
    }
    /*
    * Product Details
    */
    public function Detail($id){
      if(Auth::user()){
        try{
          $product = Products::find($id);
          $categories = $product->cat_ids;
          $cat = array();
          foreach ($categories as $category){
                $cat['cat_id'][] = $category;
                $cat_category =  Categories::where('cat_id', $category)->where('lang', $this->language)->first();
                if(!empty($cat_category)){
                    $cat['name'][] = $cat_category->name; 
                }
          }
          $attr = array();
          foreach($product->product_data as $key=>$value){
            $attr['attr_id'][] = $key;
            $attribute =  Attributes::where('attr_id', strval($key))->where('lang', $this->language)->first();
            if(!empty($attribute)){
                $attr['label'][] = $attribute->label;
            }
          }
          return array($cat, $attr);
//          return view('backend.catalog.products.import_export.detail', compact('product', 'cat', 'attr'));
        }
          catch (\Exception $e){
              $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage();
              return view('errors.custom_error')->withErrors($error);
          }
      }
      else{
           return redirect('auth/login')->with('message',"You must be login!"); 
      }
    }
    
    /*
     *  Export data into excel
     */
    public function export($id){
      if(Auth::user()){
        try {
          $product = Products::find($id);
          $categories = $product->cat_ids;
          $cat=array();
          foreach ($categories as $category){
            $cat['cat_id'][] = $category;
            $cat_category =  Categories::where('cat_id', $category)->where('lang', $this->language)->first();
            if(!empty($category->name)){
                $cat['name'][] = $category->name;
            }
          }
          $attr = array();
          foreach($product->product_data as $key=>$value){
                $attr['attr_id'][] = $key;
                $attribute =  Attributes::where('attr_id', strval($key))->where('lang', $this->language)->first();
                if(!empty($attribute->label)){
                    $attr['label'][] = $attribute->label;
                }
          }
          
//          echo time(); die;
  //----------------category sheet
          $products=$this->excel->create('gdoox_products_'.strtolower(Auth::user()->username."_".time()), function($excel) use($cat, $attr)  {
              $excel->sheet('categories', function($sheet)   use($cat){
                  $sheet->SetCellValue("A1", 'Category Id');
                  $sheet->SetCellValue("B1", 'Category Name');
                  $sheet->SetCellValue("C1", 'Product Values');
                  $sheet->getRowDimension('1')->setRowHeight(40);
                  $sheet->getStyle('A1:'.$sheet->getHighestDataColumn().'1')->getFont()->setBold(true);
                  $n=1;
                  for($i=0; $i < count($cat['cat_id']); $i++)
                  {
                    if(!empty($cat['cat_id'][$i]))
                    $sheet->SetCellValue('A'. (string)($n + 1), $cat['cat_id'][$i]);
                    if(!empty($cat['name'][$i]))
                    $sheet->SetCellValue('B'. (string)($n + 1), $cat['name'][$i]);
                    $n++;
                  }
              });
    //-------------------attribute sheet
            $excel->sheet('attributes', function($sheet) use($attr)  {
                  $sheet->SetCellValue("A1", 'Attribute Id');
                  $sheet->SetCellValue("B1", 'Attribute Label');
                  $sheet->SetCellValue("C1", 'Product Values');
                  $sheet->getRowDimension('1')->setRowHeight(40);
                  $sheet->getStyle('A1:'.$sheet->getHighestDataColumn().'1')->getFont()->setBold(true);

                  $n=1;
                  for($i=0; $i < count($attr['attr_id']); $i++)
                  {
                    if(!empty($attr['attr_id'][$i]))
                     $sheet->SetCellValue('A'. (string)($n + 1), $attr['attr_id'][$i]);
                    if(!empty($attr['label'][$i]))
                     $sheet->SetCellValue('B'. (string)($n + 1), $attr['label'][$i]);
                     $n++;
                  }
               });
          })->store('xlsx', Auth::user()->directory_path."/export_products", true);
//        echo "<pre>"; print_r($products['file']);
//        die;
          $export_file = new ExportProduct();
          $export_file->filename = $products['file'];
          $export_file->file_path = Auth::user()->directory_path."/export_products/";
          $export_file->user_id = Auth::user()->id;
          $export_file->product_id = $id;
          $export_file->save();
//          if($export_file->save()){
//            return Redirect::route('import_product.view_files');
//          }
        }
        catch (\Exception $e){
            $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage();
            return view('errors.custom_error')->withErrors($error);
        }
      }
      else{
           return redirect('auth/login')->with('message',"You must be login!"); 
      }
    }
    /*
     * View Exported Files 
     */
    public function viewFiles(){
      if(Auth::user()){
        try{
          $files = ExportProduct::where('user_id', Auth::user()->id)->get();  
          foreach($files as $file){
              $product_name[] = $this->ProductName($file->product_id);
          }
          return view('backend.catalog.products.import_export.view_files', compact('files', 'product_name'));
        }
        catch (\Exception $e){
            $error = "An error occured. ".
                            "Line Number: ".$e->getLine()." ".
                            "File Name: ".$e->getFile()." ".
                            "Error Description: ".$e->getMessage();
            return view('errors.custom_error')->withErrors($error);
        }
      }
      else{
           return redirect('auth/login')->with('message',"You must be login!"); 
      }
    }
    
    
    /*
     * File Download
     */
    
    public function FileDownload($name){
      try{
          $fpath =  asset(Auth::user()->directory_path."/export_products/".$name);
          $extension = pathinfo($fpath, PATHINFO_EXTENSION);
          $fcontent =  file_get_contents($fpath); 
//        File::get($fpath); //Not Woring 
//        Storage::get("var/www/gdoox.local/gdoox-web-app/public/uploads/export_products/".$name);  //not working          
          $response = response($fcontent, 200, [
            'Content-Type' => $extension,
//          'Content-Length' => $size,
            'Content-Description' => 'File Download',
            'Content-Disposition' => "attachment; filename={$name}",
            'Content-Transfer-Encoding' => 'binary',
        ]);
        ob_end_clean();      
        
        return $response;
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
     * Download Exported Files
     */
    public function download($name){
      if(Auth::user()){
          try {
                return $this->FileDownload($name);
          } 
          catch (Exception $e) {
              echo "An error occured.<br/>";
              echo "Line Number: ".$e->getLine()."<br/>";
              echo "File Name: ".$e->getFile()."<br/>";
              echo "Error Description: ".$e->getMessage();
          }
      }
      else {
           return redirect('auth/login')->with('message',"You must be login!"); 
      }
    }
    /*
     * Import Products
     */
    
    public function import(){
      if(Auth::user()){
        
        return view('backend.catalog.products.import_export.import');
      }
      else{
          
        return redirect('auth/login')->with('message',"You must be login!"); 
      }
    }
    
    /*
     * Store Products
     */
    public function store(Request $request){
//      try{
        $file = $request->file('import_file');
        $rules = [
            'import_file' => 'required',
        ];
        if(!empty($file)){
            $filedata = [
            'import_file'=>$file,
            'extentions'=>$file->getClientOriginalExtension()
            ];
            $rules = [
            'extentions' => 'in:et,xls,xlsx'
            ];
        }     
        $validator = Validator::make($request->all(), $rules);

          if ($validator->fails()) {
               return redirect()->back()->withErrors($validator)->withInput($request->all());                        
          }
          else 
          {
              $path = Auth::user()->directory_path."/import_products/";
              $permission = 0777;
              $name = $file->getClientOriginalName();
              $new_name = preg_replace('/.[^.]*$/', '', $name).".";
              $import_file = $this->upload($file, $new_name, $path, $permission, true);
              $fileName = $path.$import_file;
              $inputFileType = \PHPExcel_IOFactory::identify($fileName);
              $objReader = \PHPExcel_IOFactory::createReader( $inputFileType);  

              //--------------------Categories------------------------
              $objReader->setLoadSheetsOnly('categories');
              $objPHPExcel = $objReader->load($fileName); 
              $Col = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
              $Row = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
              $sheetData = $objPHPExcel->getActiveSheet()->rangetoArray("A2:B".$Row, false, false, false,false);
              foreach ($sheetData as $sheet){
                    $category_id[] = $sheet[0]; 
              }

              //--------------------Attributes -----------------------------------
              $objReader->setLoadSheetsOnly('attributes');
              $objPHPExcel = $objReader->load($fileName); 
              $Col = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
              $Row = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
              $sheetData = $objPHPExcel->getActiveSheet()->rangetoArray("A2:".$Col.$Row, false, false, false,false);
              $attribute = array();
              foreach ($sheetData as $sheet){
                  $data = array_filter($sheet);
                foreach($data as $rowkey => $colval){
                  if($rowkey == 1){
                     continue;
                  }
                  elseif( $rowkey != 0){
                     $attribute[$rowkey][$data[0]]= $colval;
                  }
                }
              }
              $product_ids = array();
              foreach ($attribute as $attr){
                $date = date('Y-m-d', \PHPExcel_Shared_Date::ExcelToPHP($attr[1]));
                $attr[1] = $date;
                $product = new Products;
                $product->shopid = $attr[2];
                $product->company_id = $this->CompanyId($attr_id[2]);
                $product->userid = Auth::user()->id;            
                $product->postedby = Auth::user()->username;            
                $product->cat_ids = $category_id ;
                $product->postdate = $attr[1];
                $product->desc = $attr[3];
                $product->product_data = $attr;
                $product->status = 'disabled';
                if($product->save()){
                    $product_ids[] = $product->id;
                 }
              }
              if(!empty($product_ids)){
                $import_data = new ImportProduct();
                $import_data->user_id = Auth::user()->id;
                $import_data->product_ids = $product_ids;
                $import_data->import_time = date("Y-m-d H:i:s");
                $import_data->no_products = count($attribute);
                $import_data->save();
              }
              return Redirect::route('import_product.list_product', array('action' => 'import_info'))->with('message', count($attribute).' products imported');
            }
//        }
//        catch (\Exception $e){
//            $error = "An error occured. ".
//                            "Line Number: ".$e->getLine()." ".
//                            "File Name: ".$e->getFile()." ".
//                            "Error Description: ".$e->getMessage();
//            return view('errors.custom_error')->withErrors($error);
//        }
    }
    
    /*
     * Get Import products list info
     */
    
    public function ImportInfo(){
      if(Auth::user()){
          $import_info = ImportProduct::where('user_id', Auth::user()->id)->get();
          
          return view('backend.catalog.products.import_export.import_info', compact('import_info'));
      }
      else{
          return redirect('auth/login')->with('message',"You must be login!"); 
      }
    }
    
    /*
     * New Product List
     * @id is import id from Import Products Collection 
     */
    
    public function NewList($id){
      if(Auth::user()){
        try{
          $new_list = ImportProduct::where('_id', $id)->first();
          $product_ids = $new_list->product_ids;

          $products = Products::whereIn('_id', $product_ids)->get();
          return $products;
//          return view('backend.catalog.products.import_export.new_list', compact('products'));
        }
        catch (\Exception $e){
            $error = "An error occured. ".
                            "Line Number: ".$e->getLine()." ".
                            "File Name: ".$e->getFile()." ".
                            "Error Description: ".$e->getMessage();
            return view('errors.custom_error')->withErrors($error);
        }
      }
      else{
          return redirect('auth/login')->with('message',"You must be login!"); 
      }
    }
    
     /*
     * site enable or disable
     */
    
    public function toggle($id){
      if(Auth::user()){
        try{
          $product = Products::find($id);
          if(empty($product->thumb) || empty($product->product_data[8])){
              return redirect()->back()->withErrors('You can not enable this product without product image and product quantity. Please edit this product and fill these fields.');
          }
          if($_GET['status'] === "enabled"){
             DB::collection('products')->where('_id', $id)->update(['status'=>$_GET['status'], 'disable_edit'=>'Yes']);
           }
           else{
             DB::collection('products')->where('_id', $id)->update(['status'=>$_GET['status']]);
           }
          
          return Redirect::route('import_product.list_product')->with('message', "Product has been ".$_GET['status']);
        }
        catch (\Exception $e){
            $error = "An error occured. ".
                            "Line Number: ".$e->getLine()." ".
                            "File Name: ".$e->getFile()." ".
                            "Error Description: ".$e->getMessage();
            return view('errors.custom_error')->withErrors($error);
        }
      }
      else{
             return redirect('auth/login')->with('message',"You must be login!"); 
      }
    }    
    /*
     * Edit Product
     */
    public function edit($id){
        if( Auth::user() ){
          try{
            $product = Products::find($id);
            $userid = Auth::user()->id;
            $prod_cats = $product->cat_ids;
            //Fetch Ancestors of aall the selected categories
            $catAnsForAttr = $this->fetchAncestorsForAll($prod_cats );
            //Fetch Attr association/classifiction
            $attrAssoc = $this->fetchAttributesAssoc();
            //Fetch Attributes 
            $attrForCats = $this->fetchAttributesIds($catAnsForAttr);
            sort($attrForCats);

            $prod_cats_name = array();
            foreach ($prod_cats as $prod_cat){
              $prod_cats_name[] = $this->fetchCatAncestors($prod_cat);
            }
            $productForm = $this->createProductForm($prod_cats, $prod_cats_name, $attrAssoc, $attrForCats, $userid, $product);

  //          echo "<pre>", print_r($productForm);
  //          die;
            return view('backend.catalog.products.import_export.edit', compact('product', 'productForm'));
          }
          catch (\Exception $e){
              $error = "An error occured. ".
                              "Line Number: ".$e->getLine()." ".
                              "File Name: ".$e->getFile()." ".
                              "Error Description: ".$e->getMessage();
              return view('errors.custom_error')->withErrors($error);
          }
        }
        else{
        
            return redirect('auth/login')->with('message',"You must be login!"); 
        }
    }
    
  /*
   * Create Product Form
   */
    
    function createProductForm($prod_cats, $prod_cats_name, $attrAssoc, $attrForCats, $userid, $product=''){
      try{
          $formFields=array();
          $formFields[] = '<div class="card">';
          $formFields[] = '<div class="card-header bgm-green"><h2>You have selected the following categories</h2></div>';
          $formFields[] = '<div class="card-body card-padding">';
          //$formFields[] = "<hr/><h4>You have selected the following categories:</h4><hr/>";
          foreach($prod_cats_name as $prod_cats_name_){
              $formFields[]='<h6><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> &nbsp;&nbsp; '.$prod_cats_name_.'</h6>';
          }
          $formFields[] = '</div></div>';
          $formFields[] = '<div class="card">';
          $formFields[] = '<div class="card-header bgm-red"><h2>What do you want to do</h2></div>';
          $formFields[] = '<div class="card-body card-padding">';  
    //        $formFields[] = "<hr/><h4>What do you want to do:</h4><hr/>";
          $sell = ($product->purpose == 'sell') ? true : false;
          $buy = ($product->purpose == 'buy') ? true : false;
          $formFields[]= Form::radio('prod_type', 'sell', $sell, ['required']) . ' &nbsp; I Want to sell my product or service';
          $formFields[]= "<br/>";
          $formFields[]= Form::radio('prod_type', 'buy', $buy, ['required']) . ' &nbsp; I Want to Buy product I need for my business';
          $formFields[] = '</div></div>';
          foreach($prod_cats as $prod_cat){
              $formFields[]= $this->createProductFormFields("cat_id[]", "", "", "hidden", "", "", "","", $prod_cat);
          }
          $formFields[]= $this->createProductFormFields("userid", "", "", "hidden", "", "", "","", $userid);
          foreach ($attrAssoc as $k=>$v) {
            $formFieldsTemp=array();
          foreach($attrForCats as $attrForCatk => $attrForCat){
              $attributes= Attributes::where('attr_id', strval($attrForCat) )->where('class', '=', $k)->where('lang', '=', $this->language)->first();
              if(count($attributes)){
                $attr_id=$attributes->attr_id;
                if (strpos($attr_id,';') !== false || strpos($attr_id,'/') !== false) {
                    $disabled="disabled";
                }
                else{
                  $disabled="";
                }
                if($attr_id === '2' || $attr_id === 2){
                  $siteslug = $this->getSites($userid);
                  $formFieldsTemp[]= $this->createProductFormFields("attr_id[$attr_id]", $attributes->label, $attributes->desc, "TD", $attributes->len, "attr_".$attributes->class, $attributes->req,$siteslug, "",$disabled,'',$product,$attr_id);
                 }
                else{
                  $opt=array();
                  if($attributes->field_type === "TD" || $attributes->field_type === "TM" ){
                      $dropopt =  DropdownOptions::where('attr_id', (int)$attributes->attr_id)->where('lang','=',$this->language)->first();
                      if(count($dropopt )){
                          foreach ($dropopt->options as $dropopt_) {
                              $opt[$dropopt_] = $dropopt_;
                          }
                      }
                  }
                  //field type and length
                  $a_type= AttributesType::where('lang', '=', $this->language)->where('id', '=', $attributes->field_type)->project(array('label'))->first();
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
                $formFields[] = '</div></div>';
            } 
          } 
          return $formFields;
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
      function getSites($userid){
        try{
            $createdby=  User::where('_id', Auth::user()->id)->first();
            $sites = EcomShops::where('user_id', $userid )->get();
            $sites_=array();
            //$a_types= AttributesType::where('lang', '=', 'en')->get();//all(array('id','label'));
            foreach ($sites as $site) {
              $sites_[$site->slug] = $site->ecomm_company_name;
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

    /*
     * Fetch attributes
     */    
    function fetchAttributesIds($catAnsForAttr){
      try{
        $attrArr =array();
        foreach ($catAnsForAttr as $cat) {
            $attrTmp = CategoryAttribute::Where('cat_id', '=', $cat)->project( array('attr_ids') )->first();//->take(1)->get();
            if(count($attrTmp)){
                foreach($attrTmp->attr_ids as $attr){
                    $attrArr[$attr]=$attr;
                }
            }
        }
        return $attrArr;        
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
    }
    
    function fetchAttributesAssoc(){
      try {
            $attrAssoc = array();
            $attrAssocTmp = AttributesAssoc::where('lang','=',$this->language)->project( array('id','label') )->get();
            foreach($attrAssocTmp as $v){
                $attrAssoc[$v->id] = $v->label;
            } 
            return $attrAssoc;
      }
      catch (\Exception $e){
          $error = "An error occured. ".
                "Line Number: ".$e->getLine()." ".
                "File Name: ".$e->getFile()." ".
                "Error Description: ".$e->getMessage();
          return view('errors.custom_error')->withErrors($error);
      }
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
        $parent=0;
        //$currentid=$cat;
        $cat_hierachy=array();
        do {
            $sql = Categories::where('lang', '=', $this->language)->Where('cat_id', '=', $currentid)->project( array('cat_id','parent') )->first();//->take(1)->get();
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
    
    public function fetchCatAncestors($currentid){
      try{
        $parent = 0;
//        $currentid=$input['category_id'];
        $cat_hierachy="";
        do {
            $sql = Categories::where('lang', '=', $this->language)->Where('cat_id', '=', $currentid)->orderBy('name')->project( array('name','parent') )->first();//->take(1)->get();
            if(count($sql)){
                if($cat_hierachy === ""){
                    $cat_hierachy = $sql->name ;
                } else {
                    $cat_hierachy = $sql->name . " / " . $cat_hierachy;
                }
                if(!empty($sql->parent)){
                    $currentid = $sql->parent;
                    $parent = 1;
                } else {
                    $parent = 0;
                }
            } else {
                $parent = 0;
            }
        }while($parent <> 0);
        //return $cat_hierachy;
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

    /*
     * Update Product
     */
    public function update (Request $request, $id){
      try{
        $input = $request->all();
        if(empty($input['attr_id'][47]) && empty($input['attr_id'][60] )){
          return redirect()->back()->withErrors('Please insert the product image');
        }
        $product = Products::find($id);
        $product->userid = $request->get('userid');
        $product->shopid = $input['attr_id'][2];
        $product->company_id = $this->CompanyId($input['attr_id'][2]);
        $input['attr_id'][61] = url('site') .'/'. $input['attr_id'][2] ;//store url
        if(Auth::user()){
            $product->userid = Auth::user()->id;            
            $product->postedby = Auth::user()->username;            
        } 
        $product->purpose = $request->get('prod_type');
        $product->cat_ids = $request->get('cat_id');
        $product->postdate = $input['attr_id'][1];
        $product->desc = $input['attr_id'][3];
        $product->thumb = "";
        $product_attr=array();
        foreach($input['attr_id'] as $attr_id => $attr_val){
            if(gettype($attr_val) === "object"){
                $image = $attr_val->getClientOriginalName();
                $extension = $attr_val->getClientOriginalExtension();
                $size = $attr_val->getSize();
                $mime = $attr_val->getMimeType();
                if(substr($mime, 0, 5) == 'image') {
                    $path =Auth::user()->directory_path."/products/".date('m')."/".date('d')."/";
                    $permission = 0777;
                    $filename = "prod-" . $this->randomString() . "-". time().".".$extension;  
                    $target_dir = $this->make_directory($path, $permission, true);
                    $attr_val->move( $target_dir, $filename);
                    $product->thumb = $filename;
                    $product->thumb_path = $path;
                }
                $product_attr[$attr_id] = $path.$filename;
            }
            else{
                $product_attr[$attr_id]=$attr_val;
            }
        }   
        $product->product_data = $product_attr;
        $product->save();
        
        return Redirect::route('import_product.list_product')->with('message', 'Product Updated');
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

