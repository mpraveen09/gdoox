@extends('layout.backend.masterbase')

@section('meta')
        @if(isset($product->seo_title))
            <title>{!! $product->seo_title !!}</title>
        @else
            <title>GDoox - Re-Inventing eCommerce</title>
        @endif
        
        @if(isset($product->seo_description))
            <meta name="description" content="{!! $product->seo_description !!}">
        @else
            <meta name="description" content="Gdoox is a powerful  ecosystem platform. Its the e-commerce new frontier where over 200 business sectors containing more than 25.000  products categories organized by plant machinery equipment, products and services allow you to trade in any distribution channel. Sharing economy at your finger.">
        @endif
        
        @if(isset($product->seo_keywords))
            <meta name="keywords" content="{!! $product->seo_keywords !!}">
        @else
            <meta name="keywords" content="GDoox, Online Shopping, Re-Inventing eCommerce, ecommerce">
        @endif

        <meta property="og:title" content="GDoox - Re-Inventing eCommerce" />
	<meta property="og:description" content="Gdoox is a powerful  ecosystem platform. Its the e-commerce new frontier where over 200 business sectors containing more than 25.000  products categories organized by plant machinery equipment, products and services allow you to trade in any distribution channel. Sharing economy at your finger." />
@endsection



@section('header-logo-url')
    {{ URL::to('/') }}
@endsection

@section('header-logo')
    {{ asset('images/gdoox.png') }}
@endsection


@section('left_col')
    @if(Auth::user())
        <div class="profile-menu">
             <a href="">
                 <div class="profile-pic">
                     <!--<img src="{{ asset('/m-admin-ui/img/profile-pics/1.jpg')}}" alt="">-->
                     <img src="@yield('profile_pic')" alt="@yield('profile_name')" >
                 </div>
                 <div class="profile-info">
                     @yield('profile_name')
                     <i class="zmdi zmdi-caret-down"></i>
                 </div>
             </a>

             <ul class="main-menu">
                 <li>
                     <a href="{!! route('personal-info-create')!!}"><i class="zmdi zmdi-account"></i> View Profile</a>
                 </li>

                 <li>
                     <a href="{!! route('profile-index')!!}"><i class="zmdi zmdi-input-antenna"></i> Privacy Settings</a>
                 </li>
    <!--             <li>
                     <a href=""><i class="zmdi zmdi-settings"></i> Settings</a>
                 </li>-->
                 <li>
                     <a href="{!! URL::to('auth/logout')!!}"><i class="zmdi zmdi-lock-outline zmdi-hc-fw"></i> Logout</a>
                 </li>
             </ul>
         </div>
    @endif
    
    
        <?php
            use Gdoox\Helpers\UUID ;
            use Gdoox\Models\ShoppingCart;
            use Gdoox\Models\BusinessEcommerceCompany;
            use Gdoox\Models\PersonalSiteDetail;
            
            if(!isset($_COOKIE['gdoox_shopping_cart']) || empty($_COOKIE['gdoox_shopping_cart'])){
                $timestamp= time();
                $cookie_value= UUID::v4() . "-" . $timestamp;
                setcookie('gdoox_shopping_cart', $cookie_value, time() + (86400 * 30), "/"); 
            }
            else {
                $cookie_val = $_COOKIE['gdoox_shopping_cart'];
        
                if(Auth::user()){
                    $userid= Auth::id();
                    $total = ShoppingCart::where('userid','=', $userid)->orwhere('cart_id','=', $cookie_val)->where('status','=','0')->count('product_id');
                }
                else {
                    $total = ShoppingCart::where('cart_id','=', $cookie_val)->where('status','=','0')->count('product_id'); 
                }
                session(['cart_items' => $total]); 
            }  
        ?>

    <ul class="main-menu side-main-menu">
      @if(Auth::user())
      <?php
        if(Auth::user()->hasRole('user')){
            $site_info = PersonalSiteDetail::where('user_id', Auth::user()->id)->project('slug')->first();
            if(!empty($site_info->slug)) {
              echo '<li><a class="nav-red" href="'.URL::to('/site/') .'/'. $site_info->slug . '">View My Site <i class="zmdi zmdi-view-web"></i></a></li>';
            }
            else {
                  echo '<li><a class="nav-red" href="#">View My Site <i class="zmdi zmdi-view-web"></i></a></li>';
            }
        }
        elseif(Auth::user()->hasRole('multi-site-admin')){
          echo '<li><a class="nav-red" href="'. route('ecomm-index') . '">View My Sites <i class="zmdi zmdi-view-web"></i></a></li>';
        }
        else {
          $site_info = BusinessEcommerceCompany::where('type', '=', 'business')->where('user_id',Auth::user()->id)->project('slug')->first();
          if(!empty($site_info)) {
            echo '<li><a class="nav-red" href="'.URL::to('/site/') .'/'. $site_info->slug . '">View My Site <i class="zmdi zmdi-view-web"></i></a></li>';
          }           
        }
      ?>            
      @endif  
      
        <li><a href="{!! route('marketplace')!!}"><i class="zmdi zmdi-mall zmdi-hc-fw"></i> Marketplace</a></li>        

        @if(Auth::user())
          @if(Auth::user()->hasRole('superadmin'))
                @include('layout.backend.navs-superadmin')        
          @endif
          @if(Auth::user()->hasRole('ecosystem-user'))
                @include('layout.backend.navs-ecosystem')        
          @endif
          @if(Auth::user()->hasRole('multi-site-user'))
                @include('layout.backend.navs-multisite')        
          @endif
          @if(Auth::user()->hasRole('multi-user'))
                @include('layout.backend.navs-multiuser')        
          @endif
          @if(Auth::user()->hasRole('mono-user'))
                @include('layout.backend.navs-monouser')
          @endif
          @if(Auth::user()->hasRole('personal-site-user'))
                @include('layout.backend.navs-personaluser')        
          @endif
          @if(Auth::user()->hasRole('team-member'))
                @include('layout.backend.navs-team-member')        
          @endif
          @if(Auth::user()->hasRole('gdoox-member'))
                @include('layout.backend.navs-gdoox-member')        
          @endif
          @if(Auth::user()->hasRole('user'))
                @include('layout.backend.navs-user')        
          @endif
          @if(Auth::user()->hasRole('company-network-user'))
                @include('layout.backend.navs-company_network')        
          @endif
          @else
          @include('layout.backend.navs-guest')        
      @endif    
    </ul>
    <br/><br/><br/><br/>
