<!-- get images inline (DEPRECATED) -->
<img src="http://www.placecage.com/500/500" alt="">
<img src="{{ App\asset_path('images/logo.png') }}" alt="">
<img src="@sub('sub_image', 'sizes', 'large')" alt="">
<img src="@field('content_image', 'sizes', 'large')" alt="@field('content_image', 'name')">

<!-- Get image sizes the WP way -->
{!! wp_get_attachment_image( $imageID, 'large' ) !!}
{!! get_the_post_thumbnail( get_the_ID(), 'large' ) !!}
<!-- directive way: https://log1x.github.io/sage-directives-docs/usage/wordpress.html#image -->
@image($imageID, 'large')
@thumbnail($imageID, 'large')

<!-- include template part -->
@include('components.banner')
@banner()@endbanner

<!-- ACF fields, rather use a directive for this -->
{{ get_field('my_field', 'option') ?: '' }}
{{ get_field('my_field') ?: '' }}
{{ get_field('my_field') ?? get_field('my_field2') ?? get_field('my_field3') : '' }}
{!! get_field('my_title') ? '<h1>'.get_field('my_title').'</h1>' : '' !!}

<!-- get acf field: https://log1x.github.io/sage-directives-docs/usage/acf.html#field -->
@field('text')
@option('brand_name')

<!-- sub fields for repeater: https://log1x.github.io/sage-directives-docs/usage/acf.html#sub -->
@sub('item')
@sub('image', 'url')

@hasfield('title')
  <h2>@field('title')</h2>
@endfield

<!-- acf loop: https://log1x.github.io/sage-directives-docs/usage/acf.html#fields -->
@hasfield('list')
  <ul>
    @fields('list')
      <li>@sub('item')</li>
    @endfields
  </ul>
@endfield

@hasoption('logo')
  <h2>@option('brand_name')</h2>
@endoption

<!-- Translatable strings + textdomain -->
{!! __('Klanten', 'meetvallei') !!}

@php
$args = array(
	'post_type'      => 'post',
	'order'          => 'ASC',
  'orderby'        => 'date',
  'post__in'       => array(),
  'post_not_in'    => array(),
  'post_parent'    => 1,
  'posts_per_page' => 3,
  'no_found_rows'  => true
);
$loop = new WP_Query( $args );
@endphp
@if($loop->have_posts())
  @while ( $loop->have_posts() ) @php($loop->the_post())

  @endwhile
@endif @php(wp_reset_query()) @php(wp_reset_postdata())

<!-- Query the directive way -->
@query([
  'post_type'       => 'post',
  'posts_per_page'  => 3,
])
@hasposts
  <ul>
    @posts
      <li>@title</li>
    @endposts
  </ul>
@endhasposts

<!-- get permalink of loop post -->
<a href="@permalink">
{{ get_permalink( get_page_by_path( 'contact' ) ) }}
{{ get_post_type_archive_link('service') }}

<!-- get acf or thumbnail as background image (DEPRECATED) -->
<section class="services"{!! (get_field('service_bg')['sizes']['meetvallei_large'] ? ' style="background-image: url('.get_field('service_bg')['sizes']['meetvallei_large'].')"' : '') !!}>
<section class="services"{!! (has_post_thumbnail(get_the_ID()) ? ' style="background-image: url('.get_the_post_thumbnail_url(get_the_ID(), 'medium').')"' : '') !!}>

@php($url = get_the_permalink())
<ul class="list-inline social-media-buttons">
	<li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
	<li><a target="_blank" href="https://twitter.com/home?status={{ $url }}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
	<li><a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url={{ $url }}"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
	<li><a href="mailto:?subject={{ bloginfo('name') }}&amp;body={{ $url }}"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
</ul>
