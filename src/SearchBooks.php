<?php

namespace MilosNisevic;

class SearchBooks {

  public function __construct()
  {
    add_action('wp_ajax_search_books', [$this, 'searchBooks']);
    add_action('wp_ajax_nopriv_search_books', [$this, 'searchBooks']);
  }

  public function searchBooks() {
  
    $searchQuery = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';
  
    $sql = "SELECT * FROM " . LibraryManagementSystem::$tableName;
    if (!empty($searchQuery)) {
        $sql .= " WHERE title LIKE '%$searchQuery%'";
    }
  
    $books = LibraryManagementSystem::$wpdb->get_results($sql);
  
    wp_send_json_success($books);
  }
}