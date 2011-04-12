<?php
require_once 'classes/Routing.php';
require_once 'classes/Post.php';
require_once 'classes/Blog.php';

		$blog=new Blog(new BlogRouting());		
		$blog->delimiter="<p>";
		$blog->addPost(new Post("Alles neue macht der Januar", "LOREM IPSUM LOREM IPSUM", "2010 Januar 23"));
		$blog->addPost(new Post("Verrückte Umlaute", "LOREM IPSUM LOREM IPSUM", "2010 Februar 10"));
		$blog->addPost(new Post("Artikel 3", "LOREM IPSUM LOREM IPSUM", "2010 Maerz 4"));
		$blog->addPost(new Post("Artikel 4", "LOREM IPSUM LOREM IPSUM", "2010 März 2"));
		$blog->addPost(new Post("Artikel 55", "LOREM IPSUM LOREM IPSUM", "2010 September 26"));
		$blog->addPost(new Post("Einzelpost", "LOREM IPSUM LOREM IPSUM", "2011 April 11"));
		
		$blog->addPost(new Post("Artikel 5", "LOREM IPSUM LOREM IPSUM", "2011 Januar 23"));
		$blog->addPost(new Post("Artikel 6", "LOREM IPSUM LOREM IPSUM", "2011 Januar 10"));
		$blog->addPost(new Post("Artikel 7", "LOREM IPSUM LOREM IPSUM", "2011 Januar 4"));
		$blog->addPost(new Post("Artikel 8", "LOREM IPSUM LOREM IPSUM", "2011 Januar 2"));
		
		$blog->addPost(new Post("Artikel 9", "LOREM IPSUM LOREM IPSUM", "2010 September 23"));
		$blog->addPost(new Post("Artikel 10", "LOREM IPSUM LOREM IPSUM", "2010 September 23"));
		$blog->addPost(new Post("Artikel 11", "LOREM IPSUM LOREM IPSUM", "2010 September 23"));
		$blog->addPost(new Post("Artikel 12", "LOREM IPSUM LOREM IPSUM", "2010 September 23"));
		$blog->addPost(new Post("Artikel 13", "Haloooooo", "2010 September 23"));


echo $blog->getPosts();

?>