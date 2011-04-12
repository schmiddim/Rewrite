<?php
class Blog{
	private $posts =array();
	private $routing;
	public $delimiter="\n";
	
	public function cmp($a, $b){
		$a=$a->intvalue;
		$b=$b->intvalue;
		if ($a == $b) {
			return 0;
		}
		return ($a < $b) ? -1 : 1;
	}
	public function __construct(Routing $routing){
		$this->routing =$routing;
	}


	public function addPost(Post $post){
		array_push($this->posts, $post);
	}
	public function getPosts(){	
		$ctr=0;
		$retval="";	
		foreach ($this->posts as $post){
		if($this->routing->match($post->getUrl() ) ) {
			$post->delimiter="<p>";
			$post->setPermalink($this->routing);	
			$retval.= "$post{$this->delimiter}";
			$ctr++;
		}						
		}//each		
				
		if ($this->routing->isDocumentRoot())
			return "Startseite";		
							
		if ($ctr==0)
			return "404";						
		return $retval;		
	}


}
