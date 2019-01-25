<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package syria_list
 */

get_header();
?>
    <section class="container mx-auto h-screen">
        <div class="flex justify-around items-center h-full">
            <div>
                <h1 class="text-blue text-5xl text-center">404</h1>
                <h3><?php _e( 'The page you are looking for could not be found.', 'syria_list' ) ?></h3>
            </div>
        </div>
    </section>
<?php
get_footer();
