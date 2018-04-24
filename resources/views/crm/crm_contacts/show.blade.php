@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>CRM</h2>-->
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
    
    @include('navigation_tabs.crm_tabs')
    
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Contact</h2>
            <a href="{!! route('crm_contacts.create')  !!}" class="btn  btn-default">Create New</a>
            <a href="{!! route('crm_contacts.edit',$userdata->_id)  !!}" class="btn  btn-default">Edit</a>
            <a href="{!! route('crm_contacts.index')  !!}" class="btn  btn-default">View All</a> 
        </div><!-- .card-header -->
        <div class="card-body card-padding">
            <table class="table table-striped responsive-utilities jambo_table ">
                <tbody>
                    @if(!empty($formfields))
                        @foreach($formfields['form_fields'] as $key=>$value)
                            <tr>
                                <td style="width: 30%;">
                                    @if(!empty($formfields['form_fields'][$key]['label']))
                                      {!! $formfields['form_fields'][$key]['label'] !!}
                                    @endif
                                </td>
                                <td>
                                    @if(is_array($userdata->$key))
                                        @if(!empty($userdata->$key))
                                            {!! implode(", ", $userdata->$key) !!}
                                        @else 
                                            N/A
                                        @endif
                                    @else
                                        {!! $userdata->$key !!}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    
                    @if(!empty($customformfields))
                        @foreach($customformfields['form_fields'] as $key1=>$val1)
                            <tr>
                                <td style="width: 30%;">
                                    @if(!empty($customformfields['form_fields'][$key1]['label']))
                                      {!! $customformfields['form_fields'][$key1]['label'] !!}
                                    @endif
                                </td>
                                <td>
                                    @if(is_array($userdata->$key1))
                                        @if(!empty($userdata->$key1))
                                            {!! implode(", ", $userdata->$key1) !!}
                                        @else 
                                            N/A
                                        @endif
                                    @else
                                        {!! $userdata->$key1 !!}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
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


