@extends('layouts.app')

@if($_SERVER['REQUEST_METHOD'] == 'POST')
  @php
    if(!isset($profilerHandler)){
      $profileHandler = new App\Controllers\profileHandler();
    }
    $profileHandler->handleProfile();
  @endphp
@endif

@section('content')
  <div class="row justify-content-end">
    <div class="col-1">
      <button id="settings" type="button" class="btn"><i class="fas fa-user-cog"></i></button>
    </div>
  </div>
<div id="modal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    @php $user = 'user_'.get_current_user_id() @endphp
    @if( get_field('dietiste', $user) )
        <h3>Jouw diëtist(e)</h3>
        <p>{{ get_field('dietiste', $user)['user_firstname'] }} {{ get_field('dietiste', $user)['user_lastname'] }}</p>
    @endif
    @while( have_rows('voedingsstoffen', $user )) @php the_row() @endphp
      @if( get_sub_field('voedingsstoffenSelect', $user) )
        <h3>Doelen</h3>
    
        <form class="mb-4" action="" method="POST">
          @php $count = count(get_sub_field('voedingsstoffenSelect', $user)) @endphp
          @for ($i = 0; $i < $count; $i++)
            @php $name = get_sub_field('voedingsstoffenSelect', $user)[$i] @endphp
            @if($name)
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">{{ $name }}:</span>
                </div>
                <div class="col-auto">
                  <input type="number" class="form-control" name="{{ $name }}" min="0" value="{{ get_sub_field($name, $user) }}">
                </div>
              </div>
              <input type="hidden" name="names[]" value="{{ $name }}">
            @endif
          @endfor  
        <button type="submit" class="btn btn-primary">Bevestigen</button>
        </form>
      @endif
    @endwhile
      <form action="{{ site_url( 'wp-login.php?action=logout') }}">
        <button type="submit" class="btn btn-danger">{{ __('Uitloggen', 'meetvallei') }}</button>
    </form>
  </div>
</div>
  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-page')
  @endwhile
@endsection
