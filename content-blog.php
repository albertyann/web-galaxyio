<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage GalaxyIO
 * @since GalaxyIO 0.1
 */
?>

<div class="entry">
    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

    <!-- Meta details -->
    <div class="meta">
        <i class="icon-calendar"></i> <?php the_date('Y-m-d'); ?> <i class="icon-user"></i> <?php the_author(); ?> 
        <i class="icon-folder-open"></i> <?php the_tags()?>
    </div>

    <?php the_excerpt();?>
    <div class="button"><a href="<?php the_permalink(); ?>">Read More...</a></div>
</div>
