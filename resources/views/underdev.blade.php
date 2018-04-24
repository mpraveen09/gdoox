@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <h2> </h2>
@endsection

@section('right_col')
      <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!!  Session::get('message')  !!}
        </div>
    @endif
    
    <div class="card">
        <div class="card-header bgm-blue">
          <h2>Under Development</h2>
        </div><!-- .card-header -->

        <div class="card-body card-padding">    
This Is Currenty Under Development
        </div>
    </div>
@endsection

@section('footer_add_js_script')

@endsection