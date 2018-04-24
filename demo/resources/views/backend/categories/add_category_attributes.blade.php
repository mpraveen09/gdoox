  @extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <h2>Select Attributes for the Category</h2> 
@endsection
@section('right_col')
<?php 
if(!empty($check)){
foreach($check as $key){
  }
}
?>
<?php echo Form::open(array('action'=>'backend\CategoriesController@addCategoryAttributes')); ?>
<table class="table table-striped responsive-utilities jambo_table ">
  <tr> 
      <td></td>
      <?php foreach($subcategories as $subcat){?>
       <td id=" <?php echo $subcat['_id'];?>"> <?php echo $subcat['name'];?></td>
     <?php } 
      ?>
  </tr>

<?php foreach($attributes as $attr){ 
?>  
  <tr>
    <?php if(!empty($attr['label'])){?>
     <td class="col-md-1"> <?php echo $attr['label']; ?></td> 
         <?php foreach($subcategories as $subcat){  ?>
          <td class="col-md-2"> 
            <?php if(!empty($check)){
                                if($key['cat_id']==$subcat['_id'] || $key['cat_id']== $subcat['parent']){
                                      echo Form::checkbox($subcat['_id']."[]", $attr['attr_id'], in_array($attr['attr_id'], $key['attr_ids']) );
                                }
                          }
                        else{
                                  echo Form::checkbox($subcat['_id']."[]", $attr['attr_id'] );
                        }
                ?>
          </td>
     <?php }}?>
  </tr>
<?php }?>
</table>
<?php echo Form::submit('Submit',array("class"=>"btn-primary  btn")); ?>
<?php echo Form::close();?>
@endsection
