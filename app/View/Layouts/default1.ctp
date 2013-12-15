<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pol-ka</title>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
<?php
        echo $this->Html->script('mootools.js');
        echo $this->Html->script('Render');
        echo $this->Html->script('RenderTranslator');
        echo $this->Html->script('ComponentTranslator');
        echo $this->Html->script('ServerManager');
		
		echo $this->Html->script('Usuario');

        echo $this->Html->css('style.default');
        echo $this->Html->script('jsTemplate/prettify/prettify');
        echo $this->Html->script('jsTemplate/jquery-1.9.1.min');
        echo $this->Html->script('jsTemplate/jquery-migrate-1.1.1.min');

        echo $this->fetch('css');
        echo $this->fetch('script');
?>



</head>

<body>

<div id="principal" class="loginwrapper">

	<div class="loginwrap zindex100 animate2 bounceInDown">
	<h1 class="logintitle"><span class="iconfa-lock"></span> Sign In <span class="subtitle">Hello! Sign in to get you started!</span></h1>
        <div class="loginwrapperinner">
<?php echo $this->Form->create('Usuario',array('id'=>'loginform' ,'class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field'))));
?>
                <p class="animate4 bounceIn"><input type="text" id="username" name="username" placeholder="Username" /></p>
                <p class="animate5 bounceIn"><input type="password" id="password" name="password" placeholder="Password" /></p>
                <p class="animate6 bounceIn"><button class="btn btn-default btn-block">Submit</button></p>
<?php echo $this->Form->end()?>
        </div><!--loginwrapperinner-->
    </div>
    <div class="loginshadow animate3 fadeInUp"></div>
</div><!--loginwrapper-->

<script type="text/javascript">
jQuery.noConflict();

jQuery(document).ready(function(){
    this.type="usuario";
	
	var anievent = (jQuery.browser.webkit)? 'webkitAnimationEnd' : 'animationend';
	jQuery('.loginwrap').bind(anievent,function(){
		jQuery(this).removeClass('animate2 bounceInDown');
	});
	
	jQuery('#username,#password').focus(function(){
		if(jQuery(this).hasClass('error')) jQuery(this).removeClass('error');
	});
	jQuery('#loginform button').click(function(){

		if(!jQuery.browser.msie) {
			if(jQuery('#username').val() == '' || jQuery('#password').val() == '') {
				if(jQuery('#username').val() == '') jQuery('#username').addClass('error'); else jQuery('#username').removeClass('error');
				if(jQuery('#password').val() == '') jQuery('#password').addClass('error'); else jQuery('#password').removeClass('error');
				jQuery('.loginwrap').addClass('animate0 wobble').bind(anievent,function(){
					jQuery(this).removeClass('animate0 wobble');
				});
			} else {
				jQuery('.loginwrapper').addClass('animate0 fadeOutUp').bind(anievent,function(){
	
				});
				translator.loginUser(self.type,jQuery('#loginform'));
			}
			return false;
		}
	});
});
</script>
</body>
</html>