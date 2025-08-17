<?php
/**
 * AI Search Optimisation Theme functions and definitions
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Theme setup
 */
function ai_search_optimization_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title.
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');

    // Register navigation menus.
    register_nav_menus(array(
        'primary' => esc_html__('Primary Navigation', 'ai-search-optimisation'),
    ));

    // Switch default core markup for search form, comment form, and comments
    // to output valid HTML5.
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for core custom logo.
    add_theme_support('custom-logo', array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ));
}
add_action('after_setup_theme', 'ai_search_optimization_setup');

/**
 * Enqueue scripts and styles.
 */
function ai_search_optimization_scripts() {
    // Enqueue Google Fonts
    wp_enqueue_style('ai-search-optimization-fonts', 'https://fonts.googleapis.com/css2?family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap', array(), null);
    
    wp_enqueue_style('ai-search-optimization-style', get_stylesheet_uri(), array('ai-search-optimization-fonts'), '1.0.0');
    
    wp_enqueue_script('ai-search-optimization-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0.0', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'ai_search_optimization_scripts');

/**
 * Add custom fields to user profile
 */
function ai_search_optimization_add_user_profile_fields($user) {
    ?>
    <h3>Author Information</h3>
    <table class="form-table">
        <tr>
            <th><label for="linkedin_url">LinkedIn URL</label></th>
            <td>
                <input type="url" name="linkedin_url" id="linkedin_url" value="<?php echo esc_attr(get_the_author_meta('linkedin_url', $user->ID)); ?>" class="regular-text" />
                <br /><span class="description">Enter your LinkedIn profile URL</span>
            </td>
        </tr>
        <tr>
            <th><label for="twitter_url">X (Twitter) URL</label></th>
            <td>
                <input type="url" name="twitter_url" id="twitter_url" value="<?php echo esc_attr(get_the_author_meta('twitter_url', $user->ID)); ?>" class="regular-text" />
                <br /><span class="description">Enter your X (Twitter) profile URL</span>
            </td>
        </tr>
    </table>
    <?php
}
add_action('show_user_profile', 'ai_search_optimization_add_user_profile_fields');
add_action('edit_user_profile', 'ai_search_optimization_add_user_profile_fields');

/**
 * Save custom user profile fields
 */
function ai_search_optimization_save_user_profile_fields($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }
    
    update_user_meta($user_id, 'linkedin_url', sanitize_url($_POST['linkedin_url']));
    update_user_meta($user_id, 'twitter_url', sanitize_url($_POST['twitter_url']));
}
add_action('personal_options_update', 'ai_search_optimization_save_user_profile_fields');
add_action('edit_user_profile_update', 'ai_search_optimization_save_user_profile_fields');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function ai_search_optimization_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'ai_search_optimization_pingback_header');

/**
 * Custom template tags for this theme.
 */

/**
 * Prints HTML with meta information for the current post-date/time.
 */
function ai_search_optimization_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if (get_the_time('U') !== get_the_modified_time('U')) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf($time_string,
        esc_attr(get_the_date(DATE_W3C)),
        esc_html(get_the_date()),
        esc_attr(get_the_modified_date(DATE_W3C)),
        esc_html(get_the_modified_date())
    );

    $posted_on = sprintf(
        /* translators: %s: post date. */
        esc_html_x('Posted on %s', 'post date', 'ai-search-optimization'),
        '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
    );

    echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
}

/**
 * Prints HTML with meta information for the current author.
 */
function ai_search_optimization_posted_by() {
    $byline = sprintf(
        /* translators: %s: post author. */
        esc_html_x('by %s', 'post author', 'ai-search-optimization'),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
    );

    echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
}

/**
 * Display post tags
 */
function ai_search_optimization_post_tags() {
    $tags_list = get_the_tag_list('', ', ');
    if ($tags_list) {
        echo '<div class="post-tags">';
        echo '<h3 class="tags-title">Tags</h3>';
        echo '<div class="tag-list">';
        $tags = get_the_tags();
        if ($tags) {
            foreach ($tags as $tag) {
                echo '<a href="' . get_tag_link($tag->term_id) . '" class="tag-item">' . $tag->name . '</a>';
            }
        }
        echo '</div>';
        echo '</div>';
    }
}

/**
 * Display author bio
 */
function ai_search_optimization_author_bio() {
    $author_id = get_the_author_meta('ID');
    $author_bio = get_the_author_meta('description');
    
    // Always display the author bio box
    echo '<div class="author-bio">';
    echo '<div class="author-info">';
    echo '<img src="' . esc_url(get_avatar_url($author_id, array('size' => 80))) . '" alt="' . esc_attr(get_the_author()) . '" class="author-avatar">';
    echo '<div class="author-details">';
    echo '<h4>Written by</h4>';
    echo '<h3>' . esc_html(get_the_author()) . '</h3>';
    echo '<p class="author-title">SEO & AI Search Optimisation Strategist</p>';
    
    echo '<div class="author-social">';
    $linkedin_url = get_the_author_meta('linkedin_url', $author_id);
    $twitter_url = get_the_author_meta('twitter_url', $author_id);
    
    // Use default URLs if custom ones aren't set
    if (empty($linkedin_url)) {
        $linkedin_url = 'https://www.linkedin.com/in/gagan-ghotra/';
    }
    if (empty($twitter_url)) {
        $twitter_url = 'https://x.com/gaganghotra_';
    }
    
    echo '<a href="' . esc_url($linkedin_url) . '" target="_blank" class="social-link"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg> LinkedIn</a>';
    
    echo '<a href="' . esc_url($twitter_url) . '" target="_blank" class="social-link"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg> X</a>';
    echo '</div>';
    
    // Use provided bio or default text
    if (!empty($author_bio)) {
        echo '<p class="author-description">' . wp_kses_post($author_bio) . '</p>';
    } else {
        echo '<p class="author-description">Gagan Ghotra is an independent SEO consultant based in Melbourne, Australia. Specialising in technical SEO, Google Discover optimisation, international SEO, eCommerce SEO, comprehensive SEO audits, and one-time consultations, he works with eCommerce brands to enhance visibility in Google\'s search results across evolving landscapes, including different countries and platforms.</p>';
    }
    
    echo '<div class="author-expertise">';
    echo '<h5 class="expertise-title">Expertise</h5>';
    echo '<div class="expertise-list">';
    echo '<span class="expertise-item">Technical SEO</span>';
    echo '<span class="expertise-item">Google Discover Optimisation</span>';
    echo '<span class="expertise-item">International SEO</span>';
    echo '<span class="expertise-item">eCommerce SEO</span>';
    echo '<span class="expertise-item">SEO Audits</span>';
    echo '<span class="expertise-item">AI Search Optimisation</span>';
    echo '</div>';
    echo '</div>';
    
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

 