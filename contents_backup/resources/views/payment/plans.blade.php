@extends('layout.backend.master')
@extends('layout.backend.userinfo')

@section('right_col_title_left')
    <h2></h2>
@endsection

@section('right_col_title_right')
@endsection

@section('right_col')
    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible" role="alert">
            {!!  Session::get('message')  !!}
        </div>
    @endif
 
    <div class="card">
    <div class="card-header bgm-cyan ">
      <h2>Business Ecosystem, Digital Economy Management, Hosted e-commerce </h2>
    </div>

    <div class="card-body card-padding">
        <p class="lead">Visit Gdoox features by selecting a Commercial Plan:</p>
        <table>
		<colgroup></colgroup>
		<colgroup></colgroup>
		<colgroup></colgroup>
		<colgroup></colgroup>
                <colgroup></colgroup>
                <colgroup></colgroup>

	    <thead>
	    	<tr>
                    <th>&nbsp;</th>
                    <th><h2>ProficientUP</h2></th>
                    <th><h2>E-COM</h2></th>
                    <th><h2>E-COM Plus</h2></th>
                    <th><h2>Company Network</h2></th>          
                    <th><h2>Business Ecosystem</h2></th>
	    	</tr>
	    </thead>

	    <tfoot>
	    	<tr>
	    		<th>&nbsp;</th>
                        <td><a href="try/public/index.php/auth/login" class="btn btn-success btn-icon-text waves-effect" target="_blank">Explore <br><strong>ProficientUP</strong> <br>features</a></td>

                        <td><a href="try/public/index.php/auth/login" class="btn btn-success btn-icon-text waves-effect" target="_blank">Explore <br><strong>E-COM</strong> <br>features</a></td>

                        <td><a href="try/public/index.php/auth/login" class="btn btn-success btn-icon-text waves-effect" target="_blank">Explore <br><strong>E-COM Plus</strong> <br>features</a></td>

                        <td><a href="try/public/index.php/auth/login" class="btn btn-success btn-icon-text waves-effect" target="_blank">Explore <br><strong>Company Network</strong> <br>features</a></td>

                        <td>
                            <a href="try/public/index.php/auth/login" class="btn btn-success btn-icon-text waves-effect" target="_blank">Explore <br><strong>Business Ecosystem</strong> <br>features</a>
                        </td>          
	    	</tr>
	    </tfoot>
            
      <tbody>
         
        <tr><th>Package description</th><td>Share your professional expertise and connect with other people like you</td><td>Powerful e-commerce , Products converge to gdoox market place + access to company network or business ecosystem</td><td>Manage your e-commerce site involving othe company account + Products converge to gdoox market place + access to company network or business ecosystem</td><td>Create you Company netwok in one or more  e-commerce  multiaccount  sites involving partners  ,+Powerful CRM+  Products converge to gdoox market place </td><td>Create your business eco-system in one or more e-commerce multi account sites,  involving partners, sharing sites &amp; products+ powerful CRM  +  Products converge to gdoox market place</td></tr>
<!--        <tr><th></th><td>14 days Free trial</td><td>14 days Free trial</td><td>14 days Free trial</td><td>14 days Free trial</td><td>14 days Free trial</td></tr>
        <tr><th></th><td>ProficientUP</td><td>E-COM</td><td>E-COM Plus</td><td>Company Network</td><td>Business Ecosystem</td></tr>-->
        <tr><th>Personal site</th><td>x</td><td></td><td></td><td></td><td></td></tr>
        <tr><th>Product posting Up to (VARIABLE)</th><td></td><td>500 MB</td><td>1GB</td><td>2GB</td><td>3GB</td></tr>
        <tr><th>Accounts (VARIABLE)</th><td>1</td><td>1</td><td>3</td><td>2</td><td>3</td></tr>
        <tr><th>Mail Traffic (VARIABLE)</th><td>50</td><td>500</td><td>1000</td><td>2000</td><td>4000</td></tr>
        <tr><th>Gdoox Marketplace</th><td>x</td><td>x</td><td>x</td><td>x</td><td>x</td></tr>
        <tr><th>Product Marketing (Bundle products, Up selling &amp; Cross selling, Multi item products)</th><td></td><td>x</td><td>x</td><td>x</td><td>x</td></tr>
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
        <tr><th>Number of accounts  for your partnes ( to support Your Allies)</th><td></td><td></td><td></td><td>8</td><td>8</td></tr>
        
        <tr><th></th><td></td><td></td><td></td><td></td><td></td></tr>
        <tr><th>Login ID For Demo</th><td>user1@gdoox.com</td><td>user2@gdoox.com</td><td>user3@gdoox.com</td><td>user5@gdoox.com</td><td>user4@gdoox.com</td></tr>
        <tr><th>Login Password For Demo</th><td>password@123</td><td>password@123</td><td>password@123</td><td>password@123</td><td>password@123</td></tr>
      </tbody>
          
    </table>
        <br /><br />
        <table>
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <td>
                        <a href="{!! route('post.register',['type'=>'ProficientUp']) !!}" class="btn btn-success btn-icon-text waves-effect" target="_blank">Make Payment <br>(ProficientUp)</a>
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                        <a href="{!! route('post.register',['type'=>'ECom']) !!}" class="btn btn-success btn-icon-text waves-effect" target="_blank">Make Payment <br>(ECom)</a>
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                        <a href="{!! route('post.register',['type'=>'Ecom Plus']) !!}" class="btn btn-success btn-icon-text waves-effect" target="_blank">Make Payment <br>(Ecom Plus)</a>
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                        <a href="{!! route('post.register',['type'=>'Company Network']) !!}" class="btn btn-success btn-icon-text waves-effect" target="_blank">Make Payment <br>(Company Network)</a>
                    </td>
                    <td>&nbsp;&nbsp;</td>
                    <td>
                        <a href="{!! route('post.register',['type'=>'Business Ecosystem']) !!}" class="btn btn-success btn-icon-text waves-effect" target="_blank">Make Payment <br>(Business Ecosystem)</a>
                    </td>          
                </tr>
            </thead>
        </table>
          
    </div>
  </div>
@endsection
 
@section('footer_add_js_script')
    <script type="text/javascript"></script>
@endsection