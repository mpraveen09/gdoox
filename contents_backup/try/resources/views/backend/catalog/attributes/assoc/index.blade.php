@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>Main Attributes Association/Classification</h2>--> 
    <!--<div class="page-top-links">-->
    <!--</div>-->
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')

    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!!  Session::get('message')  !!}
        </div>
    @endif
    
    @include('navigation_tabs.general_tabs')
    
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2> Attributes Association</h2>
            <a href="{!! route('attributesassoc.create')  !!}" class="btn btn-round btn-default">Create New</a>
            <a href="{!! route('attributesassoc.index')  !!}" class="btn btn-round btn-default">View All</a>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
          @if ( !$attributes->count() )
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    You have no Attributes Association/Classification Defined
                </div>               
          @else
              <table class="table table-striped responsive-utilities jambo_table ">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Meaning</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                  @foreach( $attributes as $attribute )
                      <tr>
                          <td>{!!  $attribute->id  !!}</td>
                          <td>{!! $attribute->label !!}</td>
                          <td><a href="{!! route('attributesassoc.edit', $attribute->id)  !!}"><i class='zmdi zmdi-edit zmdi-hc-fw'></i></a></td>
                      </tr>                
                  @endforeach

                  </tbody>
              </table>
          @endif
       </div>
    </div>     
 @endsection