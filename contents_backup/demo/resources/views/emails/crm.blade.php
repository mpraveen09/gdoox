<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
            <h2 style="font-weight:500;">Gdoox CRM Mail</h2>
            <p>This is a Demo Mail from Gdoox CRM</p>
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