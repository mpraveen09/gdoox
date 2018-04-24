<?php

namespace Gdoox\Http\Controllers\backend;
use DB;
use Gdoox\Models\Category;

use Illuminate\Http\Request;

use Gdoox\Http\Requests;
use Gdoox\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    /**
     * @Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
            //
            $this->createParentAndSlug();// @creating parent category and slug
           $data= DB::collection('cat_categories')->get();
           $parent_cat=  DB::collection('cat_categories')->where('parent','=', 0)->lists('name', '_id');
           //print_r($parent_cat);
           
           return view('backend.categories.index',compact('parent_cat'));
    }
/**
     *@ Inserting Subcategories based on parent.
     *
     * @return Response
     */
    
    public function subCategories(Request $input){
         $data=$input->all();
         //print_r($data);
         $subcategories= DB::collection('cat_categories')->where('parent', '=', $data['category'])->orwhere('_id', '=',$data['category'])->where('leaf', '=', '0')->get();
        // print_r($subcategories);die;
         $attributes=DB::collection('cat_attributes')->get();
         $check=  DB::collection('cat_attributes_relation')->where('cat_id','=',$data['category'])->get();
            
         return view('backend.categories.add_category_attributes', compact('subcategories','attributes','check'));
    }
    /**
     * @Updating the parent of category and slug in document.
     *
     * @return Response
     */
    public function createParentAndSlug(){
         $data=DB::collection('cat_categories')->get();
         foreach ($data as $d){
              $id= $d['_id'];
              $slug=$d['name'];

              $slug = preg_replace('~[^\\pL\d]+~u', '-', $slug);

              // trim
               $slug = trim($slug, '-');

               // transliterate
               $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);

               // lowercase
               $slug = strtolower($slug);

               // remove unwanted characters
               $slug = preg_replace('~[^-\w]+~', '', $slug);
               $d['slug']=$slug;

              if(preg_match('/-/',$d['_id'])){
                     $pos= strrpos($d['_id'],"-");
                     $parent= substr($d['_id'], 0, $pos);
                     $d['parent']=$parent;
                   
                      DB::collection('cat_categories')->where('_id', '=', $id)->update($d, array('upsert' => true));
              }
               else{
                     $parent=0;
                     $d['parent']=$parent;
                    
                     DB::collection('cat_categories')->where('_id', '=', $id)->update($d, array('upsert' => true));
               }
         }
    }
    /**
     * @add attributes for the category.
     *
     * @return Response
     */
    public function addCategoryAttributes(Request $input){
        $data=$input->all();
        foreach($data as $k=>$v)
        {
           if($k !=="_token"){
                $cat_attr = \Gdoox\Models\CategoryAttribute::firstOrNew(['cat_id' => $k]);
                $cat_attr->cat_id=$k;
                $cat_attr->attr_ids=$v;
                $cat_attr->save();
           }
        }
   
      return  redirect()->action('backend\CategoriesController@index');
    }
   
    /**
     * Finding Category List.
     *
     * @return Response
     */
    public function categoryList(){
        $mongoClient=new \MongoClient();
        $db = $mongoClient->selectDB('gdoox');
        $map=new \MongoCode("function(){
              var key = {name:this.name, parent:this.parent};
              emit({key}); 
         }");
         $reduce = new \MongoCode("function(key, values) {".
            "var sum = 0;".
            "for (var i in vals) {".
                "sum += vals[i];".
            "}".
            "return sum; 
        }");
         $map_reduce=array(
            'mapreduce' => 'cat_categories', // collection name
            'out' => 'map_reduce_categories', // new collection name
            'verbose' => true, 
            'map' => $map,
            'reduce' => $reduce
         );
        $cat = $db->command($map_reduce);
        print_r($cat);
    }
    
   
}