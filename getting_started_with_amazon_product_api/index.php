<?php
require_once('amazon_product_api_class.php');
$public = ''; //amazon public key here
$private = ''; //amazon private/secret key here
$site = 'com'; //amazon region
$affiliate_id = ''; //amazon affiliate id

$amazon = $amazon = new AmazonProductAPI($public, $private, $site, $affiliate_id);

$similar = array(
	'Operation' => 'SimilarityLookup',
	'ItemId' => 'B0006N149M',
	'Condition' => 'All',
	'ResponseGroup' => 'Medium'
	);

$result =	$amazon->queryAmazon($similar);
$similar_products = $result->Items->Item;

foreach($similar_products as $si){

	$item_url = $si->DetailPageURL; //get its amazon url
	$img = $si->MediumImage->URL; //get the image url

	echo "<li>";
	echo "<img src='$img'/>";
	echo "<a href='$item_url'>". $si->ASIN . "</a>";
	echo $si->ItemAttributes->ListPrice->FormattedPrice; //item price
	echo "</li>";		
}
?>