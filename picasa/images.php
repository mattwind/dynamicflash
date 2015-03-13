<?
//  dynamicflash
// http://code.google.com/p/dynamicflash/
//
// support
// http://code.google.com/p/dynamicflash/
//
// documenation 1.0
// rather than viewing local images, use your picasa web albums
// add as many album id's as you want, and it will randomly pick one
// to obtain your album id, login to picasa web albums, and click an album
// then click the rss feed at the bottom right, you will see it in the url

$album[] = "5148745220079694737";
$album[] = "5148743549337415761";
$album[] = "5148742767653366673";
$album[] = "5148760265350155825";
$album[] = "5148754334000311729";
$album[] = "5148750386925359137";
$album[] = "5148752577358683985";
$album[] = "5148758650442451345";

srand ((double) microtime() * 1000000);
$random = rand(0,count($album)-1);

$url = "http://picasaweb.google.com/data/feed/base/user/kpartscom/albumid/".$album[$random]."?kind=photo&alt=rss";

$data = implode("", file($url));
preg_match_all ("/<item>([^`]*?)<\/item>/", $data, $matches);
$i = 0;

foreach ($matches[0] as $match) {

	preg_match ("/s72\/([^`]*?)'/", $match, $temp);
		$filename = $temp['1'];
		$filename = strip_tags($filename);
		$filename = trim($filename);
		
	preg_match ("/<enclosure type='image\/jpeg' url='([^`]*?)$filename'/", $match, $temp);
		$path = $temp['1'];
		$path = strip_tags($path);
		$path = trim($path);
		
	preg_match ("/<title>([^`]*?)<\/title>/", $match, $temp);
		$title = $temp['1'];
		$title = strip_tags($title);
		$title = trim($title);		

	preg_match ("/<pubDate>([^`]*?)\+/", $match, $temp);
		$date = $temp['1'];
		$date = strip_tags($date);
		$date = trim($date);		
		$date = substr($date,0,-9);	
		
	preg_match ("/<media\:keywords>([^`]*?)<\/media\:keywords>/", $match, $temp);
		$keywords = $temp['1'];
		$keywords = strip_tags($keywords);
		$keywords = trim($keywords);		
		
		$thumb_72 = $path."s72/".$filename;
		$thumb_144 = $path."s144/".$filename;
		$thumb_288 = $path."s288/".$filename;
		$original = $path.$filename;
		
		$album_array[] = array(
		"id" => $i,
		"title" => $title,
		"filename" => $filename,
		"path" => $path,
		"date" => $date,
		"original" => $original,
		"thumb_72" => $thumb_72,
		"thumb_144" => $thumb_144,
		"thumb_288" => $thumb_288,
		"keywords" => $keywords);
		$i++;
}
echo "<images>";
foreach ($album_array as $pic) { 
?>
<pic>
 <image><? echo $pic['thumb_288'];?></image>
 <caption><? echo $pic['title'];?></caption>
</pic>
<?
}
echo '</images>';
?>
