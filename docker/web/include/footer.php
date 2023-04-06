		</div><!-- ./wrapper -->
	</div>
			
	<!-- footer -->	
	<footer style="padding:0px!important;">
		<div class="container">
			<div class="widget row">
				<!-- about -->
				<div class="col-md-4 col-xs-12 no-padding-sm-lg pull-left">
					<h4 class="title">A propos Aestia</h4>
					<div class="text">
						<span>Dofus® est une marque déposée par Ankama Games®.<br> Tous les logos et images liés sont copyright © Ankama Games®.<br> Ce site n'est pas approuvé par Ankama Games®.</span>
					</div>
				</div>
				<!-- latest tweet -->
				<div class="col-md-4 col-xs-12 visible-md-block visible-lg-block no-padding-sm-lg pull-right">
					<h4 class="title">Dernier Tweet <div style="float: right;"><a href="https://twitter.com/Aestia_eu" class="twitter-follow-button" data-show-count="true" data-lang="fr">Suivez-nous !</a></div></h4>
					<div id="twitter"></div>
				</div>	
			</div>
			<!-- /.footer widget -->
		</div>
	
		<div class="footer-bottom" style="margin-top:0px!important;">
			<div class="container">
				<ul class="pull-left hidden-xs">
					<li>2014 - 2015 &copy; <?php echo TITLE; ?>. Tous droits réservés.&nbsp;&nbsp;&nbsp;</li>		
				</ul>
				<ul class="pull-left hidden-xs">
					<li><a href="?page=cgu">Conditions générales d'utilisation</a></li>
				</ul>
				
				<ul class="pull-right hidden-xs">
					<li style= "color: rgba(255, 255, 255, 0.1);">Code by Locos</li>
				</ul>
			</div>
		</div>
	</footer>	
	<!-- ./footer -->
	
	<!-- sign-in modal -->
	<!-- Modal -->
	<div id="signin" class="modal" tabindex="-1" role="dialog" aria-labelledby="signin-title" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="signin-title"><i class="fa fa-sign-in"></i> Connexion</h4>
		  </div>
			<form method="post" action="#">
				<div class="modal-body modal-padding">
					<div class="login">
						<div class="row">
							<div class="col-md-12">	
								<input type="text" class="form-control" name="username" placeholder="Nom de compte" required=""/>
								<span class="help-block"></span>				
								<input  type="password" class="form-control" name="password" placeholder="Mot de passe" required=""/>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="checkbox margin-top-20 no-margin-bottom">
									<input type="checkbox" name="checkbox" checked="checked"> 
									<label for="checkbox">Se souvenir de moi</label>
								</div>
							</div>
						</div>	   
					</div> 	
				</div>
				<div class="modal-footer">
					<a href="#" class="btn btn-warning pull-left" data-dismiss="modal">Retour</a>
					<button type="submit" name="login" class="btn btn-success pull-right">Connexion</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal --> 
	<!-- ./sign-in modal -->
	
	<!-- register modal -->
	<!-- Modal -->
	<div id="register" class="modal" tabindex="-1" role="dialog" aria-labelledby="register-title" aria-hidden="true">
		<div class="modal-dialog" style="margin:8% auto!important">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="register-title"><i class="fa fa-user"></i> Inscription</h4>
				</div>
				<div class="alert alert-warning no-border no-margin"><i class="fa fa-info"></i> Tous les champs sont obligatoires</div>
				<form autocomplete="off" method="POST" action="?page=register">	
					<div class="modal-body">
						<div class="row">
							<div class="control-group col-md-6 col-xs-12">
								<label class="control-label" for="username">Nom de compte</label>
								<div class="controls margin-top-5">
									<input type="text" class="form-control" id="username" placeholder="" required>
								</div>
							</div>
							<div class="control-group col-md-6 col-xs-12">
								<label class="control-label" for="email">Email</label>
								<div class="controls margin-top-5">
									<input type="text" class="form-control" id="email" placeholder="" required>
								</div>
							</div>
							<div class="control-group col-md-6 col-xs-12 margin-top-10">
								<label class="control-label" for="password">Mot de passe</label>
								<div class="controls margin-top-5">
									<input type="password" class="form-control" id="password" placeholder="" required>
								</div>
							</div>
							<div class="control-group col-md-6 col-xs-12 margin-top-10">
								<label class="control-label" for="repeat-password">Confirmation du mot de passe</label>
								<div class="controls margin-top-5">
									<input type="password" class="form-control" id="repeat-password" placeholder="" required>
								</div>
							</div>

							<div class="control-group col-md-6 col-xs-12 margin-top-10">
								<label class="control-label" for="question">Question secrète</label>
								<div class="controls margin-top-5">
									<input type="text" class="form-control" id="question" placeholder="" required>
								</div>
							</div>
							<div class="control-group col-md-6 col-xs-12 margin-top-10">
								<label class="control-label" for="answer">Réponse secrète</label>
								<div class="controls margin-top-5">
									<input type="text" class="form-control" id="answer" placeholder="" required>
								</div>
							</div>
							
							<div class="control-group col-md-12 col-xs-12">
								<label class="control-label margin-top-10" for="security-password">Image de sécurité</label>
								
								<div class="control-label margin-top-10" >
									<img class="" src="./img/captcha.php" alt="Captcha" />
								</div>
							
								<div class="controls margin-top-5">
									<input type="text" class="form-control" id="security-password" placeholder="" required>
								</div>
							</div>
						</div>
					</div>
			  
					<div class="modal-footer">
						<a href="#" class="btn btn-warning pull-left" data-dismiss="modal">Retour</a>
						<div style="margin-left: 10px;" class="checkbox pull-left no-padding no-margin-bottom margin-top-5">
							<input type="checkbox" id="checkbox1"> 
							<label for="checkbox1">J'accepte les <a href="?page=cgu">CGU</a>.</label>
						</div>
						<button type="submit" name="register" class="btn btn-success pull-right">S'inscrire</button>
					</div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal --> 
	<!-- ./register modal -->
	
	<!-- style switcher -->
	<div id="styleswitcher" style="left: -180px;">
		<h2><a href="#"><i class="fa fa-cogs"></i></a></h2>
		<div>
		<h3>Parametres</h3>
		<div class="well">
			<h4>Couleurs</h4>
			<ul class="colors">
				<li><a href="#" class="blue" title="Blue"></a></li>
				<li><a href="#" class="green" title="Green"></a></li>
				<li><a href="#" class="red" title="Red"></a></li>
				<li><a href="#" class="pink" title="Pink"></a></li>
			</ul>
			
			<h4 class="margin-top-20">Arriere plan</h4>
			<ul class="colors bg">
				<li><a href="#" class="furley"></a></li>
				<li><a href="#" class="agsquare"></a></li>
				<li><a href="#" class="crossword"></a></li>
				<li><a href="#" class="notebook"></a></li>
				<li><a href="#" class="brickwall"></a></li>
				<li><a href="#" class="gray_jean"></a></li>
				<li><a href="#" class="shattered"></a></li>
				<li><a href="#" class="tiny_grid"></a></li>
				<li><a href="#" class="retina_wood"></a></li>
				<li><a href="#" class="tileable_wood_texture"></a></li>
				<li><a href="#" class="mirrored_squares"></a></li>
				<li><a href="#" class="dark_geometric"></a></li>
				<li><a href="#" class="dark_circles"></a></li>
				<li><a href="#" class="triangles"></a></li>
				<li><a href="#" class="padded"></a></li>
			</ul>
			
			<h4 class="margin-top-20">Disposition</h4>
			<a href="#" class="button boxed pull-left">Boxed</a>
			<a href="#" class="button fullwidth pull-left">Full-width</a>
			<div class="clearfix"></div>
		</div>	
		</div>	
	</div>
	<!-- ./style switcher -->
	
	<!-- Javascript -->
    <script src="plugins/jquery/jquery-1.11.1.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="plugins/bxslider/jquery.bxslider.min.js"></script>
	<script src="plugins/jcarousel/jquery.jcarousel.min.js"></script>
	<script src="plugins/holder/holder.js"></script>
	<script src="plugins/core.js"></script>
	
	<script src="plugins/notification/js/modernizr.custom.js"></script>
	<script src="plugins/notification/js/classie.js"></script>
	<script src="plugins/notification/js/notificationFx.js"></script>
		
	<script src="plugins/pace/pace.min.js"></script>
	
	<script src="plugins/demo.js"></script>
	
	<!-- Bxslider -->
	<script>
	(function($) {
	"use strict";
		/*	Bx Slider
		/*----------------------------------------------------*/
		$('.bxslider').bxSlider({
			nextSelector: '.bx-controls-direction',
			prevSelector: '.bx-controls-direction', 
			nextText: '',
			prevText: '',
			mode: 'vertical',
			pagerCustom: '#bx-tabs',
			auto: true,
			onSlideBefore: function (currentSlideNumber, totalSlideQty, currentObject) {
				$('.caption h2').removeClass('animated fadeInLeft');
				$('.caption h1').removeClass('animated fadeInRight');
				$('.caption p').removeClass('animated fadeInLeft');
				$('.caption h2').eq(currentObject + 1).addClass('animated fadeInLeft');
				$('.caption h1').eq(currentObject + 1).addClass('animated fadeInRight');
				$('.caption p').eq(currentObject + 1).addClass('animated fadeInLeft');
			}
		});
		
		// create the notification
		var bttn = document.getElementById( 'wrapper' );
		$(document).ready(function() {
			classie.add( bttn, 'active' );
			setTimeout( function() {
				classie.remove( bttn, 'active' );
				// create the notification
				var notification = new NotificationFx({
					message : '<div class="ns-content"><p><a>Le craft sécurisé</a> est disponible !</p></div>',
					layout : 'other',
					ttl : 6000,
					effect : 'thumbslider',
						type : 'success', // notice, warning, error or success
						onClose : function() {
							bttn.disabled = false;
						}
				});
				// show the notification
				notification.show();
			}, 2500);
		});
		
		/* Load Content
		/*----------------------------------------------------*/	
		$(".loaded-content section").slice(0, 3).show();
		$('#load-more').click(function (e) {
			e.preventDefault();
			var btn = $(this)
			btn.button('loading')
			setTimeout(function () {
				btn.button('reset')
				$(".loaded-content section:hidden").slice(0, 3).fadeIn();
			}, 5000)//time in ms 
		});
	})(jQuery);
	</script>
	
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
</body>

</html>
