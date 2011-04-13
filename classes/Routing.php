<?php
/**
 * 
 * Die Klasse ist für das Erzeugen und auswerten von Urls zuständig. 
 * @author ms
 *
 */
abstract class Routing{

	protected $url=array();
	protected $documentRoot=false;
	
	public function __construct(){
		$this->parseUrl();
	}

	/**
	 * lautet die Url http://[DOMAIN]/? 
	 */
	public function isDocumentRoot(){
		return $this->documentRoot;
	}
	
	public function generateUrl(array $crumbs){

		$crumbs=array_map(array($this, 'slugify'), $crumbs); //Leerzeichen entfernen
		$url="http://{$_SERVER['SERVER_NAME']}/";		
		$url.=implode('/', $crumbs);
		return $url;


	}
	/**
	 * 
	 * Prüft anhand der Url, ob ein Beitrag ausgegeben werden soll
	 * @param $post die Werte in dem Array werden mit denen der Url verglichen
	 */	
	public function match(array $post){
		 
		$url=$this->url;
		if(!is_array($post))
			return false;
			
		if ($url[0]=='/' && count($url)==1) {
			$this->documentRoot=true;
		}
		
	
			
		for($i=0;$i<count($url);$i++){		
			$modurl=($this->slugify($url[$i]));
			$modpost=($this->slugify($post[$i]));	
			
			if(($modpost)!=($modurl))
				return false;
		}

			
		return true;

	}
	
	public function getUrl(){
		return $this->url;
	}
	/**
	 * 
	 * Leer-, Sonderzeichen und Umlaute aus einer Url entfernen
	 * @param String $text
	 */
	protected  function slugify($text){
		$umlauts=array('ä','ö','ü', 'ß');
		$replace=array('ae','oe','ue','ss');
		$text=strtolower($text);
		$text=str_replace($umlauts, $replace, $text);
		$text = preg_replace('/\W+/', '-', $text);
		$text = trim($text, '-');
		return $text;
	}
	
	/**
	 * 
	 * Url in ein Array zerlegen
	 */
	private function parseUrl(){
		$url= isset($_SERVER['REQUEST_URI'])? $_SERVER['REQUEST_URI'] :'';
		$url=utf8_decode($url);		
		$crumbs = explode('/' , utf8_decode(urldecode($url)));
		$retval=array();
		foreach ($crumbs as $crumb){
			if ( trim($crumb) !='')
			array_push($retval, $crumb);

		}
		if (count($retval)==0)
		array_push($retval, '/');
		$this->url=$retval;
	}

}//class
/**
 * 
 * In dieser Klasse kann das Routing über die Methode match angepasst werden. 
 * @author ms
 *
 */
class BlogRouting extends Routing{
	public function __construct(){
		parent::__construct();

	}

	public function match(array $post){
	
		return parent::match($post);		
	}
}//class

?>