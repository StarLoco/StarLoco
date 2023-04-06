			<div class="leftside">
				<ol class="breadcrumb">
					<li><a href="?page=index">Accueil</a></li>
					<li class="active">Visualisateur de drop</li>
				</ol>	
				<ol class="breadcrumb">
					<form method="post" class="form-inline">
						<input type="text" class="form-control" name="monster" style="border: 1px solid gray;" placeholder="Recherche du monstre.." />
						<button type="submit" class="btn btn-primary" name="search1"><i class="fa fa-search"></i></button>
					</form>
					<br />
					<form method="post" class="form-inline">
						<input type="text" class="form-control" name="object" style="border: 1px solid gray;" placeholder="Recherche de l'objet.." />
						<button type="submit" name="search2" class="btn btn-primary"><i class="fa fa-search"></i></button>
					</form>
				</ol>
				
					<?php
					if(isset($_POST['search1']) && isset($_POST['monster'])) {
						$query1 = $jiva -> prepare("SELECT * FROM `monsters` WHERE LOWER(name) LIKE ?;");
						$query1 -> execute(array("%" . strtolower($_POST['monster']) . "%"));
						$query1 -> setFetchMode(PDO:: FETCH_OBJ);
						?>
						<ol class="breadcrumb">
						<div class="box no-border-radius padding-20" style="border: 1px solid gray;">
							<table class="table table-striped no-margin">
								<thead>
									<tr>
										<th>Nom du monstre</th>
										<th>Nom de l'objet</th>
										<th>Prospection</th>
										<th>Taux</th>
									</tr>
								</thead>
								<tbody>
						<?php
						
						while($row1 = $query1 -> fetch()) { 
							$count = 0;
							$query2 = $jiva -> prepare("SELECT * FROM `drops` WHERE `monsterId` = ?;");
							$query2 -> execute(array($row1 -> id));
							
							while($query2 -> fetch()) 
								$count++;
								
							$query2 -> closeCursor();
							
							if($count > 0) { ?>
								<tr>
									<td><?php echo $row1 -> name; ?></td>
								<?php
								$query2 = $jiva -> prepare("SELECT * FROM `drops` WHERE `monsterId` = ?;");
								$query2 -> execute(array($row1 -> id));
								$query2 -> setFetchMode(PDO:: FETCH_OBJ);
								$name = "";
								$seuil = "";
								$taux = "";
								while ($row2 = $query2 -> fetch()) { 
									$query3 = $jiva -> prepare("SELECT * FROM `item_template` WHERE id = ?;");
									$query3 -> execute(array($row2 -> objectId)); 
									$query3 -> setFetchMode(PDO:: FETCH_OBJ);
									while($row3 = $query3 -> fetch()) { 
										$name .= $row3 -> name . "<br />";
										$seuil .= $row2 -> ceil; 
										$seuil .= "<img src='http://dofus2.org/images/armes/Rune-Prospe_0.png' height='10' width='10'></img><br />";
										
										if ($row2->percentGrade5 >= 1) { 
											if($row2->percentGrade1 == $row2->percentGrade5) 
												$taux .= str_replace(".0", "", str_replace(".00", "", str_replace(".000", "", str_replace("00%", "%", $row2->percentGrade1 . "%"))));
											else
												$taux .= str_replace(".0", "", str_replace(".000", "", str_replace(".000", "", str_replace("00%", "%", $row2->percentGrade1 . "%")))) . " à " . str_replace(".0", "", str_replace(".000", "", str_replace(".000", "", str_replace("00%", "%", $row2->percentGrade5 . "%"))));
										} else $taux .= "<font color='red'><</font> 1%";
										$taux .= "<br />";
									}
								} ?>
									<td><?php echo $name; ?></td>
									<td><?php echo $seuil; ?></td>
									<td><?php echo $taux; ?></td>                        
								</tr><?php
							} 
						}
						$query1 -> closeCursor();
						$query2 -> closeCursor();
						$query3 -> closeCursor(); ?>
								</tbody>
							</table>	
						</div>
						</ol>
					<?php 
					
					
					
					
					
					
					
					
					} else if(isset($_POST['search2']) && isset($_POST['object'])) {
						$query1 = $jiva -> prepare("SELECT * FROM `item_template` WHERE LOWER(name) LIKE ?;");
						$query1 -> execute(array("%" . strtolower($_POST['object']) . "%"));
						$query1 -> setFetchMode(PDO:: FETCH_OBJ);
						?>
						<ol class="breadcrumb">
						<div class="box no-border-radius padding-20" style="border: 1px solid gray;">
							<table class="table table-striped no-margin">
								<thead>
									<tr>
										<th>Nom du monstre</th>
										<th>Nom de l'objet</th>
										<th>Prospection</th>
										<th>Taux</th>
									</tr>
								</thead>
								<tbody>
						<?php
						while($row1 = $query1 -> fetch()) {
							$count = 0;
							$query2 = $jiva -> prepare("SELECT * FROM `drops` WHERE `objectId` = ?;");
							$query2 -> execute(array($row1 -> id));
					
							while($query2 -> fetch())
								$count++;
							
							$query2 -> closeCursor();
							
							if($count > 0) { ?>		
								<tr>
									<td><?php echo $row1 -> name; ?></td>
									<?php
									$query2 = $jiva -> prepare("SELECT * FROM `drops` WHERE `objectId` = ?;");
									$query2 -> execute(array($row1 -> id));
									$query2 -> setFetchMode(PDO:: FETCH_OBJ);
									$name = "";
									$seuil = "";
									$taux = "";
									
									while ($row2 = $query2 -> fetch()) { 
										$query3 = $jiva->prepare("SELECT * FROM `monsters` WHERE `id` = ?;");
										$query3 -> execute(array($row2 -> monsterId)); 
										$query3 -> setFetchMode(PDO:: FETCH_OBJ);
										
										while($row3 = $query3 -> fetch()) { 
											$name .= $row3 -> name . "<br />";
											$seuil .= $row2 -> ceil; 
											$seuil .= "<img src='http://dofus2.org/images/armes/Rune-Prospe_0.png' height='10' width='10'></img><br />";
							
											if ($row2->percentGrade5 >= 1) { 
												if($row2->percentGrade1 == $row2->percentGrade5) 
													$taux .= str_replace(".0", "", str_replace(".00", "", str_replace(".000", "", str_replace("00%", "%", $row2->percentGrade1 . "%"))));
												else
													$taux .= str_replace(".0", "", str_replace(".000", "", str_replace(".000", "", str_replace("00%", "%", $row2->percentGrade1 . "%")))) . " à " . str_replace(".0", "", str_replace(".000", "", str_replace(".000", "", str_replace("00%", "%", $row2->percentGrade5 . "%"))));
											} else $taux .= "<font color='red'><</font> 1%";
											$taux .= "<br />";
										} 						
									} ?>

									<td><?php echo $name; ?></td>
									<td><?php echo $seuil; ?></td>
									<td><?php echo $taux; ?></td>                        
								</tr>
							<?php	

							}
						} 
						$query1 -> closeCursor();
						$query2 -> closeCursor();
						$query3 -> closeCursor(); ?>
								</tbody>
							</table>	
						</div>
						</ol><?php
					} ?>	
					
			</div>
			<!-- ./leftside -->	