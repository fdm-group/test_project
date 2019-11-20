<?php
 /* Template Name:  Blog load works */

get_header();

 ?>

<h2><center>Blog</center></h2>
<?php
?>
<div class="entry-content">
  <div class="my-posts">
    <div class="row blog">
    <?php
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => '3',
        'paged' => 1,
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

    <?php endif ?>
    </div>
  </div>
</div>
    <div class="loadmore">Load More...</div>

<script>
var ajax_url = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
var page = 2;
jQuery(function($) {
    $('body').on('click', '.loadmore', function() {
        var data = {
            'action': 'load_posts_by_ajax',
            'page': page,
            'security': '<?php echo wp_create_nonce("load_more_posts"); ?>'
        };

        $.post(ajax_url, data, function(response) {
            $('.my-posts').append(response);
            page++;
        });
    });
});

</script>
