	<?php
require_once("comment_class.php");
class Article
{
	private $m_szTitle;
	private $m_szText;
	private $m_Date;
	private $m_pszTags;
	private $m_szKey;
	private $m_Authors;
	private $m_Topic;
	private $m_Comments;
	
	function __construct($xmlNode)
	{
		$this->m_szTitle = $xmlNode->Title;
		if (strpos($xmlNode->Text, '<') > -1)
		{
			$this->m_szText = $xmlNode->Text;
		}
		else
		{
			$this->m_szText = "";
			foreach ($xmlNode->Text->children() as $child)
			{
				$this->m_szText .= $child->asXML();
			}
		}
		if ($xmlNode->PubDate)
		{
			$dateString = "" . $xmlNode->PubDate;
			$this->m_Date = date_create_from_format("j F Y", $dateString);
		}
		else
		{
			$Year = $xmlNode->Year;
			$Month = $xmlNode->Month;
			$Day = $xmlNode->Day;
			$this->m_Date = date_create_from_format("j F Y", $Day . " " . $Month . " " . $Year);
		}
		$this->m_pszTags = array();
		if ($xmlNode->Tags)
		{
			foreach ($xmlNode->Tags->children() as $child)
			{
				array_push($this->m_pszTags, $child);
			}
		}
		$this->m_Authors = array();
		$i = 0;
		foreach ($xmlNode->Authors->children() as $authorNode)
		{
			$this->m_Authors[$i] = $authorNode;
			$i++;
		}
		
		if ($xmlNode->Topic)
			$this->m_Topic = getTopic(makeKey((string)($xmlNode->Topic)));
		else
			$this->m_Topic = null;
		$this->m_szKey = makeKey($this->m_szTitle);
		$this->m_Comments = array();
	}
	
	function getTitle()
	{
		return $this->m_szTitle;
	}
	
	function getText()
	{
		return $this->m_szText;
	}
	
	function getDate()
	{
		return $this->m_Date;
	}
	
	function getTopic()
	{
		return $this->m_Topic;
	}
	
	function getAuthors()
	{
		return $this->m_Authors;
	}
	
	function getKey()
	{
		return $this->m_szKey;
	}
	
	function getNumTags()
	{
		return count($this->m_pszTags);
	}
	
	function getTag($index)
	{
		return $this->m_pszTags[$index];
	}
	
	//This does not add a comment in the sense of modifying comments.xml
	//THIS IS IMPORTANT ^^^^^
	function addComment($comment)
	{
		array_push($this->m_Comments, $comment);
	}
	
	function __toString()
	{
		$key = $this->getKey();
		$title = $this->getTitle();
		$date = date_format($this->getDate(), "F jS Y");
		$html = <<<EOT
		<div class="article" onclick="toggleSize(this)" articleSize="normal" vocab="http://schema.org/" typeof="NewsArticle">\r
		\t<h2 class="title-text" property="headline">$title</h2>\r
		\t<h3 class="subtitle-text" property="datePublished"> $date| By 
EOT;
		foreach ($this->getAuthors() as $author)
		{
			$html .= "<span property=\"author\">" . $author . "</span> ";
		}
		$html .= "</h3>\r";
		$html .= "\t\t\t<div class=\"article-body\" property=\"articleBody\">\r";
		$html .= $this->getText() . "\r";
		$html .= "</div> \r";
		$html .= "<div class=\"article-comments\">\r";
		foreach ($this->m_Comments as $comment)
		{
			$html .= $comment->format();

		}
		$html .= "</div>";
		$html .= <<<EOT
		<h4>Comments</h4>
		<form name="comment" action="article.php?article=$key" method="post" onmouseenter="mouseEnterComments()" onmouseleave="mouseLeaveComments()">
			<label for="commentor_name">Name: </label><input type="text" name="commentor_name" class="name-input"><br/>
			<label for="is_not_robot">Check this box if you ARE NOT a robot: </label><input name="is_not_robot" type="checkbox"/><br/> 
			<label for="is_robot">Check this box if you ARE a robot:  </label><input name="is_robot" type="checkbox"/><br/>
			<label for="comment_text">Comment:</label><br/><textarea name="comment_text" rows="4" class="comment-text"></textarea><br/>
			<input type="submit" value="Post"/>
		</form>
EOT;
		
		$html .= "</div>";
	
		return $html;
	}
}
?>

