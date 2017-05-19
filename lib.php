<?php 
$Topics;
function getTopics(){
	global $Topics;
	return $Topics;
}
function getTopic($key){
	global $Topics;
	if ($key == "")
	{
		echo "\$key = ''<br/>";
		debug_print_backtrace();
	}
	return $Topics[$key];
}
$Articles;
function getNumArticles(){
	global $Articles;
	return count($Articles);
}
function getArticle($key){
	global $Articles;
	return $Articles[$key];
}
function getArticles(){
	global $Articles;
	return $Articles;
}
$Comments = array();;

require_once ("article_class.php");
require_once ("topic_class.php");
require_once ("comment_class.php");
require_once("Mobile_Detect.php");
$detect = new Mobile_Detect;

function makeKey($key)
{
	if ($key == "")
	{
		echo "\$key = ''<br/>";
		debug_print_backtrace();
	}
	$key = strip_tags($key);
	$key = str_replace(' ', '_', $key);
	$key = str_replace('!', '', $key);
	$key = str_replace("&", 'and', $key);
	$key = str_replace(",", '', $key);
	$key = str_replace(":", '', $key);
	$key = str_replace(";", '', $key);
	$key = str_replace("%", 'percent', $key);
	$key = str_replace(".", '', $key);
	$key = str_replace("\'", '', $key);
	$key = str_replace("\"", '', $key);
	$key = str_replace("*", '', $key);
	$key = str_replace("-", '', $key);
	$key = str_replace('"', '', $key);
	$key = str_replace("'", '', $key);
	$key = str_replace("?", '', $key);
	return strtolower($key);
}

function start()
{
	$rootPath = ""; //Don't ask...
	$XML = simplexml_load_file($rootPath . "topics.xml");
	makeTopics($XML);
	$XML = simplexml_load_file($rootPath . "articles.xml");
	makeArticles($XML);
	getCommentsXML($rootPath);
	global $Comments;
	global $Articles;
	foreach ($Comments as $comment)
	{
		$Articles[$comment->m_szArticleKey]->addComment($comment);
	}
	
}

function makeArticles($XML)
{
	global $Articles;
	$Articles = array();
	foreach ($XML->children() as $child)
	{
		$article = new Article($child);
		$Articles[$article->getKey()] = $article;
	}
}

function createCalendarControls()
{
	$xml = simplexml_load_file("calendar.xml");
	$categories = [];
	foreach ($xml->children() as $day)
	{
		if ($day->Events)
		{
			foreach ($day->Events->children() as $event)
			{
				if ($event->Category)
				{
					$category = (string)$event->Category;
					if (!in_array($category, $categories))
					{
						array_push($categories, $category);
						echo "<input type=\"checkbox\" value=\"" . $category . "\" onClick=\"calendarRefresh()\" checked>" . $category . " | ";
					}
				}
			}
		}
	}
}

function printCalendar()
{
	$xml = simplexml_load_file("calendar.xml");
	$day = NULL;
	foreach ($xml->children() as $child)
	{
		$dayThing = date_create_from_format("d F Y", $child->Date); //SO SORRY
		$diff = $dayThing->diff(date_create(), false);
		if ($diff->d > 1 && $dayThing < date_create())
			continue;
		if ($day == NULL || date_create_from_format("d F Y", $child->Date) != $day)
		{
			$day = date_create_from_format("d F Y", $child->Date);
			if ($day != NULL)
				echo("<hr>");
			echo "<h5 class=\"calendar-header\" data-date=\"". $day->format("j-n-Y") . "\">" . $day->format("l, F j Y") . "</h5>";
		}
		if ($child->Events)
		{
			foreach ($child->Events->children() as $event)
			{
				$name = $event->Name;
				$category = $event->Category;
				$text = $event->Text;
				echo <<<EOT
				<div class="calendar-item" name="$name" typeof="Event">
					<div class="calendar-item-name">
						<small>$category</small><br/>
						<b property="name">$name</b>
					</div>
					<div class="calenar-item-text" property="description">
						$text
					</div>
				</div>
EOT;
			}
		}
	}
}

