<?php
class Comment
{
	public $m_szArticleKey;
	public $m_szCommentorName;
	public $m_szCommentText;
	public $m_Date;
	
	function __construct($article, $name, $text, $date)
	{
		$this->m_szArticleKey = "".$article;
		$this->m_szCommentorName = $name;
		$this->m_szCommentText = $text;
		$this->m_Date = date_create($date);
	}
	
	function format()
	{
		$html = "\t\t<p class=\"comment\" typeof=\"Comment\" property=\"comment\">\n";
		$html .= "\t\t<strong property=\"author\">".$this->m_szCommentorName."</strong><br/> \n";
		$html .= "\t\t<span property=\"datePublished\">" . date_format($this->m_Date, "jS F Y") . "</span>\n";
		$html .= "\t\t<p property\"text\">".$this->m_szCommentText."</p>";
		$html .= "\t\t</p><hr/>";
		return $html;
	}
}
?>