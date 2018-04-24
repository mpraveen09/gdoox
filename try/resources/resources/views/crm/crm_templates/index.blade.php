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

    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            {!!  Session::get('message')  !!}
        </div>
    @endif

    @include('navigation_tabs.crm_tabs')

    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>{!! $form_fields->labels['templates'] !!}</h2>
            <a href="{!! route('crm_templates.create')  !!}" class="btn  btn-default">Create New</a>
            <a href="{!! route('crm_templates.index')  !!}" class="btn  btn-default">View All</a>
        </div>
        @if(!$templates->count())
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-warning alert-dismissible" role="alert">
                         There are no Templates
                    </div>  
                </div>
            </div>      
        @else 
            <div class="row">
                <div class="text-right col-md-12">
                     {!! $templates->render() !!}
                </div>
            </div>
            <div class="card-body card-padding"> 
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                    <table class="table table-striped responsive-utilities jambo_table ">
                        <thead>
                            <th>{!! $form_fields->labels['template_name'] !!}</th>
                            <th>{!! $form_fields->labels['type'] !!}</th>
                            <th>{!! $form_fields->labels['subject'] !!}</th>
                            <th>{!! $form_fields->labels['description'] !!}</th>     
                         </thead>

                         <tbody>
                             @foreach($templates as $template)
                              <tr>
                                   <td>{!! $template->template_name !!}</td>
                                   <td>{!! $template->type !!}</td>
                                   <td>{!! $template->subject !!}</td>
                                   <td>{!! $template->description !!}</td>

                                   <td>
                                      <!--<a href="{!! route('crm_opportunities.show', $template->_id)  !!}">
                                           <i class='zmdi zmdi-eye zmdi-hc-fw'></i>
                                       </a> &nbsp; -->

                                       <a href="{!! route('crm_templates.edit', $template->_id)  !!}">
                                           <i class='zmdi zmdi-edit zmdi-hc-fw'></i>
                                       </a>
                                   </td>
                               </tr>
                             @endforeach
                         </tbody>  
                     </table>
              </div>
           </div>
            <div class="row">
                <div class="text-right col-md-12">
                     {!! $templates->render() !!}
                </div>
            </div>
        @endif
    </div>                        
@endsection
 
@section('footer_add_js_script')
    <script type="text/javascript">


    </script>
@endsection