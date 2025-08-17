<?php
/**
 * Main template file for the blog homepage
 */

get_header();
?>

<div class="blog-homepage">
    <header class="page-header">
        <h1 class="page-title">Latest Articles</h1>
        <p class="page-description">Insights and strategies for AI Search Optimization and SEO</p>
    </header>

    <?php if (have_posts()) : ?>
        <div class="posts-container">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('blog-post-preview'); ?>>
                    
                    <div class="post-thumbnail">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium_large'); ?>
                            </a>
                        <?php else : ?>
                            <a href="<?php the_permalink(); ?>">
                                <div class="post-thumbnail-placeholder">
                                    <svg width="64" height="64" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17l2.5-3.5L15 17H9z"/>
                                    </svg>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                    
                    <div class="post-content">
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
            <p>It looks like nothing was found at this location. Maybe try a search?</p>
            <?php get_search_form(); ?>
        </div>
    <?php endif; ?>
</div>

<?php
get_footer(); 