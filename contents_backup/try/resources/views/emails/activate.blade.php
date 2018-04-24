<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2 style="font-weight:500;">Thanks for creating an account with the verification Gdoox app.
            Please follow the link below to verify your email address</h2>
<br/>
		<div>
			<strong>Name</strong> : <?php echo $username; ?><br/>
			<strong>Email</strong> : <?php  echo $email; ?><br/>
			<strong>Link</strong> : <?php  echo $activation_key; ?><br/>
		</div>
<br/>
		<div>
<br/><br/><br/>
<hr/>
<br/>
          <div style="text-align:center">
<br/>
              <a href="<?php echo URL::to('/');?>">
                <!--img src="{{ asset('images/gdoox.png') }}" alt="GDoox" class="logo-header"/-->
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