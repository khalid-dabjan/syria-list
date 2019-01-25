<?php
$categories = array_reverse( get_the_category() );
?>
<?php foreach ( $categories as $index => $category ): ?>
    <a href="<?php echo get_category_link( $category ) ?>"
       class="text-grey-darker no-underline mr-1 hover:underline text-sm"><?php echo $category->name ?></a>
	<?php if ( $index != count( $categories ) - 1 ): ?>
        <span class="text-sm text-grey mr-1 fa <?php echo isLTR() ? 'fa-angle-left' : 'fa-angle-right'; ?>"></span>
	<?php endif; ?>
<?php endforeach; ?>