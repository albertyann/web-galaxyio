<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>
<div class="content blog">
    <div class="row">
        <div class="span12">
            <?php while ( have_posts() ) : the_post(); ?>
                    <?php
                    $post_type = 'product';
                    if (in_category('blog')) {
                        $post_type = 'blog';
                    }
                            get_template_part('content', $post_type);
                    ?>
            <?php endwhile; ?>
        </div>
    </div>
</div>


<?php get_footer(); ?>
