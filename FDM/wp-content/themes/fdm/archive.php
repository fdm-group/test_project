<?php get_header(); ?>
<!-- Template in use: archive.php -->

<div id="main" class="grey" role="main">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article <?php post_class() ?> id="post-<?php the_ID(); ?>">

            <h1 class="entry-title"><?php the_title(); ?></h1>

            <div class="entry-content">

                <?php the_content(); ?>

            </div>

        </article>

    <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
