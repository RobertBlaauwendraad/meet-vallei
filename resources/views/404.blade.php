@extends('layouts.app')

@section('content')
  <section class="error404 pt-5 pb-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6 ml-auto mr-auto text-center">
          <h1>{!! App::title() !!}</h1>

          @if (!have_posts())
            @component('components.alert', ['type' => 'alert-warning'])
              {{  __('Helaas, er is niets gevonden.', 'meetvallei') }}
            @endcomponent
            {!! get_search_form(false) !!}
          @endif
        </div>
      </div>
    </div>
  </section>
@endsection
