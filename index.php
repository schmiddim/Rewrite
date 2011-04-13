<?php
require_once 'classes/Routing.php';
require_once 'classes/Post.php';
require_once 'classes/Blog.php';

$blog=new Blog(new BlogRouting());
$blog->delimiter="<p>";
$blog->addPost(new Post("Regen in Deutschland", "tropf tropf", "2011 Januar 1"));
$blog->addPost(new Post("Alles neue macht der Januar", "LOREM IPSUM LOREM IPSUM", "2010 Januar 23"));
$blog->addPost(new Post("Verrückte Umlaute", "LOREM IPSUM LOREM IPSUM", "2010 Februar 10"));
$blog->addPost(new Post("Artikel 3", "LOREM IPSUM LOREM IPSUM", "2010 März 4"));
$blog->addPost(new Post("Artikel 4", "LOREM IPSUM LOREM IPSUM", "2010 März 2"));
$blog->addPost(new Post("Artikel 55", "LOREM IPSUM LOREM IPSUM", "2010 September 26"));
$blog->addPost(new Post("Einzelpost", "LOREM IPSUM LOREM IPSUM", "2011 April 11"));


$blog->addPost(new Post("Artikel 5", "LOREM IPSUM LOREM IPSUM", "2011 Januar 23"));

$blog->addPost(new Post( "Tipps zur Bedienung", "Hallo, schauen Sie sich das Archiv in der linken Leiste an. Unter jedem \"Artikel\" steht ein sog. Permalink &uuml;ber den der Artikel aufrufbar ist. Sie k&ouml;nnen die Ausgabe des PHP Skripts &uuml;ber die Url nach Jahr, Monat, Tag filtern. <p>", "2011 Januar 4"));
$blog->addPost(new Post("Artikel 8", "LOREM IPSUM LOREM IPSUM", "2011 Januar 2"));

$blog->addPost(new Post("Artikel 9", "LOREM IPSUM LOREM IPSUM", "2010 September 23"));
$blog->addPost(new Post("Artikel 10", "LOREM IPSUM LOREM IPSUM", "2010 September 23"));
$blog->addPost(new Post("Artikel 11", "LOREM IPSUM LOREM IPSUM", "2010 September 23"));
$blog->addPost(new Post("Artikel 12", "LOREM IPSUM LOREM IPSUM", "2010 September 23"));
$blog->addPost(new Post("Artikel 13", "Haloooooo", "2010 September 23"));


?>
<!DOCTYPE html>
<html lang="de">
<head>
<title>mod_rewrite</title>
<link rel="stylesheet" type="text/css" href="/layout.css" />
<meta charset="UTF-8">
</head>
<body>

<div id="container">
<div id="header">
<div id="logo"></div>

<h1><a href="/">Beispiel zu </a></h1>
<h3><a href="/">mod_rewrite mit PHP</a></h3>

</div>
<div id="left">
<div class="widget">
<h1>Links</h1>
<ul>

<li><a href="http://localhost/2011">2011</a></li>
<li><a href="http://localhost/2010">2010</a></li>
<li><a href="http://localhost/2010/September/23">23 September 2010</a></li>
<li><a href="http://localhost/2011/Januar">Januar 2011</a></li>
<li><a href="http://localhost/2011/januar/4/tipps-zur-bedienung">Tipps</a></li>
<li><a href="http://localhost/__/adsfas/assss">404</a></li>
	


</ul>
</div>

</div>
<!--left-->

<div id="center">
<div id="content"><?php 


echo $blog->getPosts();

?></div>



</div>
<!--center--> <!-- <div id="footer">hier k&ouml;nnte Ihr Footer stehen</div> --></div>
<!-- container -->


</body>
</html>