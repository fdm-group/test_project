<footer class="fdm-footer">
<div class="container">
  <div class="row">
  <div class="col-md-3 col-sm-12" >
    <img src="<?php echo get_template_directory_uri()?>/images/fdm-logo-2018.png" alt="FDM Footer Logo" />
    <p><a href="#" class="sweep-to-right white" id="fdm_button">OTHER JOB VACANCIES</a></p>
    <p>&copy; FDM Group 2018</p>
  </div>
  <div class="col-md-6 col-sm-12" id="footer-menu">

      <div id="nav" class="footer-menu">
          <!-- Main Menu-->
          <?php
          /*wp_nav_menu( array('theme_location' => 'footer_navigation',
                                   'menu_class' => 'FDM_footer_menu') ); */

        wp_nav_menu( array('theme_location' => 'secondary',
                          'menu_class' => 'FDM_footer_menu') );

                                   ?>
      </div><!-- #nav-menu-container -->
  </div>

  <div class="col-md-3 col-sm-12 social" id="right">
    <ul class="icon-effect">
      <li class="link-fb"><a href="https://www.facebook.com/fdmgroup"  aria-label="facebook"><i class="fab fa-facebook-f" ></i><span class="label fb">Facebook</span></a></li>
      <li class="link-twitter"><a href="https://twitter.com/FDMGroup" aria-label="twitter"><i class="fab fa-twitter"></i><span class="label twitter">Twitter</span></a></li>
      <li class="link-in"><a href="https://www.linkedin.com/company/fdm-group"  aria-label="linkedin"><i class="fab fa-linkedin"></i><span class="label in">linkedin</span></a></li>
      <li class="link-yt"><a href="https://www.youtube.com/FDMGroupVideos"  aria-label="youtube"><i class="fab fa-youtube"></i><span class="label yt">Youtube</span></a></li>
      <li class="link-insta"><a href="https://www.instagram.com/fdm_group/"  aria-label="instagram"><i class="fab fa-instagram"></i><span class="label insta">Instagram</span></a></li>
    </ul>
  </div>
</div>

</div>
<script>
window.onscroll = function() {

  navScroll()};

function navScroll() {
  if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
    //var logo = document.getElementById("logo");
    document.getElementById("navigation").style.padding = "0 0px 5px 0px";
    document.getElementById("img").width = "80";
    document.getElementById("img").height = "50";
  } else {
    document.getElementById("navigation").style.padding = "0 10px 15px 10px";
    document.getElementById("img").width = "120";
    document.getElementById("img").height = "60";
  }
}

</script>
</footer>
<?php wp_footer(); ?>
</body>
 <?php do_action('after_footer'); ?>
</html>
