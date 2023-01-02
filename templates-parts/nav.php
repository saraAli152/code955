 <nav class="navbar navbar-expand-md navbar-light  py-5 ">
            <div class="container  ">

             <?php if ( function_exists( 'the_custom_logo' ) ) {
	the_custom_logo();
         };?>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
             
              <div class="collapse navbar-collapse " id="navbarScroll">
    
              <?php       
              wp_nav_menu( array(
                'theme_location'  => 'header-menu',
                'container' => '',
                'menu_class' => '',
                'fallback_cb' => '__return_false',
                'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
                'depth' => 2,
                'walker' => new wp_dropdown_menu()
              ) );
              ?>
              </div>
            </div>
          </nav>
     













































































