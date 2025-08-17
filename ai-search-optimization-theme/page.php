<?php
/**
 * Template for displaying pages
 */

get_header();
?>

<div class="page-content">
    <?php while (have_posts()) : the_post(); ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <!-- Page Title -->
            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </header>

            <!-- Page Content -->
            <div class="entry-content">
                <?php the_content(); ?>
            </div>

        </article>

    <?php endwhile; ?>
</div>

<?php
get_footer(); 