<?php
/**
 * The template for displaying the header
 *
 * This is the template that displays all of the <head> section, opens the <body> tag and adds the site's header.
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>


    <div class="site__logo">
        <?php
        if (!empty(the_custom_logo())) :
            the_custom_logo();
        endif;
        ?>
    </div>

