<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage GalaxyIO
 * @since GalaxyIO 0.1
 */
?>

<!--   -->
<div class="article-title">
    <div class="sub-squares">
        <h3><?php the_title(); ?></h3>
    </div>
     
</div>
    <hr>
<div class="row">
	<div class="span12">
	    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	            <div class="entry-content">
	                    <?php the_content(); ?>
	            </div><!-- .entry-content -->

	    </article>
	</div>
</div>
