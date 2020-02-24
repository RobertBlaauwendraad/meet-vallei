<header class="banner">
    <nav id="navbar" class="navbar navbar-expand-lg navbar-custom">
      <a class="navbar-brand" href="{{ home_url('/') }}"><img src="{{ home_url('/wp-content/uploads/2020/02/logoMV.png') }}" alt="Logo MeetVallei"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
        @if(has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(
          [
            'theme_location'    => 'primary_navigation',
            'depth'             => 2,
            'container'         => 'div',
            'container_class'   => 'collapse navbar-collapse flex-grow-1 text-center',
            'container_id'      => 'navbarNav',
            'menu_class'        => 'navbar-nav ml-auto flex-nowrap',
            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
            'walker'            => new WP_Bootstrap_Navwalker(),
            ]) !!}
        @endif
  </nav>
</header>
