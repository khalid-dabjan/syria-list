<?php

/*
Template Name: Categories
 */

get_header();

$categories = get_categories( [
	'meta_key'   => 'show_in_index',
	'meta_value' => true,
	'hide_empty' => false
] );

$featuredID  = get_post_meta( get_the_ID(), 'featured_category', true );
$featuredCat = array_filter( $categories, function ( $cat ) use ( $featuredID ) {
	return $cat->term_id == $featuredID;
} );

//var_dump( $featuredCat );

?>
    <section class="bg-grey-lighter py-16">
        <div class="container mx-auto">
            <div class="flex -mx-2 flex-wrap">
				<?php
				if ( isset( $featuredCat[0] ) ):
					$featuredCat = $featuredCat[0];
					#TODO: cache this.
					$icon = get_term_meta( $featuredCat->term_id, 'icon_class', true );
					?>
                    <div class="w-full">
                        <div class="w-full px-10 md:w-2/5 mb-12 md:px-2 mx-auto">
                            <a href="<?php echo get_category_link( $featuredCat ) ?>" class="no-underline">
                                <div class="flex flex-col items-center py-6 border bg-white shadow hover:shadow-md">
                                    <div class="mb-4 text-5xl text-blue">
										<?php if ( $icon ): ?>
											<?php echo $icon ?>
										<?php else: ?>
                                            <i class="fas fa-image"></i>
										<?php endif ?>
                                    </div>
                                    <h2 class="text-black font-thin">
										<?php echo $featuredCat->name ?>
                                    </h2>
                                </div>
                            </a>
                        </div>
                    </div>
				<?php endif; ?>
				<?php foreach ( $categories as $category ): ?>
					<?php
					if ( $category->term_id == $featuredID ) {
						continue;
					}
					$icon = get_term_meta( $category->term_id, 'icon_class', true );
					?>
                    <div class="w-full px-10 mx-4 md:mx-0 md:w-1/3 lg:w-1/5 md:px-2 mb-12">
                        <a href="<?php echo get_category_link( $category ) ?>" class="no-underline">
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
                        </a>
                    </div>
				<?php endforeach; ?>

            </div>
        </div>
    </section>
<?php
get_sidebar();
get_footer();
