<?php
namespace Gdoox\Helpers\backend\dashboard;

use DB;
use Auth;
//use Image;
use Gdoox\User;
use Intervention\Image\Facades\Image;
use Input;
use Illuminate\Support\Facades\Redirect;
use Gdoox\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Lang;


trait ImageUpload{
use UserInfoHelperFunctions;
  protected $image;
  protected $document;

      /**
     * Display a listing of the resource.
     *
     * @return Upload image and create thumbnail
     */
     public function upload($img, $image_new_name, $path, $permission, $recursion){
      $name = $img->getClientOriginalName() ;
      $extension = $img->getClientOriginalExtension();
      $size = $img->getSize();
      $mime = $img->getMimeType();
      $this->image = $image_new_name;
      $dir = $this->make_directory($path, $permission, $recursion);
      $img->move( $dir, $this->image);
      return $this->image;
    }
    
    
     public function uploadImage($img, $image_new_name, $path, $permission, $recursion){
      $name = $img->getClientOriginalName() ;
      $extension= $img->getClientOriginalExtension();
      $size = $img->getSize();
      $mime = $img->getMimeType();
      if(substr($mime, 0, 5) == 'image') {
         $this->image=$image_new_name.$extension;
         $dir = $this->make_directory($path, $permission, $recursion);
         $img->move( $dir, $this->image);        
         return $this->image;
      }
      else{
           return false;
      }
    }    
     public function UploadSIteLogo($img){
      $file=Input::file($img); 
      $name= Input::file($img)->getClientOriginalName() ;
      $extension= Input::file($img)->getClientOriginalExtension();
      $size = Input::file($img)->getSize();
      $mime =Input::file($img)->getMimeType();
      if(substr($mime, 0, 5) == 'image') {
         $this->image="site_logo_".rand(1,100).".".$extension;
         $path= base_path()."/public/uploads/site_logo";

         Input::file($img)->move( $path, $this->image);

         return $this->image;
      }
      else{

           return false;
      }
    }
    public function uploadDocuments($path, $permission, $recursion, array $docs, $doc_name, $type, array $doc=NULL){
      for ($i=0;$i<count(array_filter($docs));$i++)
      {
          if(!empty($docs)){
              $ext = ['jpg','pdf','jpeg'];
              $docname = $docs[$i]->getClientOriginalName();
              $extension = $docs[$i]->getClientOriginalExtension();
              if( in_array($extension, $ext)){
                  $document=!empty($doc_name[$i]) ? $doc_name[$i] : $docname; 
                  $doc[] = $document; ;
                  $dir = $this->make_directory($path, $permission, $recursion);
                  $docs[$i]->move( $dir, $document);
              }
              else{
                $doc[]="You have uploaded wrong format file";
              }
          }
        }
        return $doc;
    }
    
    public function Extension(array $docs){
      for ($i=0;$i<count(array_filter($docs));$i++){
               $docname=$docs[$i]->getClientOriginalName();
              return $extension= $docs[$i]->getClientOriginalExtension();
       }
    }
    /*
     * 
     */
    public function uploadlogo($img){
      $file=Input::file($img); 
      $name= Input::file($img)->getClientOriginalName() ;
      $extension= Input::file($img)->getClientOriginalExtension();
      $size = Input::file($img)->getSize();
      $mime =Input::file($img)->getMimeType();
      $this->image="gdoox_".time()."_".$name;
      $path= base_path()."/public/uploads/certification_logos";
      $image_upload=Input::file($img)->move( $path, $this->image);
    }
    
}