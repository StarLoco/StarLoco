			<ol class="breadcrumb">
				<li><a href="?page=index">Accueil</a></li>
				<li class="active">Mot de passe oublié ?</li>
			</ol>
			
			<br /> <br /> <br />	
			<div class="row">
				<div class="col-md-12">
					<!-- section -->
					<div class="row">
						<div class="col-md-6 col-md-offset-3 col-xs-12">
							<section class="section margin-top-20 margin-bottom-20 no-border">
									<h2 class="page-header text-center no-margin-top"><i class="fa fa-sign-in"></i> Réinitialisation de mot de passe</h2>
									<?php
									function generatePassword($length = 8) {
										$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
										$count = mb_strlen($chars);

										for ($i = 0, $result = ''; $i < $length; $i++) {
											$index = rand(0, $count - 1);
											$result .= mb_substr($chars, $index, 1);
										}

										return $result;
									}
									
									if(!isset($_POST['next1']) && !isset($_POST['change'])) { ?>
										<form autocomplete="off" method="POST" action="#">
											<input type="text" class="form-control" name="account" placeholder="Nom de compte" required="">
											<span class="help-block"></span>				
								
											<div class="margin-top-20">
												<center>
													<button type="submit" name="next1" class="btn btn-success pull-mid">Suivant</button>
												</center>
											</div>
										</form>
										<a href="#" class="text-dark margin-top-20 padding-top-20 help-block border-top-light btn-icon-right"></a>
									<?php
									} else if(isset($_POST['next1']) && isset($_POST['account'])) {

										$account = filter_var($_POST['account']);
										$query = $connection -> prepare("SELECT * FROM world_accounts WHERE account = ?;");
										$query -> bindParam(1, $account);
										$query -> execute();
										$query -> setFetchMode(PDO:: FETCH_OBJ);
										$row = $query -> fetch();	
										$query -> closeCursor();
										if(isset($row)) { ?>
											<form autocomplete="off" method="POST" action="?page=password&user=<?php echo $account; ?>">
												<input type="text" class="form-control" name="account" value="<?php echo $row -> account; ?>" disabled>
												<span class="help-block"></span>				
												<input type="text" class="form-control" name="question" value="<?php echo $row -> question; ?>" disabled>
												<span class="help-block"></span>
												<input type="text" class="form-control" name="answer" placeholder="Votre réponse..">
												
												<div class="margin-top-20">
													<center>
														<button type="submit" name="change" class="btn btn-success pull-mid">Modifier</button>
													</center>
												</div>
											</form>
											<a href="#" class="text-dark margin-top-20 padding-top-20 help-block border-top-light btn-icon-right"></a>
										<?php
										} else {
											echo "<div class='alert alert-danger no-border-radius no-margin' style='text-align: center!important;' role='alert'><strong>Oh shit!</strong> Le nom de compte est incorrecte.</div><br />";
										}
									} else if(isset($_POST['change']) && isset($_POST['answer']) && isset($_GET['user'])) { 
										$account = filter_var($_GET['user']);
										$answer = filter_var($_POST['answer']);
										$query = $login -> prepare("SELECT * FROM world_accounts WHERE `account` = ? AND `reponse` = ?;");
										$query -> bindParam(1, $account);
										$query -> bindParam(2, $answer);
										$query -> execute();
										$ok = $query -> rowCount();
										$query -> setFetchMode(PDO:: FETCH_OBJ);
										$row = $query -> fetch();	
										$query -> closeCursor();
										if($ok) {
											$newPass = generatePassword(10);
											$password = hash('SHA512', md5($newPass));
											$query = $login -> prepare("UPDATE world_accounts SET `pass` = ? WHERE `account` LIKE ?;");
											$query -> bindParam(1, $password);
											$query -> bindParam(2, $account);
											$query -> execute();
											$query -> closeCursor();
											echo "<div class='alert alert-success no-border-radius no-margin' style='text-align: center!important;' role='alert'><strong>Oh good!</strong> Votre nouveau mot de passe est désormais : " . $newPass . "</div><br />";
											
										} else {
											echo "<div class='alert alert-danger no-border-radius no-margin' style='text-align: center!important;' role='alert'><strong>Oh shit!</strong> La réponse secrète est incorrecte.</div><br />";
											echo "<meta http-equiv='refresh' content='5; url=" . URL_SITE . "?page=password'> ";
										}
									}
									?>
							
							</section>
						</div>
					</div>
				</div>
			</div>	
			<br /> <br /> <br /> <br /><br /> <br /> <br /> <br /><br /> <br /> <br /> <br /><br /> <br /> <br /> <br />
			<!-- ./leftside -->				
