    @extends('layout.backend.master')
    @extends('layout.backend.userinfo')

    @section('right_col_title')

    @endsection


    @section('right_col')

    @include('navigation_tabs.product_mgmt_tabs')
      
    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
    @endif
      
    <div class="card">
        <div class="card-header card-padding-sm bgm-blue head-title">
            <h2>Product Info</h2>
        </div>
        <div class="card-body card-padding">
            <div class="table-responsive">
                <table class="table table-striped responsive-utilities jambo_table ">
                    <tbody>
                          <tr><th>Product Thumb</th><td><img style="height: 40px; width: 40px; overflow: hidden;" src="{!! asset($product->thumb_path.$product->thumb) !!}" alt="" ></td></tr>
                          <tr><th>Product Name</th><td>{!! $product->product_name !!}</td></tr>
                          <tr><th>Quantity</th><td>{!! $product->qty !!}</td></tr>
                          <tr><th>Price</th> <td>{!! $product->price !!}</td></tr>
                    </tbody>
                </table>
            </div>
        </div> 
    </div>
    
    <div class="card">
        <div class="card-header card-padding-sm bgm-blue head-title">
            <h2>Customer Info</h2>
        </div>
        
        <div class="card-body card-padding">
            <div class="table-responsive">
                <table class="table table-striped responsive-utilities jambo_table ">
                    @if(!empty($userdetails))
                        @if(!empty($userdetails->first_name))
                              <tr><th> Name</th><td>{!!$userdetails->first_name!!}</td></tr>
                        @else
                            <tr><th>First Name</th><td>{!! $user->username !!}</td></tr>
                        @endif

                        @if($userdetails->second_name)
                              <tr><th>First Name</th><td>{!!$userdetails->second_name!!}</td></tr>
                        @endif

                        @if($userdetails->surname)
                              <tr><th>Sur Name</th><td>{!!$userdetails->surname!!}</td></tr>
                        @endif

                        @if($userdetails->email)
                              <tr><th>Email</th><td>{!!$userdetails->email!!}</td></tr>
                        @endif

                        @if($userdetails->street_add)
                                <tr><th>Street Address</th><td>{!!$userdetails->street_add !!}</td></tr>
                        @endif

                        @if($userdetails->city)
                                <tr><th>City</th><td>{!!$userdetails->city!!}</td></tr>
                        @endif

                        @if($userdetails->country)
                                <tr><th>Country</th><td>{!!$userdetails->country!!}</td></tr>
                        @endif

                        @if($userdetails->zip)
                                <tr><th>Zip</th><td>{!!$userdetails->zip!!}</td></tr>
                        @endif

                        @if($userdetails->business_phone_no1)
                                <tr><th>Business Phone No</th><td>{!!$userdetails->business_phone_no1!!}</td></tr>
                        @endif

                        @if($userdetails->business_mob_no1)
                                <tr><th>Business Mobile No</th><td>{!!$userdetails->business_mob_no1!!}</td></tr>
                        @endif
                    @else
                        <tr>
                            <th>Name</th>
                            <td>{!! $user->username !!}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{!! $user->email !!}</td>
                        </tr>
                    @endif
                    <tr>
                        <th>Action:</th>
                        <td colspan="2">
                            <a class="btn btn-success waves-effect" href="{!! route('manage_in_crm', $product->product_id) !!}">Go to CRM to Manage</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div> 
    </div>
@endsection

@section('footer_add_js_script')

@endsection