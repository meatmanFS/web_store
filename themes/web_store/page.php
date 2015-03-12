<?php get_header();?>
<div id="menu-container">
    <?php while(have_posts()): the_post(); ?>
				<div class="post-wrapper">
					<h2 class="title"><?php the_title(); ?></h2>
					<div class="post-content">
						<?php the_content(); ?>
					</div>
				</div>
    <?php endwhile; ?>
</div>
<?php get_footer();?>