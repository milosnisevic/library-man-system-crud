<?php

namespace MilosNisevic;

class AddBooks {

  public function __construct() {
    add_action('admin_init', [$this, 'addBookToLibrary']);
  }

  public function addBookToLibrary() {
    if (isset($_POST['add_book'])) {

        $title = sanitize_text_field($_POST['book_title']);
        $author = sanitize_text_field($_POST['book_author']);
        $genre = sanitize_text_field($_POST['book_genre']);
        $isbn = sanitize_text_field($_POST['book_isbn']);

        LibraryManagementSystem::$wpdb->insert(
          LibraryManagementSystem::$tableName,
            [
                'title' => $title,
                'author' => $author,
                'genre' => $genre,
                'isbn' => $isbn
            ]
        );

        echo '<div class="updated"><p>Book added successfully!</p></div>';
    }
  }
}