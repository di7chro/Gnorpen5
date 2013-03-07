<?php while ( have_posts() ) : the_post(); ?>
<div class="inlagg">
	<div class="inlagg_bild">
		<?php if (function_exists('userphoto_the_author_thumbnail')) {  userphoto_the_author_thumbnail();}?>	
	</div> <!-- END INLAGG_BILD -->
	<div class="inlagg_rubrik">
		<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	</div> <!-- END INLAGG_RUBRIK -->
	<div class="inlagg_meta">
		<?php echo gnorpen_human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' sedan'; echo " av "; the_author_posts_link();?>
		</div> <!-- END INLAGG_META -->
	<div class="inlagg_texten">	
		<?php the_content( __( 'Continue reading &rarr;', 'twentyten' ) ); ?>
	</div> <!-- END INLAGG_TEXTEN -->
</div> <!-- END INLAGG -->
<div class="kommentarer">
		<?php comments_template(); ?>	
</div> <!-- END KOMMENTARER -->
<?php endwhile; ?>
