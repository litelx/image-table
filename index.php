<?php
$url = $argv[0];
// echo $url;
// $url = 'https://www.geektime.co.il/angularup-2018/';
$directory = 'C:\xampp\htdocs\image-table\\';

$html = file_get_contents($url);
$pattern = '<img\s+src="([^"]+)"\s*+>';
preg_match_all($pattern, $html, $matches);

$bootstrap_css_file = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
$html_to_file = '<html><head>'.$bootstrap_css_file.'</head><body><div class="col-md-8 col-md-offset-2">';

$html_table = '<table class="table"><tr><th>Image</th><th>Image Details</th></tr>';

foreach($matches[1] as $imageUrl) {
  $imageData = parse_url($imageUrl);
  $imageInfo = pathinfo($imageData['path']); // , PATHINFO_EXTENSION
  // pa($imageData);
  $isImageUrl = array_key_exists('scheme', $imageData) && array_key_exists('host', $imageData) && array_key_exists('path', $imageData);
  echo $isImageUrl;
  // if ($isImageUrl) break;
  // $imgLink = $imageData['scheme'] . '://'. $imageData['host'] . $imageData['path'];
  // echo $imgLink;

  // $filename = basename($imgLink);
  // $complete_save_loc = $directory . $filename;
  // $html_table = $html_table.'<tr><td>'.img_details($imageInfo['extension'], getimagesize($imgLink)[3], $imgLink).'</td><td>'.imgElement($imgLink).'</td></tr>';
  // file_put_contents($complete_save_loc, file_get_contents($imgLink));
}

$html_table = $html_table.'</table>';
$html_to_file = $html_to_file.$html_table.'</div></body></html>';
file_put_contents('index.html', $html_to_file);

function img_details($extension, $size, $url) {
  return '<div>
  <h4>Image URL: '.$url.'</h4>
  <h4>Image format: '.$extension.'</h4>
  <h4>Image size: '.$size.'</h4>
  </div>';
}

function imgElement($src_url) {
  return '<img src="'.$src_url.'" style="max-width: 120px;">';
}


function pa($a) {
  echo "<pre>";
  print_r($a);
  echo "</pre>";
}
/*

// pa($imageUrl);
// pa($imageInfo);
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
  
*/