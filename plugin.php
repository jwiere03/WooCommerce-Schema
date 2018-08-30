<?php
/*
Plugin Name: Schema for WooCommerce
Description: Add product JSON schema
Version: 1.0
Author: SCS Grand Rapids
*/
function scs_product_schema() {
	if (is_product()){
	$json_product = wc_get_product();
	if ($json_product != null){
$json_productSKU = $json_product->get_sku();
$json_productTitle = $json_product->get_name();
$json_description = $json_product->get_description();
$json_price = $json_product->get_price();
$json_instockstatus = $json_product->get_stock_status();
$json_brand=get_bloginfo( 'name' );
$json_image = get_the_post_thumbnail_url( $json_product->get_id(), 'full' );
echo "This $json_image";
//echo "<h1>$json_productTitle</h1><strong>Price:</strong> $json_price<br/>$json_description<br/>This product is: $json_instockstatus<br/><em>Product ID#: $json_productSKU</em><br/><br/>";
//var_dump($json_product);
echo '<script type="application/ld+json">
{
  "@context": "http://schema.org/",
  "@type": "Product",
    "brand": "'.$json_brand.'",
	"name": "'.$json_productTitle.'",
	"image": "'.$json_image.'",
	"offers": {
	"@type": "Offer",
	"priceCurrency": "$",
	"price": "'.$json_price.'",
	"availability" : "'.$json_instockstatus.'"
  }
}
</script>';
	}
}
}
add_action("wp_footer", "scs_product_schema");
?>