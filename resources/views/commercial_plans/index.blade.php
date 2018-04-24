    @extends('layout.backend.master')
    
    @section('header_custom_css')        
    <!--header_custom_css-->
    <link href="{{ asset('/js/bxslider/bxslider.css') }}" rel="stylesheet">
    <style>
      .bx-wrapper .bx-viewport {
        border: 0px solid #fff !important;
        left: 0 !important;
      }
      .bx-wrapper .bx-viewport li {
        left: 0 !important;
      }
      .bx-wrapper .bx-viewport li img{
        width: 100% !important;
      }
    </style>  
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
        
        .block-header{
          display: none
        }
        
    </style>    
    
    
<style>
      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */


.card-body-plans table { width: 100%; text-align: left; border-spacing: 0; border-collapse: collapse; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; }

th, td { font-family: inherit; line-height: 1.45; color: #444; vertical-align: middle; padding: 1em; }
th { font-weight: 600; font-size: .875em; }
th { font-weight: 600; font-size: 1em; }

/*colgroup:nth-child(1) { width: 31%; border: 0 none; }
colgroup:nth-child(2) { width: 22%; border: 1px solid #ccc; }
colgroup:nth-child(3) { width: 25%; border: 10px solid #59c7fb; }
colgroup:nth-child(4) { width: 22%; border: 1px solid #ccc; }*/

colgroup { width: 15%; border: 1px solid #ccc; }
colgroup:nth-child(1) { width: 25%; border: none }


/* Tablehead */

thead th { background: #def4fe; background: -moz-linear-gradient(top,  #ffffff 0%, #f5f5f5 100%); background: -webkit-linear-gradient(top,  #ffffff 0%,#f5f5f5 100%); background: -o-linear-gradient(top,  #ffffff 0%,#f5f5f5 100%); background: -ms-linear-gradient(top,  #ffffff 0%,#f5f5f5 100%); background: linear-gradient(to bottom,  #ffffff 0%,#f5f5f5 100%); text-align: center; position: relative; border-bottom: 1px solid #ccc;  font-weight: 400; color: #999; }
thead th:nth-child(1) { background: transparent;  }
/*thead th:nth-child(3) {  padding: 2em 0 5em; }*/
thead th h2 { font-weight: 300; font-size: 2.4em; line-height: 1.2; color: #f44336; }
thead th h2 + p { font-size: 1.25em; line-height: 1.4; }
/*thead th:nth-child(3) h2 { font-size: 3.6em; }
thead th:nth-child(3) h2 + p { font-size: 1.5em; }*/

thead th p.promo { font-size: 1em; color: #fff; position: absolute; top: 9em; left: -17px; z-index: 1000; width: 100%; margin: 0; padding: .625em 17px .75em; background: #c00; box-shadow: 0 2px 4px rgba(0,0,0,.25); border-bottom: 1px solid #900; }

thead th p.promo:before { content: ""; position: absolute; display: block; width: 0px; height: 0px; border-style: solid; border-width: 0 7px 7px 0; border-color: transparent #900 transparent transparent; bottom: -7px; left: 0; }
thead th p.promo:after { content: ""; position: absolute; display: block; width: 0px; height: 0px; border-style: solid; border-width: 7px 7px 0 0; border-color: #900 transparent transparent transparent; bottom: -7px; right: 0; }

/* Tablebody */

tbody th { background: #fff; border-left: 1px solid #ccc; }
tbody th span { font-weight: normal; font-size: 87.5%; color: #999; display: block; }

tbody td { background: #fff; text-align: center; }

tbody tr:nth-child(even) th,
tbody tr:nth-child(even) td { background: #f5f5f5; border: 1px solid #ccc; border-width: 1px 0 1px 1px; }
tbody tr:last-child td { border-bottom: 0 none; }

/* Tablefooter */

tfoot th  { padding: 2em 1em; border-top: 1px solid #ccc; }
tfoot td  { text-align: center; padding: 2em 1em; border-top: 1px solid #ccc; }

tfoot a  { font-weight: bold; color: #fff; text-decoration: none; text-transform: uppercase; display: block; padding: 1.125em 2em; background: #59c7fb; border-radius: .5em; }
	
.plan_pricing{
    font-weight: bold; color: #c00;
    font-size: 150%;
}
.plan_pricing_{
    font-weight: bold; color: #c00;
    font-size: 100%;
}
.headline_{
    font-style:italic;
    font-weight: bold;
    display: block;
    color: inherit;
    text-decoration: underline;
    text-transform: uppercase;
    font-size: 100%;
}

    </style>
    
    
    @endsection

    @section('header-logo-url')
    {{ URL::to('marketplace') }}
    @endsection
    
    @section('right_col_title_left')
        <!--<h2>Gdoox Marketplace</h2>-->
    @endsection


    @section('right_col_title_right')
<!--    <br>
    <br>-->
    <!--<button onclick="goBack()" class="btn btn-primary waves-effect">Back</button>-->
    @endsection
    
    @section('right_col')

    <div class="card site-banners">
        <div class="card-body">
          <ul class="bannerslider">
            <li><img src="{{ asset('images/welcome.jpg') }}" alt="" ></li>
          </ul>
        </div>
    </div>

       @if (HTML::ul($errors->all()))
           <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {!! HTML::ul($errors->all()) !!}
            </div>
       @endif
        
      <!-- will be used to show any messages -->
      @if (Session::has('message'))
          <div class="alert alert-info">{!!  Session::get('message')  !!}</div>
      @endif


        <?php
use Gdoox\Models\GdooxPlatformPlans;
use Gdoox\Models\CountrySubscriptionCharges;
use Gdoox\Models\GdooxSubscriptionInfo;
use Gdoox\Models\DropdownOption;
use Gdoox\Models\GdooxPaypalPayment;
use Gdoox\Models\GdooxSubscriptionPayments;

use Gdoox\Models\GdooxSubscriptionPlanNames;
use Gdoox\Models\GdooxSubscriptionPlans;
use Gdoox\Models\GdooxSubscriptionTypes;

        //country dropdown
        $countries =  DropdownOption::where('name','countries')->where('type','drop_down')->where('lang','en')->first();
        foreach($countries->options as $countryname){
                $country[$countryname] = $countryname;
        }

        if (!empty($_GET['country'])) {
          $countrysel =$_GET['country'];
        }else{
                $countrysel ='Italy';
        }

//echo $countrysel;
//        $GdooxSubscriptionPlans=GdooxSubscriptionPlans::distinct('subscriptiontype')->where('country','=',$countrysel)->orderBy('updated_at', 'desc')->get();
        
        //,$Subscription_Type->user_type
        $Subscription_Types =  GdooxSubscriptionTypes::orderBy('order', 'asc')->get();

        $SubscriptionPlanNames_ =  GdooxSubscriptionPlanNames::orderBy('display_order', 'asc')->get();
        foreach($SubscriptionPlanNames_ as $SubscriptionPlanName){
            if($SubscriptionPlanName->plan_id === "currency" || $SubscriptionPlanName->plan_id === "country"){
                        //$data_[$SubscriptionPlanName->plan_id][$Subscription_Type->user_type] = "&#10004;";
            }else{
                $data_[$SubscriptionPlanName->plan_id]['type'] = $SubscriptionPlanName->type;
                $data_[$SubscriptionPlanName->plan_id]['label'] = $SubscriptionPlanName->label;
    //            $data_[$SubscriptionPlanName->plan_id]=$SubscriptionPlanName->label;
                foreach($Subscription_Types as $Subscription_Type){
                    $GdooxSubscriptionPlans = GdooxSubscriptionPlans::where('subscriptiontype',$Subscription_Type->user_type)
                            ->where('country','=',$countrysel)->orderBy('updated_at', 'desc')->first();
                    if(empty($GdooxSubscriptionPlans)){
                        $GdooxSubscriptionPlans = GdooxSubscriptionPlans::where('subscriptiontype',$Subscription_Type->user_type)
                            ->where('default','=','yes')->orderBy('updated_at', 'desc')->first();
                    }


                    if($SubscriptionPlanName->type === 'head'){
    //                    if($SubscriptionPlanName->plan_id === "performance"){
    //                        $data_[$SubscriptionPlanName->plan_id][$Subscription_Type->user_type] = "&#10004;";
    //                    }else{
    //                        $data_[$SubscriptionPlanName->plan_id][$Subscription_Type->user_type] = "";
    //                    }
                        $data_[$SubscriptionPlanName->plan_id][$Subscription_Type->user_type] = "";

                    }elseif($SubscriptionPlanName->type === 'bool'){
                        if($GdooxSubscriptionPlans[$SubscriptionPlanName->plan_id] ==='Yes'){
                            $data_[$SubscriptionPlanName->plan_id][$Subscription_Type->user_type] = "&#10004;";
                        }else{
                            $data_[$SubscriptionPlanName->plan_id][$Subscription_Type->user_type] = "&#10008;";
                        }

                    }elseif($SubscriptionPlanName->type === 'num'){
                        if(strpos( strtolower($SubscriptionPlanName->label), "price") ){
                            if($GdooxSubscriptionPlans[$SubscriptionPlanName->plan_id] <= 0){
                                $data_[$SubscriptionPlanName->plan_id][$Subscription_Type->user_type] = "&mdash;";
                            }else{
                                $data_[$SubscriptionPlanName->plan_id][$Subscription_Type->user_type] = $GdooxSubscriptionPlans[$SubscriptionPlanName->plan_id] .' '. $GdooxSubscriptionPlans['currency'];
                            }
                        }elseif(strtolower($SubscriptionPlanName->plan_id) === "product_posting_up_to_included"){
							if($GdooxSubscriptionPlans[$SubscriptionPlanName->plan_id] > 0){
                            $data_[$SubscriptionPlanName->plan_id][$Subscription_Type->user_type] = $GdooxSubscriptionPlans[$SubscriptionPlanName->plan_id] . ' GB';
							}else{
								$data_[$SubscriptionPlanName->plan_id][$Subscription_Type->user_type] = '-';
							}
                        }elseif(strpos( strtolower($SubscriptionPlanName->label), "included") ){
                            if($GdooxSubscriptionPlans[$SubscriptionPlanName->plan_id] <= 0){
                                $data_[$SubscriptionPlanName->plan_id][$Subscription_Type->user_type] = "&mdash;";
                            }else{
                                $data_[$SubscriptionPlanName->plan_id][$Subscription_Type->user_type] = $GdooxSubscriptionPlans[$SubscriptionPlanName->plan_id];
                            }
                        }elseif(strtolower($SubscriptionPlanName->plan_id) === "pricing"){
                            $data_[$SubscriptionPlanName->plan_id][$Subscription_Type->user_type] = $GdooxSubscriptionPlans[$SubscriptionPlanName->plan_id] .' '. $GdooxSubscriptionPlans['currency'];
                        }else{
                            if($GdooxSubscriptionPlans[$SubscriptionPlanName->plan_id] <= 0){
                                $data_[$SubscriptionPlanName->plan_id][$Subscription_Type->user_type] = ""; 
                            }else{
                                $data_[$SubscriptionPlanName->plan_id][$Subscription_Type->user_type] = $GdooxSubscriptionPlans[$SubscriptionPlanName->plan_id];
                            }
                        }
                    }else{
                        $data_[$SubscriptionPlanName->plan_id][$Subscription_Type->user_type] = $GdooxSubscriptionPlans[$SubscriptionPlanName->plan_id];
                    }
                    //
                }
            }
            ////
        }                  
        
//        echo "<pre>";
////        var_dump($Subscription_Types);
//        var_dump($data_);
//        echo "</pre>";        
        
//exit();     
        
        
		$p1 = ""; $p2 = ""; $p3 = ""; $p4 = ""; $p5 = "";
                
/*
        $charges = CountrySubscriptionCharges::where('country', $countrysel)->first();
        if(!empty($charges)){
			
            $p1 = $charges->personal_user_price . ' ' . $charges->currency;
			$p2 = $charges->mono_user_price . ' ' . $charges->currency;
			$p3 = $charges->multi_user_price . ' ' . $charges->currency;
			$p4 = $charges->multi_site_user_price . ' ' . $charges->currency;
			$p5 = $charges->ecosystem_user_price . ' ' . $charges->currency;
               //$item = "ProficientUP";

        }
        else {
			$charges = GdooxPlatformPlans::where('user', 'personal-user')->first();
            $p1 = $charges->price_per_year . ' ' . $charges->currency;
			$charges = GdooxPlatformPlans::where('user', 'mono-user')->first();
            $p2 = $charges->price_per_year . ' ' . $charges->currency;
			$charges = GdooxPlatformPlans::where('user', 'multi-user')->first();
            $p3 = $charges->price_per_year . ' ' . $charges->currency;
			$charges = GdooxPlatformPlans::where('user', 'company-network-user')->first();
            $p4 = $charges->price_per_year . ' ' . $charges->currency;
			$charges = GdooxPlatformPlans::where('user', 'ecosystem-user')->first();
            $p5 = $charges->price_per_year . ' ' . $charges->currency;

			
        }
*/

?>
      
  <div class="card-body card-padding card-body-plans">
    <div class="row">
        <div class="col-md-12 text-center">

            <h2>To</h2>
            <h1>Gdoox Platform</h1>
        </div>      
    </div>      
  </div>      

  <div class="card">
    <div class="card-header bgm-cyan ">
      <h2>Business Ecosystem, Digital Economy Management, Hosted e-commerce </h2>
    </div>

    <div class="card-body card-padding">
        <p class="lead">Visit Gdoox features by selecting a Commercial Plan:</p>
        

		
            {!! Form::open([
                'method' => 'GET',
                //'route' => 'proceed-to-payment',
                'class' => 'form-horizontal form-label-left'
            ]) !!}

            
            <div class="form-group">
                {!! Form::label('country','View pricing for your country:', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::select('country', $country, $countrysel, array('required', 'placeholder' =>'--Select--', 'class'=>'form-control')) !!}
                </div>    
            </div>
                        
            <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                    <button id="send" type="submit" class="btn btn-round btn-success">SHOW</button>
                </div>
            </div>
            {!! Form::close() !!}		
		
		
		
		
  <table style="table-layout: fixed;word-wrap: break-word;width: 120%;">

		<colgroup></colgroup>
		<colgroup></colgroup>
		<colgroup></colgroup>
		<colgroup></colgroup>
    <colgroup></colgroup>
    <colgroup></colgroup>

	    <thead>
	    	<tr>
            <th>
                &nbsp;</th>
	    		<th>
	    			<h2>ProficientUP</h2>
	    		</th>
	    		<th>
	    			<h2>E-COM</h2>
	    		</th>
	    		<th>
	    			<h2>E-COM Plus</h2>
	    		</th>
	    		<th>
	    			<h2>Company Network</h2>
	    		</th>          
	    		<th>
	    			<h2>Business Ecosystem</h2>
	    		</th>
          
	    	</tr>
	    </thead>

	    <tfoot>
	    	<tr>
	    		<th>&nbsp;</th>
          <td>
              <a href="/demo/public/index.php/auth/login" class="btn btn-success btn-icon-text waves-effect" target="_blank">Explore <br/><strong>ProficientUP</strong> <br/>features</a>
          </td>

          <td>
              <a href="/demo/public/index.php/auth/login" class="btn btn-success btn-icon-text waves-effect" target="_blank">Explore <br/><strong>E-COM</strong> <br/>features</a>
          </td>
          
          <td>
              <a href="/demo/public/index.php/auth/login" class="btn btn-success btn-icon-text waves-effect" target="_blank">Explore <br/><strong>E-COM Plus</strong> <br/>features</a>
          </td>
          
          <td>
              <a href="/demo/public/index.php/auth/login" class="btn btn-success btn-icon-text waves-effect" target="_blank">Explore <br/><strong>Company Network</strong> <br/>features</a>
          </td>
          
          <td>
              <a href="/demo/public/index.php/auth/login" class="btn btn-success btn-icon-text waves-effect" target="_blank">Explore <br/><strong>Business Ecosystem</strong> <br/>features</a>
          </td>          
	    	</tr>
                
                
	    	<tr>
	    		<th>&nbsp;</th>
          <td>OR<br/><br/>
              <a href="{!! route('post.register',['type'=>'ProficientUp']) !!}" class="btn btn-warning btn-icon-text waves-effect" target="_blank">Register For <br/><strong>ProficientUP</strong></a><br/><small>14 days Free trial</small>
          </td>

          <td>OR<br/><br/>
              <a href="{!! route('post.register',['type'=>'ECom']) !!}" class="btn btn-warning btn-icon-text waves-effect" target="_blank">Register For <br/><strong>E-COM</strong></a>
			  <br/><small>14 days Free trial</small>
          </td>
          
          <td>OR<br/><br/>
              <a href="{!! route('post.register',['type'=>'Ecom Plus']) !!}" class="btn btn-warning btn-icon-text waves-effect" target="_blank">Register For <br/><strong>E-COM Plus</strong></a><br/><small>14 days Free trial</small>
          </td>
          
          <td>OR<br/><br/>
              <a href="{!! route('post.register',['type'=>'Company Network']) !!}" class="btn btn-warning btn-icon-text waves-effect" target="_blank">Register For <br/><strong>Company Network</strong></a><br/><small>14 days Free trial</small>
          </td>
          
          <td>OR<br/><br/>
              <a href="{!! route('post.register',['type'=>'Business Ecosystem']) !!}" class="btn btn-warning btn-icon-text waves-effect" target="_blank">Register For <br/><strong>Business Ecosystem</strong></a><br/><small>14 days Free trial</small>
          </td>          
	    	</tr>	                
	    </tfoot>

      <tbody>

          
          
          
        <tr><th>Package description</th><td>Share your professional expertise and connect with other people like you.</td>
			<td>Powerful e-commerce , Products converge to gdoox market place + access to company network or business ecosystem</td>
			<td>Manage your e-commerce site involving othe company account + Products converge to gdoox market place + access to company network or business ecosystem</td>
			<td>Create you Company netwok in one or more e-commerce multiaccount sites involving partners ,+Powerful CRM (Optional)+ Products converge to gdoox market place</td>
			<td>Create your business eco-system in one or more e-commerce multi account sites, involving partners, sharing sites & products+ powerful CRM (Optional) + Products converge to gdoox market place</td></tr>
<tr><th></th><td>14 days Free trial</td><td>14 days Free trial</td><td>14 days Free trial</td><td>14 days Free trial</td><td>14 days Free trial</td></tr>
        <!--tr><th></th><td>ProficientUP</td><td>E-COM</td><td>E-COM Plus</td><td>Company Network</td><td>Business Ecosystem</td></tr-->
		<tr><th>SITES TYPE</th><td>STAKEHOLDER</td><td>CONTRIBUTORS</td><td>CONTRYBUTORS</td><td>INTEGRATORS</td><td> INTEGRATORS &amp; HUBs</td></tr>
<!--		<tr><th>PERFORMANCE (INCLUDED)</th><td></td><td ></td><td ></td><td ></td><td ></td></tr>
		<tr><th>Gdoox Marketplace</th><td>x</td><td >x</td><td >x</td><td >x</td><td >x</td></tr>
		<tr><th>Products Management &amp; SEO</th><td></td><td >X</td><td >X</td><td >X</td><td >X</td></tr>
		<tr><th>WEB MARKETING : Product Marketing (Bundle products, Up selling &amp; Cross selling, Multi item products)</th><td></td><td >x</td><td >x</td><td >x</td><td >x</td></tr>
		<tr><th>Company performance analytics</th><td></td><td >x</td><td >x</td><td >x</td><td >x</td></tr>
		<tr><th>CONTACT MANAGER</th><td></td><td >X</td><td >X</td><td >X</td><td >X</td></tr>
		
		<tr><th>SPECIAL FEATURES</th><td></td><td ></td><td ></td><td ></td><td ></td></tr>
		<tr><th>Auction</th><td></td><td ></td><td >x</td><td >x</td><td >x</td></tr>
		<tr><th>Reverse auction</th><td></td><td ></td><td >x</td><td >x</td><td >x</td></tr>
		<tr><th>Procurement</th><td></td><td ></td><td >x</td><td >x</td><td >x</td></tr>
		
		<tr><th>SITES (INCLUDED)</th><td></td><td ></td><td ></td><td ></td><td ></td></tr>
		<tr><th>Personal site</th><td>1</td><td ></td><td ></td><td ></td><td ></td></tr>
		<tr><th>e-Commerce site included</th><td></td><td >1</td><td >1</td><td >3</td><td >3</td></tr>
		<tr><th>ECO-SYSTEM site included</th><td></td><td ></td><td ></td><td ></td><td >2</td></tr>
		
		<tr><th>E-COMMERCE SITES (ADDITIONAL)</th><td></td><td ></td><td ></td><td ></td><td ></td></tr>
		<tr><th>Additional e-commerce site (number)</th><td></td><td ></td><td ></td><td ></td><td ></td></tr>
		<tr><th>Additional e-commerce site (price)</th><td></td><td ></td><td ></td><td ></td><td ></td></tr>
		<tr><th>Total amount Additional e-commerce Site</th><td></td><td ></td><td ></td><td ></td><td ></td></tr>
		
		<tr><th>BUSINESS ECOSYSTEM SITES (ADDITIONAL)</th><td></td><td ></td><td ></td><td ></td><td ></td></tr>
		<tr><th>Additional Busineess Ecosystem site (number)</th><td></td><td ></td><td ></td><td ></td><td ></td></tr>
		<tr><th>Additional Busineess Ecosystem site (price)</th><td></td><td ></td><td ></td><td ></td><td ></td></tr>
		<tr><th>Total amount Additional Busineess Ecosystem Site</th><td></td><td ></td><td ></td><td ></td><td ></td></tr>-->
		        

                <!--date 9 jan 2017-->
 <?php
foreach($data_ as $data__){
//    var_dump($data__);
 if($data__['type'] === 'total_optional_price' || $data__['type'] === 'optional_num' 
         || $data__['type'] === 'optional_price' || $data__['type'] === 'total_price'){
 }else{  
  
 echo "<tr>";
// var_dump($data__);
    foreach($data__ as $k => $v){
        if($k === 'type' ){
        }elseif($k === 'label'){
            echo "<th>";
            if($data__['type'] === 'head' ){
                echo '<span class="headline_">' . $v . '</span>';
            }else{
                echo $v;    
            }

            echo "</th>";               
        }else{
            echo "<td>";
                //if($data__['label'] === 'pricing'){
				//if(strpos(strtolower($data__['label']), 'pricing') || strpos(strtolower($data__['label']), 'price') ){
                if(strpos( strtolower($data__['label']), "price") ){
                    if($v === "&mdash;"){
                            echo $v;
                    }else{
                    	echo "<span class='plan_pricing_'>" . $v . "</span>";
                    }
                }elseif(strpos( strtolower($data__['label']), "base plan") ){
                    echo "<span class='plan_pricing'>" . $v . "</span>";
                }else{
                    echo $v;
                }
               
            echo "</td>";    
        }
        
    }
 
 echo "</tr>";  
 }
}
?>                         
                
                
                
		  
		  <!--tr><th>Personal site</th><td>x</td><td></td><td></td><td></td><td></td></tr>
        <tr><th>Product posting Up to (VARIABLE)</th><td></td><td>500 MB</td><td>1GB</td><td>2GB</td><td>3GB</td></tr>
        <tr><th>Accounts (VARIABLE)</th><td>1</td><td>1</td><td>3</td><td>2</td><td>3</td></tr>
        <tr><th>Mail Traffic (VARIABLE)</th><td>50</td><td>500</td><td>1000</td><td>2000</td><td>4000</td></tr>
        <tr><th>Gdoox Marketplace</th><td>x</td><td>x</td><td>x</td><td>x</td><td>x</td></tr>
        <tr><th>Product Marketing (Bundle products, Up selling & Cross selling, Multi item products)</th><td></td><td>x</td><td>x</td><td>x</td><td>x</td></tr>
        <tr><th>Company performance analytics</th><td></td><td>x</td><td>x</td><td>x</td><td>x</td></tr>
        <tr><th>e-Commerce site included</th><td></td><td>1</td><td>1</td><td>3</td><td>4</td></tr>
        <tr><th>E-Com  site included for a partner</th><td></td><td></td><td></td><td>2</td><td>2</td></tr>
        <tr><th>Number of account E-COM</th><td></td><td></td><td></td><td>2</td><td>2</td></tr>
        <tr><th>E-Com Plus site included for a partner</th><td></td><td></td><td></td><td>2</td><td>2</td></tr>
        <tr><th>Number of account E-Com PLUS</th><td></td><td></td><td></td><td>6</td><td>6</td></tr>
        <tr><th>ECO-SYSTEM  site included</th><td></td><td></td><td></td><td></td><td>2</td></tr>
        <tr><th>Performance</th><td></td><td></td><td></td><td></td><td></td></tr>
        <tr><th>Number of sites nvolved</th><td>1</td><td>1</td><td>1</td><td>7</td><td>10</td></tr>
        <tr><th>Number of CRM users</th><td></td><td></td><td></td><td>2</td><td>3</td></tr>
        <tr><th>Number of alliance site for your partners</th><td></td><td></td><td></td><td>4</td><td>4</td></tr>
        <tr><th>Number of accounts  for your partnes ( to support Your Allies)</th><td></td><td></td><td></td><td>8</td><td>8</td></tr-->
        
        <tr><th></th><td></td><td></td><td></td><td></td><td></td></tr>
        <tr><th>Login ID For Demo</th><td>user1@gdoox.com</td><td>user2@gdoox.com</td><td>user3@gdoox.com</td><td>user5@gdoox.com</td><td>user4@gdoox.com</td></tr>
        <tr><th>Login Password For Demo</th><td>password@123</td><td>password@123</td><td>password@123</td><td>password@123</td><td>password@123</td></tr>
		<!--<tr><th>PRICING</th><td><strong><?php echo $p1;?></strong></td><td><strong><?php echo $p2;?></strong></td><td><strong><?php echo $p3;?></strong></td><td><strong><?php echo $p4;?></strong></td><td><strong><?php echo $p5;?></strong></td></tr>-->
      </tbody>
          
    </table>     
<br/><br/>

		
            {!! Form::open([
                'method' => 'GET',
                //'route' => 'proceed-to-payment',
                'class' => 'form-horizontal form-label-left'
            ]) !!}

            
            <div class="form-group">
                {!! Form::label('country','View pricing for your country:', array('class'=>'control-label col-md-3 col-sm-3 col-xs-12')) !!} 
                <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::select('country', $country, $countrysel, array('required', 'placeholder' =>'--Select--', 'class'=>'form-control')) !!}
                </div>    
            </div>
                        
            <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                    <button id="send" type="submit" class="btn btn-round btn-success">SHOW</button>
                </div>
            </div>
            {!! Form::close() !!}		
				
    </div>
  </div>


<style>
    .state-icon {
        left: -5px;
    }
    .list-group-item-primary {
        color: rgb(255, 255, 255);
        background-color: rgb(66, 139, 202);
    }

/* DEMO ONLY - REMOVES UNWANTED MARGIN */
    .well .list-group {
        margin-bottom: 0px;
    }
</style>


@endsection

@section('footer_add_js_script')

<script src="{{ asset('/js/bxslider/bxslider.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function(){  
    $('.bannerslider').bxSlider({
      auto: false,
      adaptiveHeight: true,
      mode: 'horizontal',
      pager:false
    });
  });
</script> 


  
@endsection
