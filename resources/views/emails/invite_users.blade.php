<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2 style="font-weight:500;">Thank you for showing interest with Gdoox.
                    Please follow the link below to get register </h2>
                    @if(!empty($gdooxCode))
                        <h3>For discounts, please use your Gdoox code <span style="color:red;"><a><?php  echo $gdooxCode; ?></a></span>  while registration on Gdoox platform.</h3>
                    @endif
                <p>Registeration Link: <?php  echo $registration_link; ?><br/><br/>
					If the above link is not clickable, try copying and pasting it into the address bar of your web browser.
				</p>
		<div>
                    <br/><br/><br/>
			<p>
				Step 1: Please register using the above link, create your account password, which will be used later for login into the platform.  
				<br/>
				Step 2: After you register on the platform, you will receive an email to verify your email address. Once you verify the email address, then you can login into the platform using the password you created at Step 1.</p>
                    <hr/>
                    <br/>
                        <div style="text-align:center">
                              <br/>
                            <a href="<?php echo URL::to('/');?>">
                              <img src="<?php echo $message->embed(asset('images/gdoox_blue.png')); ?>">
                            </a>
                          <p style="font-size:18px; font-weight:500;"><br/>&copy; <?php date('Y'); ?> Gdoox Italia srl.</p>
                        </div>
						<div style="text-align:center">
							<p style="color:#888">You are receiving this email at the account <?php  echo $email; ?> because you have shown interest in Gdoox platform and requested invitation.</p>
						</div>
                    <br/>
                    <hr/>
                    <br/>

		</div>
	</body>
</html>