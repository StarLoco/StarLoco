			<div class="leftside">
				<ol class="breadcrumb">
					<li><a href="?page=index">Accueil</a></li>
					<li class="active">Vote</li>
				</ol>	
				<?php 
				if(isset($_GET['ok'])) {
					if(isset($_SESSION['id'])) {
						$query = $login -> prepare('SELECT votes, heurevote, points, totalVotes FROM world_accounts WHERE guid = ' . $_SESSION['id'] . ';');
						$query -> execute();
						$row = $query -> fetch();
						$query -> closeCursor();
						
						date_default_timezone_set("Europe/Paris"); 
						
						$curVotes = $row['votes']; 
						$totalVotes = $row['totalVotes'] + 1;
						
						$curDate = time();
						$lastDate = $row['heurevote']; 
						$diffDate = $curDate - $lastDate;
						
						$curPoints = $row['points']; 
						
						if(!CLOUDFLARE_ENABLE) $ip = $_SERVER['REMOTE_ADDR']; // no cloudflare
						else $ip = $_SERVER["HTTP_CF_CONNECTING_IP"]; // with cloudflare

						$query = $connection -> prepare("SELECT * FROM `website_users_votes` WHERE ip LIKE '" . $ip . "';");
						$query -> execute();
						$row = $query -> fetch();
						$query -> closeCursor();
						
						$ipDate = $row['date'];

						if(!($diffDate > 60 * 60 * 3)) {
							echo '<div class="alert alert-danger no-border-radius" role="alert">
							<center>Il te faut attendre encore ' . (int) (60 * 3 - ($diffDate / 60)) . ' minute(s) avant de pouvoir voter !</center></div>';
						} else if(!(($curDate - $ipDate) > 60 * 60 * 3)) {
							echo '<div class="alert alert-danger no-border-radius" role="alert">
							<center>Il te faut attendre encore ' . (int) (60 * 3 - (($curDate - $ipDate) / 60)) . ' minute(s) avant de pouvoir voter !</center></div>';
						} else {
							$query = $login -> prepare("UPDATE world_accounts SET votes = " . ($curVotes + 1) . ", heurevote = '" . $curDate . "', totalVotes = " . $totalVotes . ", points = " . ($curPoints + PTS_PER_VOTE) . " WHERE guid = " . $_SESSION['id'] . ";");
							$query -> execute();
							$query -> closeCursor();
							$query = $connection -> prepare("DELETE FROM `website_users_votes` WHERE ip = '" . $ip . "';");
							$query -> execute();
							$query -> closeCursor();
							$query = $connection -> prepare("INSERT INTO `website_users_votes` (ip, date) VALUES ('" . $ip . "', '" . $curDate . "');");
							$query -> execute();
							$query -> closeCursor();

							echo '<div class="alert alert-info no-border-radius" role="alert">
							<center>Tu va être redirigé sur la page de vote !</center></div>';
							echo "<meta http-equiv='refresh' content='1; url=" . URL_RPG . "'> ";
						}					
					}
						
				} else { ?>
					<center><a href="?page=vote&ok"><img style="border: 1px solid gray;" src="<?php echo URL_SITE . 'img/rpg.jpg'; ?>"/></a></center><br>
					<?php
					if(isset($_SESSION['id'])) { ?>
						<div class="alert alert-info no-border-radius" role="alert">
							<center>Afin de rendre utile les votes, nous vous offrons <?php echo PTS_PER_VOTE; ?> points de vote pour vous remerciez des votes effectués !<br>
							Après avoir cliqué sur l'image ci-dessus, vous serez créditer des points indiqué.</center>
						</div><?php
					} else { ?>
						<div class="alert alert-info no-border-radius" role="alert">
							<center>Afin de rendre utile les votes, nous vous offrons <?php echo PTS_PER_VOTE; ?> points de vote pour vous remerciez des votes effectués !
							Pour que vos votes soient comptabiliser, il faut que vous soyez connecter sur le site.
							Nous vous invitons donc à vous connectez en <strong><a href="<?php echo URL_SITE . "?page=signin"; ?>"> cliquant ici.</a></strong><br><br>
							
							Sinon, vous pouvez directement voter pour nous en cliquant sur l'image ci-dessus.</center>
						</div><?php
					}
				}
				?>
			</div>
			<!-- ./leftside -->	
