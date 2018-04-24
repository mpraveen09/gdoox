@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>Distribution Network</h2>-->
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
    
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Gdoox Subsciption</h2>
            <a href="{!! route('country-subscription.create') !!}" type="submit" class="btn btn-default">Create</a>
            <button onclick="goBack()" class="btn btn-default waves-effect">Back</button>
        </div><!-- .card-header -->
        @if (!$charges->count())
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                No Charges added for the countries. Please add <a href="{!! route('country-subscription.create') !!}" class="btn btn-default">Add Charges for Countries</a>
            </div>                 
        @else
            <div class="card">
                <div class="card-body card-padding">
                    <div class="text-right col-md-12">
                        {!! $charges->render() !!}             
                    </div>
                    <table class="table">
                        <thead>
                            <th>Country</th>
                            <th>Charges</th>
                            <th>Currency</th>
                            <th>Action</th>
                        </thead>
                        @foreach($charges as $charge)
                            <tr>
                                <td>{!! $charge->country !!}</td>
                                <td>
                                    Personal User: {!! $charge->personal_user_price !!} <br />
									Mono User: {!! $charge->mono_user_price !!} <br />
                                    Multi User: {!! $charge->multi_user_price !!} <br />
                                    Company Network User: {!! $charge->multi_site_user_price !!} <br />
									Ecosystem User: {!! $charge->ecosystem_user_price !!} <br />
                                    
                                </td>
                                <td>{!! $charge->currency !!}</td>
                                <td><a href="{!! route('country-subscription.edit', $charge->_id)  !!}">Edit</a> &nbsp;</td>
                            </tr>  
                        @endforeach
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('footer_add_js_script')
<script>
function goBack() {
    window.history.back();
}
</script>
@endsection