@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <h3>Add Product</h3>
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')
    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
    @endif

    @if (HTML::ul($errors->all()))
        <div class="alert alert-error">{!! HTML::ul($errors->all()) !!}</div>
    @endif    
    
    @if ( ! count($productForm)  )
        <div class="alert alert-warning">You have no Categories</div>
    @else

        </div-->
        <div class="row">
            {!! Form::open([
                'method' => 'POST',
                'route' => 'products/save',
                'class' => 'form-horizontal form-label-left',
                'novalidate'=>'',
                'files' => true
            ]) !!}                
            <div class="col-md-12">
                @foreach( $productForm as $productFormfield )
                        {!!  $productFormfield   !!}
                @endforeach 
                
                <br/>
            </div>

            <div class="col-md-12 text-center">
                <button id="send_prod_cat" type="submit" class="btn btn-round btn-success">Add This Product</button>    
                <br/><br/>
            </div>
            
            {!! Form::close() !!}                

        </div>        
      

        
      
        
    

    @endif    

    
@endsection

@section('footer_add_js_script')
<script>
    $(document).ready(function(){

        
    });
</script>    
@endsection