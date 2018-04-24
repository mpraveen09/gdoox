@extends('layout.backend.masterlogin')
@section('content_register')
<div id="l-register" class="lc-block toggled">
  <div class="card-body card-padding">
      <div class="jumbotron">
          <p style="font-weight: 500;">Thank you for registering with Gdoox.</p>
          <p>A activation link has been sent to your registered Email Id. Please click on activation link to activate your Account.</p>
          <p><a role="button" href="auth/login" class="btn btn-primary btn-lg waves-effect">Login</a></p>
      </div>

      <!--<p>To make the jumbotron full width, and without rounded corners, place it outside all <code>.container</code>s and instead add a <code>.container</code> within.</p>-->
  </div>
</div>
@endsection