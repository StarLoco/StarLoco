<?php
/*
	RSS Extractor and Displayer
	(c) 2007-2009  Scriptol.com - Licence Mozilla 1.1.
	rsslib.php
	
	Requirements:
	- PHP 5.
	- A RSS feed.
	
	Using the library:
	Insert this code into the page that displays the RSS feed:
	
	<?php
	require_once("rsslib.php");
	echo RSS_Display("http://www.xul.fr/rss.xml", 15);
	?>
	
*/

$RSS_Content = array();

function RSS_Tags($item, $type) {
	$y = array();
	$tnl = $item->getElementsByTagName("title");
	$tnl = $tnl->item(0);
	$title = $tnl->firstChild->textContent;

	$tnl = $item->getElementsByTagName("link");
	$tnl = $tnl->item(0);
	$link = $tnl->firstChild->textContent;
	
	$tnl = $item->getElementsByTagName("description");
	$tnl = $tnl->item(0);
	$description = $tnl->firstChild->textContent;
   
	$tnl = $item->getElementsByTagName("pubDate");
	$tnl = $tnl->item(0);
	$pubDate = $tnl->firstChild->textContent;
	
	$y["title"] = $title;
	$y["link"] = $link;
	$y["description"] = $description;
	$y["type"] = $type;
	$y["pubDate"] = $pubDate;

	return $y;
}

function RSS_Channel($channel) {
	global $RSS_Content;

	$items = $channel->getElementsByTagName("item");
	// Processing channel
	$y = RSS_Tags($channel, 0);		// get description of channel, type 0
	array_push($RSS_Content, $y);
	// Processing articles
	foreach($items as $item) {
		$y = RSS_Tags($item, 1);	// get description of article, type 1
		array_push($RSS_Content, $y);
	}
}

function RSS_Retrieve($url) {
	global $RSS_Content;
	$opts = array('http' => array('user_agent' => 'PHP libxml agent'));
	$context = stream_context_create($opts);
	libxml_set_streams_context($context);
	
	$doc  = new DOMDocument();
	$doc->load($url);
	
	$channels = $doc->getElementsByTagName("channel");
	$RSS_Content = array();
	
	foreach($channels as $channel) {
		RSS_Channel($channel);
	}
}

function RSS_Display($url, $size = 15, $site = 0) {
	global $RSS_Content;

	$opened = false;
	$page = "";
	$site = (intval($site) == 0) ? 1 : 0;

	RSS_Retrieve($url);
	if($size > 0)
		$recents = array_slice($RSS_Content, $site, $size + 1 - $site);

	$i = 0;
		
	foreach($recents as $article) {
	if($i > 5) break;
			$type = $article["type"];
			$title = $article["title"];
			$link = $article["link"];
			$description = $article["description"];
			$date = substr($article["pubDate"], 5, -5);
			
			if(strlen($description) > 250)  { 
				$description = substr($description, 0, 250) . '..';
			}
			$description = str_replace("<p>&nbsp;</p>", "", $description);
			$description = str_replace("<strong>", "", $description);
			$description = str_replace("</strong>", "", $description);
			
			$page .= 
			'<section>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<h3 class="main-title"><a href="' . $link . '">' . $title . '</a></h3>
					<p>' . $description . '</p>
					<div class="details"><i class="ion-android-calendar"></i>' . convertDateEnToFr($date) . '</div>
				</div>
			</section>';
			$i++;
			
	}
	return $page;
} ?>