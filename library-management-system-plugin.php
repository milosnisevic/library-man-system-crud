<?php 

/*
Plugin Name: Library Management System Plugin
Description: Manage books in your library.
Version: 1.0
Author: Milos
Text Domain: library-management-system
*/

if (! defined('ABSPATH')) {
    exit;
 } // Exit if accessed directly

 require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';
 
 use MilosNisevic\LibraryManagementSystem;

 new LibraryManagementSystem();