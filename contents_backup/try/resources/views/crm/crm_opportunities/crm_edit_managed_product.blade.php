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
    <!-- if there are creation errors, they will show here -->
    @if (HTML::ul($errors->all()))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {!! HTML::ul($errors->all()) !!}
        </div>
    @endif
    
    @include('navigation_tabs.crm_tabs')
    
    <div class="card">
         <div class="card-header bgm-blue head-title">
                <h2>Update Opportunity</h2>
         </div><!-- .card-header -->
         
          {!! Form::open([
                 'method' => 'POST',
                 'route' => ['ab_cart_opportunities.update',$id],
                 'class' => 'form-horizontal form-label-left'
             ]) !!}
             

            <div class="card-body card-padding">
                <div class="item form-group">
                    {!! Form::label('product_name', $form_fields->labels['product_name'], ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('product_name',$opportunity->product_name, ['placeholder'=>$form_fields->labels['product_name'],'class' => 'form-control col-md-7 col-xs-12','readonly']) !!}
                    </div>
                </div>
                
                <div class="item form-group">
                    {!! Form::label('email', $form_fields->labels['email'], ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('email',$opportunity->email, ['placeholder'=>$form_fields->labels['email'],'class' => 'form-control col-md-7 col-xs-12','readonly']) !!}
                    </div>
                </div>
                
                <div class="item form-group">
                    {!! Form::label('opportunity_name', $form_fields->labels['opportunity_name'], ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('opportunity_name',$opportunity->opportunity_name, ['placeholder'=>$form_fields->labels['opportunity_name'],'class' => 'form-control col-md-7 col-xs-12']) !!}
                    </div>
                </div>
                
                <div class="item form-group">
                    {!! Form::label('currency',$form_fields->labels['currency'], ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::select('currency',$currency, $opportunity->currency ,array('class'=>'form-control col-md-7 col-xs-12','readonly')) !!}
                    </div>
                </div>

                <div class="item form-group">
                    {!! Form::label('opportunity_amt', $form_fields->labels['opportunity_amt'], ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('opportunity_amt', $opportunity->opportunity_amt, ['readonly','placeholder'=>$form_fields->labels['opportunity_amt'],'class' => 'form-control col-md-7 col-xs-12']) !!}
                    </div>
                </div>
                
                <div class="item form-group">
                    {!! Form::label('excected_closing_date', $form_fields->labels['excected_closing_date'], ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::date('excected_closing_date', $opportunity->excected_closing_date, ['placeholder'=>$form_fields->labels['excected_closing_date'],'class' => 'form-control col-md-7 col-xs-12']) !!}
                    </div>
                </div>
                
                <div class="item form-group">
                    {!! Form::label('type',$form_fields->labels['type'], ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::select('type',$business_type, $opportunity->type, array('placeholder'=>'-- Select Business Type --','class'=>'form-control col-md-7 col-xs-12')) !!}
                    </div>
                </div>
                
                <div class="item form-group">
                    {!! Form::label('sales_stage',$form_fields->labels['sales_stage'], ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::select('sales_stage',$sales_stage, $opportunity->sales_stage, array('placeholder'=>'-- Select Sales Stage --','class'=>'form-control col-md-7 col-xs-12')) !!}
                    </div>
                </div>
                
                <div class="item form-group">
                    {!! Form::label('lead_source',$form_fields->labels['lead_source'], ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::select('lead_source',$lead_source, $opportunity->lead_source, array('placeholder'=>'-- Select Lead Source --','class'=>'form-control col-md-7 col-xs-12')) !!}
                    </div>
                </div>
                
                <div class="item form-group">
                    {!! Form::label('probability', $form_fields->labels['probability'], ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('probability', $opportunity->probability, ['class' => 'form-control col-md-7 col-xs-12']) !!}
                    </div>
                </div>
                
                <div class="item form-group">
                    {!! Form::label('next_step', $form_fields->labels['next_step'], ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('next_step', $opportunity->next_step, ['class' => 'form-control col-md-7 col-xs-12']) !!}
                    </div>
                </div>
                
                <div class="item form-group">
                    {!! Form::label('discussion', $form_fields->labels['discussion'], ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('discussion', $opportunity->discussion, array('id'=>'discussion','class'=>'form-control'))!!}
                    </div>
                </div>
                
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-5">
                       <a href="{!! route('crm_opportunities.index')  !!}" type="submit" class="btn btn-round btn-primary">Cancel</a>
                       <button id="send" type="submit" class="btn btn-round btn-success">Save</button>
                    </div>
                </div> 
                <div class="ln_solid"></div>
            </div>
         {!! Form::close() !!}
    </div>

@endsection

@section('footer_add_js_script')
<script>
function goBack() {
    window.history.back();
}
</script>
@endsection


