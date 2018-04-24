@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <!--<h2>Business Ecosystem</h2>-->
    <!--<div class="page-top-links">-->
    <!--</div>-->
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')

@if (Session::has('message'))
    <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
@endif

@if (HTML::ul($errors->all()))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {!! HTML::ul($errors->all()) !!}
    </div>
@endif

   @include('navigation_tabs.network_tabs')

    <div class="row">
        <div class="col-md-12">
          <div class="card">
              <div class="card-header card-padding-sm bgm-blue head-title">
                  <h2><i class="zmdi zmdi-account m-r-5"></i> Select Company</h2>
                  <button onclick="goBack()" style="float: right;" class="btn waves-effect">Back</button>
              </div>
              @if(count($networks))
                <div class="card-body card-padding">
                    {!! Form::model($fm_data, [
                        'method' => 'GET',
                        'route' => ['company.network.store.site'],
                        'class' => 'form-horizontal form-label-left',
                        ]) !!}
                      
                        @if(!empty($networks))
                            <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                                <table class="table table-striped responsive-utilities jambo_table ">
                                     <tbody>
                                        @foreach($networks as $key=>$value)
                                            <tr><td>{!! Form::radio('network_site', $value) !!} {!! $value !!}</td></tr>
                                        @endforeach
                                      </tbody>
                                 </table>             
                            </div>

                            @if (!empty($fm_data->labels['submit']))
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                                         <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['save']!!}</button>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">No Sites Available to Assign to Comapny Network</div>
                            </div>
                        @endif
                      {!! Form::close() !!}
                </div>
              @else
                <div class="card-body card-padding">
                    <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                         You have no more sites to be assigned as Network Sites.
                    </div>
                </div> 
              @endif
          </div>    
            
            
            <div class="card">
                <div class="card-header bgm-blue head-title">
                    <h2>Company Network</h2>
                </div><!-- .card-header -->
    
                <div class="card-body card-padding">
                    @if(!$network_sites->count())
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            You have no Network Company Sites linked to your Company.
                        </div>    
                    @else

                    <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                         <table class="table  ">
                             <thead>
                                 <tr>
                                     <th>YOUR BUSINESS COMPANY</th>
                                     <th>Verify Company</th>
                                     <th>Add Site</th>
                                     <th>E-commerce Sites</th>
                                     <th>Company Partners</th>
                                 </tr>
                             </thead>
                             <tbody>    
                             @foreach($companies as $company )
                                 <tr>
                                    <td>
                                        {!! $company->company_name!!}&nbsp;&nbsp;
                                        <a href="{!! route('business-info-show', $company->_id)  !!}" data-toggle="tooltip" data-placement="bottom" title="view"><i class='zmdi zmdi-eye zmdi-hc-fw'></i></a> &nbsp; 
                                        <a href="{!! route('business-info-edit', $company->_id)  !!}"data-toggle="tooltip" data-placement="bottom" title="Edit"><i class='zmdi zmdi-edit zmdi-hc-fw'></i></a>
                                        <br/>({!! ($company->status)!!}) 
                                    </td>
                                    <td class="verify_busi">
                                           {!! ($company->verify)!!}
                                             @if($company->verify!='Verified')
                                             <ul class="actions btn-default">
                                                 <li class="dropdown">
                                                     <a data-toggle="dropdown" href="" aria-expanded="false">
                                                         <i class="zmdi zmdi-more-vert"></i>
                                                     </a>

                                                     <ul class="dropdown-menu dropdown-menu-right">
                                                         <li>
                                                             <a href="{!! route('verify-fiscalvat-edit', $company->_id)  !!}">Verify with Fiscal ID & Vat Number</a>
                                                         </li>
                                                         <li>
                                                             <a href="{!! route('verify-documents-edit', $company->_id)  !!}">Verify with Company Documents</a>
                                                         </li>
                                                     </ul>
                                                 </li>
                                             </ul>                        
                                             @endif
                                     </td>
                                     <td>
                                         <a href="{!!route('company.network.assign.site', ['company' => $company->company_name])!!}" class="" data-toggle="tooltip" data-placement="bottom" title="Add New">
                                             <button class="btn btn-default btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-plus zmdi-hc-fw"></i></button>                        
                                         </a>
                                     </td>
                                     <td>
                                         <table class="table">
                                           <thead>
                                             <tr>
                                                 <th>Site Name</th><th>Site Slug</th><th>Site Admin</th><th>Action</th>
                                             </tr>
                                           </thead>
                                           <tbody>
                                            @foreach($network_sites as $site)
                                                @if($site->user_id ==  $company->user_id)
                                                   <tr>
                                                       <td><a href="{!! URL::to('/site/') !!}/{!! $site->network_site !!}">{!! $site->network_site !!}</a></td>
                                                       <td>{!! $site->network_site !!}</td>
                                                       <td>
                                                           @if(array_key_exists($site->network_site, $admins))
                                                               {!! implode (", ", $admins[$site->network_site]); !!}
                                                           @endif
                                                       </td>
                                                       <td>
                                                           <a href="{!! route('company.network.assign.site', ['site' => $site->network_site]) !!}">Edit/View</a>
                                                       </td>
                                                   </tr>
                                                 @endif
                                            @endforeach
                                           </tbody>
                                         </table>
                                     </td>
                                     <td>
                                         @foreach($network_partner as $partner)
                                            <div>
                                                {!! $partner->ecomm_company_name !!} <br /> 
                                                <a href="{!! URL::to('/site/') !!}/{!! $partner->slug !!}">{!! $partner->slug !!}</a>
                                            </div>
                                         <br />
                                         @endforeach
                                     </td>  
                                 </tr>  
                             @endforeach
                             </tbody>
                         </table>
                    </div>
                    @endif
                </div>
            </div>
            
        @if($term == 1)
            <div class="card">
                <div class="card-header bgm-blue">
                    <h2>{!!$fm_data->labels['heading']." ".$fm_data->labels['create']!!}</h2>
                </div><!-- .card-header -->
                <div class="card-body card-padding">    
                  {!! Form::open(array('route' => 'company.network.add.site','method'=>'POST ', 'class'=>'form-horizontal form-label-left', 'files'=>true)) !!}

                      {!! Form::hidden('user_id', Auth::user()->id) !!}
                      {!! Form::hidden('type', 'business') !!}
                      @if (!empty($fm_data->labels))
                          <div class="form-group clearfix">
                              @if(!empty($fm_data->labels['ecomm_company_name']))
                                   {!! Form::label('ecomm_company_name', $fm_data->labels['ecomm_company_name'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                  {!! Form::text('ecomm_company_name', null, array('required','placeholder' =>$fm_data->labels['ecomm_company_name'],'class'=>'form-control','id'=>'estore_title')) !!}
                                  </div>    
                              @endif
                          </div>

                          <div class="form-group clearfix">
                              @if(!empty($fm_data->labels['slug']))
                                   {!! Form::label('slug', $fm_data->labels['slug'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                  {!! Form::text('slug', null, array('required','placeholder' =>$fm_data->labels['slug'],'class'=>'form-control', 'id'=>'estore_slug')) !!}
                                  </div>    
                              @endif
                          </div>

                      <div class="form-group clearfix">
                              @if(!empty($fm_data->labels['email']))
                                   {!! Form::label('email', $fm_data->labels['email'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                  {!! Form::email('email', null, array('required','placeholder' =>$fm_data->labels['email'],'class'=>'form-control')) !!}
                                  </div>    
                              @endif
                      </div>

                      <div class="form-group clearfix">
                          @if(!empty($fm_data->labels['company']))
                               {!! Form::label('company', $fm_data->labels['company'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::text('company',$ecom, array('required', 'readonly', 'placeholder' =>'---', 'class'=>'form-control')) !!}
                              </div>    
                          @endif
                      </div>
                      <div class="form-group clearfix">
                            {!! Form::label('business_desc_tags', "Business Description Tags".$required, array('id' => '', 'class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                             <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::text('business_desc_tags', null, array('required', 'id' => "tags_1", 'class'=>'form-control tags')) !!}
                           </div>    
                       </div>

                      <div class="form-group clearfix">
                            {!! Form::label('brands', "Brands You Deal".$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                             <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::text('brands', null, array('required', 'id' => "tags_2", 'class'=>'form-control tags')) !!}
                           </div>    
                       </div>

                        <div class="row">
                            <div class="col-sm-12">
                                {!! Form::label('policy_doc','Return Policy Document',array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <span class="btn btn-primary btn-file m-r-10">
                                        <span class="fileinput-new">Select policy document</span>
                                        <span class="fileinput-exists">Change</span>
                                        {!! Form::file('policy_doc') !!}
                                    </span>
                                    <span class="fileinput-filename"></span>
                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                                    <br/><br/>
                                    <h5>Or</h5>
                                  {!! Form::textarea('policy_doc_data', null, array('placeholder' =>'Your return policy, maximum 1000 characters', 'class'=>'form-control')) !!}
                                </div>
                            </div>
                        </div>
                      <div class="form-group clearfix">
                                {!! Form::label('market', "Your Market", array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                 <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::select('market', $market, null, array( 'multiple', 'class'=>'form-control selectpicker')) !!}
                               </div>    
                       </div>


                      <div class="form-group">
                              @if (!empty($fm_data->labels['submit']))
                                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                                      {!!HTML::linkRoute('ecomm-index', $fm_data->labels['cancel'], array(), array('class'=>"btn btn-round btn-primary"))!!}
                                       <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['save']!!}</button>
                                  </div>
                              @endif
                          </div>
                         @endif
                    {!! Form::close() !!}
                </div>
            </div>    
        @endif
        
        @if($term == 2)
            <div class="card">
                <div class="card-header bgm-blue">
                    <h2>{!!$fm_data->labels['heading']." ".$fm_data->labels['create']!!}</h2>
                </div><!-- .card-header -->
                <div class="card-body card-padding">    
                  {!! Form::model($ecompany, [
                        'method'=>'PUT', 
                        'route' =>['company.network.update.site', 'id'=>$ecompany->id], 
                        'class'=>'form-horizontal form-label-left',
                        'files'=>true]) 
                  !!}

                      {!!Form::hidden('user_id', Auth::user()->id)!!}

                      @if (!empty($fm_data->labels))

                          <div class="form-group clearfix">
                              @if(!empty($fm_data->labels['ecomm_company_name']))
                                   {!! Form::label('ecomm_company_name', $fm_data->labels['ecomm_company_name'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                  {!! Form::text('ecomm_company_name', $ecompany->ecomm_company_name, array('required','placeholder' =>$fm_data->labels['ecomm_company_name'],'class'=>'form-control','id'=>'estore_title')) !!}
                                  </div>    
                              @endif
                          </div>

                          <div class="form-group clearfix">
                              @if(!empty($fm_data->labels['slug']))
                                   {!! Form::label('slug', $fm_data->labels['slug'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                  {!! Form::text('slug', $ecompany->slug, array('readonly', 'placeholder' =>$fm_data->labels['slug'], 'class'=>'form-control', 'id'=>'estore_slug')) !!}
                                  </div>    
                              @endif
                          </div>

                      <div class="form-group clearfix">
                            @if(!empty($fm_data->labels['email']))
                                 {!! Form::label('email', $fm_data->labels['email'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::email('email', $ecompany->email, array('required','placeholder' =>$fm_data->labels['email'],'class'=>'form-control')) !!}
                                </div>    
                            @endif
                      </div>

                        <div class="form-group clearfix">
                            @if(!empty($fm_data->labels['company']))
                                 {!! Form::label('company', $fm_data->labels['company'].$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::text('company',$ecom,  array('required', 'readonly', 'placeholder' =>'---', 'class'=>'form-control')) !!}
                                </div>    
                            @endif
                        </div>


                      <div class="form-group clearfix">
                            {!! Form::label('business_desc_tags', "Business Description Tags".$required, array('id' => '', 'class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                             <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::text('business_desc_tags', $ecompany->business_desc_tags, array('required', 'id' => "tags_1", 'class'=>'form-control tags')) !!}
                           </div>    
                       </div>

                      <div class="form-group clearfix">
                            {!! Form::label('brands', "Brands You Deal".$required, array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                             <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::text('brands', $ecompany->brands, array('required', 'id' => "tags_2", 'class'=>'form-control tags')) !!}
                           </div>    
                       </div>

                        <div class="row">
                            <div class="col-sm-12">
                                {!! Form::label('policy_doc','Return Policy Document',array("class"=>"control-label  col-md-3 col-sm-3 col-xs-12"))!!}
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <span class="btn btn-primary btn-file m-r-10">
                                        <span class="fileinput-new">Select policy document</span>
                                        <span class="fileinput-exists">Change</span>
                                        {!! Form::file('policy_doc') !!}
                                    </span>
                                    <span class="fileinput-filename"></span>
                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>

                                    @if(!empty($ecompany->policy_doc))
                                           <?php $img = $ecompany->doc_path.$ecompany->policy_doc;?>

                                           <a href="{!!asset($img)!!}">{!!$ecompany->policy_doc!!}</a>
                                     @elseif(!empty($ecompany->policy_doc_data))
                                         <br/> <br/>
                                         <h5>Or</h5>
                                         {!! Form::textarea('policy_doc_data', $ecompany->policy_doc_data, array('placeholder' =>'Your return policy, maximum 1000 characters', 'maxlength' => '1000', 'class'=>'form-control')) !!}
                                     @endif
                                   <br/>
                                </div>
                            </div>
                        </div>
                      <div class="form-group clearfix">
                                {!! Form::label('market', "Your Market", array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                                 <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::select('market[]', $market, $ecompany->market, array( 'multiple', 'class'=>'form-control selectpicker')) !!}
                               </div>    
                       </div>


                          <div class="form-group">
                              @if (!empty($fm_data->labels['submit']))
                                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                                      {!!HTML::linkRoute('ecomm-index', $fm_data->labels['cancel'], array(), array('class'=>"btn btn-round btn-primary"))!!}
                                       <button id="send" type="submit" class="btn btn-round btn-success">{!!$fm_data->labels['save']!!}</button>
                                  </div>
                              @endif
                          </div>
                         @endif
                    {!! Form::close() !!}
                </div>
            </div>  
        @endif
        
        
        
    </div>      
</div>
@endsection
@section('footer_add_js_files') 
        <script src="{{ asset('/m-admin-ui/vendors/fileinput/fileinput.min.js') }}"></script>
        <script src="{{ asset('/m-admin-ui/vendors/input-mask/input-mask.min.js') }}"></script>
        <script src="{{ asset('/js/jquery.tagsinput.js') }}"></script>
@endsection       
@section('footer_add_js_script')
<script type="text/javascript">
   $(document).ready(function(){
       <?php if($term == 1 || $term == '1'){ ?>
        $("#estore_title").keyup(function(){
              var Text = $(this).val();
              Text = Text.toLowerCase();
              Text = Text.replace(/\s/g, '');
              $("#estore_slug").val(Text);
        });  
       <?php } ?>
   });
</script>
<script type="text/javascript">
    function goBack() {
        window.history.back();
    }
    function onAddTag(tag) {
            alert("Added a tag: " + tag);
    }
    function onRemoveTag(tag) {
            alert("Removed a tag: " + tag);
    }
    function onChangeTag(input,tag) {
            alert("Changed a tag: " + tag);
    }

    $(function() {
        $('#tags_1').tagsInput({width:'auto'});
        $('#tags_2').tagsInput({
            width: 'auto',
            onChange: function(elem, elem_tags) {
                var languages = [];
                $('.tag', elem_tags).each(function() {
                    if($(this).text().search(new RegExp('\\b(' + languages.join('|') + ')\\b')) >= 0)
                    $(this).css('background-color', 'yellow');
                });
            }
        });
    });

</script>
@endsection
