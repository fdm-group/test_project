<?php get_header(); ?>

<div class="blog-page">

  <div class="row">

		<?php

		if( have_posts() ):

			while( have_posts() ): the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="feature-img"><?php if( has_post_thumbnail() ): ?></div>
            <h4>AMP Single page</h4>
						<div class="pull-right"><?php the_post_thumbnail('shop_single'); ?></div>
                <?php the_title('<h2 class="post-title">','</h2>' ); ?>

					<?php endif; ?>

					<div class="post-preview"><i class="far fa-clock"></i><?= get_the_date() ?> <i class="fas fa-user"></i>  <?= get_field('author') ?> <?php
            $categories = get_the_category(); $first_category = array_shift( $categories ); if ( $first_category ) { ?>
             <strong><span name="category"><i class="fas fa-folder-open"></i><?= $first_category->name; ?></span></strong>
           <?php } ?>
           <div class="social-media">
           </div>
         </div>
          <br />
            <br />
					<?php the_content(); ?>

					<hr>

				</article>

			<?php endwhile;

		endif;

		?>

</div>

</div>

<?php get_footer(); ?>
