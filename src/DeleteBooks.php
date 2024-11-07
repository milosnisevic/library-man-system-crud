<?php

namespace MilosNisevic;

class DeleteBooks {

  public function __construct()
  {
    add_action('wp_ajax_delete_book', [$this, 'deleteBook']);
    add_action('wp_ajax_nopriv_delete_book', [$this, 'deleteBook']);
  }

  public function deleteBook() {
    
      if (isset($_POST['book_id'])) {
          $bookID = intval($_POST['book_id']);
          LibraryManagementSystem::$wpdb->delete(LibraryManagementSystem::$tableName, ['id' => $bookID]);
          wp_send_json_success('Book deleted successfully.');
      } else {
          wp_send_json_error('Book ID not provided.');
      }
    }
}