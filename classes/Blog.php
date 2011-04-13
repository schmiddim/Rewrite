<?php
class Blog{
	private $posts =array();
	private $routing;
	public $delimiter="\n";


	public function __construct(Routing $routing){
		$this->routing =$routing;
	}

	
	public function addPost(Post $post){
		array_push($this->posts, $post);
	}

	public function getHtmlForPost(Post $p){
		$retval="
		<div class=\"post\">
		<h3>{$p->title()}</h3>
		<div class=\"post-date\">{$p->date()}</div>
		<div class=\"post-text\">{$p->text()}</div>
		<div class=\"post-perma\"><a href=\"{$p->permalink()}\">{$p->permalink()}</a></div>
		</div>						
		";

		return $retval;
	}

	public function getPosts(){
		$ctr=0;
		$retval="";
		$selectedPosts=array();
		usort($this->posts, array($this, 'postSort'))	;

		foreach ($this->posts as $post){

			if($this->routing->match($post->getUrlArray() ) ) {
				$post->delimiter="<p>";
				$post->setPermalink($this->routing);
				array_push($selectedPosts, $post);
					
				$ctr++;
			}
		}//each

		if ($this->routing->isDocumentRoot()){
			for ($i=0;$i<5;$i++){
				$p=array_pop($this->posts);
				$p->setPermalink($this->routing);
				array_push($selectedPosts, $p);
			}
		}
			
		if (empty($selectedPosts))
		return "<h1>Leider nichts gefunden &#9785;</h1>";
			
		foreach ($selectedPosts as $post){
			$retval.=$this->getHtmlForPost($post);
		}
			
		return $retval;
	}
	/**	 
	 * Sortierfunktion fuer usort
	 * Sortiert nicht wirklich korrekt, aber fuer das Beispiel sollte es reichen :)	
	 */
	private function postSort($m, $n){
		if($m->date()==$n->date())
			return 0;	
		return ($m->date()>$n->date()) ? 1:-1;
	}

}