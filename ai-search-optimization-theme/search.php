<?php
/**
 * Template for displaying search results
 */

get_header();
?>

<div class="search-results">
    <header class="page-header">
        <h1 class="page-title">
            <?php
            printf(
                esc_html__('Search Results for: %s', 'ai-search-optimization'),
                '<span>' . get_search_query() . '</span>'
            );
            ?>
        </h1>
        <?php
        global $wp_query;
        if ($wp_query->found_posts) {
            printf(
                esc_html(_n('Found %s result', 'Found %s results', $wp_query->found_posts, 'ai-search-optimization')),
                number_format_i18n($wp_query->found_posts)
            );
        }
        ?>
    </header>

    <?php if (have_posts()) : ?>
        <div class="posts-container">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('search-result'); ?>>
                    
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
                            <span class="post-type"><?php echo ucfirst(get_post_type()); ?></span>
                        </div>
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
            <h2>Nothing found</h2>
            <p>Sorry, but nothing matched your search terms. Please try again with different keywords.</p>
            <?php get_search_form(); ?>
        </div>
    <?php endif; ?>
</div>

<?php
get_footer(); 