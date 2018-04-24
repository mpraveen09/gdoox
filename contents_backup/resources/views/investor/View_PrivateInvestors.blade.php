@extends('layout.backend.master')
@extends('layout.backend.userinfo')
@section('right_col')
  
<?php 
//echo"<pre>";print_r($private_investor_data);echo"</pre>";
?>
<table class="table table-striped table-hover table-condensed">
  <tr>
    <th class="col-sm-1">First Name</th><th class="col-sm-1">Last Name</th><th colspan="3" class="text-center col-sm-1">Action</th>
  </tr>
    <?php foreach($private_investor_data as $private){?>
  
  <tr class="success active warning danger">
    
    <td><?php if(!empty( $private['fst_name'])){ echo $private['fst_name'];}?></td> 
    
    <td><?php if( !empty($private['scnd_name'])){echo $private['lst_name'];}?></td>
    
    <td class="text-center"><?php  echo HTML::link("private-investor/edit/$private[_id]", "Edit")?></td>
    
    <td class="text-center"><?php echo HTML::link("private-investor/delete/$private[_id]", 'Delete',array( "onclick"=>"return confirm('Are you sure you want to delete?')"));?></td>
    
    <td class="text-center"><?php  echo HTML::link("private-investor/view/$private[_id]", "View")?></td>
  
  </tr>
  
    <?php }?>
</table>
<?php  echo $private_investor_data->render();?> 
@endsection