<!doctype html>
<html class="no-js<?php if ( is_post_type_archive('portfolio') ) { echo " portfolio-archive"; } ?>" lang="en" >
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title><?php wp_title(' &mdash; ', true, 'right'); ?></title>
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/style.css">
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/js/prettify/prettify.css">
  <link rel="author" href="humans.txt">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
  <!--[if lt IE 9]>
  <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <?php if ( is_user_logged_in() ): ?>
  <style type="text/css">
    #wpadminbar * {
      -webkit-box-sizing: content-box;
      -moz-box-sizing: content-box;
      -o-box-sizing: content-box;
      box-sizing: content-box;
    }
  </style>
<?php endif; ?>

  <!-- TypeKit embed code -->
  <script type="text/javascript" src="http://use.typekit.com/gax5vgl.js"></script>
  <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
  
  <!-- Google CSE -->
  <script src="http://www.google.com/jsapi" type="text/javascript"></script>
  <script type="text/javascript"> 
    google.load('search', '1');

    /**
     * Extracts the users query from the URL.
     */ 
    function getQuery() {
      var url = '' + window.location;
      var queryStart = url.indexOf('?') + 1;
      if (queryStart > 0) {
        var parts = url.substr(queryStart).split('&');
        for (var i = 0; i < parts.length; i++) {
          if (parts[i].length > 2 && parts[i].substr(0, 2) == 'q=') {
            return decodeURIComponent(
                parts[i].split('=')[1].replace(/\+/g, ' '));
          }
        }
      }
      return '';
    }

    function onLoad() {
      // Create a custom search control that uses a CSE restricted to
      // code.google.com
      var customSearchControl = new google.search.CustomSearchControl(
          '010175855548164516950:zxya1uapa3s');

      var drawOptions = new google.search.DrawOptions();
      drawOptions.setAutoComplete(true);

      // Draw the control in content div
      customSearchControl.draw('results', drawOptions);

      // Run a query
      customSearchControl.execute(getQuery());
    }

    google.setOnLoadCallback(onLoad);
  </script>
  
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrap">
  <header id="header">
    <?php if ( is_home() ): ?>
    <h1>Josh Betz</h1>
    <p>I’m a web designer and developer in Madison, WI. Currently a junior at the University of Wisconsin - Madison studying Computer Science, I like to think of myself as a generalist.</p>
    <?php else: ?>
      <h1><a href="http://joshbetz.com/">Josh Betz</a></h1>
    <?php endif; ?>
    <hr>
  </header>