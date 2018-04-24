<?php
namespace Gdoox\Helpers\backend\dashboard;

use DB;
use Gdoox\Http\Requests;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\Auth;
use Gdoox\Models\CategoryAttribute;
use Gdoox\Models\TmpCategoryAttribute;
use Gdoox\Models\TmpCategoryUpload;
use Gdoox\Models\CategoryUpload;
//use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

trait AttributesCategoriesUpload {
    
  public function CategoryImport($fileName, $path, $col, $row){
    $inputFileType = \PHPExcel_IOFactory::identify($fileName);
    $objReader = \PHPExcel_IOFactory::createReader( $inputFileType);  
    $objReader->setLoadSheetsOnly('Struttura-categorie-multilingua');
    $objPHPExcel = $objReader->load($fileName); 
    $sheetValue = array();
    $cat_upload = array();
     $Row = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

     $sheetData = $objPHPExcel->getActiveSheet()->rangetoArray("A1:".$col.$Row, false, false, false,false);

    for($i=0;$i<count($sheetData);$i++){
        if(empty(array_filter($sheetData[$i]))){
             break;
        }
        else {
            $sheetValue[] = $sheetData[$i];
        }
    }

      for($i=1; $i<count($sheetValue); $i++ ){
          for($j=1; $j<count($sheetValue[1]); $j++){
              $cat_upload[] = array(
                     'lang'=> strtolower($sheetValue[0][$j]),
                     'cat_id'=>$sheetValue[$i][0],
                     'name'=>$sheetValue[$i][$j],
                     'parent'=>$this->parentCategory($sheetValue[$i][0]),
                     'type'=>'cat',
                     'slug'=>$this->categorySlug($sheetValue[$i][$j]),
                     'filename' => $fileName,
                     );
         }
      }
      return $cat_upload;
    }
    
    public function categorySlug($categoryName){
        $slug=$categoryName;

        $slug = preg_replace('~[^\\pL\d]+~u', '-', $slug);

        // trim
         $slug = trim($slug, '-');

         // transliterate
         $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);

         // lowercase
         $slug = strtolower($slug);

         // remove unwanted characters
         $slug = preg_replace('~[^-\w]+~', '', $slug);
        
         return $slug;

    }
    public function parentCategory($catID){
        if(preg_match('/-/',$catID)){
             $pos= strrpos($catID,"-");
             $parent= substr($catID, 0, $pos);
              
             return $parent;
        }
         else{
             $parent=0;
              
             return$parent;
         }
    }
    
    public function CategoryAttributeImport($fileName){
         $inputFileType = \PHPExcel_IOFactory::identify($fileName);
         $objReader = \PHPExcel_IOFactory::createReader( $inputFileType);
         $objReader->setLoadSheetsOnly('Campi');
         $objPHPExcel = $objReader->load($fileName);
         $cat_attrib = array();
         $sheetData = $objPHPExcel->getActiveSheet()->toArray(false, false, false,false);
         $attr_array = [];
                             
//                  $cat=array();
//                  for($i=2;$i<50; $i++){
//                       if(in_array('x', $data[$i])){
//                           $position=  array_search('x', $data[$i]);
//                           $cat[$data[1][$position]][]=$data[$i][0];
//                      }
//                  }    
             //      echo "<pre>", print_r($cat);
              
         foreach ($sheetData as $rowk => $rowdata){
            if($rowk > 1){
                if (in_array("x", $rowdata)) {
                      foreach ($rowdata as $colk => $colv){
                        if($colk > 1){
                            if($colv === "x"){
                                $attr_array[ $sheetData[1][$colk] ][] = $rowdata[0];
                            }
                        }
                     }
                }                        
            }
         }
         
         foreach ($attr_array as $cat_id => $attr_ids){
            $cat_attrib[] = array('cat_id' => $cat_id, 'attr_ids' => $attr_ids);
         }       
       return $cat_attrib;  
    }
}