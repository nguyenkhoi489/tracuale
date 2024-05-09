<?php
// Add custom Theme Functions here
add_filter('use_block_editor_for_post', '__return_false');

add_action('init', 'hide_notice');
function hide_notice()
{
    remove_action('admin_notices', 'flatsome_maintenance_admin_notice');
}

// Add Font Awesome 5.15.4
function wpb_load_fa()
{
    wp_enqueue_style('wpb-fa', get_stylesheet_directory_uri() . '/FontAwesome/css/all.css');
}
add_action('wp_enqueue_scripts', 'wpb_load_fa');

if (!function_exists('pre')) {
    function pre($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        die;
    }
}
/*
* Author: Nguyên Khôi Dev
* Custom UX Builder Element
*/

function nkd_ux_builder_title_element()
{
    $title_link_options            = require __DIR__ . '/commons/links.php';
    $title_link_options['options'] = array_merge(
        array(
            'link_text' => array(
                'type'    => 'textfield',
                'heading' => 'Text',
                'default' => '',
            ),
        ),
        $title_link_options['options']
    );

    add_ux_builder_shortcode('nkd_custom_title', array(
        'name'      => __('Custom Title'),
        'category'  => __('Nguyên Khôi Dev'),
        'thumbnail' => '',
        'priority'  => 1,
        'options' => array(
            'style'            => array(
                'type'    => 'select',
                'heading' => 'Style',
                'default' => 'normal',
                'options' => array(
                    'normal'      => 'Normal',
                    'center'      => 'Center',
                    'bold'        => 'Left Bold',
                    'bold-center' => 'Center Bold',
                ),
            ),
            'text'             => array(
                'type'       => 'textfield',
                'heading'    => 'Title',
                'default'    => 'Lorem ipsum dolor sit amet...',
                'auto_focus' => true,
            ),
            'tag_name'         => array(
                'type'    => 'select',
                'heading' => 'Tag',
                'default' => 'h3',
                'options' => array(
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                ),
            ),
            'color'            => array(
                'type'     => 'colorpicker',
                'heading'  => __('Color'),
                'alpha'    => true,
                'format'   => 'rgb',
                'position' => 'bottom right',
            ),
            'width'            => array(
                'type'    => 'scrubfield',
                'heading' => __('Width'),
                'default' => '',
                'min'     => 0,
                'max'     => 1200,
                'step'    => 5,
            ),
            'margin_top'       => array(
                'type'        => 'scrubfield',
                'heading'     => __('Margin Top'),
                'default'     => '',
                'placeholder' => __('0px'),
                'min'         => -100,
                'max'         => 300,
                'step'        => 1,
            ),
            'margin_bottom'    => array(
                'type'        => 'scrubfield',
                'heading'     => __('Margin Bottom'),
                'default'     => '',
                'placeholder' => __('0px'),
                'min'         => -100,
                'max'         => 300,
                'step'        => 1,
            ),
            'size'             => array(
                'type'    => 'slider',
                'heading' => __('Size'),
                'default' => 100,
                'unit'    => '%',
                'min'     => 20,
                'max'     => 300,
                'step'    => 1,
            ),
            'link_options'     => $title_link_options,
            'advanced_options' => require __DIR__ . '/commons/advanced.php',
        ),
    ));
}
add_action('ux_builder_setup', 'nkd_ux_builder_title_element');

function nkd_title_element_func($atts)
{

    extract(shortcode_atts(array(
        'style' => 'normal',
        'text' => 'Lorem ipsum dolor sit amet...',
        'tag_name' => 'h3',
        'color' => '',
        'width' => '',
        'margin_top' => '',
        'margin_bottom' => '',
        'size' => '100',
        'link' => '',
        'target' => '',
        'rel' => '',
        'class' => ''
    ), $atts));
    ob_start();
    $allStyle = [];
    if ($style) {
        switch ($style) {
            case "center":
                $allStyle[] = "text-align: center";
                break;
            case "bold":
                $allStyle[] = "font-weight: bold";
                break;
            case "bold-center":
                $allStyle[] = "font-weight: bold";
                $allStyle[] = "text-align: center";
                break;
        }
    }
    if ($color) {
        $allStyle[] = "color: $color";
    }
    if ($width) {
        $allStyle[] = "max-width: $width";
    }
    if ($margin_top) {
        $allStyle[] = "margin-top: $margin_top";
    }
    if ($margin_bottom) {
        $allStyle[] = "margin-bottom: $margin_bottom";
    }
    if ($size && $size != 100) {
        $allStyle[] = "font-size: $size%";
    }
    echo "<$tag_name class=\"nkd_title" . ($class ? " $class" : "") . "\"" . (count($allStyle) ? "style=\"" . implode(";", $allStyle) . "\"" : "") . ">";
    if ($link) {
        echo "<a href=\"$link\" " . ($rel ? "rel=\"$rel\"" : "") . ($target ? "target=\"$target\"" : "") . ">text</a>";
    } else {
        echo $text;
    }
    echo "</$tag_name>";

    $content = ob_get_clean();
    return $content;
}
add_shortcode('nkd_custom_title', 'nkd_title_element_func');


