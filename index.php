<!DOCTYPE HTML>
<html>
	<head>
		<title>HashTag Photography</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-loading-0 is-loading-1 is-loading-2">

		<!-- Main -->
			<div id="main">

				<!-- Header -->
					<header id="header">
						<h1>Search Your #Tag</h1>

					</header>
					<div align="center">
					<form action="index.php" method="GET">
					
						<table>
							<tr>
								<td style="padding: 10px 5px 10px 0;"><input name="searchname" id="search" type="text" placeholder="#Search here"></td>
								<td><input id="submit" type="submit" value="Search"></td>
							</tr>
						</table>
						</form>
					</div>

					
				
					
					<?php
					
					if (isset($_GET['searchname'])){
						$tag = mysql_real_escape_string($_GET['searchname']);
					}else{
						$tag = 'photography';
					}
					
					function scrape_insta_hash($tag) {
						$insta_source = file_get_contents('https://www.instagram.com/explore/tags/'.$tag.'/'); // instagrame tag url
						$shards = explode('window._sharedData = ', $insta_source);
						$insta_json = explode(';</script>', $shards[1]); 
						$insta_array = json_decode($insta_json[0], TRUE);
						return $insta_array; // this return a lot things print it and see what else you need
					}
					
					//$defaulttag = 'cat'; // tag for which ou want images 
					$results_array = scrape_insta_hash($tag);
					$limit = 48; // provide the limit thats important because one page only give some images then load more have to be clicked
					$image_array= array(); // array to store images.
						for ($i=0; $i < $limit; $i++) { 
							$latest_array = $results_array['entry_data']['TagPage'][0]['tag']['media']['nodes'][$i];
							//$image_data  = '<img src="'.$latest_array['thumbnail_src'].'" width="300px" height="300px">'; // thumbnail and same sizes 
							//$image_data  = '<img src="'.$latest_array['display_src'].'">'; actual image and different sizes 
							
							$image_data  = '<a class="thumbnail" href="'.$latest_array['display_src'].'" data-position="left center"><img src="'.$latest_array['thumbnail_src'].'" alt="" /></a>';
						
							
							
							array_push($image_array, $image_data);
						}

					?>
					
					
					
					
					
					
					
				<!-- Thumbnail -->
					<section id="thumbnails">
					

						<?php
						
						foreach ($image_array as $image) {
							echo '<article>';
							echo $image;// this will echo the images wrap it in div or ul li what ever html structure 
							echo '</article>';
						}
						
						?>
						
						
						<!--
						<article>
							<a class="thumbnail" href="images/fulls/01.jpg" data-position="left center"><img src="images/thumbs/01.jpg" alt="" /></a>
							<h2>Diam tempus accumsan</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						</article>
						
						<article>
							<a class="thumbnail" href="images/fulls/02.jpg"><img src="images/thumbs/02.jpg" alt="" /></a>
							<h2>Vivamus convallis libero</h2>
							<p>Sed velit lacus, laoreet at venenatis convallis in lorem tincidunt.</p>
						</article>
						<article>
							<a class="thumbnail" href="images/fulls/03.jpg" data-position="top center"><img src="images/thumbs/03.jpg" alt="" /></a>
							<h2>Nec accumsan enim felis</h2>
							<p>Maecenas eleifend tellus ut turpis eleifend, vitae pretium faucibus.</p>
						</article>
						<article>
							<a class="thumbnail" href="images/fulls/04.jpg"><img src="images/thumbs/04.jpg" alt="" /></a>
							<h2>Donec maximus nisi eget</h2>
							<p>Tristique in nulla vel congue. Sed sociis natoque parturient nascetur.</p>
						</article>
						<article>
							<a class="thumbnail" href="images/fulls/05.jpg" data-position="top center"><img src="images/thumbs/05.jpg" alt="" /></a>
							<h2>Nullam vitae nunc vulputate</h2>
							<p>In pellentesque cursus velit id posuere. Donec vehicula nulla.</p>
						</article>
						<article>
							<a class="thumbnail" href="images/fulls/06.jpg"><img src="images/thumbs/06.jpg" alt="" /></a>
							<h2>Phasellus magna faucibus</h2>
							<p>Nulla dignissim libero maximus tellus varius dictum ut posuere magna.</p>
						</article>
						<article>
							<a class="thumbnail" href="images/fulls/07.jpg"><img src="images/thumbs/07.jpg" alt="" /></a>
							<h2>Proin quis mauris</h2>
							<p>Etiam ultricies, lorem quis efficitur porttitor, facilisis ante orci urna.</p>
						</article>
						<article>
							<a class="thumbnail" href="images/fulls/08.jpg"><img src="images/thumbs/08.jpg" alt="" /></a>
							<h2>Gravida quis varius enim</h2>
							<p>Nunc egestas congue lorem. Nullam dictum placerat ex sapien tortor mattis.</p>
						</article>
						<article>
							<a class="thumbnail" href="images/fulls/09.jpg"><img src="images/thumbs/09.jpg" alt="" /></a>
							<h2>Morbi eget vitae adipiscing</h2>
							<p>In quis vulputate dui. Maecenas metus elit, dictum praesent lacinia lacus.</p>
						</article>
						<article>
							<a class="thumbnail" href="images/fulls/10.jpg"><img src="images/thumbs/10.jpg" alt="" /></a>
							<h2>Habitant tristique senectus</h2>
							<p>Vestibulum ante ipsum primis in faucibus orci luctus ac tincidunt dolor.</p>
						</article>
						<article>
							<a class="thumbnail" href="images/fulls/11.jpg"><img src="images/thumbs/11.jpg" alt="" /></a>
							<h2>Pharetra ex non faucibus</h2>
							<p>Ut sed magna euismod leo laoreet congue. Fusce congue enim ultricies.</p>
						</article>
						<article>
							<a class="thumbnail" href="images/fulls/12.jpg"><img src="images/thumbs/12.jpg" alt="" /></a>
							<h2>Mattis lorem sodales</h2>
							<p>Feugiat auctor leo massa, nec vestibulum nisl erat faucibus, rutrum nulla.</p>
						</article>
						-->
						
					</section>

				<!-- Footer -->
					<footer id="footer">
						<ul class="copyright">
							<li>&copy; Mudzafar Faiq Mahusin</li><li>for: <a href="http://www.bnm.gov.my/">BNM</a>.</li>
						</ul>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>