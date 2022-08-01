<?php $loop = new WP_Query( array( 'post_type' => 'games', 'posts_per_page' => 10 ) ); ?>

<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

	<?php the_title( '## <a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a>' ); ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>
<?php endwhile; ?>