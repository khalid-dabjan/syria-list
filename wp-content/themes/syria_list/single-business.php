<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package syria_list
 */

get_header();
?>
<?php
the_post();
$meta = get_post_meta( get_the_ID() );
//echo $meta['facebook'];
?>
    <style>
        .post-ratings-text {
            display: none !important;
        }
    </style>
    <section>
        <div class="container mx-auto">

            <div class="py-5 border-b">
                <div class="flex justify-around mb-6">
					<?php the_post_thumbnail( 'large' ) ?>
                </div>

                <div class="mb-6">
                    <div class="flex justify-between mb-3 pb-1 border-b">
                        <div class="flex items-center">
                            <h1 class="mr-4 text-3xl"><?php the_title() ?></h1>

							<?php if ( pluck_from_meta( $meta, 'is_partner' ) ): ?>
                                <i class="fa fa-handshake text-blue text-3xl" title="Partner"></i>
							<?php endif; ?>
                            <!--<div>-->
                            <!--<span class="border py-1 px-1 bg-grey-light text-sm text-blue">Partner</span>-->
                            <!--</div>-->
                        </div>
                        <div>
                            <div class="px-6 py-4">
								<?php get_template_part( 'template-parts/content', 'categories' ); ?>
                            </div>
                        </div>

                    </div>
                    <div class="text-grey-dark leading-normal">
						<?php the_content() ?>
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex justify-start">
						<?php if ( pluck_from_meta( $meta, 'website' ) ): ?>
                            <a href="<?php echo pluck_from_meta( $meta, 'website' ) ?>"
                               class="no-underline text-grey-darker text-lg hover:text-white hover:bg-blue mr-2"
                               target="_blank">
                                <div class="border p-2 shadow">
                                    <i class="fas fa-globe"></i>
                                </div>
                            </a>
						<?php endif ?>
						<?php if ( pluck_from_meta( $meta, 'facebook' ) ): ?>
                            <a href="<?php echo pluck_from_meta( $meta, 'facebook' ) ?>"
                               class="no-underline text-grey-darker text-lg hover:text-white hover:bg-blue mr-2"
                               target="_blank">
                                <div class="border p-2 shadow">
                                    <i class="fab fa-facebook"></i>
                                </div>
                            </a>
						<?php endif ?>

						<?php if ( pluck_from_meta( $meta, 'twitter' ) ): ?>
                            <a href="<?php echo pluck_from_meta( $meta, 'twitter' ) ?>"
                               class="no-underline text-grey-darker text-lg hover:text-white hover:bg-blue mr-2"
                               target="_blank">
                                <div class="border p-2 shadow">
                                    <i class="fab fa-twitter"></i>
                                </div>
                            </a>
						<?php endif ?>

						<?php if ( pluck_from_meta( $meta, 'google' ) ): ?>
                            <a href="<?php echo pluck_from_meta( $meta, 'google' ) ?>"
                               class="no-underline text-grey-darker text-lg hover:text-white hover:bg-blue mr-2"
                               target="_blank">
                                <div class="border p-2 shadow">
                                    <i class="fab fa-google"></i>
                                </div>
                            </a>
						<?php endif ?>

						<?php if ( pluck_from_meta( $meta, 'instagram' ) ): ?>
                            <a href="<?php echo pluck_from_meta( $meta, 'instagram' ) ?>"
                               class="no-underline text-grey-darker text-lg hover:text-white hover:bg-blue mr-2"
                               target="_blank">
                                <div class="border p-2 shadow">
                                    <i class="fab fa-instagram"></i>
                                </div>
                            </a>
						<?php endif ?>
						<?php //var_dump(pluck_from_meta( $meta, 'map_location' )) ?>
						<?php if ( pluck_from_meta( $meta, 'map_location' ) ): ?>
							<?php $map = get_post_meta( get_the_ID(), 'map_location', true ) ?>
                            <a href="#"
                               id="map-locator"
                               data-lat="<?php echo $map['lat'] ?>" data-lng="<?php echo $map['lng'] ?>"
                               class="no-underline text-grey-darker text-lg hover:text-white hover:bg-blue mr-2"
                               target="_blank">
                                <div class="border p-2 shadow">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                            </a>
						<?php endif ?>
                    </div>
                    <div class="flex">
						<?php the_ratings() ?>
                    </div>
                </div>
                <div class="hidden mt-3" id="map_container">
                    <div id="map" style="height: 400px;
        width: 100%;"></div>
                </div>
            </div>

            <div>
				<?php
				// If comments are open or we have at least one comment, load up the comment template.
				//				if ( comments_open() || get_comments_number() ) :
				//					comments_template();
				//				endif;
				?>
            </div>
			<?php
			$similarPlaces = getSimilarPlaces( $post );
			?>
            <div class="py-6">
                <h3>
					<?php _e( 'Similar Places', 'syria_list' ) ?>
                </h3>
                <div class="flex flex-wrap my-5 -mx-2">

					<?php foreach ( $similarPlaces as $post ): ?>
                        <div class="w-full md:w-1/2 lg:w-1/4 px-2 pb-3">
							<?php
							setup_postdata( $post );
							get_template_part( 'template-parts/content', 'busin' )
							?>

                        </div>
					<?php endforeach; ?>
                </div>
            </div>

        </div>
    </section>

<?php
get_sidebar();
get_footer();
