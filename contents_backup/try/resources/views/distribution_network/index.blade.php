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
          <h2>Distribution Network</h2>
          <button onclick="goBack()" class="btn btn-default waves-effect">Back</button>
        </div><!-- .card-header -->
        
            @if ( !$types->count())
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    You have no Network
                </div>                 
            @else
            
             <div class="card">
                <div class="card-body card-padding">
                      <table class="table">
                            <thead>
                                  <th>Types of Network</th>
                                  <th>View Network</th>
                            </thead>
                            
                            <tbody>
                                @foreach($network_types->options as $key=>$type)
                                    <tr>
                                        <td>
                                            {!! $type !!}
                                        </td>
                                        <td>
                                            {!! HTML::linkRoute('view_network','View',array('type'=>$type)) !!} &nbsp;
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td>View All</td>
                                    <td> {!! HTML::linkRoute('view_network','View',array('type'=>'View All')) !!} &nbsp;</td>
                                </tr>
                            </tbody> 
                    </table>
                </div>
        </div>
        @endif 
   
@endsection

@section('footer_add_js_script')
<script>
function goBack() {
    window.history.back();
}
</script>
@endsection