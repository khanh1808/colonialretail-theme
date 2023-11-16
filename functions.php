<?php
// sjkdnjkasndkasdn
// Test asdasd
// Add custom Theme Functions here
require_once(dirname(__FILE__)."/shortcode-nhansu.php");


add_action( 'flatsome_product_box_after',function(){
	echo get_field('type',get_the_ID());
});