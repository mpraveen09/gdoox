@extends('layout.backend.master')
@extends('layout.backend.userinfo')
@section('right_col')
  
<?php 
echo Form::open(array('action'=>'InvestorsController@InsertPrivateInvestors'));?>

  <h3 class="page-header">Private Investors</h3>

<?php 
echo $field_data;

echo Form::close();

?>
@endsection