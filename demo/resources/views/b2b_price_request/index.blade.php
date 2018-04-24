@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <h2>B2B Price Requests</h2>
@endsection

@section('right_col_title_right')
    <br/>
    <br/>
    <button onclick="goBack()" class="btn btn-primary waves-effect">Back</button>
@endsection

@section('right_col')
    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!! Session::get('message') !!}
        </div>           
    @endif
    
    <div class="card">
        <div class="card-header bgm-blue">
            <h2> B2B Price Requests</h2>
        </div><!-- .card-header -->
        
            @if (!$requests->count())
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    There are no B2B Price Requests.
                </div>                 
            @else
                <div class="text-right col-md-12">
                    {!! $requests->render() !!}             
                </div>
                
               <div class="card-body card-padding">    
                    <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                        <table class="table table-striped responsive-utilities jambo_table ">
                            <thead>
                                <tr>
                                    <th>Company</th>
                                    <th>Store Name</th>
                                    <th>Product Name</th>
                                    <th>Requesting Company</th>
                                    <th>Name</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>    
                               @foreach($requests as $request)
                                    <tr>
                                        <td>{!! $request->company !!}</td>
                                        <td>{!! $request->shopid !!}</td>
                                        <td>{!! $request->desc !!}</td>
                                        <td>{!! $request->user_company !!}</td>
                                        <td>{!! $request->user_name !!}</td>
                                        <td>{!! $request->message !!}</td>
                                        <td>
                                            <a href="{!! route('approve.prod.price_req',['id'=>$request->id]) !!}" class="btn btn-primary btn-xs waves-effect">Accept for Product</a><br />
                                            <a href="{!! route('approve.store.price_req',['id'=>$request->id]) !!}" class="btn btn-primary btn-xs waves-effect">Accept for Store</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>    
                </div>
            
                <div class="text-right col-md-12">
                    {!! $requests->render() !!}             
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