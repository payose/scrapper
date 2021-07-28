<?php
//send a GET request to get the html input from another website

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "http://sharevue.tech");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$html = curl_exec($ch);
// var_dump($html);

//finding all heading (h2) on the page

$dom = new DOMDocument();
@ $dom->loadHTML($html);

$h2s = $dom->getElementsByTagName('a');

/* $h2array = array();

foreach($h2s as $h2) {
  $titletext = $h2->textContent;
  $h2array[] = $titletext;
  echo $titletext.'<br>';
} */

// getting all hyperlinks
$linksfile = fopen("links.txt", "a");

$links = $dom->getElementsByTagName('a');

$linksarray = array();

foreach($links as $link) {
  $linktext = $link->textContent;
  $linksarray[] = $linktext;
  $hyperlink = $link->getAttribute('href');

  
  fwrite($linksfile, $link->getAttribute('href')."\n");
  echo $linktext. ' ------------ '. $hyperlink .'<br>';
}

//saving it to a text file
fclose($linksfile);
