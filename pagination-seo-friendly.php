<?php
/*
Plugin Name: SEO Friendly Pagination
Plugin URI: https://gitlab.com/sadeghisalar/seo-friendly-pagination-wp/
Description: Lightweight SEO Friendly Pagination Plugin, if your theme use wp_pagenavi plugin for Pagination just deactivate it, this plugin will override wp_pagenavi() function. otherwise you should contact your theme developer to change it on your theme.
Version: 1
Author: Salar Sadeghi
Author URI: https://salars.xyz
Text Domain: seofp
Domain Path: /languages
*/
if (!defined('ABSPATH')) {
    die('💔');
}

class SEO_FriendlyPagination
{

    function __construct()
    {

        add_action('seo_friendly_pagination', [$this, 'pagination'], 10);
        add_action('after_setup_theme', [$this, 'override'], 10);
        add_action('wp_enqueue_scripts', [$this, 'style']);
        load_plugin_textdomain('seofp', FALSE, basename(dirname(__FILE__)) . '/languages/');
    }

    function override()
    {

        if (!function_exists('wp_pagenavi')) {

            function wp_pagenavi()
            {

                do_action('seo_friendly_pagination');

            }

        }
    }

    function pagination()
    {
        $pages = '';
        global $paged;

        if (empty($paged)) $paged = 1;


        if ($pages == '') {

            global $wp_query;

            $pages = $wp_query->max_num_pages;

            if (!$pages) {

                $pages = 1;

            }

        }

        if (1 != $pages) {

            echo "<ul class='pagination pagination-seo-friendly'>";


            for ($i = 1; $i <= $pages; $i++) {

                if ($paged == 1) {

                    if ($i == $paged) {

                        echo '<li class="page-item disabled"><a class="page-link disabled" href="' . strtok(get_pagenum_link($i), '?') . '" tabindex="-1">' . $i . '</a></li>';

                    }

                    if ($i == 2) {

                        echo '<li class="page-item"><a class="page-link" href="' . strtok(get_pagenum_link($i), '?') . '">' . __('Next Page', 'seofp') . '</a></li>';

                    }

                    if ($i == 3) {

                        echo '<li class="page-item"><a class="page-link" href="' . strtok(get_pagenum_link($wp_query->max_num_pages), '?') . '">' . __('Last Page', 'seofp') . '</a></li>';

                    }


                }


                if ($paged > 1) {


                    if ($i == ($paged - 1)) {

                        if ($i > 1) {

                            echo '<li class="page-item"><a class="page-link" href="' . strtok(get_pagenum_link(1), '?') . '">' . __('First Page', 'seofp') . '</a></li>';

                        }

                        echo '<li class="page-item"><a class="page-link" href="' . strtok(get_pagenum_link($i), '?') . '">' . __('Previous Page', 'seofp') . '</a></li>';

                    }

                    if ($i == $paged) {

                        echo '<li class="page-item disabled"><a class="page-link disabled" href="' . strtok(get_pagenum_link($i), '?') . '" tabindex="-1">' . $i . '</a></li>';

                    }

                    if ($i == ($paged + 1)) {

                        echo '<li class="page-item"><a class="page-link" href="' . strtok(get_pagenum_link($i), '?') . '">' . __('Next Page', 'seofp') . '</a></li>';

                        if ($wp_query->max_num_pages != ($paged + 1)) {

                            echo '<li class="page-item"><a class="page-link" href="' . strtok(get_pagenum_link($wp_query->max_num_pages), '?') . '">' . __('Last Page', 'seofp') . '</a></li>';

                        }

                    }


                }


            }


            echo "</ul>";

        }

    }

    function style()
    {
        wp_enqueue_style(self::class, plugins_url('style.css', __FILE__));
    }

}

add_action('plugins_loaded', function () {
    new SEO_FriendlyPagination;
}, 99);
