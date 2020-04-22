<?php
/**
 * The template for displaying Social Share Plugins
 *
 * @package jasmin
 */
?>

<span class="social-share clear">
    <?php printf( esc_html__( 'Share:', 'jasmin' ) ); ?>
    <!-- twitter -->
    <a href="https://twitter.com/share?text=<?php echo urlencode(get_the_title()); ?>&amp;url=<?php the_permalink(); ?>" onclick="window.open(this.href, 'twitter-share', 'width=550,height=235');return false;"><i class="fab fa-twitter"></i></a>
    <!-- facebook -->
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" onclick="window.open(this.href, 'facebook-share','width=580,height=296');return false;"><i class="fab fa-facebook"></i></a>
    <!-- linkedin -->
    <a href="https://www.linkedin.com/shareArticle?mini=true%26url=<?php the_permalink(); ?>%26source=<?php home_url(); ?>" onclick="window.open(this.href, 'linkedin-share', 'width=490,height=530');return false;"><i class="fab fa-linkedin"></i></a>
    <!-- pinterest -->
    <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());"><i class="fab fa-pinterest"></i></a>
</span>