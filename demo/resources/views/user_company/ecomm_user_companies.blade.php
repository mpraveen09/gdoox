@extends('layout.backend.master')
@extends('layout.backend.userinfo')
@section('right_col')
<div class="col-md-12 ">
  
    <h3 class="page-header">E-commerce User Company </h3>

<?php 
echo $field_data; 
echo $tabs;
?>
</div>
@endsection