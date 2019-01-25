<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package syria_list
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri() ?>/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri() ?>/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri() ?>/images/icons/favicon-16x16.png">
    <link rel="mask-icon" href="<?php echo get_template_directory_uri() ?>/images/icons/safari-pinned-tab.svg" color="#0190cf">
    <meta name="msapplication-TileColor" content="#0190cf">
    <meta name="theme-color" content="#0190cf">


	<?php wp_head(); ?>
</head>

<body <?php body_class( 'relative font-display' ); ?>>

<header class="py-8 px-3 md:px-0 bg-blue border-b border-white">
    <div class="container mx-auto">
        <div class="flex justify-between items-center">

            <h1 class="logo">
                <a href="<?php echo get_home_url() ?>">
                    <img src="<?php echo get_template_directory_uri() . '/images/logo3.png' ?>"
                         alt="Syria List Logo">
                </a>
            </h1>

            <div class="items-baseline hidden lg:flex">

                <div class="flex mr-3">
                    <div class="relative">
                        <select name="lang"
                                class="bg-blue text-white language-change appearance-none pr-6 pl-2 bg-white">
                            <option data-local="en" <?php echo get_locale() === 'en_GB' ? 'selected' : '' ?>
                                    value="<?php echo get_home_url( null, 'en' ) ?>">EN
                            </option>
                            <option data-local="ar" <?php echo get_locale() === 'ar' ? 'selected' : '' ?>
                                    value="<?php echo get_home_url( null, 'ar' ) ?>">AR
                            </option>
                        </select>
                        <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-white">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <button class="bg-white bgbl text-blue py-2 px-5 rounded-full"> <?php _e( 'Become A Partner', 'syria_list' ) ?> </button>
            </div>
            <a href="#" class="no-underline text-white lg:hidden toggle-mobile-menu">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <div id="mobile-menu" class="hidden rounded absolute bg-white w-1/2 pin-t pin-r">
            <div class="pt-16 pb-8 px-4 relative">
                <div class="border-b mb-4">
                    <div class="absolute pt-6 pin-t pin-r px-4">
                        <a href="#" class="no-underline text-blue toggle-mobile-menu">
                            <i class="fa fa-angle-up"></i>
                        </a>
                    </div>
                    <div class="absolute pt-6 pin-t pin-l px-4">
                        <div class="relative">
                            <select name="lang" class="language-change appearance-none pr-6 pl-2 bg-white">
                                <option data-local="en" <?php echo get_locale() === 'en_GB' ? 'selected' : '' ?>
                                        value="<?php echo get_home_url( null, 'en' ) ?>">EN
                                </option>
                                <option data-local="ar" <?php echo get_locale() === 'ar' ? 'selected' : '' ?>
                                        value="<?php echo get_home_url( null, 'ar' ) ?>">AR
                                </option>
                            </select>
                            <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-4 mb-4 border-b">
					<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
                </div>
                <div class="flex justify-around">
                    <button class="bg-blue text-white py-2 px-5 rounded-full"><?php _e( 'Become A Partner', 'syria_list' ) ?></button>
                </div>
            </div>

        </div>
    </div>
</header>

<nav class="py-2 bg-blue hidden lg:block">
    <div class="container mx-auto">
		<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
    </div>
</nav>
