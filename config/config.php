<?php
//Edit later with database credentials
//Database Configuration
define("DB_HOST", "sql310.infinityfree.com");
define("DB_NAME", "if0_41174388_library_db");
define("DB_USER", "if0_41174388_libraryuser");
define("DB_PASS", "0qt3UDjqhpZZ7Y9");
define("DB_CHARSET", "utf8mb4");
//Site Configuration
define("SITE_NAME", "Online Library");
//File Upload Settings
define('UPLOAD_MAX_SIZE', 10485760); // 10MB in bytes
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png', 'image/jpg']);
define('ALLOWED_PDF_TYPES', ['application/pdf']);
define('UPLOAD_PATH_COVERS', __DIR__ . '/../uploads/covers/');
define('UPLOAD_PATH_BOOKS', __DIR__ . '/../uploads/books/');
//Security Settings
define("SESSION_LIFETIME", "3600");
define("PASSWORD_MIN_LENGTH", 8);

define("DISPLAY_ERRORS", true);

if (DISPLAY_ERRORS) {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
} else {
    error_reporting(0);
    ini_set("display_errors",0);
}

date_default_timezone_set("Europe/Budapest");
?>