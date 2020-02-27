@extends('layouts.app')

@section('content')
    <div class="privacy-content">
    @while(have_posts()) @php the_post() @endphp
        @include('partials.content-page')
    @endwhile
    </div>
  <img src="{{ home_url('/wp-content/uploads/2020/02/Group-21.png') }}" alt="Cookiemonster" class="cookiemonster">
@endsection