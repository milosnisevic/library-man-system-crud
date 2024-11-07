<?php

namespace MilosNisevic;

class Enqueue {

  public function __construct()
  {
    add_action('admin_enqueue_scripts', [$this, 'enqueueScripts']);
  }

  public function enqueueScripts() {
    wp_enqueue_script('edit-books', plugin_dir_url(__DIR__) . 'assets/js/edit-books.js', [], '1.0', true);
    wp_enqueue_script('delete-books', plugin_dir_url(__DIR__) . 'assets/js/delete-books.js', [], '1.0', true);
    wp_enqueue_script('search-books', plugin_dir_url(__DIR__) . 'assets/js/search-books.js', [], '1.0', true);
  }

}