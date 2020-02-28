<?php

namespace classes\core;

class ThemeClass
{
    public function __construct()
    {
        $this->addSupport('title-tag')
            ->addSupport('custom-logo')
            ->addSupport('post-thumbnails')
            ->addSupport('customize-selective-refresh-widgets')
            ->addSupport('html5', [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            ])
            ->addFilter('show_admin_bar', function () {
                return false;
            });
    }

    public function addSupport($feature, $options = null)
    {
        $this->actionAfterInit(function () use ($feature, $options) {
            if ($options) {
                add_theme_support($feature, $options);
            } else {
                add_theme_support($feature);
            }
        });
        return $this;
    }
    public function addFilter($name, $function)
    {
        add_filter($name, $function);
    }
    public function actionAfterSetup($function)
    {
        add_action('after_setup_theme', function () use ($function) {
            $function();
        });
    }
    public function addNavMenus($locations = [])
    {
        add_action('after_setup_theme', function () use ($locations) {
            register_nav_menus($locations);
        });
    }
    public function enqueueScripts($locations = [])
    {
        $this->actionEnqueueScripts(function () use ($locations) {
            foreach ($locations as $location) {
                wp_enqueue_script('script-' . $location, get_template_directory_uri() . '/assets/js/' . $location, 1.1, true);
            }
        });
    }
    public function enqueueStyles($locations = [])
    {
        $this->actionEnqueueScripts(function () use ($locations) {
            foreach ($locations as $location) {
                wp_enqueue_style('style-' . $location, get_template_directory_uri() . '/assets/css/' . $location, [], false, 'all');
            }
        });
    }

    public function actionAfterInit($function)
    {
        add_action('init', function () use ($function) {
            $function();
        });
    }
    public function actionEnqueueScripts($function)
    {
        add_action('wp_enqueue_scripts', function () use ($function) {
            $function();
        });
    }
    public function createPostType($name = "", $args = [])
    {
        $this->actionAfterInit(function () use ($args, $name) {
            // print_r($name);
            register_post_type($name, $args);
        });
    }
    public function createTaxonomy($name = "", $options = [], $args = [])
    {
        $this->actionAfterInit(function () use ($args, $name, $options) {
            register_taxonomy($name, $options, $args);
        });
    }
}
