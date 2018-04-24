@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>Business Ecosystem</h2>-->
    <!--<div class="page-top-links">-->
    <!--</div>-->
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')

@if (Session::has('message'))
    <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
@endif

@if (HTML::ul($errors->all()))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {!! HTML::ul($errors->all()) !!}
    </div>
@endif

    
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2><i class="zmdi zmdi-account m-r-5"></i> Select Business Partner</h2>
            <button onclick="goBack()" class="btn btn-primary waves-effect">Back</button>
        </div><!-- .card-header -->
        
        @if(!empty($inviter_users))
        
        <div class="card-body card-padding">
            
            {!! Form::model($fm_data, [
                  'method' => 'GET',
                  'route' => ['invited-business-partners.list_products'],
                  'class' => 'form-horizontal form-label-left',
                  'id'=>'product-list'
              ]) !!}
                  
                <div class="form-group clearfix">
                    <div class="col-md-6 col-sm-6 col-xs-12"></div>
                </div>
              
                @if(!empty($fm_data->labels['name']))
                  <div class="form-group clearfix">
                     {!! Form::label('inviter', $fm_data->labels['name'], array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                     <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::select('inviter', $inviter_users,'', array('required', 'class'=>'form-control')) !!}
                     </div>    
                  </div>
                @endif

                @if (!empty($fm_data->labels['submit']))
                  <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                           <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['next']!!}</button>
                      </div>
                  </div>
                @endif
                  
            {!! Form::close() !!}
        </div>
        @else 
        <div class="card-body card-padding">
            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                You don't have Business Partners
            </div>
         </div> 
        @endif
    </div>    
    
@endsection


@section('footer_add_js_script')
    <script type="text/javascript">
        function goBack() {
            window.history.back();
        }
    </script>
@endsection