function nkd_ux_builder_divider()
{
    add_ux_builder_shortcode('nkd_divider', array(
        'name' => __('Custom Divider'),
        'category' => __('Nguyên Khôi Dev'),
        'template' => '',
        'thumbnail' =>  '',
    ));
}
add_action('ux_builder_setup', 'nkd_ux_builder_divider');

function nkd_divider_func()
{
    ob_start();
    echo "<span class=\"nkd_divider\"></span>";
    return ob_get_clean();
}
add_shortcode('nkd_divider', 'nkd_divider_func');


function nkd_ux_builder_title_before_element()
{


    add_ux_builder_shortcode('nkd_custom_title_before', array(
        'name'      => __('Custom Title With Before'),
        'category'  => __('Nguyên Khôi Dev'),
        'thumbnail' => '',
        'priority'  => 1,
        'options' => array(
            'text'             => array(
                'type'       => 'textfield',
                'heading'    => 'Title',
                'default'    => 'Lorem ipsum dolor sit amet...',
                'auto_focus' => true,
            )
        ),
    ));
}
add_action('ux_builder_setup', 'nkd_ux_builder_title_before_element');

function nkd_custom_title_before_func($atts)
{

    extract(shortcode_atts(array(
        'text' => 'Lorem ipsum dolor sit amet...',
    ), $atts));
    ob_start();

    echo "<h4 class=\"nkd_title_before\">";
    echo $text;
    echo "</h4>";

    $content = ob_get_clean();
    return $content;
}
add_shortcode('nkd_custom_title_before', 'nkd_custom_title_before_func');

function nkd_ux_builder_product_cat_element()
{
    $repeater_posts     = 'products';
    $repeater_post_type = 'product';
    $repeater_post_cat  = 'product_cat';

    $options = array(
        'post_options' => require(__DIR__ . '/commons/repeater-category.php'),
    );

    add_ux_builder_shortcode('nkd_custom_products_list', array(
        'name'      => __('Custom Product Category'),
        'category'  => __('Nguyên Khôi Dev'),
        'priority' => 2,
        'thumbnail' =>  '',
        'options' => $options
    ));
}
add_action('ux_builder_setup', 'nkd_ux_builder_product_cat_element');

