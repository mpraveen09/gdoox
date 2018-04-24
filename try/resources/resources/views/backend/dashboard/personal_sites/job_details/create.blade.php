@extends("layout.backend.master")
@extends("layout.backend.userinfo")

@section("right_col_title_left")
<!--<h2>Personal Site</h2>-->
@endsection

@section("right_col_title_right")
@endsection

@section("header_add_js_script")        
@endsection

@section("right_col")

@if (Session::has("message"))
<div class="alert alert-info">{!!  Session::get("message")  !!}</div>
@endif

@if (HTML::ul($errors->all()))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {!! HTML::ul($errors->all()) !!}
    </div>
@endif

    @include('navigation_tabs.personal-site-tabs')
   <div class="card">
        <div class="card-header bgm-blue head-title">
            <h2>{!!$fm_data->labels["form_title"]!!}</h2>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
            {!! Form::open(array(
                    "action" => "backend\dashboard\personal_sites\JobDetailsController@store",
                    "method" => "POST", 
                    "class"=>" form-label-left")) 
                !!}
              {!! Form::hidden("user_id", Auth::user()->id) !!} 
              
              @if (!empty($fm_data->labels))
                <p class="c-black f-500">Your Current/Last Job</p>
                <div class="row">
                      @if (!empty($fm_data->labels["company_name"]))
                          <div class="col-sm-3 m-b-20">
                              <div class="form-group fg-line">
                               {!! Form::label("company_name", $fm_data->labels["company_name"].$required) !!} 
                               {!! Form::text("company_name","", array("required","placeholder" =>$fm_data->labels["company_name"],"class"=>"form-control")) !!}
                              </div>
                          </div>
                      @endif
                      @if (!empty($fm_data->labels["from"]))
                          <div class="col-sm-3 m-b-20">
                              <div class="form-group fg-line">
                               {!! Form::label("from", $fm_data->labels["from"].$required) !!} 
                               {!! Form::text("from","", array("required","placeholder" =>$fm_data->labels["from"],"class"=>"form-control")) !!}
                              </div>
                          </div>
                      @endif
                      @if (!empty($fm_data->labels["to"]))
                          <div class="col-sm-3 m-b-20">
                              <div class="form-group fg-line">
                               {!! Form::label("to", $fm_data->labels["to"].$required) !!} 
                               {!! Form::text("to","", array("required","placeholder" =>$fm_data->labels["to"],"class"=>"form-control")) !!}
                              </div>
                          </div>
                      @endif
              </div>
              
              
            <div class="row">
                <div class="form-group clearfix">
                    @if(!empty($fm_data->labels["org_type"]))
                        <div class="col-sm-4">
    <!--                    {!! Form::label("org_type", $fm_data->labels["org_type"].$required) !!} -->
                            {!! Form::select("org_type", $organization, null, array('id'=>'org_type',"placeholder"=>"-- Select Organization Type --","required", "class"=>"org_type form-control")) !!}
                        </div>
                    @endif

                    @if(!empty($fm_data->labels["org_category"]))
                        <div class="col-sm-4 org_cat_div">
    <!--                       {!! Form::label("org_category", $fm_data->labels["org_category"].$required) !!} -->
                               {!! Form::select("org_category", $org_cat, null, array('id'=>'org_category',"placeholder"=>"-- Select Organization Category --","required", "class"=>"form-control")) !!}
                        </div>
                    @endif
                </div> 
            </div> 
              
            <div class="row">
              @if(!empty($fm_data->labels["position"]))
                <div class="form-group clearfix">
                    {!! Form::label("position", $fm_data->labels["position"].$required) !!} 
                     <div class="col-md-6 col-sm-6 col-xs-12">
                       @foreach($position as $pos)
                           {!! Form::checkbox("position[]", $pos, null,["class" => "position"])!!}
                           {!! Form::label($pos, $pos)!!}<br/>
                       @endforeach
                     </div>   
                  </div>
              @endif
            </div>
                 
        <p class="c-black f-500">Add Job Experiences</p>
        
        <div class="input_fields_wrap"></div>
        
        <a class="btn btn-default waves-effect add_field_button">Add</a>
        <!--<a href="#" class="btn btn-default waves-effect">Add </a>-->        
        @if (!empty($fm_data->labels["submit"]))
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                     <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels["submit"]!!}</button>
                </div>
            </div>
          @endif
        @endif
      {!! Form::close() !!}
     </div>
   </div>    
@endsection

