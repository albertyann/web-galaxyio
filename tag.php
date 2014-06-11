<?php
/**
 * The template used to display Tag Archive pages
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<div class="content">
                    <div class="container">

			<?php if ( have_posts() ) : ?>

					<h3 class="page-title"><?php
						printf( __( '关键字搜索: %s', 'galaxyio' ), '<span>' . single_tag_title( '', false ) . '</span>' );
					?></h3>

                        <hr>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						get_template_part( 'content', 'blog' );
					?>

				<?php endwhile; ?>


			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div>
                </div>

<?php get_footer(); ?>