function nkd_product_cat_func($atts)
{

    extract(shortcode_atts(array(
        'cat' => '',
    ), $atts));
    ob_start();
    $args = array(
        'taxonomy'   => 'product_cat',
        'hide_empty' => false,
        'orderby' => 'menu_order'
    );
    if (!empty($cat)) {
        $cat = array_map('trim', explode(",", $cat));
        $args['include'] =   $cat;
    }

    $terms = get_terms($args);

    if (count($terms)) {
        echo "<div class=\"row\">";
        foreach ($terms as $item) {
            $thumbnail_id = get_term_meta($item->term_id, 'thumbnail_id', true);
            $image = wp_get_attachment_url($thumbnail_id);

?>
            <div class="col large-4 medium-6 small-6">
                <div class="col-inner">
                    <div data-url="<?= get_term_link($item->term_id, 'product_cat') ?>" class="box-content__category" style="background-image: url(<?= $image ? $image : get_stylesheet_directory_uri('/assets/img/no-image.jpg') ?>)">
                        <div class="text-box__name">
                            <div class="box-text__name">
                                <h3><?= $item->name ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
        echo "</div>";
    }

    return ob_get_clean();
}
add_shortcode('nkd_custom_products_list', 'nkd_product_cat_func');

function nkd_custom_video_iframe()
{
    add_ux_builder_shortcode('nkd_video_custom', array(
        'name'      => __('Custom Video Iframe'),
        'category'  => __('Nguyên Khôi Dev'),
        'thumbnail' => '',
        'priority'  => 1,
        'options' => array(
            'url'             => array(
                'type'       => 'textfield',
                'heading'    => 'Video URL',
                'default'    => '',
            ),
            'id' => array(
                'type' => 'image',
                'heading' => __('Image'),
                'default' => ''
            ),
        ),
    ));
}
add_action('ux_builder_setup', 'nkd_custom_video_iframe');

function nkd_video_custom_func($atts)
{
    extract(shortcode_atts(array(
        'url' => 'https://www.youtube.com/watch?v=VA2jlmINSFY',
        'id' => 162
    ), $atts));
    ob_start();
    ?>
    <div class="box-video-custom">
        <div class="box-image__background">
            <img src="<?= wp_get_attachment_url($id) ?>" loading="lazy" alt="Thumbnail Video">
        </div>
        <div class="box-action">
            <span data-href="<?= $url ?>" class="btn-action__icon">
                <i class="fas fa-play"></i>
            </span>
        </div>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('nkd_video_custom', 'nkd_video_custom_func');

function nkd_ux_custom_copyright_element()
{
    add_ux_builder_shortcode('nkd_custom_copyright', array(
        'name'      => __('Custom Copyright'),
        'category'  => __('Nguyên Khôi Dev'),
        'thumbnail' => '',
        'priority'  => 1,
    ));
}
add_action('ux_builder_setup', 'nkd_ux_custom_copyright_element');

function nkd_custom_copyright_func()
{
    ob_start();
    $blog_name = ucwords(get_bloginfo('name'));
    echo "<p>Copyright " . date("Y") . " © $blog_name </p>";
    return ob_get_clean();
}
add_shortcode('nkd_custom_copyright', 'nkd_custom_copyright_func');


function nkd_custom_page_title()
{
    add_ux_builder_shortcode('nkd_page_title_custom', array(
        'name'      => __('Custom Page Title With Image'),
        'category'  => __('Nguyên Khôi Dev'),
        'thumbnail' => '',
        'priority'  => 1,
        'options' => array(
            'id' => array(
                'type' => 'image',
                'heading' => __('Image'),
                'default' => ''
            ),
        ),
    ));
}
add_action('ux_builder_setup', 'nkd_custom_page_title');

function nkd_page_title_custom_func($atts)
{
    extract(shortcode_atts(array(
        'id' => ""
    ), $atts));
    ob_start();
?>
    <section class="section p-0">
        <div class="bg section-bg fill bg-fill bg-loaded"></div>
        <div class="section-content relative">
            <div class="page-header-wrapper">
                <div class="page-title dark featured-title">
                    <div class="page-title-bg">
                        <div class="title-bg fill bg-fill" data-parallax-container=".page-title" data-parallax-background="" data-parallax="-"></div>
                        <div class="title-overlay fill"></div>
                    </div>
                    <div class="page-title-inner container align-center text-center flex-row-col medium-flex-wrap">
                        <div class="title-wrapper flex-col">
                            <h1 class="entry-title mb-0"><?=get_the_title()?></h1>
                        </div>
                        <div class="title-content flex-col">
                            <div class="title-breadcrumbs pb-half pt-half">
                               <?=dimox_breadcrumbs()?>
                            </div>
                        </div>
                    </div>
                    <style>
                        .page-title-inner {
                            min-height: 200px;
                        }

                        .title-bg {
                            background-image: url(<?=wp_get_attachment_url($id)?>);
                        }

                        .title-overlay {
                            background-color: rgba(0, 0, 0, .5);
                        }
                    </style>
                </div>
            </div>
        </div>
    </section>
<?php

    return ob_get_clean();
}
add_shortcode('nkd_page_title_custom', 'nkd_page_title_custom_func');





/**
 * Breadcrumb
 */
function dimox_breadcrumbs() {
    $delimiter = '»';
    $home = 'Trang chủ'; // chữ thay thế cho phần 'Home' link
    $before = '<span class="current">'; // thẻ html đằng trước mỗi link
    $after = '</span>'; // thẻ đằng sau mỗi link
    if ( !is_home() && !is_front_page() || is_paged() ) {
        echo '<div id="crumbs">';
        global $post;
        $homeLink = get_bloginfo('url');
        echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
        if ( is_category() ) {
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
            echo $before . single_cat_title('', false) . $after;
        } elseif ( is_day() ) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time('d') . $after;
        } elseif ( is_month() ) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time('F') . $after;
        } elseif ( is_year() ) {
            echo $before . get_the_time('Y') . $after;
        } elseif ( is_single() && !is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
                echo $before . get_the_title() . $after;
            } else {
                $cat = get_the_category(); $cat = $cat[0];
                echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                echo $before . get_the_title() . $after;
            }
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;
        } elseif ( is_attachment() ) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID); $cat = $cat[0];
            echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;
        } elseif ( is_page() && !$post->post_parent ) {
            echo $before . get_the_title() . $after;
        } elseif ( is_page() && $post->post_parent ) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;
        } elseif ( is_search() ) {
            echo $before . 'Search results for "' . get_search_query() . '"' . $after;
        } elseif ( is_tag() ) {
            echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
        } elseif ( is_author() ) {
            global $author;
            echo $before . 'Articles posted by ' . $author->display_name . $after;
        } elseif ( is_404() ) {
            echo $before . 'Error 404' . $after;
        }
        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
            echo __('Page') . ' ' . get_query_var('paged');
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }
        echo '</div>';
    }
} // end dimox_breadcrumbs()