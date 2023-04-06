			<div class="leftside">
					<ol class="breadcrumb">
						<li><a href="?page=index">Accueil</a></li>
						<li class="active">News</li>
					</ol>	
				<div class="row">
					<div class="col-md-12 col-xs-12">
						<section class="no-border no-padding-top">
							<div class="page-header margin-top-10"><h4>Quoi de neuf ?</h4></div>
							
								<?php
								require_once("./include/rsslib.php");
								echo RSS_Display(URL_RSS_NEWS_IPB, 15, false, true);
								?>
							
							
						</section>
					</div>
				</div>			
			</div>
			<!-- ./leftside -->			