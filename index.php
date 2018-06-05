<?php

$url = 'https://www.geektime.co.il/angularup-2018/';
$directory = 'C:\xampp\htdocs\image-table\\';
/*
$html = file_get_contents($url);
$pattern = '<img\s+src="([^"]+)"\s*+>';
preg_match_all($pattern, $html, $matches);
*/

/*
*/
$matches = array (
    0 => 
    array (
      0 => 'img src="https://www.geektime.co.il/wp-content/themes/geektime/css/images/mobile-menu-icon.svg?x35493" ',
      1 => 'img src="https://www.geektime.co.il/wp-content/themes/geektime/css/images/logo.png?x35493" ',
      2 => 'img src="https://www.geektime.co.il/wp-content/themes/geektime/css/images/loading.gif?x35493" ',
      3 => 'img src="https://www.geektime.co.il/wp-content/themes/geektime/css/images/geek.png?x35493" ',
    ),
    1 => 
    array (
      0 => 'https://www.geektime.co.il/wp-content/themes/geektime/css/images/mobile-menu-icon.svg?x35493',
      1 => 'https://www.geektime.co.il/wp-content/themes/geektime/css/images/logo.png?x35493',
      2 => 'https://www.geektime.co.il/wp-content/themes/geektime/css/images/loading.gif?x35493',
      3 => 'https://www.geektime.co.il/wp-content/themes/geektime/css/images/geek.png?x35493',
    ),
);
echo '<table>';
echo '<tr><th>Image</th><th>Image Details</th></tr>';
echo '<tr><td></td><td></td></tr>';
echo '</table>';
foreach($matches[1] as $imageUrl) {
    // pa("start");
    // pa($imageUrl);
    $imageeData = parse_url($imageUrl);
    // pa($imageeData);
    // $imageInfo = pathinfo($imageeData['path']); // , PATHINFO_EXTENSION
    // pa($imageInfo);
    $imgLink = $imageeData['scheme'] . '://' . $imageeData['host'] . $imageeData['path'];
    $filename = basename($imgLink);
    $complete_save_loc = $directory . $filename;
    file_put_contents($complete_save_loc, file_get_contents($imgLink));
    echo '<br> img saved: ' . $imgLink;
}

function pa($a) {
    echo "<pre>";
    print_r($a);
    echo "</pre>";
}

