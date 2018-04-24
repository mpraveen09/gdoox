@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <h2>Main Attributes List</h2>
    <!--<div class="page-top-links">-->
    <a href="{!! route('attributes.index')  !!}" class="btn btn-default">View All</a>
    <a href="{!! route('attributes.create')  !!}" class="btn btn-default">Create New</a>
    <!--</div>-->
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')


    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!!  Session::get('message')  !!}
        </div>
    @endif

<div class="card">
	<div class="card-header bgm-blue">
		<h2>Attributes</h2>
	</div><!-- .card-header -->
    
    @if ( !$attributes->count() )
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            You have no Attributes
        </div>    
    @else
    
    
    <div class="card-body card-padding">
        <div class="row">
            {!! Form::model($attributes, [
                'method' => 'POST',
                'route' => ['attr_search'],
                'class' => 'form-horizontal form-label-left',
                'novalidate'=>''
            ]) !!}
            <div class="col-md-4  form-group top_search" style="padding: 20px 0; margin-left: 0px;">
                <div class="input-group">
                    {!! Form::text('term',$term, array('required','placeholder'=>'Search Attributes...','class'=>'form-control searchattribute'))!!}
<!--                <input type="text" class="form-control" placeholder="Search attributes...">-->
                    <span class="input-group-btn">
                        <!--<button class="btn btn-default" type="submit">Go!</button>-->
                        <button class="btn btn-default btn-icon-text waves-effect"><i class="zmdi zmdi-search"></i></button>
                    </span>
                    
                </div>
            </div>
            {!! Form::close() !!}
            
            <div class="text-right col-md-8">
                {!! $attributes->appends(['term' => $term])->render() !!}
            </div>
        </div>
    </div><!-- .card-body -->
    
    
    <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
        <table class="table table-striped responsive-utilities jambo_table ">
            <thead>
                <tr>
                    <th>Attribute ID</th>
                    <th>Label / Brief Description</th>
                    <th>Tool Tip</th>
                    <th>Type</th>
                    <th>Length</th>
                    <th>Association / Classification</th>
                    <th>Required</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>    
            @foreach( $attributes as $attribute )
                <tr>
                    <td>{!!  $attribute->attr_id  !!}</td>
                    <td>{!! $attribute->label !!}</td><td>{!! $attribute->desc !!}</td>
                    <td>{!! $attribute->field_type !!}</td><td>{!! $attribute->len !!}</td>
                    <td>{!! $attribute->class !!}</td><td>{!! $attribute->req !!}</td>
                    
                    <td>
                        <a href="{!! route('attributes.show', $attribute->attr_id)  !!}"><i class='zmdi zmdi-eye zmdi-hc-fw'></i></a> &nbsp; 
                        <a href="{!! route('attributes.edit', $attribute->attr_id)  !!}"><i class='zmdi zmdi-edit zmdi-hc-fw'></i></a>
                    </td>
                </tr>                
            @endforeach
    
            </tbody>
        </table>
        
        </div>
    
        <div class="row">
            <div class="text-right col-md-12">
                 {!! $attributes->appends(['term' => $term])->render() !!}
            </div>
        </div>    
    @endif

   
</div><!-- .card -->

@endsection

@section('footer_add_js_script')
<style>
    .ui-menu-item{
        width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;        
        font-size: 11px;
    }   
    .ui-widget-content{
        max-height: 400px;
        overflow: scroll;
    }
</style>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
    jQuery(function($) {
        $(".searchattribute").autocomplete({
            source: function( request, response ) {   
                $.ajax({
                    url: "{!! URL::route('auto_search_attr')  !!}",
                    dataType: "json",
                    data: {
                            term: request.term,
                    },
                    success: function(json) {
                        response( $.map( json, function( item ) {
                            return {
                                value: item.attribute
                            }
                        }));
                    }
                });
            },
            autoFocus: true,
            minLength: 3,
            });
        });
</script>

@endsection