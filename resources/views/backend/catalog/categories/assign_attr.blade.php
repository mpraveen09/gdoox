@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('header_custom_css')
    <link href="{{ asset('/m-admin-ui/vendors/bootgrid/jquery.bootgrid.min.css') }}" rel="stylesheet">
@endsection

@section('right_col_title_left')
    <!--<h2>Assign Attributes to Category</h2>-->
    <!--<div class="page-top-links">-->
    <!--</div>-->
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')

@if (Session::has('message'))
<div class="alert alert-info">{!!  Session::get('message')  !!}</div>
@endif
@if (Session::has('error'))
<div class="alert alert-danger">{!!  Session::get('error')  !!}</div>
@endif
    <!-- if there are creation errors, they will show here -->
    @if (HTML::ul($errors->all()))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!! HTML::ul($errors->all()) !!}
        </div>
    @endif
    
    @include('navigation_tabs.category_mgmt_tabs')
    
<!--    <div class="card">
	<div class="card-header bgm-blue">
		<h2>Assign Category to Attributes</h2>
	</div> .card-header    
         {!! Form::model($attributes, [
                'method' => 'POST',
                'route' => ['categories.assign', $id],
                'class' => 'form-horizontal form-label-left',
                'novalidate'=>''
            ]) !!}
            
            This is the div in which textboxes will be created on Selection of Attribute
            <div id="TextBoxesGroup"></div>
            
            <div class="table-responsive">
                <table id="data-table-attr" class="table table-striped">
                    <thead>
                        <tr> 
                            <th data-column-id="id" >Attribute ID</th>
                            <th data-column-id="sender">Label</th>
                            <th data-column-id="received">Description</th>
                            <th data-column-id="commands" data-formatter="commands" ></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attributes as $attribute)
                            @if(in_array($attribute->attr_id, $attr))
                                <tr >
                                    <td>{!! $attribute->attr_id !!} 
                                    </td>
                                    <td>{!! $attribute->label !!}</td>
                                    <td></td>
                                    <td >checked</td>
                                </tr>
                            @else
                               <tr >
                                    <td>{!! $attribute->attr_id !!}
                                    
                                    </td>
                                    <td>{!! $attribute->label !!}</td>
                                    <td></td>
                                    <td ></td>
                                </tr>
                            @endif     
                         @endforeach
                    </tbody>
                </table>
            </div>
        
            <div class="ln_solid"></div>
            <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                            <a href="{!! route('categories.index')  !!}" type="submit" class="btn btn-round btn-primary">Cancel</a>
                            <button id="send" type="submit" class="btn btn-round btn-success">Save</button>
                    </div>
            </div>
        {!! Form::close() !!}
    </div>-->
    
    
    <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>Assign Category to Attributes</h2>
            <a href="{!! route('categories.create')  !!}" class="btn btn-round btn-default">Create New</a>
            <a href="{!! route('categories.index')  !!}" class="btn btn-round btn-default">View All</a>
        </div>
        <div class="card-body card-padding">
        <!--   <div class="row">
                    {!! Form::model($attributes, [
                        'method' => 'POST',
                        'route' => ['categories.get_attributes'],
                        'class' => 'form-horizontal form-label-left',
                        'novalidate'=>''
                    ]) !!}
                    
                    {!! Form::hidden('id', $id, array('id'=>'id')) !!}
                    
                    <div class="col-md-4 col-sm-4 col-xs-10  form-group top_search" style="padding: 20px 0; margin-left: 0px;">
                        <div class="input-group">
                            {!! Form::text('term','', array('required','placeholder'=>'Search Attributes...','class'=>'searchattribute form-control'))!!}
                            <span class="input-group-btn">
                                <button class="btn btn-default btn-icon-text waves-effect"><i class="zmdi zmdi-search"></i></button>
                            </span>                          
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div> -->
            
            
            {!! Form::model($attributes, [
                'method' => 'POST',
                'route' => ['categories.assign', $id],
                'class' => 'form-horizontal form-label-left',
                'novalidate'=>''
            ]) !!}
            
            <div class="table-responsive">
                <table id="data-table-attr" class="table table-striped">
                    <thead>
                        <tr> 
                            <th>Select</th>
                            <th>Label</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attributes as $attribute)
                        <tr>
                            @if(in_array($attribute->attr_id, $attr))
                                <td>{!! Form::checkbox('attributes[]',$attribute->attr_id, true ,array('id' => 'top_level_attribute')) !!}</td>
                            @else
                                <td>{!! Form::checkbox('attributes[]', $attribute->attr_id, false ,array('id' => 'top_level_attribute')) !!}</td>
                            @endif
                                <td>{!! $attribute->label !!}</td>
                                <td>{!! $attribute->desc !!}</td>
                        </tr>
                         @endforeach
                    </tbody>
                </table>
            </div>

            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                        <a href="{!! route('categories.index')  !!}" type="submit" class="btn btn-round btn-primary">Cancel</a>
                        <button id="send" type="submit" class="btn btn-round btn-success">Save</button>
                </div>
            </div>
 
        {!! Form::close() !!}

	</div><!-- .card-body -->
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
//    jQuery(function($) {
//        $(".searchattribute").autocomplete({
//            source: function( request, response ) {   
//                $.ajax({
//                    url: "{!! URL::route('auto_search_attr')  !!}",
//                    dataType: "json",
//                    data: {
//                            term: request.term,
//                    },
//                    success: function(json) {
//                        response( $.map( json, function( item ) {
//                            return {
//                                value: item.attribute
//                            }
//                        }));
//                    }
//                });
//            },
//            autoFocus: true,
//            minLength: 3,
//            });
//        });
</script>

