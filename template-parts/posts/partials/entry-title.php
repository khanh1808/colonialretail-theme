<?php
/**
 * Post-entry title.
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.16.0
 */

if ( is_single() ) :
	if ( get_theme_mod( 'blog_single_header_category', 1 ) ) :
		echo '<h6 class="entry-category is-xsmall">';
		echo get_the_category_list( __( ', ', 'flatsome' ) );
		echo '</h6>';
	endif;
else :
	// $time_string = sprintf( $time_string,
	// 	esc_attr( get_the_date( 'c' ) ),
	// 	esc_html( get_the_date() ),
	// 	esc_attr( get_the_modified_date( 'c' ) ),
	// 	esc_html( get_the_modified_date() )
	// );

	?>
	<div class="entry-blog-top flex justify-between mb">
		<div class="entry-category lowercase secondary-font">
			<?php echo get_the_category_list( __( ', ', 'flatsome' ) ) ?>
		</div>
		<div class="entry-blog-right is-small">
			<div class="entry-date flex align-center"><img src="<?php echo THEME_IMAGE.'/calendar.svg' ?>" width="15" height="16" style="margin-right: 3px"><?php echo esc_html( get_the_date() ); ?></div>
		</div>
	</div>
	<?php
endif;

if ( is_single() ) :
	if ( get_theme_mod( 'blog_single_header_title', 1 ) ) :
		echo '<h1 class="entry-title">' . get_the_title() . '</h1>';
		?>
		<div class="entry-blog-top flex justify-between mb">
			<div class="entry-category lowercase secondary-font">
				<?php echo get_the_category_list( __( ', ', 'flatsome' ) ) ?>
			</div>
			<div class="entry-blog-right is-small">
				<div class="entry-date flex align-center"><img src="<?php echo THEME_IMAGE.'/calendar.svg' ?>" width="15" height="16" style="margin-right: 3px"><?php echo esc_html( get_the_date() ); ?></div>
			</div>
		</div>
		<?php
	endif;
else :
	echo '<h2 class="entry-title"><a href="' . get_the_permalink() . '" rel="bookmark" class="plain">' . get_the_title() . '</a></h2>';
endif;
?>

<?php
$single_post = is_singular( 'post' );
if ( $single_post && get_theme_mod( 'blog_single_header_meta', 1 ) ) : ?>
	<div class="entry-meta uppercase is-xsmall">
		<?php flatsome_posted_on(); ?>
	</div>
<?php elseif ( ! $single_post && 'post' == get_post_type() ) : ?>
<?php endif; ?>
