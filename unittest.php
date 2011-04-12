#!/usr/bin/phpunit
<?php
require_once 'classes/Routing.php';
require_once 'classes/Post.php';
require_once 'classes/Blog.php';
class DependencyFailureTest extends PHPUnit_Framework_TestCase{
	private static $posts=array();
	private static $router;
	private static $blog;


	public static function tearDownAfterClass(){}
	public  function setup(){
		$_SERVER['SERVER_NAME']='localhost';

		self::$blog=new Blog(new BlogRouting());		
		self::$blog->addPost(new Post("Artikel 1", "LOREM IPSUM LOREM IPSUM", "2010 Januar 23"));
		self::$blog->addPost(new Post("Verrückte Umlaute", "LOREM IPSUM LOREM IPSUM", "2010 Februar 10"));
		self::$blog->addPost(new Post("Artikel 3", "LOREM IPSUM LOREM IPSUM", "2010 März 4"));
		self::$blog->addPost(new Post("Artikel 4", "LOREM IPSUM LOREM IPSUM", "2010 April 2"));
		self::$blog->addPost(new Post("Artikel 55", "LOREM IPSUM LOREM IPSUM", "2010 September 26"));
		self::$blog->addPost(new Post("Einzelpost", "LOREM IPSUM LOREM IPSUM", "2011 April 11"));
		
		self::$blog->addPost(new Post("Artikel 5", "LOREM IPSUM LOREM IPSUM", "2011 Januar 23"));
		self::$blog->addPost(new Post("Artikel 6", "LOREM IPSUM LOREM IPSUM", "2011 Januar 10"));
		self::$blog->addPost(new Post("Artikel 7", "LOREM IPSUM LOREM IPSUM", "2011 Januar 4"));
		self::$blog->addPost(new Post("Artikel 8", "LOREM IPSUM LOREM IPSUM", "2011 Januar 2"));
		
		self::$blog->addPost(new Post("Artikel 9", "LOREM IPSUM LOREM IPSUM", "2010 September 23"));
		self::$blog->addPost(new Post("Artikel 10", "LOREM IPSUM LOREM IPSUM", "2010 September 23"));
		self::$blog->addPost(new Post("Artikel 11", "LOREM IPSUM LOREM IPSUM", "2010 September 23"));
		self::$blog->addPost(new Post("Artikel 12", "LOREM IPSUM LOREM IPSUM", "2010 September 23"));
		self::$blog->addPost(new Post("Artikel 13", "Haloooooo", "2010 September 23"));

	}//setup

	private function countArticles(){
		return count(preg_split("/\n/", self::$blog->getPosts(),-1,PREG_SPLIT_NO_EMPTY));
	}
	
	public function testGetArticle(){
		$_SERVER['REQUEST_URI']='/2011/April/11/Einzelpost';
		$this->setUp();								
		$this->assertEquals($this->countArticles(), 1);

	}
	
	public function testGetYear(){
		$_SERVER['REQUEST_URI']='/2011';
		$this->setUp();		
		$this->assertEquals($this->countArticles(), 5);
	
	}

	public function testGetMonth(){
		$_SERVER['REQUEST_URI']='/2010/September';
		$this->setUp();	
		$this->assertEquals($this->countArticles(), 6);
		
	}
	
	public  function testGetDay(){
		$_SERVER['REQUEST_URI']='/2010/september/23';
		$this->setUp();
		$this->assertEquals($this->countArticles(), 5);	
		
	}

	public function testGetDocumentRoot(){
		$_SERVER['REQUEST_URI']='/';	
		$this->setUp();		
		$this->assertEquals(self::$blog->getPosts(), "Startseite");
	}	
	public function testContentNotFound(){
		$_SERVER['REQUEST_URI']='/kk/';
		$this->setUp();	
		$this->assertEquals("404",self::$blog->getPosts());
	}

	/*	public function testException(){
		$success=false;
		try{
		$unrar=new UnRar("-ass");

		} catch (Exception $e){
		$success=true;
		}

		if(!$success)
		$this->fail("Exception for Folder not found raised");

		}
		*/


}
?>