<script type="text/javascript">
$(document).ready(function(){
    
//    var attr = <?php echo json_encode($attr); ?>;
//    var len =  Object.keys(attr).length;
//    var attr_ids = [];
//    for (var i = 1; i <= len; i++)
//    {
//        attr_ids.push(attr[i]);
//    }
//    
//    var attributes = <?php echo json_encode($attributes); ?>;
//    
//    console.log(attr_ids);
//    
//    $.each(attributes, function(i, val){  
//        if(jQuery.inArray(val['attr_id'], attr_ids) != -1) {
//            $(val['attr_id']).prop('checked', true);
//        } else {
//           
//        }
        
//      if($.inArray(val['attr_id'], attr_ids) !== -1){
//          console.log(val['attr_id']);
//         console.log('Yes');
//    }
//    else{
//        console.log('No');
//    }
//  });

//    $("#data-table-selection").bootgrid({
//    selection: true,
//    multiSelect: true
//    }).on("selected.rs.jquery.bootgrid", function(e, rows)
//    {
//        var rowIds = [];
//        for (var i = 0; i < rows.length; i++)
//        {
//            rowIds.push(rows[i].id);
//        }
//        
//        var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv');      
//	newTextBoxDiv.after().html('<input type="text" name="attributes[]" id="top_attr_'+rowIds+ '" value="" >');    
//	newTextBoxDiv.appendTo("#TextBoxesGroup");
//        $('#top_attr_'+rowIds).val(rowIds);
//        
//    }).on("deselected.rs.jquery.bootgrid", function(e, rows)
//    {
//        var rowIds = [];
//        for (var i = 0; i < rows.length; i++)
//        {
//            rowIds.push(rows[i].id);
//        }
//        $('#top_attr_'+rowIds).remove();
//    });
//    
    
//    $("#data-table-attr").bootgrid({
//        css: {
//            icon: 'zmdi icon',
//            iconColumns: 'zmdi-view-module',
//            iconDown: 'zmdi-expand-more',
//            iconRefresh: 'zmdi-refresh',
//            iconUp: 'zmdi-expand-less'
//        },
//        
//        formatters: {
//                        "commands": function(column, row) {
//                            var cellValue = row[column.id];
//                            // now edit the value
////                            return cellValue;                            
//        console.log( cellValue);                            
//                            
//        console.log( row.id );
//        return '<input id="top_level_attribute" type="checkbox" name="attributes[]" value="'+row.id+'" '+ cellValue +'>' ;
//        //checked="checked" 
//                        }
//                    }
//       
//            
//        });
        
//    $("#data-table-selection").bootgrid({
//                css: {
//                    icon: 'zmdi icon',
//                    iconColumns: 'zmdi-view-module',
//                    iconDown: 'zmdi-expand-more',
//                    iconRefresh: 'zmdi-refresh',
//                    iconUp: 'zmdi-expand-less'
//                },
//                selection: true,
//                multiSelect: true,
//                rowSelect: true,
//                keepSelection: true,
//            });
           
//    $( ".actions" ).hide();
});
</script>

@endsection


