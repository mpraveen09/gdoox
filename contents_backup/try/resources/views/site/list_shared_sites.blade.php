@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <h2></h2>
@endsection

@section('header_add_js_script')        
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
    
    <div class="row">
        <div class="col-md-12">
          <div class="card">
              <div class="card-header card-padding-sm bgm-blue">
                  <h2><i class="zmdi zmdi-account m-r-5"></i> Business Sites</h2>
              </div>
              
              
              @if(!empty($invited_sites))
              <div class="card-body card-padding">
                  {!! Form::model($fm_data, [
                        'method' => 'GET',
                        'route' => ['store_shared_product'],
                        'class' => 'form-horizontal form-label-left',
                        'id'=>'import-products'
                    ]) !!}

                    {!! Form::hidden('store_id',$shopid) !!}
                    {!! Form::hidden('product_id',$product_id) !!}
                    
                    
                    <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                        <table class="table table-striped responsive-utilities jambo_table ">
                            <thead>
                                <th>Select Site to Share</th>
                            </thead>

                             <tbody>
                                @foreach($invited_sites as $key=>$value)
                                    <tr>
                                        <td>{!! Form::checkbox('sites[]', $key ) !!} {!! $value !!}</td>
                                    </tr>
                                @endforeach
                              </tbody>
                         </table>             
                    </div>
                    
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
                             There are no Shared Sites.
                        </div>
                     </div> 
              @endif
          </div>               
        </div>      
      </div>
    
@endsection
@section('footer_add_js_script')

@endsection

