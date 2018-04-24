<div class="row">
  <div class="col-md-12 company-site-head">
      <h4>Welcome to <span>
            @if(isset($storename->ecomm_company_name))
                {!!  $storename->ecomm_company_name !!}
            @elseif(isset($personalsitedetails->site_name))
                {!!  $personalsitedetails->site_name !!}
            @elseif(isset($personalsitedetails->general_info) )
                @if(!empty($personalsitedetails->general_info['first_name']) )
                  {{ $personalsitedetails->general_info['first_name'] }} 
                @endif
                <!--@if(!empty($personalsitedetails->general_info['second_name']) )
                  {{ $personalsitedetails->general_info['second_name'] }} 
                @endif-->
                @if(!empty($personalsitedetails->general_info['surname']) )
                  {{ $personalsitedetails->general_info['surname'] }} 
                @endif                      
            @endif
                    
          </span> site</h4>
  </div>
</div>

<nav class="navbar navbar-default user-site-menu">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ URL::to('/site/') }}/{!!  $shopid !!}"><i class="zmdi zmdi-home"></i></a>
    </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
   
  <?php // echo "<pre>"; print_r($site_menu); exit; ?>
  
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
  <ul class="nav navbar-nav">
    @if(!empty($personalsitedetails->type) && $personalsitedetails->type === 'personal')
      @if(!empty($site_menu))
        @foreach($site_menu->labels as $key=>$value)
<!--      ($key === 'aboutus' || $key === 'product-catalog' || $key === 'contact-us' || $key === 'companies-involved')-->
          @if($key === 'product-catalog' || $key === 'contact-us' || $key === 'companies-involved')
          @else 
            <li class="">
                <a href="{!! URL::to('/site/') !!}/{!!  $shopid !!}/page/{!! $key !!}">{!! $value !!}</a>
            </li>
          @endif
        @endforeach
      @endif
    @else
      @if(!empty($site_menu))
        @foreach($site_menu->labels as $key => $value)
        @if($storename->type === 'business')
<!--      ($key === 'aboutus' || $key === 'product-catalog' || $key === 'contact-us' )-->
          @if($key === 'product-catalog' || $key === 'contact-us' )
            <li class="">
              <a href="{!! URL::to('/site/') !!}/{!!  $shopid !!}/page/{!! $key !!}">{!! $value !!}</a>
            </li>
          @endif
        @elseif( $storename->type === 'business_ecosystem')
<!--      ($key === 'aboutus' || $key === 'product-catalog' || $key === 'contact-us' || $key === 'companies-involved')-->
          @if($key === 'product-catalog' || $key === 'contact-us' || $key === 'companies-involved')
            <li class="">
              <a href="{!! URL::to('/site/') !!}/{!!  $shopid !!}/page/{!! $key !!}">{!! $value !!}</a>
            </li>
          @endif
        @endif
       @endforeach
      @endif
      @foreach($cmspages as $cmspage)
        <li class="">
          <a href="{!! URL::to('/site/') !!}/{!!  $shopid !!}/page/{!! preg_replace('/[^a-zA-Z]+/', '', $cmspage->page_title) !!}/{!! $cmspage->id !!}">
            {!! $cmspage->page_title !!}
          </a>
        </li>
      @endforeach

<!--            <li class="">
         <a href="{!! URL::to('/site/') !!}/{!!  $shopid !!}/page/businessinfo">
           About Us
         </a>
       </li>
       <li class="">
         <a href="{!! URL::to('/site/') !!}/{!!  $shopid !!}/page/product-catalog">
           Product Catalog
         </a>
       </li> 
       <li class="">
         <a href="{!! URL::to('/site/') !!}/{!!  $shopid !!}/page/contact-us">
           Contact Us
         </a> 
      </li> -->
    @endif
  </ul>

      @if( !empty($business->type) && $business->type !== "personal" )
  <!--<div class="col-sm-10 col-md-5">-->
      {!! Form::model('$products_list', [
          'method' => 'GET',
          'route' => ['site', $shopid],
          'class' => 'form-label-left clearfix',
          'novalidate'=>''
      ]) !!} 
        <div  class="navbar-form navbar-right" role="search">
          <div class="form-group">
            {!! Form::text('keyword','',array('','placeholder'=>'Search...',
            'class'=>'form-control searchshopcategories'))!!}
          </div>
            <button class="btn btn-default"><i class="zmdi zmdi-search"></i></button>
        </div>
      
       {!! Form::close() !!}
   <!--</div>-->
  @endif
<!--  @if(Auth::user())
      <div class="navbar-header pull-right">
        <ul class="actions">
          <li class="dropdown">
              <a href="" data-toggle="dropdown">
                  <i class="zmdi zmdi-more-vert"></i>
              </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a href="">Hi {!!Auth::user()->username!!}</a>
                    </li>
                    <li>
                        <a href="">Invite</a>
                    </li>
                </ul>
          </li>
        </ul>
      </div> 
    @endif-->
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
