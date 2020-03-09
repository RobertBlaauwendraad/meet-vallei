@global($wp_query)

<div class="pagination">
  {!!
    paginate_links( array(
      'current' => max( 1, get_query_var('paged') ),
      'prev_text' => '&laquo;',
      'next_text' => '&raquo;',
      'type' => 'list',
      'total' => $wp_query->max_num_pages
    ));
  !!}
</div>
