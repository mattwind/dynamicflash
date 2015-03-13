<images>
<?
$dir = "slideshow/";

if (is_dir($dir)) {

    if ($dh = opendir($dir)) {
	
        while (($file = readdir($dh)) !== false) {

			$filetype = substr($file,-3);
			$filetype = strtolower($filetype);
						
			if ($filetype == "jpg" || $filetype == "gif") { ?>
    <pic>
        <image>slideshow/<? echo $file;?></image>
        <caption><? echo $file;?></caption>
    </pic>
<?			
			}
        }
        closedir($dh);
    }
}
?>
</images>