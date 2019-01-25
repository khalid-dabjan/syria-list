<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package syria_list
 */

get_header();
the_post()
?>

    <section>
        <div class="container mx-auto py-3">
            <h1 class="py-2 text-grey-darkest text-center dash"><?php the_title() ?></h1>
            <div class="text-grey-darker leading-normal">
				<?php the_content() ?>
            </div>
        </div>
    </section>

<?php
get_sidebar();
get_footer();
