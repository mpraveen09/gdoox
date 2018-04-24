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
            <!--a href="{!! route('gdoox-subscription.create') !!}" type="submit" class="btn btn-default">Create</a-->
            <button onclick="goBack()" class="btn btn-default waves-effect">Back</button>
        </div><!-- .card-header -->
        <div class="card">
            <div class="card-body card-padding">
                <table class="table">
                    <thead>
                        <th>User Role</th>
                        <th>Price Per Year</th>
                        <th>Currency</th>
                    </thead>
                    @foreach($charges as $charge )
                        <tr>
                            <td>{!! $charge->user !!}</td>
                            <td>{!! number_format($charge->price_per_year, 3, '.', ',') !!} </td>
                            <td>{!! $charge->currency !!}</td>
                            <td><a href="{!! route('subscription-charges.edit', $charge->_id)  !!}">Edit</a> &nbsp;</td>
                        </tr>  
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection

@section('footer_add_js_script')
<script>
function goBack() {
    window.history.back();
}
</script>
@endsection