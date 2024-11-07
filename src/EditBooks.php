<?php

namespace MilosNisevic;

class EditBooks {

  public function __construct()
  {
    add_action('wp_ajax_get_book_details', [$this, 'getBookDetails']);
    add_action('wp_ajax_update_book', [$this, 'editBook']);
  }

  public function getBookDetails() {
    if (isset($_GET['book_id'])) {

        $bookID = intval($_GET['book_id']);
        $bookDetails = LibraryManagementSystem::$wpdb->get_row("SELECT * FROM " . LibraryManagementSystem::$tableName . " WHERE id = $bookID");
        
        if ($bookDetails) {
            wp_send_json_success($bookDetails);
        } else {
            wp_send_json_error('Book not found.');
        }
    } else {
        wp_send_json_error('Book ID not provided.');
    }
  }

  public function editBook() {
    if (isset($_POST['edit_book'])) {

        $bookID = intval($_POST['book_id']);
        $title = sanitize_text_field($_POST['book_title']);
        $author = sanitize_text_field($_POST['book_author']);
        $genre = sanitize_text_field($_POST['book_genre']);
        $isbn = sanitize_text_field($_POST['book_isbn']);

        $updated = LibraryManagementSystem::$wpdb->update(
          LibraryManagementSystem::$tableName,
                [
                'title' => $title,
                'author' => $author,
                'genre' => $genre,
                'isbn' => $isbn
                ],
                ['id' => $bookID]
        );

        if ($updated !== false) {
            wp_send_json_success('Book updated successfully.');
        } else {
            wp_send_json_error('Failed to update book.');
        }
    }
  }
}