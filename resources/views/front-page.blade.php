@extends('layouts.app')

@if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['profile']))
  @php
    if(!isset($profileHandler)){
      $profileHandler = new App\Controllers\profileHandler();
    }
    $profileHandler->handleProfile();
  @endphp
@endif

@section('content')
  <div class="row justify-content-end mt-3">
    <div class="col-auto">
      <button id="settings" type="button" class="btn">
        <svg class="bi bi-pencil" width="36" height="36" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M13.293 3.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391l9-9zM14 4l2 2-9 9-3 1 1-3 9-9z" clip-rule="evenodd"></path>
          <path fill-rule="evenodd" d="M14.146 8.354l-2.5-2.5.708-.708 2.5 2.5-.708.708zM5 12v.5a.5.5 0 00.5.5H6v.5a.5.5 0 00.5.5H7v.5a.5.5 0 00.5.5H8v-1.5a.5.5 0 00-.5-.5H7v-.5a.5.5 0 00-.5-.5H5z" clip-rule="evenodd"></path>
        </svg>
      </button>
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
        <button type="submit" name="profile" class="btn btn-primary">Bevestigen</button>
        </form>
      @endif
    @endwhile
      <form action="{{ site_url( 'wp-login.php?action=logout') }}">
        <button type="submit" class="btn btn-danger mb-5">{{ __('Uitloggen', 'meetvallei') }}</button>
    </form>
  </div>
</div>
  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-page')
  @endwhile
@endsection
