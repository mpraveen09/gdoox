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
            <h2>Gdoox Commercial Plan Management - Plans by Country</h2>
            <a href="{!! route('plan_configuration_country.create')!!}" class="btn btn-default">Create New</a> <button onclick="goBack()" class="btn btn-default waves-effect">Back</button>
        </div>
        <div class="card-body card-padding">    
            <table class="table">
                
            @foreach( $countries as $country)
               <tr>
                   <th><strong>{!! $country[0] !!}</strong>
                       <br/><br/>
                       <a href="{!! route('plan_configuration_country.create','country='.$country[0])!!}" class="btn btn-primary">Create New</a>
                   </th>
                   <td>
                        <table class="table table-striped responsive-utilities  ">
                       
                        @foreach( $SubscriptionTypes[$country[0]] as $SubscriptionType )
                            <tr>
                                <td>{!! $SubscriptionType['user_type'] !!} : </td><td> {!! $SubscriptionType['pricing'] !!} {!! $SubscriptionType['currency'] !!} </td>
                                <td>
                                    <a href="{!! route('plan_configuration_country.create', 'id='.$SubscriptionType['user_id'] .'&country='.$country[0])!!}" >Edit</a>
                                     
                               </td>
                               <td>
                                    @if(isset($SubscriptionType['pricing']))
                                    <a href="{!! route('plan_configuration_country.show', $SubscriptionType['id'] )!!}" >View Details</a>
                                    @else
                                    &nbsp;
                                    @endif

                               </td>
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



