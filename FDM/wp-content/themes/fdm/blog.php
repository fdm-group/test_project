<?php
/*

Template Name: blog Page

*/
get_header();
?>

<div>
<?php  $categories = get_categories(); ?>
<h2><center>Blog</center></h2>

<div id="datafetch">
  <label style="display: none;">Categories</label>
  <?php $categories = get_categories(); ?>
  <select id="categoryselect" name="category">
    <option value="" selected>All Categories</option>
    <?php foreach($categories as $cat):?>
      <option value="<?php echo $cat->cat_ID ?>"><?php echo $cat->name; ?></option>
    <?php endforeach;?>
  </select>

<label style="display: none;">Region</label>
<select name="region" id="region">
  <option value="" selected><?= __( 'All Regions', 'fdm' ) ?></option>
  <option value="North America"><?= __( 'North America', 'fdm' ) ?></option>
  <option value="Europe"><?= __( 'Europe', 'fdm' ) ?></option>
  <option value="APAC"><?= __( 'APAC', 'fdm' ) ?></option>
</select>
</div>
<br/>
<div class="entry-content">
  <div class="fdm-posts">
    <div class="row blog">
    <?php
    $paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
  //  echo $paged
  $args = array(
  'numberposts'	=> -1,
  'post_type'		=> 'post',
  'posts_per_page' => '3',
  'paged' => $paged,
);
    $q = new WP_Query( $args );


    if ( $q->have_posts() ) :
    ?>

    <?php while ( $q->have_posts() ) : $q->the_post(); ?>

      <div class='col-md-4'>
        <div class="fdm-post-teaser">
          <a class="fdm-post-teaser-inner" href="<?= get_permalink() ?>">
          <div class="teaser-text">
            <h3 name="post-title"><?= get_the_title() ?></h3>
            <span name="author"><i class="fas fa-user"></i> <?= get_field('author') ?></span>
            <time name="updated" datetime="<?= get_the_date( 'Y-m-d H:i:s' ) ?>"><i class="material-icons">access_time</i> <?= get_the_date() ?></time>
          </div>
          <?php $image1 = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blog-listing');
          ?>
            <div class="teaser-image" style="background: url(<?php echo $image1[0];?>);background-position:center;background-repeat:no-repeat;background-size:cover;">
            </div>
          </a>
        </div>
        </div>

    <?php endwhile; ?>

    </div>
  </div>
</div>
<div class="loadmore" name="load" >Load More</div>
<div id="load_data_message"></div>

<?php endif; ?>
</div>
<?php

get_footer(); ?>
