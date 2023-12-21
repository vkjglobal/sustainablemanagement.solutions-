<?php
/**
 * @var $css_class
 * @var $style
 * @var $per_row
 * @var $image_style
 * @var $count
 * @var $category
 * @var $link
 * @var $grid_view
 */

$css_class .= ' ' . $style . ' cols_' . $per_row . ' ' . $image_style;

if ( isset( $image_leaf_rounded_corners ) ) {
	$css_class .= ' ' . $image_leaf_rounded_corners;
}

$args = array(
	'post_type'      => 'stm_staff',
	'posts_per_page' => $count,
);

if ( 'all' !== $category ) {
	$args['stm_staff_category'] = $category;
}

$staff = new WP_Query( $args );

?>

<?php if ( $staff->have_posts() ) : ?>
	<div class="staff_list<?php echo esc_attr( $css_class ); ?>">
		<ul class="staff_<?php echo esc_attr( $grid_view ); ?>">
			<?php
			while ( $staff->have_posts() ) :
				$staff->the_post();
				?>
				<li>
					<div class="staff_inner">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="staff_image">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'consulting-image-320x320-croped' ); ?>
								</a>
							</div>
						<?php endif; ?>
						<div class="staff_info">
							<h4 class="no_stripe">
								<a href="<?php the_permalink(); ?>" class="text_decoration_none"><?php the_title(); ?></a>
							</h4>
							<?php $department = get_post_meta( get_the_ID(), 'department', true ); ?>
							<?php if ( $department ) : ?>
								<div class="staff_department">
									<?php echo esc_html( $department ); ?>
								</div>
							<?php endif; ?>
							<ul class="staff_socials">
								<?php
									$staff_socials = array(
										'facebook'    => 'fa fa-facebook',
										'twitter'     => 'fa fa-twitter',
										'google_plus' => 'fa fa-google-plus',
										'linkedin'    => 'fa fa-linkedin',
									);

									foreach ( $staff_socials as $staff_social => $staff_social_icon ) {
										$staff_social_link = get_post_meta( get_the_ID(), $staff_social, true );
										if ( $staff_social_link ) :
											?>
											<li class="staff_<?php echo esc_attr( $staff_social ); ?>">
												<a href="<?php echo esc_url( $staff_social_link ); ?>">
													<i class="<?php echo esc_attr( $staff_social_icon ); ?>"></i>
												</a>
											</li>
											<?php
										endif;
									}
									?>
							</ul>
						</div>
					</div>
				</li>
				<?php
			endwhile;
			wp_reset_postdata();
			?>
			<?php if ( $link['url'] ) : ?>
				<li class="staff_custom_link">
					<a href="<?php echo esc_url( $link['url'] ); ?>">
						<?php if ( ! empty( $link['title'] ) || ! empty( $link_text ) ) : ?>
							<span>
							<?php if ( ! empty( $link['title'] ) ) : ?>
								<span class="staff_custom_link_title"><?php echo esc_html( $link['title'] ); ?></span>
							<?php endif; ?>
								<?php echo esc_html( $link_text ); ?>
							</span>
						<?php endif; ?>
					</a>
				</li>
			<?php endif; ?>
		</ul>
	</div>
<?php endif; ?>
