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

@php( $user = 'user_'.get_current_user_id() )
@if( get_field('dietiste', $user) )
    <h3>Jouw diëtist(e)</h3>
    <p>{{ get_field('dietiste', $user)['user_firstname'] }} {{ get_field('dietiste', $user)['user_lastname'] }}</p>
@endif
@while( have_rows('voedingsstoffen', $user )) @php( the_row() )
  @if( get_sub_field('voedingsstoffenSelect', $user) )
    <h3>Doelen</h3>

    <form class="mb-5" action="" method="POST">
      @php($count = count(get_sub_field('voedingsstoffenSelect', $user)))
      @for ($i = 0; $i < $count; $i++)
        @php($name = get_sub_field('voedingsstoffenSelect', $user)[$i] )
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

@endsection
