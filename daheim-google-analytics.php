<?php
/*
Plugin Name: Daheim Google Analytics Plugin
Plugin URI: http://daheimapp.de
Description: Add Google Analytics tracking code to Daheim
Author: Gergő Ertli 
Version: 1.0
*/

add_action('wp_footer', 'add_google_analytics');

function add_google_analytics() { ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-70818056-1', 'auto');
  ga('send', 'pageview');

</script>
<?php }
