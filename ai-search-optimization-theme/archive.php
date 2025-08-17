<?php
/**
 * Template for displaying archive pages
 */

get_header();
?>

<div class="archive-page">
    <header class="page-header">
        <?php
        the_archive_title('<h1 class="page-title">', '</h1>');
        the_archive_description('<div class="archive-description">', '</div>');
        ?>
    </header>

    <?php if (have_posts()) : ?>
        <div class="posts-container">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('blog-post-preview'); ?>>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium_large'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <div class="post-content">
                        <!-- Post Category -->
                        <?php 
                        $categories = get_the_category();
                        if (!empty($categories)) {
                            echo '<span class="post-category">' . esc_html($categories[0]->name) . '</span>';
                        }
                        ?>
                        
                        <!-- Post Title -->
                        <h2 class="post-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        
                        <!-- Post Excerpt -->
                        <div class="post-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                        
                        <!-- Post Meta -->
                        <div class="post-meta">
                            <span class="post-date"><?php echo get_the_date(); ?></span>
                            <span class="post-author">by <?php the_author(); ?></span>
                            <span class="read-time">5 min read</span>
                        </div>
                        
                        <!-- Post Tags -->
                        <?php 
                        $tags = get_the_tags();
                        if ($tags) {
                            echo '<div class="post-tags-preview">';
                            foreach (array_slice($tags, 0, 3) as $tag) {
                                echo '<span class="tag-item">' . $tag->name . '</span>';
                            }
                            echo '</div>';
                        }
                        ?>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?php
            the_posts_pagination(array(
                'mid_size'  => 2,
                'prev_text' => __('← Previous', 'ai-search-optimization'),
                'next_text' => __('Next →', 'ai-search-optimization'),
            ));
            ?>
        </div>

    <?php else : ?>
        <div class="no-posts">
            <h2>No posts found</h2>
            <p>It looks like nothing was found in this archive. Maybe try a search?</p>
            <?php get_search_form(); ?>
        </div>
    <?php endif; ?>
</div>

<?php
get_footer(); 