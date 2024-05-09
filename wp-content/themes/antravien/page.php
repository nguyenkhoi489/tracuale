<?php

/**
 * The template for displaying all pages.
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.16.0
 */

if (flatsome_option('pages_template') != 'default') {

	// Get default template from theme options.
	get_template_part('page', flatsome_option('pages_template'));
	return;
} else {

	get_header();
	do_action('flatsome_before_page'); ?>

	<div id="content" class="content-area custom-page__content page-wrapper pt-0" role="main">
		<section class="section p-0">
			<div class="bg section-bg fill bg-fill bg-loaded"></div>
			<div class="section-content relative">
				<div class="page-header-wrapper">
					<div class="page-title dark featured-title">
						<div class="page-title-bg">
							<div class="title-bg fill bg-fill" data-parallax-container=".page-title" data-parallax-background="" data-parallax="-"></div>
							<div class="title-overlay fill"></div>
						</div>
						<div class="page-title-inner container align-center text-center flex-row-col medium-flex-wrap">
							<div class="title-wrapper flex-col">
								<h1 class="entry-title mb-0"><?= get_the_title() ?></h1>
							</div>
							<div class="title-content flex-col">
								<div class="title-breadcrumbs pb-half pt-half">
									<?= dimox_breadcrumbs() ?>
								</div>
							</div>
						</div>
						<style>
							.page-title-inner {
								min-height: 140px;
							}

							.featured-title .page-title-inner {
								margin-bottom: 0;
							}

							.title-bg {
								background-image: url(<?= wp_get_attachment_url(85) ?>);
							}

							.title-overlay {
								background-color: rgba(0, 0, 0, .5);
							}
						</style>
					</div>
				</div>
			</div>
		</section>
		<section class="section">
			<div class="row row-main">
				<div class="large-9 col">
					<div class="col-inner border">

						<?php if (get_theme_mod('default_title', 0)) { ?>
							<header class="entry-header">
								<h1 class="entry-title mb uppercase"><?php the_title(); ?></h1>
							</header>
						<?php } ?>

						<?php while (have_posts()) : the_post(); ?>
							<?php do_action('flatsome_before_page_content'); ?>

							<?php the_content(); ?>

							<?php
							if (comments_open() || get_comments_number()) {
								comments_template();
							}
							?>

							<?php do_action('flatsome_after_page_content'); ?>
						<?php endwhile; // end of the loop. 
						?>
					</div>
				</div>
				<div class="col large-3">
					<div class="col-inner border">
						<aside id="custom_html-5" class="widget_text widget widget_custom_html">
							<span class="widget-title "><i class="far fa-newspaper"></i> Nội dung mới</span>
							<div class="textwidget custom-html-widget">
								<div class="post-related">
									<?php
									$q = new WP_Query(array(
										'post_type' => 'post',
										'posts_per_page' => 4,
										'orderby' => 'date',
										'order' => 'DESC'
									));
									if ($q->have_posts()) :

										echo '<ul>';
										while ($q->have_posts()) : $q->the_post();
											echo '<li>
										<a href="' . get_the_permalink() . '">
											<div class="b2-widget-post-thumb">
												<div class="b2-widget-post-thumb-img">
													<img class="b2-radius" loading="lazy" src="' . get_the_post_thumbnail_url() . '" alt="' . get_the_title() . '">
												</div>
												<div class="b2-widget-post-title">
													<span class="tt-xemnhiu">' . get_the_title() . '</span>
													<time>' . get_the_time('d/m/y', get_the_ID()) . '</time>
												</div>
											</div>
										</a>
									</li>';
										endwhile;
										echo '</ul>';
									endif;
									wp_reset_query();
									?>
								</div>
							</div>
						</aside>

					</div>
				</div>
			</div>
		</section>
	</div>

<?php
	do_action('flatsome_after_page');
	get_footer();
}

?>