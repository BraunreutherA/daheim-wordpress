<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <title><?php bloginfo('name'); ?> &raquo; <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <meta name="viewport" content="initial-scale=1, user-scalable=no">
    <?php if (is_singular() && get_option('thread_comments')) wp_enqueue_script('comment-reply'); ?>
    <?php wp_head(); ?>
  </head>
  <body>

    <div class="menu-popup-container">
      <div class="menu-popup-content">
        <div class="close"><img src="http://alexanderboenninger.de/Daheim/img/close.svg" alt="Schliessen" /></div>
        <div class="full-menu"><?php wp_nav_menu(array('theme_location' => 'full-menu', 'container' => false)); ?></div>
        <div class="full-menu-secondary"><?php wp_nav_menu(array('theme_location' => 'full-menu-secondary', 'container' => false)); ?></div>
      </div>
    </div>

    <div id="headerWrapper" <?php if (!is_front_page()) echo 'class="white"' ?>>
      <div id="header">
        <div id="logo">
          <a href="/"><img id="logo_2" src="http://alexanderboenninger.de/Daheim/img/daheim-logo_2.svg" alt="Logo" />
          <img id="logo_1" src="http://alexanderboenninger.de/Daheim/img/daheim-logo_1.svg" alt="Logo" /></a>
        </div>
        <div class="top">

          <ul id="header-menu" class="header-menu">

            <div class="small-top-menu">
              <?php wp_nav_menu(array(
                'theme_location' => 'header-menu',
                'container' => false,
                'depth' => 1,
                'items_wrap' => '%3$s'
              )); ?>
            </div>

            <li id="menu-item-menu-opener" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-menu-opener main-menu-opener">
              <a href="#">Menü</a>
            </li>
          </ul>

          <ul id="login-menu" class="login-menu">
            <li><a href="https://app.willkommen-daheim.org/auth">Anmelden</a></li>
            <li><a href="https://app.willkommen-daheim.org/auth/register">Registrieren</a></li>
            <li><a href="/donate/">Spende</a></li>
          </ul>

        </div>
      </div>
    </div>

    <?php if (!is_front_page()) { ?>
    <div style="padding-bottom: 140px"></div>
    <?php } ?>
