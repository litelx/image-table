<?php

// validate required arguments
if(!isset($argv[1])) {
  exit("Please provide url as argument 1");
}

if(!isset($argv[2])) {
  exit("Please provide folder path as argument 2");
}

$url = $argv[1];
$directory = rtrim($argv[2], DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
$htmlToFile = '';

// Check if it's realy diretcory
if(!is_dir($directory)) {
  exit("Directory is not exist: $directory");
}

// fetch url html
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
$result = curl_exec($curl);
if ($result === false) {
  exit("Can't fetch url: $url");
} 

// $url = 'https://www.geektime.co.il/angularup-2018/';
// $directory = 'C:\xampp\htdocs\image-table\\';

$html = $result;

$pattern = '<img\s+src="([^"]+)"\s*+>';
preg_match_all($pattern, $html, $matches);


$htmlToFile .= '<table class="table"><tr><th>Image</th><th>Image Details</th></tr>';

foreach($matches[1] as $imageUrl) {
  $imageData = parse_url($imageUrl);
  $imageInfo = pathinfo($imageData['path']);
  $isImageUrl = array_key_exists('scheme', $imageData) && array_key_exists('host', $imageData) && array_key_exists('path', $imageData);
  if (!$isImageUrl) {
    continue;
  }
  $imgLink = $imageData['scheme'] . '://'. $imageData['host'] . $imageData['path'];
  
  $filename = basename($imgLink);
  $completeSaveLoc = $directory . $filename;
  $htmlToFile .= '<tr><td>'.imgDetails($imageInfo['extension'], getimagesize($imgLink)[3], $imgLink).'</td><td>'.imgElement($imgLink).'</td></tr>';
  file_put_contents($completeSaveLoc, file_get_contents($imgLink));
}

$htmlToFile .= '</table>';

saveContent($htmlToFile, $directory);


function saveContent($content = "", $directory = "", $filename = "index.html") {
  $html = buildHtml($content);
  file_put_contents($directory.$filename, $html);
}

function buildHtml($content = "") {
  return '<html>
            <head>
              <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            </head>
            <body>
              <div class="col-md-8 col-md-offset-2">
                '. $content .'
              </div>
            </body>
          </html>
          ';
}

function imgDetails($extension, $size, $url) {
  return '<div>
  <h4>Image URL: '.$url.'</h4>
  <h4>Image format: '.$extension.'</h4>
  <h4>Image size: '.$size.'</h4>
  </div>';
}

function imgElement($srcUrl) {
  return '<img src="'.$srcUrl.'" style="max-width: 120px;">';
}
