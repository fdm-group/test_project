<!--blog starts here -->
<div>
  <h2><center>Blog</center></h2>
  <div id="datafetch">
    <?php $categories = get_categories(); ?>
   
    <select id="testselect" name="category" aria-label="Select Blog Category">
      <option value="" selected>All Categories</option>
      <?php foreach($categories as $cat):?>
        <option value="<?php echo $cat->cat_ID ?>"><?php echo $cat->name; ?></option>
      <?php endforeach;?>
    </select>

  
    <select name="region" id="region" aria-label="Select Blog region">
      <option value="" selected><?= __( 'All Regions', 'fdm' ) ?></option>
      <option value="North America"><?= __( 'North America', 'fdm' ) ?></option>
      <option value="Europe"><?= __( 'Europe', 'fdm' ) ?></option>
      <option value="APAC"><?= __( 'APAC', 'fdm' ) ?></option>
    </select>
  </div>

<div class="entry-content">
  <div class="fdm-posts">
    <div class="row blog">
    <?php
    $paged = (get_query_var('page') ) ? get_query_var('page') : 1;

    $args = array(
      'post_type'		=> 'post',
      'posts_per_page' => '3',
      'orderby' => 'publish_date',
    );
    $q = new WP_Query( $args );
    if ( $q->have_posts() ):
    ?>
    <?php while ( $q->have_posts() ) : $q->the_post(); ?>
      <div class='col-md-4'>
        <div class="fdm-post-teaser">
          <a class="fdm-post-teaser-inner" href="<?= get_permalink() ?>">
          <div class="teaser-text">
            <?php
            $categories = get_the_category(); $first_category = array_shift( $categories ); if ( $first_category ) { ?>
              <strong><span name="category"><?= $first_category->name ?> ____</span></strong>
            <?php }
            ?>
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
<?php endif;
wp_reset_query();
?>

</div>
  <div class="loadmore" name="load" >Load More</div>
</div>
