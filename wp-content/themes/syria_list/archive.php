<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package syria_list
 */

get_header();
?>
<?php
if ( is_category() ):
//	var_dump( $GLOBALS['wp_query']->request);
	$category = get_queried_object();
	$icon     = get_term_meta( $category->term_id, 'icon_class', true );
endif;
?>
    <section class="bg-grey-lighter shadow">
        <div class="container mx-auto py-10">
            <div class="flex justify-around">
                <div class="w-full px-10 mx-4 md:mx-0 md:w-1/3 lg:w-1/5 md:px-2">
                    <div class="flex flex-col items-center py-6 border bg-white shadow hover:shadow-md">
                        <div class="mb-4 text-5xl text-blue">
							<?php if ( $icon ): ?>
								<?php echo $icon ?>
							<?php else: ?>
                                <i class="fas fa-image"></i>
							<?php endif ?>
                        </div>
                        <h2 class="text-black font-thin">
							<?php echo $category->name ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="my-6">
        <div class="container mx-auto">

            <div class="flex flex-wrap my-5 -mx-2">

				<?php while ( have_posts() ):
					the_post()
					?>
                    <div class="w-full md:w-1/2 lg:w-1/4 px-2 pb-3">
						<?php get_template_part( 'template-parts/content', 'busin' ) ?>
                    </div>
				<?php endwhile; ?>

            </div>

            <div class="flex justify-around navigation">
				<?php posts_nav_link( ' ' ) ?>
            </div>

        </div>
    </section>
<?php
get_footer();
