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
            <a href="{!! route('gdoox-subscription.create') !!}" type="submit" class="btn btn-default">Create</a>
            <button onclick="goBack()" class="btn btn-default waves-effect">Back</button>
        </div><!-- .card-header -->
        @if (!$discounts->count())
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                No Discount added for the countries. Please add <a href="{!! route('gdoox-subscription.create') !!}" class="btn btn-default">Discounts</a>
            </div>                 
        @else
            <div class="card">
                <div class="card-body card-padding">
                    <div class="text-right col-md-12">
                        {!! $discounts->render() !!}             
                    </div>
                    <table class="table">
                        <thead>
                            <th>Country</th>
                            <th>Discount Percentage</th>
                            <th>Action</th>
                        </thead>
                        @foreach($discounts as $discount )
                            <tr>
                                <td>{!! $discount->country !!}</td>
                                <td>{!! $discount->discount !!} %</td>
                                <td><a href="{!! route('gdoox-subscription.edit', $discount->_id)  !!}">Edit</a> &nbsp;</td>
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