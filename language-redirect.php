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

    // Проверка за наличие на параметър 'n' и редирект
    if (!is_null($page_number) && $_SERVER['HTTP_HOST'] !== 'usb-travel.com') {
        wp_redirect('https://usb-travel.com/page.php?n=' . $page_number);
        exit;
    }

}

function custom_language_switcher($items, $args) {
    // Проверка дали това е главното меню
    if ($args->theme_location == 'primary-menu') {
        // Масив с езиците и техните URL адреси
        $languages = array(
            'en' => 'https://en.usb-travel.com',
            'bg' => 'https://bg.usb-travel.com',
            'ru' => 'https://ru.usb-travel.com'
        );

        // Вземане на текущия език на сайта
        $current_language = substr(get_bloginfo('language'), 0, 2);

        // Изграждане на HTML линковете за езиците
        $language_links = '';
        foreach ($languages as $language => $url) {
            // Активен клас за текущия език
            $active_class = ($language === $current_language) ? 'active' : '';
            $language_links .= '<li class="menu-item ' . $active_class . '"><a href="' . $url . '">' . $language . '</a></li>';
        }

        // Добавяне на езиковите линкове към менюто
        $items .= $language_links;
    }

    return $items;
}

// Добавяне на функцията към хука wp_nav_menu_items
add_filter('wp_nav_menu_items', 'custom_language_switcher', 10, 2);

add_action('template_redirect', 'language_redirect');


?>
