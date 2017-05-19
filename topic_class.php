<?php 
class Topic
{
	private $name;
	private $subtopics;
	private $description;
	private $key;
	private $bSubtopic;

	function __construct($xmlNode)
	{
		$this->name = (string)$xmlNode->Name;
		$this->description = (string)$xmlNode->Description;
		$this->key = makeKey($this->getName());
	}
	
	function readPass2($xmlNode)
	{
		if (!($xmlNode->Subtopics) || count($xmlNode->children()) == 0)
			return;
		global $Topics;
		$this->subtopics = array();
		foreach ($xmlNode->Subtopics->children() as $child)
		{
			$this->subtopics[makeKey($child)] = $Topics[makeKey($child)];
		}
	}
	
	function readPass3()
	{
		$this->bSubtopic = false;
		foreach (getTopics() as $topic)
		{
			if ($topic == $this)
				continue;
			$this->bSubtopic = $this->bSubtopic || $topic->hasSubtopic($this->getKey());
		}
	}
	
	function getName()
	{
		return $this->name;
	}
	
	function getDescription()
	{
		return $this->description;
	}
	
	function getSubtopic($key)
	{
		return $this->subtopics[$key];
	}
	
	function getSubtopics()
	{
		return $this->subtopics;
	}
	
	function getNumSubtopics()
	{
		return count($this->subtopics);
	}
	
	function hasSubtopic($key)
	{
		return array_key_exists($key, $this->subtopics);
	}
	
	function isSubtopic()
	{
		return $this->bSubtopic;
	}
	
	function includesTopic($key)
	{
		if ($key == $this->getKey()) //If $key refers to $this
			return true;
		foreach ($this->subtopics as $subtopic)
		{
			if ($subtopic->includesTopic($key))
				return true;
		}
		return false;
	}
	
	function includesArticle($key)
	{
		if (getArticle($key)->getTopic() == null) //if $key refers to an article with no topic
		{
			return false;
		}
		return $this->includesTopic(getArticle($key)->getTopic()->getKey());
	}
	
	function getKey()
	{
		return $this->key;
	}

	function __toString()
	{
		return $this->getName();
	}
}
?>