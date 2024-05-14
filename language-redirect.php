<?php
/*
Plugin Name: Language Redirect
Description: Redirect users based on browser language and URL parameters.
Version: 1.0
Author: Martin Kamenov
Author URI: https://maksoft.net
Plugin URI: https://maksoft.net

*/

function language_redirect() {
    // Проверка за език на браузъра
    $browser_language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

    // Проверка за URL параметър 'n'
    $page_number = isset($_GET['n']) ? $_GET['n'] : null;

    // Проверка за наличие на параметър 'n' и различен хост от 'usb-travel.com'
    if (!is_null($page_number) && $_SERVER['HTTP_HOST'] !== 'usb-travel.com') {
        wp_redirect('https://usb-travel.com/page.php?n=' . $page_number);
        exit;
    }
}

add_action('template_redirect', 'language_redirect');


?>
