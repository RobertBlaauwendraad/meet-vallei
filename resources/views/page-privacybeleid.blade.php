@extends('layouts.app')

@section('content')
    <div class="privacy-content mt-3">
    @while(have_posts()) @php the_post() @endphp
        @include('partials.content-page')
    @endwhile
    </div>
  <img src="{{ home_url('/wp-content/uploads/2020/03/Group-21.png') }}" alt="Cookiemonster" class="cookiemonster">
@endsection