@endsection



@section('right_col_title')

<div class="block-header">
    <div class="page-help">
    <?php
        $lang = ['en' => 'en', 'it' => 'it', 'fr' => 'fr', 'de'=>'de','es'=>'es'];
        $help_text =  Gdoox\Models\PageHelp::where('route_name', \Request::route()->getName())->where('lang', 'en')->first(); 
        $str = " Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.";
    ?>
      
      
    @if(Auth::user() && Auth::user()->hasRole('superadmin'))
        <div class="panel panel-collapse">
          <div class="panel-heading" role="tab" id="page-help-one">
                <h4 class="panel-title clearfix ">
                  <a href="#" class="col-md-6" >
                        @if(!empty($help_text->help_title))
                        <p class="instruction_title">{!!$help_text->help_title!!}</p>
                        @else
                          <p class="instruction_title">  Page Help / Instructions</p>
                        @endif
                        <?php $data = !empty($help_text->help_title) ? $help_text->help_title : "Page Help / Instructions";?>
                        {!!Form::text('help_title', $data, ['class' => 'help_title', 'style' => 'display:none'])!!}
                    </a>
                  <a data-toggle="collapse" data-parent="#accordion" href="#page-help-collapse-one" aria-expanded="true" aria-controls="page-help-collapse-one" class="col-md-6 text-right edit-btn" >Edit</a>
                  <button id="save_help_btn" class="btn btn-primary save-btn  waves-effect pull-right" style="display:none;" type="submit" onclick="setHelpContent();"  >Save</button>
                  {!!Form::select('lang', $lang, 'en', ['id'=>'lang','placeholder' => '-select language-', 'class' => 'btn btn-default save-btn  waves-effect pull-right help_data', 'style' => 'display:none;'])!!}
                </h4>
          </div>
          
          <div id="page-help-collapse-one" class="collapse" role="tabpanel" aria-labelledby="page-help-one">
                <div class="panel-body">
                    <?php $help_data = !empty($help_text->help_text) ? stripslashes($help_text->help_text) : $str;?>
                        {!! Form::hidden('help_text', $help_data, array('class'=>'help_text', 'id'=>'help_text')) !!}
                        <div class="html-editor-help"></div>
                </div>
                <div class="text-right"></div>
          </div>
        </div>
      @else
        <div class="panel panel-collapse ">
          <div class="panel-heading" role="tab" id="page-help-one">
            <h4 class="panel-title clearfix">
              <a class="col-md-6">
              @if(!empty($help_text->help_title))
              {!!$help_text->help_title!!}
              @else
                  Page Help / Instructions
              @endif
              </a>
              <a data-toggle="collapse" data-parent="#accordion" href="#page-help-collapse-one" aria-expanded="true" aria-controls="page-help-collapse-one" class="col-md-6  text-right">
                View
              </a>
            </h4>
          </div>
          <div id="page-help-collapse-one" class="collapse" role="tabpanel" aria-labelledby="page-help-one">
            <div class="panel-body">
              @if(!empty($help_text->help_text))
              {!!stripslashes($help_text->help_text)!!}
              @else
                 {!!$str!!}   
              @endif
            </div>
          </div>
        </div>
      @endif
    </div>
    
    
    @yield('right_col_title_left')
    <div class="block-header-actions">
        @yield('right_col_title_right')
    </div>
</div>
@endsection


@section('right_col')
<!--page content-->
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
@endsection

@section('footer')
        <ul class="f-menu">
            <li><a href="">Home</a></li>
            <li><a href="">Dashboard</a></li>
            <li><a href="">Reports</a></li>
            <li><a href="">Support</a></li>
            <li><a href="">Contact</a></li>
            <li><a href="">Privacy Policy</a></li>
            <li><a href="">Terms Of Use</a></li>
        </ul>

        <div class="">
            <p class="">
                <span class=""> Copyright &copy; {{ date('Y') }} Gdoox</span>
            </p>
        </div>
@endsection
@section('footer_add_js_script')
<script type="text/javascript">
    $(function(){
        $.ajax({
            url:"{!! route('alertsytem.index') !!}",
            type:'POST',
            success:function(data){
                  $('#user_alerts').html(data);
            }
        });
    });
</script>

@endsection
@section('custom_notifications')
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
@endsection

