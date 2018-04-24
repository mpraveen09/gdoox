<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2 style="font-weight:500;">You have a business invitation</h2>
    <h3>You can check after login to your gdoox  <a href="<?php echo URL::to('/auth/login');?>">account</a><br/>
Your gdoox code <span style="color:red;"><a><?php  echo $gdoox_code; ?></a> </h3>
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