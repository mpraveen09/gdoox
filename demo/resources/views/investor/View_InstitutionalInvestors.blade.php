@extends('layout.backend.master')
@extends('layout.backend.userinfo')
@section('right_col')
  
<?php 
//echo"<pre>";print_r($inst_investor_data);echo"</pre>";
?>
<table class="table table-striped table-hover table-condensed">
  <tr>
    <th class="col-sm-1">First Name</th><th class="col-sm-1">Last Name</th><th colspan="3" class="text-center col-sm-1">Action</th>
  </tr>
    <?php foreach($inst_data as $inst){?>
  
  <tr class="success active warning danger">
    
    <td><?php if(!empty( $inst['fst_name'])){ echo $inst['fst_name'];}?></td> 
    
    <td><?php if( !empty($inst['scnd_name'])){echo $inst['lst_name'];}?></td>
    
    <td class="text-center"><?php  echo HTML::link("institutional-investor/edit/$inst[_id]", "Edit")?></td>
    
    <td class="text-center"><?php echo HTML::link("institutional-investor/delete/$inst[_id]", 'Delete',array( "onclick"=>"return confirm('Are you sure you want to delete?')"));?></td>
    
    <td class="text-center"><?php  echo HTML::link("institutional-investor/view/$inst[_id]", "View")?></td>
  
  </tr>
  
    <?php }?>
</table>
<?php  echo $inst_data ->render();?> 
@endsection