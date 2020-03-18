@extends('layouts.app')

@php
    global $wpdb;
    $user = get_user_by( 'slug', get_query_var( 'author_name' ) ); 
    $date = date("Ymd"); 
    $userid = $user->ID;
    $field = get_field_object('eetstoornis');
    $value = get_field('eetstoornis');
    $label = $field['choices'][ $value ];
    $block["Energie"] = 0;
    $block["Vetten"] = 0;
    $block["Verzadigd-vet"] = 0;
    $block["Koolhydraten"] = 0;
    $block["Suiker"] = 0;
    $block["Vezels"] = 0;
    $block["Eiwitten"] = 0;
    $block["Natrium"] = 0;
    $Energie = 0;
    $Vetten = 0;
    $Verzadigd = "Verzadigd-vet";
    $$Verzadigd = 0;
    $Koolhydraten = 0;
    $Suiker = 0;
    $Vezels = 0;
    $Eiwitten = 0;
    $Natrium = 0;
    $queryList = "
      SELECT * 
      FROM foodlog
      WHERE 1=1
      AND (foodlog.user LIKE '%{$userid}%')
      AND (foodlog.date='{$date}')
  ";
  $results = $wpdb->get_results( $queryList, ARRAY_A );

  foreach( $results as $result ) {
    $productid = $result["product"];
    $productcount = $result["amount"];

    while( have_rows('voedingsstoffen', $user ) ) : the_row();
      $count = count(get_sub_field('voedingsstoffenSelect', $user));
      for($i = 0; $i < $count; $i++){
        $name = get_sub_field('voedingsstoffenSelect', $user)[$i];
        $block[$name] = $block[$name] + $productcount * get_field($name, $productid);
      }
    endwhile;
  }; 
@endphp
@if ( current_user_can('patient') )
    @php
        wp_redirect(home_url());
    @endphp
@endif

@section('content')
    <h3 class="mt-3">{{$user->display_name}}</h3>
    {{ $label }}
<div class="row justify-content-center">
    <div class="col-md col-12 mt-3">
        @if ($results)
            <ul class="list-group">
                <h3>Vandaag</h3>
                @foreach ( $results as $result )
                    @php
                        $listid = $result["id"];
                        $productid = $result["product"];
                        $product = get_the_title($productid);
                        $productcount = $result["amount"];
                    @endphp
                    <form class="" action="" method="POST">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $productcount }}x {{ $product }}
                            </li>
                    </form>
                    @while( have_rows('voedingsstoffen', $user )) @php the_row() @endphp
                        @php $count = count(get_sub_field('voedingsstoffenSelect', $user)) @endphp
                        @for ($i = 0; $i < $count; $i++)
                            @php $name = get_sub_field('voedingsstoffenSelect', $user)[$i] @endphp
                            @php
                                $$name = $$name + $productcount * get_field($name, $productid);
                            @endphp
                        @endfor
                    @endwhile
                    
                @endforeach
            </ul>
            @else
            <ul class="list-group">
                <h3>Vandaag</h3>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Er is vandaag nog niks toegevoegd!
                </li>
            </ul>
        @endif
    </div>
    <div class="col-md col-12 mt-3">
        @while( have_rows('voedingsstoffen', $user )) @php( the_row() )
            @php($count = count(get_sub_field('voedingsstoffenSelect', $user)))
            <ul class="list-group"> 
                <h3>Totaal</h3>
                @for ($i = 0; $i < $count; $i++)
                    @php( $name = get_sub_field('voedingsstoffenSelect', $user)[$i] )
                    @php( $amount = $block[$name] )
                    @php( $goal = get_sub_field($name, $user) )
                    @php( $percent = round( $amount / $goal * 100 ) )
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{$name}}
                        <span>{{ $amount }}</span>
                    </li>
                @endfor
            </ul> 
        @endwhile
    </div>
</div>
@endsection
