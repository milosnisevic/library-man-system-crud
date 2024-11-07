<?php

namespace MilosNisevic;

class GutendexAPI {
  
  private $apiURL = 'https://gutendex.com/books/';

  public function fetchBooks($searchQuery = '', $page = 1) {

    $transientKey = $searchQuery . '_page_' . $page;
    $cachedBooks = get_transient($transientKey);

    if ($cachedBooks) {
      return $cachedBooks;
    }

    $url = $this->apiURL;

    if(!empty($searchQuery)) {
      $url .= '?search' . urlencode($searchQuery);
    }

    $url .= (!empty($searchQuery) ? '&' : '?') . 'page=' . $page;

    $response = wp_remote_get($url, [
      'timeout' => 15
    ]);

    if(is_wp_error($response)) {
      return [];
    }

    $body = wp_remote_retrieve_body($response);
    $books = json_decode($body, true);

    set_transient($transientKey, $books, DAY_IN_SECONDS);

    return $books;
  }
}