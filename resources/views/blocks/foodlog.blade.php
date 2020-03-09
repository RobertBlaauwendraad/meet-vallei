{{--
  Title: Lijst met voedsel
  Description: Blok met een lijst van voedsel
  Category: meetvallei
  Icon: list-view
  Keywords: meetvallei lijst voedsel
  Align: full
  SupportsAlign: full
--}}

@php
    global $wpdb;
    $userid = get_current_user_id();
    $user="user_".$userid ;
    $date = date("Ymd");
    $Energie = 0;
    $Vetten = 0;
    $Verzadigd = "Verzadigd-vet";
    $$Verzadigd = 0;
    $Koolhydraten = 0;
    $Suiker = 0;
    $Vezels = 0;
    $Eiwitten = 0;
    $Natrium = 0;
@endphp
@if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteproduct']))
    @php
        $id = $_POST['deleteproduct'];
        $queryRemove = "
        DELETE FROM foodlog
        WHERE 1=1
        AND (foodlog.user LIKE '%{$userid}%')
        AND (foodlog.date='{$date}')
        AND (foodlog.id='{$id}')
        ";
        $wpdb->query($queryRemove);
    @endphp
@endif

@php
  $queryList = "
      SELECT * 
      FROM foodlog
      WHERE 1=1
      AND (foodlog.user LIKE '%{$userid}%')
      AND (foodlog.date='{$date}')
  ";
  $results = $wpdb->get_results( $queryList, ARRAY_A );
@endphp

@component('components.block', ['block' => $block])
<div class="row justify-content-center">
    <div class="col mt-3">
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
                                <button type="submit" name="deleteproduct" value="{{ $listid }}" class="btn btn-danger ml-3"><i class="fas fa-times"></i></button>
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
                    Je hebt vandaag nog niks toegevoegd!
                </li>
            </ul>
        @endif
    </div>
    <div class="col mt-3">
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
@endcomponent
