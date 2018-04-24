@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2></h2>-->
@endsection
@section('right_col_title_right')
   
@endsection

@section('right_col')

    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!!  Session::get('message')  !!}
        </div>
    @endif
    
    
    @if ( !$get_logos->count())
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"></span></button>
                There are no Certificate Logos
            </div>                 
    @else
        <div class="card">
            <div class="card-header bgm-blue head-title">
                  <h2>Certificate Logos</h2>
            </div><!-- .card-header -->
            <div class="card-body card-padding">
                  <table class="table">
                      <thead>
                        <th>Certificate Logo</th>
                        <th>Name</th>
                        <th>URL</th>
                      </thead>
                          <tbody>
                               @foreach($get_logos as $logos)
                                <tr>
                                    <td>
                                        @if(!empty($logos->logo))
                                            <img src="{!! $logos->logo_path.$logos->logo !!}" alt="Certification Logo"/>
                                        @endif
                                    </td>
                                    <td>
                                       @if(!empty($logos->name))
                                            {!! $logos->name !!}
                                       @endif
                                    </td>
                                    <td>
                                        @if(!empty($logos->url))
                                            {!! $logos->url !!}
                                        @endif
                                    </td>
                                </tr>
                              @endforeach
                          </tbody>
                      </table>
                </div>
        </div>
    @endif
@endsection


