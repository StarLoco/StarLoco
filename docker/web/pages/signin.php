			<ol class="breadcrumb">
				<li><a href="?page=index">Accueil</a></li>
				<li class="active">Connexion</li>
			</ol>
			
			<br /> <br /> <br />	
			<div class="row">
				<div class="col-md-12">
					<!-- section -->
					<div class="row">
						<div class="col-md-6 col-md-offset-3 col-xs-12">
							<section class="section margin-top-20 margin-bottom-20 no-border">
									<h2 class="page-header text-center no-margin-top"><i class="fa fa-sign-in"></i> Connexion a <?php echo TITLE; ?></h2>
									<?php
									if(isset($_GET['ok'])) {
										$ok = $_GET['ok'];
										if($ok == 1) {
											echo "<div class='alert alert-success no-border-radius no-margin' style='text-align: center!important;' role='success'>
												<strong>Oh yes!</strong> La connexion a été effectué avec succès !
												</div><br />";
											echo "<meta http-equiv='refresh' content='3; url=" . URL_SITE . "'> ";
										} else if($ok == 2) {
											setcookie('user', " ", -1000);
											setcookie('pass', " ", -1000);
											$_SESSION = array();
											session_destroy();
											echo "<div class='alert alert-info no-border-radius no-margin' style='text-align: center!important;' role='alert'>
												<strong>Well done!</strong> Tu t'es déconnecté avec succès !
												</div><br />";
											echo "<meta http-equiv='refresh' content='1; url=" . URL_SITE . "'> ";
										} else {
											echo "<div class='alert alert-danger no-border-radius no-margin' style='text-align: center!important;' role='alert'>
												<strong>Oh shit!</strong> T'es identifiants sont incorrectes !
												</div><br />";
										}
									}
									?>
									<form autocomplete="off" method="POST" action="#">
										<input type="text" class="form-control" name="username" placeholder="Nom de compte" required="">
										<span class="help-block"></span>				
										<input type="password" class="form-control" name="password" placeholder="Mot de passe" required="">
										<div class="margin-top-20">
											<div class="checkbox pull-left no-padding no-margin-bottom margin-top-5">
												<input type="checkbox" id="checkbox1"> 
												<label for="checkbox1">Se souvenir de moi</label>
											</div>
											<button type="submit" name="login" class="btn btn-success pull-right">Connexion</button>
										</div>
									</form>
									<a href="?page=password" class="text-dark margin-top-20 padding-top-20 help-block border-top-light btn-icon-right"><i class="fa fa-unlock"></i> Mot de passe oublié ?</a>
							</section>
						</div>
					</div>
				</div>
			</div>	
			<br /> <br /> <br /> <br />
			<!-- ./leftside -->				
