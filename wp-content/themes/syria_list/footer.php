<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package syria_list
 */

?>
<footer class="hidden lg:block bg-blue py-16">
    <div class="container mx-auto">

        <div class="flex justify-between">

            <div class="w-2/5">
                <h3 class="text-white mb-3"><?php _e( 'Download the Syria List app', 'syria_list' ) ?></h3>
                <div class="mb-1">
                    <a href="#"><img src="<?php echo get_template_directory_uri() . '/images/Layer-1.png' ?>"
                                     alt="Apple Store icon"></a>
                </div>

                <div>
                    <a href="#"><img src="<?php echo get_template_directory_uri() . '/images/Layer-2.png' ?>"
                                     alt="Google Play Store icon"></a>
                </div>
            </div>

            <div class="w-1/5">
                <h3 class="text-white mb-3"><?php _e( 'Content', 'syria_list' ) ?></h3>
				<?php wp_nav_menu( array( 'theme_location' => 'content-footer-menu' ) ); ?>
            </div>

            <div class="w-1/5">
                <h3 class="text-white mb-3"><?php _e( 'About', 'syria_list' ) ?></h3>
				<?php wp_nav_menu( array( 'theme_location' => 'about-footer-menu' ) ); ?>
            </div>

            <div class="w-1/5">
                <h3 class="text-white mb-3"><?php _e( 'Follow us', 'syria_list' ) ?></h3>
                <div class="flex justify-between w-1/3">
                    <a href="#" class="text-white no-underline">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" class="text-white no-underline">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-white no-underline">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAWM6zS3GB5lkhbb27VIYZ3T80miumkdxE"
        async></script>


<?php wp_footer(); ?>

</body>
</html>
