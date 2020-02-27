@extends('layouts.app')

@section('content')

@php( $user = 'user_'.get_current_user_id() )
@while( have_rows('voedingsstoffen', $user )) @php( the_row() )
  @if( get_sub_field('voedingsstoffenSelect', $user) )
    <h3>Doelen</h3>
    <form class="mb-5" action="">
      @php($count = count(get_sub_field('voedingsstoffenSelect', $user)))
      @for ($i = 0; $i < $count; $i++)
        @php($name = get_sub_field('voedingsstoffenSelect', $user)[$i] )
        @if($name)
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text">{{ $name }}:</span>
            </div>
            <div class="col-auto">
              <input type="number" class="form-control" id="$field" min="0" value="{{ get_sub_field($name, $user) }}">
            </div>
          </div>
        @endif
      @endfor  
    <button type="submit" class="btn btn-primary">Bevestigen</button>
    </form>
  @endif
@endwhile

<form action="{{ wp_logout_url() }}">
    <button type="submit" class="btn btn-danger">{{ __('Uitloggen', 'meetvallei') }}</button>
</form>

@endsection
