{{--
  Title: Staafdiagram
  Description: Blok met een staafdiagram
  Category: meetvallei
  Icon: chart-bar
  Keywords: meetvallei diagram gegevens staaf
  Align: full
  SupportsAlign: full
--}}

@php( $user = 'user_'.get_current_user_id() )

@component('components.block', ['block' => $block])
    @while( have_rows('voedingsstoffen', $user )) @php( the_row() )
        @php($count = count(get_sub_field('voedingsstoffenSelect', $user)))
        <div class="row justify-content-center">
            @for ($i = 0; $i < $count; $i++)
                <ul class="chart col-12 col-auto-md my-5     mx-md-5">
                    @php( $name = get_sub_field('voedingsstoffenSelect', $user)[$i] )
                    @php( $amount = $block[$name] )
                    @php( $goal = get_sub_field($name, $user) )
                    @php( $percent = round( $amount / $goal * 100 ) )
                    <li>
                    <span class="amount mb-5" style="height: {{ $percent }}%" title="{{ $name }}"><p class="mb-0">{{ $percent }}%</p><p>{{ $amount }} / {{ $goal }}</p></span>
                    </li>
                </ul>   
            @endfor 
        </div>
    @endwhile
@endcomponent