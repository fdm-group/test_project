<?php

// check cookie form acceptance post
add_action('init',function(){

	if(isset($_GET['accept_cookies'])) {
       // $lang = pll_current_language();

        if($_GET['accept_cookies']==1){
    		setcookie('acceptcookies', 1, (time()+(3600)*2), "/");
            $page = str_replace('?accept_cookies=1','',$_SERVER['REQUEST_URI']);
        }
        if($_GET['accept_cookies']==0){
            setcookie('acceptcookies', 0, (time()+(3600)*2), "/");
           $page = str_replace('?accept_cookies=0','',$_SERVER['REQUEST_URI']);
        }
    
        $url =  get_site_url().$page;
        wp_redirect($url,301);
        exit;
        
    }
});

add_filter('body_class', 'polylang_class');

function polylang_class($classes) {
    if(function_exists('pll_current_language') ) {
        $lang='';
        $location='';
        if (isset($_SERVER['HTTP_CF_IPCOUNTRY'])) {
            $location = $_SERVER['HTTP_CF_IPCOUNTRY'];
        }
        $lang = pll_current_language();
        if($lang=='de' || $location=='DE'){
            array_push($classes,'de');
        }else{
            array_push($classes,'en');
        }
        
    }
    return $classes;
}

add_action('after_body', function()
{

    // different IDs for policy page on live/staging
    $page_id = 9883;

    //local $staging = 9095;
    if ('STAGING') {
        $page_id = 9809;
    }
    $policy_id = get_translated_post_id($page_id);

  if (showcookiemessage()) {
    ?>

    <div class='cookies_overlay'>
        
            <div class="l-main-h i-cf">

                            <p><?php

                                echo __('We use cookies to ensure that we give you the best experience on our website. If you continue to use this site we will assume that you are happy with it.', 'fdm');
                                ?>
                              <span class="cookie_inputs">
                             
                                <a href="?accept_cookies=1" class="btn_cookie btn_cookie_ok" id="confirmcookies"><?php echo __('OK','fdm');?></a>
                                <a href="?accept_cookies=0" class="btn_cookie" id="denycookies"><?php echo __('No Thanks','fdm');?></a>
                                <?php
                                if(get_the_ID()!=$policy_id){ ?>
                                <a href="<?php echo get_permalink($policy_id);?>" class="btn_cookie" ><?php echo __('Learn more','fdm');?></a>
                                <?php } ?>
                            </span>
                            </p>

            </div>
        
    </div>
    <?php
   }
});


function showcookiemessage(){

   
    if (isset($_COOKIE["acceptcookies"])) {
        return false;
    }  else{
        return true;
    }
    
    
}

function checkallowedcookie(){

    // function to test if cookies are allowed

    $lang = '';
    $location='';
    if (isset($_SERVER['HTTP_CF_IPCOUNTRY'])) {
        $location = $_SERVER['HTTP_CF_IPCOUNTRY'];
    }
    if(function_exists('pll_current_language') ) {
     $lang = pll_current_language();
    }
    if (isset($_COOKIE["acceptcookies"]) && $_COOKIE["acceptcookies"]==1 ) {
        return true;
    }
    if (isset($_COOKIE["acceptcookies"]) && $_COOKIE["acceptcookies"]==0 ) {
        return false;
    }
    if($lang=='de' || $location=='DE'){
        return false;
    }else{
        return true;
    }
    
    
}


add_action( 'wp_head', function() {


    ?>
<!-- Global site tag (gtag.js) - AdWords: 1070642605 -->


<?
    if(checkallowedcookie()){
?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NR4946Z');</script>
<!-- End Google Tag Manager -->


<script type="text/javascript">


  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-1070642605');


  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '1650835965140444');
  fbq('track', 'PageView');



    fbq('track', 'ViewContent');

</script>
  
<?php
    }
} );


/**  facebook tracking pixel ***/

add_action('wp_footer', function() {

    // if acf set for tracking pixel and cookies are not optout by user, trigger tracking event
    if( get_field('include_facebook_tracking_pixel') ){
     ?>
     <script> 
    jQuery(function($){
        $( document ).ready(function() {
            if ((typeof $.cookie('acceptcookies') === 'undefined' && !$("body").hasClass("de")) || $.cookie('acceptcookies') == '1'){
             fbq('track', 'ViewContent');
             }
        });
    });
    </script>
     <?php
    }

},200);


add_action('after_body', function() {
  ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NR4946Z" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    
<?php
});

add_action('after_footer', function() {
  ?>
    <script type="text/javascript" id="hs-script-loader" async src="//js.hs-scripts.com/4411419.js"></script>
    
<?php
});
