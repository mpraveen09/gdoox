<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!-- If you delete this tag, the sky will fall on your head -->
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Gdoox Invitation</title>	
    <link rel="stylesheet" type="text/css" href="stylesheets/email.css" />
</head>
 
<body bgcolor="#FFFFFF">
    <!-- HEADER -->
    <table class="head-wrap" bgcolor="#999999">
        <tr>
            <td></td>
            <td class="header container">
                <div class="content">
                    <table bgcolor="#999999">
                        <tr>
                            <td><img src="<?php echo $message->embed(asset('images/gdoox.png')); ?>"></img></td>
                            <td align="right"><h6 class="collapse">Gdoox Inc.</h6></td>
                        </tr>
                    </table>
                </div>
            </td>
            <td></td>
        </tr>
    </table><!-- /HEADER -->


<!-- BODY -->
<table class="body-wrap">
    <tr>
        <td></td>
        <td class="container" bgcolor="#FFFFFF">
            <div class="content">
                <table>
                    <tr>
                        <td>
                            <h3>Hi, <?php echo $data['name']; ?></h3>
                            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.</p>

                            <!-- A Real Hero (and a real human being) -->
                            <p>
                                <a href="<?php echo URL::to('/');?>">
                                    <img src="<?php echo $message->embed(asset('images/gdoox.png')); ?>"></img>
                                </a>
                            </p><!-- /hero -->

                            <!-- Callout Panel -->
                            <p class="callout">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.
                            </p><!-- /Callout Panel -->

                            <h3>Title Ipsum <small>This is a note.</small></h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </p>
                           
                            <br/>
                            <br/>							

                            <!-- social & contact -->
                            <table class="social" width="100%">
                                <tr>
                                    <td>
                                            <!--- column 1 -->
                                            <table align="left" class="column">
                                                <tr>
                                                    <td>
                                                        <h5 class="">Connect with Us:</h5>
                                                        <p class="">
                                                            <a href="#" class="soc-btn fb">Facebook</a> 
                                                            <a href="#" class="soc-btn tw">Twitter</a> 
                                                            <a href="#" class="soc-btn gp">Google+</a>
                                                        </p>
                                                    </td>
                                                </tr>
                                            </table><!-- /column 1 -->	

                                            <!--- column 2 -->
                                            <table align="left" class="column">
                                                <tr>
                                                    <td>
                                                        <h5 class="">Contact Info:</h5>												
                                                        <p>
                                                            Phone: <strong>123.456.6754</strong><br/>
                                                            Email: <strong><a href="emailto:gdoox@gdoox.com">gdoox@gdoox.com</a></strong>
                                                        </p>
                                                    </td>
                                                </tr>
                                            </table><!-- /column 2 -->
                                            <span class="clear"></span>	
                                    </td>
                                </tr>
                            </table><!-- /social & contact -->
                        </td>
                    </tr>
                </table>
            </div>						
        </td>
        <td></td>
    </tr>
</table><!-- /BODY -->

<!-- FOOTER -->
<table class="footer-wrap">
    <tr>
        <td></td>
        <td class="container">
            <!-- content -->
            <div class="content">
                <table>
                    <tr>
                        <td align="center">
                            <p>
                                <a href="#">Terms</a> |
                                <a href="#">Privacy</a> |
                            </p>
                        </td>
                    </tr>
                </table>
            </div><!-- /content -->	
        </td>
        <td></td>
    </tr>
</table><!-- /FOOTER -->

</body>
</html>



<!--<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2 style="font-weight:500;">Hi, <?php // echo $data['name']; ?></h2>
                    <br/><br/>
                    <div>
			<h1 style="font-weight:500;">Thank you very much for contacting us.</h1>
                        <br/><br/>
                        <h3 style="font-weight:500;">We will start emailing Invitation Code after end of March 2016. <br/>Your Invitation Code for FREE ACCESS will be sent to you on your registered email id <?php echo $data['email']; ?>.</h3>
                    </div>
                <br/>
		<div>
                    <br/><br/><br/><hr/><br/>
                    <div style="text-align:center">
                        <br/>
                        <a href="<?php // echo URL::to('/');?>">
                          img src="{{ asset('images/gdoox.png') }}" alt="GDoox" class="logo-header"/
                            <img src="<?php // echo $message->embed(asset('images/gdoox.png')); ?>">
                        </a>


                        <p style="font-size:18px; font-weight:500;"><br/>&copy; 2015 All Rights Reserved.</p>
                    </div>
                    <br/>
                    <hr/>
                    <br/>

                    <small>Email Sent from contact form on GDoox.com</small>
		</div>
	</body>
</html>-->