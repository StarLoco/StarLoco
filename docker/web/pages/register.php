			<ol class="breadcrumb">
				<li><a href="?page=index">Accueil</a></li>
				<li class="active">Inscription</li>
			</ol>
			
			<br /> <br /> <br />	
			<div class="row">
				<div class="col-md-12">
					<!-- section -->
					<div class="row">
						<div class="col-md-6 col-md-offset-3 col-xs-12">
							<section class="section margin-top-20 margin-bottom-20 no-border">
								<h2 class="page-header text-center no-margin-top"><i class="ion-clipboard"></i> Incription a <?php echo TITLE; ?></h2>
									<?php
									if(isset($_POST['register'])) {
										$ok = true; $error = 0;
										if(!isset($_POST['username']) || !isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['question']) || !isset($_POST['answer']) || !isset($_POST['security-password'])) {
											$ok = false;
										} else {
											$username = $_POST['username'];
											$email = $_POST['email'];
											$password = $_POST['password'];
											$repeat_password = $_POST['repeat-password'];
											$question = $_POST['question'];
											$answer = $_POST['answer'];
											$security = $_POST['security-password'];
											
											if(empty($username) || empty($email) || empty($password) || empty($repeat_password) || empty($question) || empty($answer) || empty($security)) {
												$ok = false;
											} else {
												if(checkString($username) || checkString($password) || checkString($question) || checkString($answer)) {
													$ok = false;
													$error = 1; // invalid password
												} else {
													if(strcmp($password, $repeat_password) !== 0) {
														$ok = false;
														$error = 2; // invalid password
													} else {
														if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
															$ok = false;
															$error = 3; // invalid mail
														} else {
															if(strtoupper($security) != $_SESSION['captcha']) {
																$ok = false;
																$error = 4; // invalid captcha
															} else {
																if(!isset($_POST['checkbox'])) {
																	$ok = false;
																	$error = 5; // invalid checkbox
																}
															}
														}
													}
												}												
											}											
										}
											
										if($ok) {
											$query = $login -> prepare("SELECT COUNT(account) FROM world_accounts WHERE account = ?;");
											$query -> bindParam(1, $username);
											$query -> execute();
											$row = $query -> fetch();
											$query -> closeCursor();
									
											if($row['COUNT(account)'] > 0) {
												echo "<div class='alert alert-danger no-border-radius no-margin' style='text-align: center!important;' role='success'>
													<strong>Oh shit!</strong> Le nom de compte existe déjà !
													</div><br />";
											} else {
												$query = $login -> prepare("INSERT INTO world_accounts(account, pass, email, question, reponse, dateRegister) VALUES (?, ?, ?, ?, ?, ?);");
											
												$query -> bindParam(1, $username);
												$password = hash("SHA512", md5($password));
												$query -> bindParam(2, $password);
												$query -> bindParam(3, $email);
												$query -> bindParam(4, $question);
												$query -> bindParam(5, $answer);
												$date = date('d/m/y H:i');
												$query -> bindParam(6, $date);
												
												$query -> execute();
												$query -> closeCursor();
												
												setcookie("user", $username, time() + 5); 
												setcookie("pass", $password, time() + 5); 
												
												echo "<div class='alert alert-success no-border-radius no-margin' style='text-align: center!important;' role='success'>
													<strong>Oh good!</strong> Ton compte a été crée avec succès !
													</div><br />";
												
												echo "<meta http-equiv='refresh' content='2; url=" . URL_SITE . "'> ";
											}
										} else {
											switch($error) {
											case 0:
												echo "<div class='alert alert-danger no-border-radius no-margin' style='text-align: center!important;' role='success'>
												<strong>Oh shit!</strong> Un des champs est invalide !
												</div><br />";
												break;
											case 1:
												echo "<div class='alert alert-danger no-border-radius no-margin' style='text-align: center!important;' role='success'>
												<strong>Oh shit!</strong> Un des champs comporte des caractères indésirable !
												</div><br />";
												break;
											case 2:
												echo "<div class='alert alert-danger no-border-radius no-margin' style='text-align: center!important;' role='success'>
												<strong>Oh shit!</strong> Les mots de passe ne sont pas identique !
												</div><br />";
												break;
											case 3:
												echo "<div class='alert alert-danger no-border-radius no-margin' style='text-align: center!important;' role='success'>
												<strong>Oh shit!</strong> L'email est invalide !
												</div><br />";
												break;
											case 4:
												echo "<div class='alert alert-danger no-border-radius no-margin' style='text-align: center!important;' role='success'>
												<strong>Oh shit!</strong> Le captcha ne correspond pas à celui de l'image !
												</div><br />";
												break;
											case 5:
												echo "<div class='alert alert-danger no-border-radius no-margin' style='text-align: center!important;' role='success'>
												<strong>Oh shit!</strong> Vous devez accepter les CGUS afin de vous incrire sur nos service.
												</div><br />";
												break;
											}
										}
									}
									?>
								<form method="POST" action="#">	
									<div class="row">
										<div class="control-group col-md-6 col-xs-12">
											<label class="control-label" for="username">Nom de compte</label>
											<div class="controls margin-top-5">
												<input type="text" class="form-control"  name="username" required>
											</div>
										</div>
										<div class="control-group col-md-6 col-xs-12">
											<label class="control-label" for="email">Email</label>
											<div class="controls margin-top-5">
												<input type="text" class="form-control" id="email" name="email" placeholder="" required="">
											</div>
										</div>
										<div class="control-group col-md-6 col-xs-12 margin-top-10">
											<label class="control-label" for="password">Mot de passe</label>
											<div class="controls margin-top-5">
												<input type="password" class="form-control" id="password" name="password" placeholder="" required="">
											</div>
										</div>
										<div class="control-group col-md-6 col-xs-12 margin-top-10">
											<label class="control-label" for="repeat-password">Confirmation du mot de passe</label>
											<div class="controls margin-top-5">
												<input type="password" class="form-control" id="repeat-password" name="repeat-password" placeholder="" required="">
											</div>
										</div>

										<div class="control-group col-md-6 col-xs-12 margin-top-10">
											<label class="control-label" for="question">Question secrète</label>
											<div class="controls margin-top-5">
												<input type="text" class="form-control" id="question" name="question" placeholder="" required="">
											</div>
										</div>
										<div class="control-group col-md-6 col-xs-12 margin-top-10">
											<label class="control-label" for="answer">Réponse secrète</label>
											<div class="controls margin-top-5">
												<input type="text" class="form-control" id="answer" name="answer" placeholder="" required="">
											</div>
										</div>
										
										<div class="control-group col-md-12 col-xs-12">
											<label class="control-label margin-top-10" for="security-password">Image de sécurité</label>
											
											<div class="control-label margin-top-10">
												<img class="" src="./img/captcha.php" alt="Captcha">
											</div>
										
											<div class="controls margin-top-5">
												<input type="text" class="form-control" id="security-password" name="security-password" placeholder="" required="">
											</div>
											
										</div><br />
										<div style="margin-top: 15px;" class="control-group col-md-12 col-xs-12">
											<div class="checkbox pull-left no-padding no-margin-bottom margin-top-5">
												<input type="checkbox" id="checkbox1" name="checkbox"> 
												<label for="checkbox1">J'accepte les <a href="?page=cgu">CGU</a>.</label>
											</div>
											<button type="submit" name="register" class="btn btn-success pull-right">S'inscrire</button>
										</div>
									</div>	
								</form>
								<h2 class="page-header text-center no-margin-top"></h2>
							</section>
							
						</div>
					</div>
				</div>
			</div>	
			<br /> <br /> <br /> <br />
			<!-- ./leftside -->				
