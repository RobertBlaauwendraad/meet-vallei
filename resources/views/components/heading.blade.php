@php
  $heading = get_field('heading');
  $title = $heading['title'];
  $subtitle = $heading['subtitle'];
@endphp
@if($heading)
  <div class="{!! isset($class) ? $class : 'mb-2' !!}">
    @if($title)
      <h2{!! isset($class_title) ? ' class="' . $class_title . '"' : '' !!}>{{ $title }}</h2>
    @endif
    @if($subtitle)
      <span{!! isset($class_subtitle) ? ' class="' . $class_subtitle . '"' : '' !!}>{{ $subtitle }}</span>
    @endif
  </div>
@endif
