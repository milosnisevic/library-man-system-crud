<?php

namespace MilosNisevic;

class CreateMenu {

  public function __construct()
  {
      add_action('admin_menu', [$this, 'addMenuPages']);
  }

  public function addMenuPages() {
      add_menu_page(
          'Library Management',
          'Library Management',
          'manage_options',
          'library-management-system',
          [$this, 'libraryManagementSystemPage'],
          'dashicons-book-alt'
      );

      add_submenu_page(
          'library-management-system',
          'Add New Book',
          'Add New Book',
          'manage_options',
          'library-management-system-add-new',
          [$this, 'libraryManagementSystemAddNewBook']
      );

      add_submenu_page(
          'library-management-system',
          'Book List',
          'Book List',
          'manage_options',
          'library-management-system-book-list',
          [$this, 'libraryManagementSystemBookList']
      );

      add_submenu_page(
        'library-management-system',
        'Fetch Books from Gutendex',
        'Fetch Books',
        'manage_options',
        'library-management-system-fetch-books',
        [$this, 'libraryManagementSystemFetchBooks']
    );
  }

  public function libraryManagementSystemPage() {
      ?>
      <div class="wrap">
          <h2>Library Management</h2>
          <p>Welcome to the Library Management System!</p>
      </div>
      <?php
  }

  public function libraryManagementSystemAddNewBook() {
      ?>
      <div class="wrap">
          <h2>Add New Book</h2>
          <?php $this->displayAddBookForm(); ?>
      </div>
      <?php
  }

  public function libraryManagementSystemBookList() {
      ?>
      <div class="wrap">
          <h2>Book List</h2>
          <?php $this->displayBookTable(); ?>
      </div>
      <?php
  }

  public function displayAddBookForm() {
      ?>
      <form method="post" action="">
          <label for="book_title">Title:</label><br>
          <input type="text" id="book_title" name="book_title" required><br>
          <label for="book_author">Author:</label><br>
          <input type="text" id="book_author" name="book_author" required><br>
          <label for="book_genre">Genre:</label><br>
          <input type="text" id="book_genre" name="book_genre" required><br>
          <label for="book_isbn">ISBN:</label><br>
          <input type="text" id="book_isbn" name="book_isbn" required><br>
          <input type="submit" name="add_book" value="Add Book">
      </form>
      <?php
  }

  public function displayBookTable() {
    
    $books = LibraryManagementSystem::$wpdb->get_results("SELECT * FROM " . LibraryManagementSystem::$tableName);

    include_once plugin_dir_path(__DIR__) . 'template-parts/' . 'search-form.php';
    include_once plugin_dir_path(__DIR__) . 'template-parts/' . 'book-table-admin.php';
    include_once plugin_dir_path(__DIR__) . 'template-parts/' . 'edit-modal.php';
  }

  public function libraryManagementSystemFetchBooks() {

    $librarySystem = new LibraryManagementSystem();
    $currentPage = isset($_GET['paged']) ? intval($_GET['paged']) : 1;
    $books = $librarySystem->getBooksFromGutendex('', $currentPage);
    
    include_once plugin_dir_path(__DIR__) . 'template-parts/gutendex-book-list.php';
  }
}