function makeTopics($XML)
{
	global $Topics;
	$Topics = array();
	foreach ($XML->children() as $child)
	{
		$Topics[makeKey((string)$child->Name)] = new Topic($child);
	}
	foreach ($XML->children() as $child)
	{
		$Topics[makeKey((string)$child->Name)]->readPass2($child);
	}
	foreach (getTopics() as $topic)
	{
		$topic->readPass3();
	}
}

function printArticles()
{
	global $Articles;
	foreach (getArticles() as $article)
	{ 
		printArticle($article->getKey(), true);
	}
}

function printSomeArticles($count, $start = 0)
{
	global $Articles;
	for ($i = $start; $i < $count + $start; $i++)
	{
		echo array_values($Articles)[$i];
	}
}

function getArticleTitle($key)
{
	return getArticle($key)->getTitle();
}

function printArticle($key)
{
	global $Articles;
	echo $Articles[$key];
} 

function makeNavBar()
{
	global $Articles;
	global $detect;
	$year = "def";
	$month = "null";
	$monthFormat = ($detect->isMobile() ? "M" : "F");
	foreach ($Articles as $article)
	{
		if (strcmp($month, $article->getDate()->format($monthFormat)) != 0) //Creates a new list for each month
		{
			if (strcmp($month, "null") != 0)
			{
				echo "\t\t\t</div>\n";
			}
			
			if (strcmp($year, $article->getDate()->format("Y")) != 0)//Creates a new list for each year
			{
				if (strcmp($year, "def") != 0)
				{
					echo "\t\t</div>\n";
				}
				$year = $article->getDate()->format("Y");
				echo "\t\t<div class=\"navBarItem year\">\n\t\t\t<h3 onClick=\"toggleDateCatagory(this)\">".$year."</h3>\n";
			}
			
			$month = $article->getDate()->format($monthFormat);
			$div = "\t\t\t<div class=\"navBarItem month\"";
			if (strcmp($year, getdate()['year']) != 0)
			{
				$div .= " style=\"display:none;\"";
			}
			$div .= ">\n";
			echo $div."\t\t\t\t<b onClick=\"toggleDateCatagory(this)\">".$month."</b>\n";
		}
		
		
		echo "\t\t\t\t<a href=\"article.php?article=".$article->getKey()."\"";
		if (strcmp($month, getdate()['month']) == 0 && strcmp($year, getdate()['year']) == 0)
			echo " style=\"display:block\"";
		else
			echo " style=\"display:none\"";
		echo " class=\"navBarItem navBarArticle\">" . strip_tags($article->getTitle()) . "</a>\n";
	}
	echo "\t\t\t</div>\n";
}

function getCommentsXML($rootPath)
{
	global $Comments;
	$xml = simplexml_load_file($rootPath . "comments.xml");
	$i = 0;
	foreach ($xml->children() as $node)
	{
		$Comments[$i] = new Comment(
		$node->Article,
		$node->Name,
		$node->Text,
		$node->CommentDate);
		$i++;
	}
}

function addComment($article, $name, $text)
{
	$xml = simplexml_load_file('comments.xml');
	$comment = $xml->addChild('Comment');
	$comment->addChild('Article', $article);
	$comment->addChild('Name', $name);
	$comment->addChild('Text', $text);
	$comment->addChild('Date', date("Y/m/d"));
	//Format XML to save indented tree rather than one line
	$dom = new DOMDocument('1.0');
	$dom->preserveWhiteSpace = false;
	$dom->formatOutput = true;
	$dom->loadXML($xml->asXML());
	//Echo XML - remove this and following line if echo not desired
	//echo $dom->saveXML();
	//Save XML to file - remove this and following line if save not desired
	$dom->save('comments.xml');
}
?>