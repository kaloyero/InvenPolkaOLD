<div id="principal" class="loginwrapper">

	<div class="loginwrap zindex100 animate2 bounceInDown">
	<h1 class="logintitle"><span class="iconfa-lock"></span> LOGIN <span class="subtitle">Bienvenido al sistema de inventarios de POL-KA</span></h1>
        <div class="loginwrapperinner">
<?php echo $this->Form->create('Usuario',array('id'=>'loginform' ,'class' => 'stdform stdform2','inputDefaults' => array(
        'div' => array('class' => 'field'))));
?>
                <p class="animate4 bounceIn"><input type="text" id="username" name="username" placeholder="Usuario" /></p>
                <p class="animate5 bounceIn"><input type="password" id="password" name="password" placeholder="Contraseña" /></p>
                <p class="animate6 bounceIn"><button class="btn btn-default btn-block">Entrar</button></p>
<?php echo $this->Form->end()?>
        </div><!--loginwrapperinner-->
    </div>
    <div class="loginshadow animate3 fadeInUp"><b><font color="#FE2E2E" size="2"><?php echo $mensaje ?></font></b></div>
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