@section("footer_add_js_script")
<script>
//Add more job experience
$(document).ready(function() {
    var max_fields = 10; // Maximum input boxes allowed
    var wrapper = $(".input_fields_wrap"); // Fields wrapper
    var add_button = $(".add_field_button"); // Add button ID
    var x = 1; // initlal text box count
    <?php $i = 1; ?>
            
    $(document).on('change', '.org_type', function(){
        var org_type = $(this).val();
        var ref = $(this);
        $.ajax({
            url: "{!! URL::route('fetch_org_category') !!}",
            data: {
                org_type: org_type
            },
            success: function(json) {
                var options = [];
                ref.parent().parent().find('div.org_cat_div').children().html('');
                options.push('<option>-- Select Organization Category --</option>');
                $.each(JSON.parse(json), function(i, item) {
                options.push($('<option/>',
                    {
                        value: item.org_name, text: item.org_name 
                    }));
                });
                ref.parent().parent().find('div.org_cat_div').children().append(options);
                // $('#org_category').append(options);
            }
        });
    });

    $(add_button).click(function(e){ // On add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            var newInput = '<div class="add_job">'+
              '<div class="row">'+
             ' @if (!empty($fm_data->labels["old_company_name"]))'+
                 ' <div class="col-sm-3 m-b-20">'+
                      '<div class="form-group fg-line">'+
                       '{!! Form::label("old_company_name", $fm_data->labels["old_company_name"].$required) !!}'+ 
                       '{!! Form::text("old_company_name[]","", array("required","placeholder" =>$fm_data->labels["old_company_name"],"class"=>"form-control old_company_name")) !!}'+
                     '</div>'+
                  '</div>'+
              '@endif'+
              '@if (!empty($fm_data->labels["old_from"]))'+
                  '<div class="col-sm-3 m-b-20">'+
                      '<div class="form-group fg-line">'+
                       '{!! Form::label("old_from", $fm_data->labels["old_from"].$required) !!}'+ 
                       '{!! Form::text("old_from[]","", array("required","placeholder" =>$fm_data->labels["old_from"],"class"=>"form-control")) !!}'+
                      '</div>'+
                  '</div>'+
              '@endif'+
              '@if (!empty($fm_data->labels["old_to"]))'+
                  '<div class="col-sm-3 m-b-20">'+
                      '<div class="form-group fg-line">'+
                       '{!! Form::label("old_to", $fm_data->labels["old_to"].$required) !!} '+
                       '{!! Form::text("old_to[]","", array("required","placeholder" =>$fm_data->labels["old_to"],"class"=>"form-control")) !!}'+
                      '</div>'+
                  '</div>'+
              '@endif'+
            '</div>'+
            '<div class="row">'+
                    '<div class="form-group clearfix">'+
                        '@if(!empty($fm_data->labels["org_type"]))'+
                            '<div class="col-sm-4">'+
                                '{!! Form::select("old_org_type[]", $organization, null, array("id"=>"org_type","placeholder"=>"-- Select Organization Type --","required", "class"=>"org_type form-control")) !!}'+         
                            '</div>'+
                        '@endif'+
                        '@if(!empty($fm_data->labels["org_category"]))'+
                            '<div class="col-sm-4 org_cat_div">'+
                                 '{!! Form::select("old_org_category[]", $org_cat, null, array("id"=>"org_category","placeholder"=>"-- Select Organization Category --","required", "class"=>"form-control")) !!}'+        
                            '</div>'+
                        '@endif'+
                    '</div>'+
                '</div>'+
            '<div class="row">'+
              '@if(!empty($fm_data->labels["old_position"]))'+
                '<div class="form-group clearfix col-md-6 col-sm-6 col-xs-12">'+
                        '{!! Form::label("old_position", $fm_data->labels["old_position"].$required) !!} '+
                     '<div class="">'+
                       '@foreach($position as $pos)'+
                           '<input type="checkbox" name="old_position_'+x+'[]"  value="<?php echo $pos ?>" class="position">'+
                           '{!! Form::label($pos, $pos)!!}<br/>'+
                       '@endforeach'+
                     '</div>'+
                  '</div>'+
              '@endif'+
            '</div>'+
            '<a href="#" class="remove_field">Remove</a></div>'; //remove experience
//            newInput = newInput.replace('name="old_company_name"', 'name="old_company_name['+x+']"');
//            newInput = newInput.replace('name="old_from"', 'name="old_from['+x+']"');
//            newInput = newInput.replace('name="old_to"', 'name="old_to['+x+']"');
//            newInput = newInput.replace('name="old_position"', 'name="old_position['+x+'][]"');
//            newInput = newInput.replace('name="old_org_type"', 'name="old_org_type['+x+']"');
//            newInput = newInput.replace('name="old_org_category"', 'name="old_org_category['+x+']"');
            $(wrapper).append(newInput);
            x++; //text box increment
            <?php $i++; ?>
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent("div").remove(); x--;
    });


//add other position
$(".other-text").hide();

$(document).on('change', ".position" ,function () {
        //    check if its checked. If checked move inside and check for others value
        //    alert(this.checked && this.value);
    if (this.checked && this.value === "Other Position") {
        //show a text box
        $(".other-text").show();
    } 
    else if (!this.checked && this.value === "Other Position"){
        //        hide the text box
        //        $(this).closest('.add_job').html();
        //        console.log($(this).closest('.add_job').filter('.other-tex').html());
        $(".other-text").hide();
    }
});
});

</script>
@endsection

