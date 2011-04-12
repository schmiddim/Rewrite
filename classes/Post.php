<?php
define('DELIMITER'," " );
class Post{

	private $title, $date, $text, $permalink;
	public $delimiter=" ";
	public function __construct($title, $text,$date=""){
		$this->text=$text;
		$this->title=$title;
		if (empty($date)){
			$this->date=date("Y M d");
		}else {
			$this->date=$date;
		}

	}
	public function setPermalink(Routing $r){
		$this->permalink=$r->generateUrl($this->getUrl());


	}
	private function splitDate(){
		return explode(" ", $this->date);

	}
	public function getUrl(){
		$split=$this->splitDate();
		array_push($split, $this->title);
		return $split;
	}
	public function __toString(){
		return $this->title.$this->delimiter. $this->date.$this->delimiter.$this->text ." <a href=\"{$this->permalink}\">{$this->permalink}</a>";
	}
	/************GETTER & SETTER*********************/
	public function title($title=""){ if (empty($title)){return $this->title; }else{$this->title=$title;}}
	public function text($text=""){ if (empty($text)){return $this->text; }else{$this->text=$text;}}
	public function date($date=""){ if (empty($date)){return $this->date; }else{$this->date=$date;}}
	public function permalink($permalink=""){ if (empty($permalink)){return $this->permalink; }else{$this->permalink=$permalink;}}

}