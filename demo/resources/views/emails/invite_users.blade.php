<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2 style="font-weight:500;">Thank you for showing interest with Gdoox.
                    Please follow the link below to get register </h2>
                    @if(!empty($gdooxCode))
                        <h3>You can use your gdoox code <span style="color:red;"><a><?php  echo $gdooxCode; ?></a></span>  in registration for creating free* E-shop </h3>
                    @endif
                <p>Registeration Link: <?php  echo $registration_link; ?></p>
		<div>
                    <br/><br/><br/>
                    <hr/>
                    <br/>
                        <div style="text-align:center">
                              <br/>
                            <a href="<?php echo URL::to('/');?>">
                              <img src="<?php echo $message->embed(asset('images/gdoox.png')); ?>">
                            </a>
                          <p style="font-size:18px; font-weight:500;"><br/>&copy; 2015 All Rights Reserved.</p>
                        </div>
                    <br/>
                    <hr/>
                    <br/>

                    <small>Email Sent from contact form on GDoox.com</small>
		</div>
	</body>
</html>