@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
@endsection

@section('right_col_title_right')
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

    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Gdoox Commercial Plan Management - Default Plans</h2>
            <button onclick="goBack()" class="btn btn-default waves-effect">Back</button>
        </div>
        <div class="card-body card-padding">    
            <table class="table">
            @foreach( $SubscriptionTypes as $SubscriptionType )
                <?php //exit(); ?>
               <tr>
                   <th>{!! $SubscriptionType['user_type'] !!}
                       <br/><br/>
                       <a href="{!! route('plan_configuration.create', 'id='.$SubscriptionType['user_id'])!!}" class="btn btn-primary">Update</a>
                   </th>
                   <td>
                       <!--{!! var_dump($SubscriptionType) !!}-->
                       <table class="table table-striped responsive-utilities  ">
                       @foreach( $SubscriptionPlanNames as $k => $v )
                       <tr>
                           <td>{!! $v !!} </td><td> {!! $SubscriptionType[$k] !!} </td>
                       </tr>
                       @endforeach
                       </table>
                   </td>
               </tr>
               
            @endforeach
</table>


            
         </div>
    </div>       
@endsection

@section('footer_add_js_files') 
@endsection       

@section('footer_add_js_script')

<script type="text/javascript">
function goBack() {
    window.history.back();
}
</script>

@endsection



