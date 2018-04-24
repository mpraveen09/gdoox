@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <h2></h2>
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')
    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            {!!  Session::get('message')  !!}
        </div>
    @endif
 
    <div class="card">
        <div class="card-header bgm-cyan ">
            <h2>Review And Customise your plan and proceed for payment<br/>
            OR you can continue exploring the platform (14 days free trial)</h2>
             
        </div>

        <div class="card-body card-padding">
        <table class="table table-striped responsive-utilities">
            
            {!! Form::open([
                'method' => 'POST',
                'route' => 'proceed-to-payment',
                'class' => 'form-horizontal form-label-left'
            ]) !!}            
            

            {!! Form::hidden('payment', 'Yearly') !!}
            {!! Form::hidden('userid', $user->_id) !!}
            {!! Form::hidden('plan', $GdooxPlan->_id) !!}
            {!! Form::hidden('plan_name', $GdooxPlan->subscriptiontype) !!}
            
            
        @foreach($html_data as $html_field)
        <tr>
            <td>
                @if($html_field['type']==='head')
                <strong style="text-transform: uppercase">{!! $html_field['label'] !!}</strong>
                @else
                    {!! Form::label($html_field['id'],$html_field['label'], ['class' => 'control-label col-md-6 col-sm-6 col-xs-12']) !!}
                @endif
            </td>
            <td class="">
                @if($html_field['type']==='head')
                
                @elseif($html_field['id']==='pricing' )                
                    <strong>{!! $html_field['val'] !!} {!! $html_data['currency']['val'] !!}</strong>
                    {!! Form::hidden($html_field['id'], $html_field['val'], ['data-val'=>$html_field['display_order'], 'data-name'=>$html_field['id']]) !!}                
                @elseif($html_field['type']==='bool' || $html_field['type']==='num' )                
                    @if($html_field['val'] !== 0 && $html_field['val'] !== "0")
                        @if($html_field['id'] === 'product_posting_up_to_included')
                            {!! $html_field['val'] !!} GB
                        @elseif( strpos( strtolower($html_field['label']), "price") )
                        <strong>{!! $html_field['val'] !!} {!! $html_data['currency']['val'] !!}</strong>
                        @else
                            {!! $html_field['val'] !!}
                        @endif
                    @else
                        &mdash;
                    @endif
                    {!! Form::hidden($html_field['id'], $html_field['val'], ['data-val'=>$html_field['display_order'], 'data-name'=>$html_field['type'] ]) !!}
                @elseif($html_field['type']==='optional_price' )               
                    <div class="input-group">
                       {!! Form::text($html_field['id'], $html_field['val'], ['readonly','data-val'=>$html_field['display_order'], 'data-name'=>$html_field['type'],'class' => 'form-control col-md-7 col-xs-12']) !!} 
                       <div class="input-group-addon">{!! $html_data['currency']['val'] !!}</div>
                     </div>                
                    
                @elseif($html_field['type']==='optional_num' )                
                    {!! Form::number($html_field['id'], 0, ['min'=>0,'data-val'=>$html_field['display_order'], 'data-name'=>$html_field['type'],'pattern'=>'[0-9]','class' => 'form-control col-md-7 col-xs-12']) !!}
                    <small><em>enter additional numbers (optional)</em></small>
                @else
                    <div class="input-group">
                       {!! Form::text($html_field['id'], $html_field['val'], ['readonly' ,'data-val'=>$html_field['display_order'], 'data-name'=>$html_field['type'],'class' => 'form-control col-md-7 col-xs-12']) !!}
                       <div class="input-group-addon">{!! $html_data['currency']['val'] !!}</div>
                     </div>                       
                @endif
            </td>
        </tr>
        @endforeach

        
        <tr>
            <td>&nbsp;</td>
            <td>
                <a id="back"href="{!! route('account-payment.create') !!}" class="btn btn-round btn-danger">Go Back</a>
                <button id="send" type="submit" class="btn btn-round btn-success">NEXT</button></td>
       </tr>
            {!! Form::close() !!}        
       
        </table>   
            
            
    </div>
    </div>
@endsection
 
@section('footer_add_js_script')
    <script type="text/javascript">
    $( document ).ready(function() {
        $( 'input[data-name="optional_num"]' ).change(function() {
            var inputid = $(this).attr('data-val').replace("_num", "");
            $( 'input[data-val="'+inputid+'_price"]' ).val( $(this).val() * $( 'input[data-val="'+inputid+'"]' ).val());
            var oprice=0;
            $(  'input[data-name="optional_price"]'  ).each(function( i ) {
                oprice += Number($( this ).val());
            });          
            $( 'input#total_optional_amount' ).val(oprice);
            $( 'input#total_price' ).val(Number($( 'input#pricing' ).val() ) + Number($( 'input#total_optional_amount' ).val()) );
        });
        
        $( 'input#total_price' ).val(Number($( 'input#pricing' ).val() ) + Number($( 'input#total_optional_amount' ).val()) );
    });
    </script>
@endsection