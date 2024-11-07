<?php

namespace MilosNisevic;

use MilosNisevic\Enqueue;
use MilosNisevic\CreateMenu;
use MilosNisevic\AddBooks;
use MilosNisevic\DeleteBooks;
use MilosNisevic\EditBooks;
use MilosNisevic\SearchBooks;
use MilosNisevic\GutendexAPI;

class LibraryManagementSystem {

  public static $wpdb;
  public static $tableName;
  private $gutendexAPI;

  public function __construct() {
      global $wpdb;
      self::$wpdb = $wpdb;
      self::$tableName = $wpdb->prefix . 'books';
      
      new Enqueue();
      new CreateMenu();
      new AddBooks();
      new DeleteBooks();
      new EditBooks();
      new SearchBooks();
      $this->gutendexAPI = new GutendexAPI();
    }

    public function getBooksFromGutendex($searchQuery = '', $page = 1) {
      return $this->gutendexAPI->fetchBooks($searchQuery, $page);
  }
}