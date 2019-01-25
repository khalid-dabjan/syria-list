<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package syria_list
 */

get_header();

$blocks = get_terms( [
	'taxonomy' => 'block',
	'orderby'  => 'menu_order'
] );
?>
    <div class="bg-3 text-white">
        <div class="py-64 flex flex-col items-center">
            <h1 class="font-thin uppercase mb-4 text-sm sm:text-xl md:text-3xl">
				<?php _e( 'Find And Connect With Businesses Around Syria', 'syria_list' ) ?>
            </h1>

            <div class="w-3/4 md:w-1/3 relative">
                <form action="<?php echo get_home_url() ?>">
                    <input class="w-full py-3 px-4 rounded-full text-sm md:text-base" name="s"
                           placeholder="<?php _e( 'What are you looking for?', 'syria_list' ) ?>">
                    <button type="submit" class="absolute text-2xl pin-t pin-r pt-2 pr-4 focus:outline-none">
                        <i class="fas fa-search text-blue hover:text-blue-darker"></i>
                    </button>
                </form>
            </div>


        </div>
    </div>

<?php foreach ( $blocks as $index => $block ): ?>
	<?php
	$posts = get_posts( [
		'numberposts' => '6',
		'order'       => 'ASC',
		'post_status' => 'publish',
		'post_type'   => [ 'business', 'offers' ],
		'orderby'     => 'menu_order',
		'tax_query'   => [
			[
				'taxonomy' => $block->taxonomy,
				'field'    => 'slug',
				'terms'    => $block->slug,
			]
		]
	] );
//	var_dump( $posts );
	?>
    <section class="<?php echo $index % 2 == 0 ? 'bg-grey-lighter' : 'bg-white' ?> py-8 px-3 md:px-0">
        <div class="container mx-auto">
            <div class="flex justify-between items-baseline border-b-2 border-blue pb-2">
                <h2 class="font-normal text-2xl md:text-4xl">
					<?php echo $block->name ?>
                    <!--                <span class="align-middle ml-2"><i class="far fa-handshake"></i></span>-->
                </h2>
<!--                <a href="#" class="text-blue no-underline hover:text-blue-darker">See All</a>-->
            </div>

            <div class="flex flex-wrap my-5 -mx-2">
				<?php foreach ( $posts as $post ): ?>
					<?php setup_postdata( $post ); ?>
                    <div class="w-full md:w-1/2 lg:w-1/3 px-2 pb-3">
						<?php get_template_part( 'template-parts/content', 'busin' ) ?>
                    </div>
				<?php endforeach; ?>

            </div>


        </div>

    </section>
<?php endforeach; ?>

    <!--    <section class="bg-grey-lighter py-8 px-3 md:px-0">-->
    <!--        <div class="container mx-auto">-->
    <!--            <div class="flex justify-between items-baseline border-b-2 border-blue pb-2">-->
    <!--                <h2 class="font-normal text-2xl md:text-4xl">-->
    <!--                    Featured Partners-->
    <!--                                    <span class="align-middle ml-2"><i class="far fa-handshake"></i></span>-->
    <!--                </h2>-->
    <!--                <a href="#" class="text-blue no-underline hover:text-blue-darker">See All</a>-->
    <!--            </div>-->
    <!---->
    <!--            <div class="flex flex-wrap my-5 -mx-2">-->
    <!---->
    <!--                <div class="w-full md:w-1/2 lg:w-1/3 px-2 pb-3">-->
    <!--                    <div class="rounded overflow-hidden shadow-md hover:shadow-lg bg-white max-h-412">-->
    <!--                        <img class="w-full block"-->
    <!--                             src="images/bus1.jpg"-->
    <!--                             alt="Sunset in the mountains">-->
    <!--                        <div class="px-6 py-4">-->
    <!--                            <div class="font-bold text-xl mb-2 truncate">Abu Shaker Juice</div>-->
    <!--                            <p class="text-grey-darker text-base h-16 overflow-hidden">-->
    <!--                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla!-->
    <!--                                Maiores-->
    <!--                                et perferendis eaque, exercitationem praesentium nihil.-->
    <!--                                et perferendis eaque, exercitationem praesentium nihil.-->
    <!--                                et perferendis eaque, exercitationem praesentium nihil.-->
    <!--                            </p>-->
    <!--                        </div>-->
    <!--                        <div class="px-6 py-4 flex items-center">-->
    <!---->
    <!--                            <a href="#" class="text-grey-darker no-underline mr-1 hover:underline text-sm">Partners</a>-->
    <!--                            <span class="text-sm text-grey mr-1 fa fa-angle-right"></span>-->
    <!--                            <a href="#"-->
    <!--                               class="text-grey-darker no-underline mr-1 hover:underline text-sm">Restaurants</a>-->
    <!--                            <span class="text-sm text-grey mr-1 fa fa-angle-right"></span>-->
    <!--                            <a href="#"-->
    <!--                               class="text-grey-darker no-underline mr-1 hover:underline text-sm">Juice-Bar</a>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!---->
    <!--            </div>-->
    <!---->
    <!---->
    <!--        </div>-->
    <!---->
    <!--    </section>-->
<?php
get_footer();
