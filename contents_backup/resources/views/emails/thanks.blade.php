<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2 style="font-weight:500;">Hi, <?php echo $data['name']; ?></h2>
<br/><br/>
		<div>
			<h1 style="font-weight:500;">
			Thank you very much for contacting us.
			</h1>
<br/><br/>
<h3 style="font-weight:500;">We will start emailing Invitation Code after end of March 2016. <br/>Your Invitation Code for FREE ACCESS will be sent to you on your registered email id <?php echo $data['email']; ?>.</h3>

			
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