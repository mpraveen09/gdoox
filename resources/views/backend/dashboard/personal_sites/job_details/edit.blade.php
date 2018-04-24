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
<?php use Gdoox\Models\DropdownOption; $i = 1; $x = 1; ?>

    @include('navigation_tabs.personal-site-tabs')
   <div class="card">
        <div class="card-header bgm-blue head-title">
          <h2>{!!$fm_data->labels["form_title"]!!}</h2>
        </div><!-- .card-header -->
        <div class="card-body card-padding">    
          {!! Form::open(array("action" => "backend\dashboard\personal_sites\JobDetailsController@update",  "method" => "GET", "class"=>" form-label-left")) !!}
              {!! Form::hidden("user_id", Auth::user()->id) !!} 
              
              @if (!empty($fm_data->labels))
                <p class="c-black f-500">Your Current/Last Job</p>

                <div class="row">
                      @if (!empty($fm_data->labels["company_name"]))
                          <div class="col-sm-3 m-b-20">
                              <div class="form-group fg-line">
                               {!! Form::label("company_name", $fm_data->labels["company_name"].$required) !!} 
                               {!! Form::text("company_name",$jobdetails->job_details[0]['company_name'], array("required","placeholder" =>$fm_data->labels["company_name"],"class"=>"form-control")) !!}
                              </div>
                          </div>
                      @endif
                      @if (!empty($fm_data->labels["from"]))
                          <div class="col-sm-3 m-b-20">
                              <div class="form-group fg-line">
                               {!! Form::label("from", $fm_data->labels["from"].$required) !!} 
                               {!! Form::text("from",$jobdetails->job_details[0]['from'], array("required","placeholder" =>$fm_data->labels["from"],"class"=>"form-control")) !!}
                              </div>
                          </div>
                      @endif
                      @if (!empty($fm_data->labels["to"]))
                          <div class="col-sm-3 m-b-20">
                              <div class="form-group fg-line">
                               {!! Form::label("to", $fm_data->labels["to"].$required) !!}
                               {!! Form::text("to",$jobdetails->job_details[0]['to'], array("required","placeholder" =>$fm_data->labels["to"],"class"=>"form-control")) !!}
                              </div>
                          </div>
                      @endif
                </div>

                <div class="row">
                     <div class="form-group clearfix">
                         @if(!empty($fm_data->labels["org_type"]))
                             <div class="col-sm-4">
                                 {!! Form::select("org_type", $organization, $jobdetails->job_details[0]['org_type'], array('id'=>'org_type',"placeholder"=>"-- Select Organization Type --","required", "class"=>"org_type form-control")) !!}
                             </div>
                         @endif

                         @if(!empty($fm_data->labels["org_category"]))
                             <div class="col-sm-4 org_cat_div">
                                    {!! Form::select("org_category", $orgtype, $jobdetails->job_details[0]['org_category'], array('id'=>'org_category',"placeholder"=>"-- Select Organization Category --","required", "class"=>"form-control")) !!}
                             </div>
                         @endif
                     </div>
                 </div>
                
                <div class="row">
                    @if(!empty($fm_data->labels["position"]))
                        <div class="form-group clearfix">
                          {!! Form::label("old_position", $fm_data->labels["old_position"].$required) !!} 
                           <div class="col-md-6 col-sm-6 col-xs-12">
                                @foreach($position as $pos)
                                   @if(in_array($pos, $jobdetails->job_details[0]['position']))
                                   <input type="checkbox" name="position[]"  value="<?php echo $pos ?>" class="position" checked>
                                       {!! Form::label($pos, $pos)!!}<br/>
                                   @else
                                       <input type="checkbox" name="position[]"  value="<?php echo $pos ?>" class="position">
                                       {!! Form::label($pos, $pos)!!}<br/>
                                   @endif
                                @endforeach
                           </div>   
                        </div>
                    @endif
                </div>
                
                @if(count($jobdetails->job_details) > 1)
                    @foreach($jobdetails->job_details as $key=>$jobdetails)
                        <?php
                            unset($orgtype);
                            $orgtype = array();
                            $orgcat = DropdownOption::where('parent', $jobdetails['org_type'])->where('lang','en')->first();
                            if(!empty($orgcat)){
                                foreach($orgcat->options as $orgname){
                                    $orgtype[$orgname] = $orgname;
                                }
                            }
                            else {
                                $orgtype['no_categories'] = "No Available Categories";
                            }
                        ?>

                        <div class="add_job">
                            <div class="row">
                                    @if (!empty($fm_data->labels["old_company_name"]))
                                        <div class="col-sm-3 m-b-20">
                                            <div class="form-group fg-line">
                                                {!! Form::label("old_company_name", $fm_data->labels["old_company_name"].$required) !!}
                                                {!! Form::text("old_company_name[]",$jobdetails['company_name'], array("required","placeholder" =>$fm_data->labels["old_company_name"],"class"=>"form-control old_company_name")) !!}
                                           </div>
                                        </div>
                                    @endif

                                    @if (!empty($fm_data->labels["old_from"]))
                                        <div class="col-sm-3 m-b-20">
                                            <div class="form-group fg-line">
                                                {!! Form::label("old_from", $fm_data->labels["old_from"].$required) !!}
                                                {!! Form::text("old_from[]", $jobdetails['from'], array("required","placeholder" =>$fm_data->labels["old_from"],"class"=>"form-control")) !!}
                                            </div>
                                        </div>
                                    @endif

                                    @if (!empty($fm_data->labels["old_to"]))
                                        <div class="col-sm-3 m-b-20">
                                            <div class="form-group fg-line">
                                                {!! Form::label("old_to", $fm_data->labels["old_to"].$required) !!}
                                                {!! Form::text("old_to[]", $jobdetails['to'], array("required","placeholder" =>$fm_data->labels["old_to"],"class"=>"form-control")) !!}
                                            </div>
                                        </div>
                                    @endif
                             </div>

                            <div class="row">
                               <div class="form-group clearfix">
                                   @if(!empty($fm_data->labels["org_type"]))
                                       <div class="col-sm-4">
                                           {!! Form::select("old_org_type[]", $organization, $jobdetails['org_type'], array("id"=>"org_type","placeholder"=>"-- Select Organization Type --","required", "class"=>"org_type form-control")) !!}      
                                       </div>
                                   @endif
                                   @if(!empty($fm_data->labels["org_category"]))
                                       <div class="col-sm-4 org_cat_div">
                                            {!! Form::select("old_org_category[]", $orgtype, $jobdetails['org_category'], array("id"=>"org_category","placeholder"=>"-- Select Organization Category --","required", "class"=>"form-control")) !!}      
                                       </div>
                                   @endif
                               </div>
                           </div>

                            <div class="row">
                                @if(!empty($fm_data->labels["position"]))
                                    <div class="form-group clearfix">
                                      {!! Form::label("old_position", $fm_data->labels["old_position"].$required) !!} 
                                       <div class="col-md-6 col-sm-6 col-xs-12">
                                            @foreach($position as $pos)
                                               @if(in_array($pos, $jobdetails['position']))
                                               <input type="checkbox" name="old_position_<?php echo $x ?>[]"  value="<?php echo $pos ?>" class="position" checked>
                                                   {!! Form::label($pos, $pos)!!}<br/>
                                               @else
                                                   <input type="checkbox" name="old_position_<?php echo $x ?>[]"  value="<?php echo $pos ?>" class="position">
                                                   {!! Form::label($pos, $pos)!!}<br/>
                                               @endif
                                            @endforeach
                                       </div>   
                                    </div>
                                @endif
                            </div>
                            <a href="#" class="remove_field">Remove</a>
                        </div>
                        <?php $x++; ?>
                    @endforeach
                @endif


     <p class="c-black f-500">Add Job Experiences</p>
     <div class="input_fields_wrap"></div>
     <a class="btn btn-default waves-effect add_field_button">Add</a>    
        @if (!empty($fm_data->labels["submit"]))
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                     <button id="send" type="submit" class="btn btn-round btn-success">Update</button>
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
    <?php $i = 1; ?>
    var max_fields = 10; // Maximum input boxes allowed
    var wrapper = $(".input_fields_wrap"); // Fields wrapper
    var x = <?php echo $x; ?> ; //initlal text box count
    
    $(document).ready(function() {
        var add_button = $(".add_field_button"); // Add button ID
        if(typeof(x)  === "undefined"){
            x=1;
         }

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

    //    return ;
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
      $(".job_info").click(function(event) {
        event.preventDefault();
            $(this).parent('div').remove();
    });

    $(document).on('change', ".position" ,function () {
    //    check if its checked. If checked move inside and check for others value
    //    alert(this.checked && this.value);
            if (this.checked && this.value === "Other Position") {
                //show a text box
                $(".other-text").show();
            } 
            else if (!this.checked && this.value === "Other Position"){
            //      hide the text box
            //      $(this).closest('.add_job').html();
            //      console.log($(this).closest('.add_job').filter('.other-tex').html());
                $(".other-text").hide();
            }
        });
    });


</script>
@endsection

