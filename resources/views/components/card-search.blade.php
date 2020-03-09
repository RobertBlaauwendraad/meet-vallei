<article @php(post_class())>
  <header>
  <h2 class="entry-title"><a href="{{ the_permalink() }}">{{ the_title() }}</a></h2>
    @if (get_post_type() === 'post')
      <time class="updated" datetime="{{ get_post_time('c', true) }}">{{ get_the_date() }}</time>
    @endif
  </header>
  <div class="entry-summary">
    {!! the_excerpt() !!}
  </div>
</article>
<hr>
