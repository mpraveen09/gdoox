@extends('layout.backend.master')
@extends('layout.backend.userinfo')
@section('right_col')
  <div class="card">
     <div class="card-header bgm-orange">
        <h2>Access to this feature is not allowed.</h2>
     </div>
    <div class="card-body text-center">
      <br/><br/>
      <p class="lead">This feature is not available in your package. You need to upgrade to use this feature.</p>
      <br/><br/>
      <img src="{{ asset('images/security.png') }}" />
      <br/><br/>
    </div>
    
  </div>
  <!-- will be used to show any messages -->
@endsection