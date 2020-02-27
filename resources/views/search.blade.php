@extends('layouts.app')

@section('content')
  <section class="search-page py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-8 mx-auto">
          <h1 class="pb-4">{!! App::title() !!}</h1>

          @if (!have_posts())
            @component('components.alert', ['type' => 'alert-warning'])
              {{  __('Helaas, er is niets gevonden.', 'meetvallei') }}
            @endcomponent
            {!! get_search_form(false) !!}
          @endif

          @posts
            @include('components.card-search')
          @endposts

        </div>
      </div>
    </div>
  </section>
@endsection
