<div class="rounded overflow-hidden shadow-md hover:shadow-lg bg-white max-h-412">
    <a href="<?php the_permalink() ?>" class="no-underline text-grey-darker">

		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'featured-small', [ 'class' => 'w-full' ] );
		} else {
			?>
            <img src="<?php bloginfo( 'template_directory' ); ?>/images/default-image.png" alt="<?php the_title(); ?>"
                 class="w-full"/>
			<?php
		}
		?>
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2 truncate py-1"><?php the_title() ?></div>
            <div class="text-grey-darker text-base h-10 overflow-hidden">
				<?php the_excerpt() ?>
            </div>
        </div>
        <div class="px-6 py-4 flex items-center">
			<?php
			get_template_part( 'template-parts/content', 'categories' );
			?>
        </div>
    </a>
</div>