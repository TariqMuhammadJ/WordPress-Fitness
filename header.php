<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php wp_title('|', true, 'right'); ?></title>
    
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?display=swap&family=Inter:wght@400;500;700;900&family=Noto+Sans:wght@400;500;700;900" onload="this.rel='stylesheet'" as="style" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    

