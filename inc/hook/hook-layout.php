<?php
//Thêm banner và breadcrumb vào các trang
add_filter( 'woocommerce_get_price_html', function ($price, $product) {
	if(empty($price) && is_front_page()){
	   	$str = '<a class="is-bold is-uppercase is-small" href="'.get_permalink( $product->get_ID() ).'">'.__('Liên hệ', 'htecom').'</a>';
	   	return $str;
 	}
	return $price;
}, 10, 2);

add_action( 'flatsome_blog_post_before', function() {
	// if (is_front_page()) {
		?>
		<div class="post-meta is-large op-8 mb-half">
			<?php echo get_the_date(); ?>
			<span class="author_name">
				<?php echo get_the_author(); ?>
			</span>
		</div>
		<?php 	
	// }
} );

add_action('flatsome_before_column_blog', function() {
	if ( is_front_page() && !is_home() && !is_category()) return;
	if (is_single()) return;
	$sticky_posts = get_option('sticky_posts');
	if (!is_array($sticky_posts) || empty($sticky_posts)) return;
	
	$first_sticky = array_splice($sticky_posts,0,1);
	$first_sticky = implode(",", $first_sticky);

	$col_left = (empty($sticky_posts)) ? 12 : 7;
	
	$sticky_section = '
		[section class="section_sticky_post pb-0"]

			[row]

			[col span__sm="12" class="pb-0"]

				[title text="TIN NỔI BẬT" margin_bottom="0px" class="title-noborder is-xxlarge"]

			[/col]
			[col span="'.$col_left.'" span__sm="12" span__md="12" class="pb-0"]

				[custom_blog_posts style="normal" type="row" columns="1" columns__md="1" ids="'.$first_sticky.'" title_size="larger" title_style="uppercase" show_date="false" comments="false" image_height="56.25%" image_size="original" text_align="left" text_padding="20px 0px 0px 0px" class="left-sticky"]

			[/col]
	';

	if(!empty($sticky_posts)) {
		$remain_sticky = implode(",", $sticky_posts);
		$sticky_section .= '
			[col span="5" span__sm="12" span__md="12" class="pb-0"]

				[custom_blog_posts style="vertical" type="row" columns="1" columns__md="1" ids="'.$remain_sticky.'" title_size="large" title_style="uppercase" show_date="false" excerpt="false" comments="false" image_height="56.25%" image_width="45" image_size="original" text_align="left" text_padding="0px 0px 0px 20px" class="right-sticky"]

			[/col]
		';	
	}

	$sticky_section .= '
			[/row]

		[/section]

		[divider width="100%" height="2px" margin="30px" color="rgb(234, 229, 225)"]
	';

	echo do_shortcode( $sticky_section );

}, 10);

add_action('flatsome_before_column_blog', function() {
	if ( is_front_page() && !is_home() && !is_category()) return;
	if (is_single()) return;
	$cur_cat = get_queried_object();
	$categories = get_categories();
	?>
	<ul class="nav blog-format-nav flex mb">
		<li <?php if(isset($cur_cat->ID) && $cur_cat->ID == get_option( 'page_for_posts' )) echo 'class="actived"' ?>>
			<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ) ?>" class="button is-uppercase"><?php _e('Mới nhất', DOMAIN) ?></a>
		</li>
		<?php
		foreach( $categories as $category ) {
			?>
			<li <?php if(isset($cur_cat->term_id) && $category->term_id == $cur_cat->term_id) echo 'class="actived"' ?>>
				<a href="<?php echo esc_url( get_category_link( $category->term_id ) ) ?>" class="button is-uppercase"><?php echo esc_html( $category->name ) ?></a>
			</li>
			<?php
		}
		?>
	</ul>
	<?php
}, 10);

add_action('flatsome_after_column_blog', function() {
	if(!is_single()) return;

	$mt = (wp_is_mobile()) ? '30px' : '80px';
	$title_size = (wp_is_mobile()) ? 'is-large' : 'is-xxlarge';
	$related_section = '
		[row]

			[col span__sm="12" class="pb-0"]
			
				[title text="'.__('Các tin tức khác', DOMAIN).'" tag_name="h2" margin_top="'.$mt.'" margin_bottom="0px" class="title-noborder '.$title_size.'"]
			
			[/col]
		
		[/row]

		[section bg_color="rgb(251, 248, 247)" class="single-related-post"]


			[blog_posts style="vertical" columns="3" columns__md="1" slider_nav_style="circle" slider_nav_position="outside" slider_bullets="true" title_size="large" title_style="uppercase" show_date="false" excerpt="false" comments="false" image_height="100%" image_width="36" image_size="large" image_overlay="rgba(0, 0, 0, 0.401)" text_align="left"]
		
		[/section]
	';
	
	echo do_shortcode( $related_section );

}, 10);

// function so_27975262_product_query( $q ){
// 	if (isset($_GET['sort']) && $_GET['sort'] == 'asc') {
// 		$q->set( 'order', 'asc' ); 
// 	}
// }
// add_action( 'woocommerce_product_query', 'so_27975262_product_query' ); 

add_filter('flatsome_class_wrapper_sidebar', function($classes, $id) {
	if ($id === 'header-filter') {
		$classes[] = 'header-filter-wrapper';
	}

	return $classes;
}, 10, 99999);

add_filter( 'flatsome_header_class', function($classes){
	$classes[] = 'hte-custom-header';

	return $classes;
});