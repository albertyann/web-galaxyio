<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<div class="content">
            <div class="container">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content-single', get_post_format() ); ?>


				<?php endwhile; // end of the loop. ?>

			 </div>
        </div>

<?php get_footer(); ?>