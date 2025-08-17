<?php
/**
 * Template for displaying single posts
 */

get_header();
?>

<div class="single-post">
    <?php while (have_posts()) : the_post(); ?>
        
        <!-- Back to Blog Link -->
        <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="back-link">Back to Blog</a>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <!-- Post Category -->
            <?php 
            $categories = get_the_category();
            if (!empty($categories)) {
                echo '<span class="post-category">' . esc_html($categories[0]->name) . '</span>';
            }
            ?>
            
            <!-- Post Title -->
            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </header>

            <!-- Post Content -->
            <div class="entry-content">
                <?php the_content(); ?>
            </div>

            <!-- Post Tags -->
            <?php ai_search_optimization_post_tags(); ?>

            <!-- Author Bio -->
            <?php ai_search_optimization_author_bio(); ?>

        </article>

    <?php endwhile; ?>
</div>

<?php
get_footer(); 