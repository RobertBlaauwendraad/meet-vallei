{{--
  Title: Cirkeldiagram
  Description: Blok met een cirkeldiagram
  Category: meetvallei
  Icon: marker
  Keywords: meetvallei diagram gegevens cirkel
  Align: full
  SupportsAlign: full
--}}

@php $user = 'user_'.get_current_user_id() @endphp

@component('components.block', ['block' => $block])
    @while( have_rows('voedingsstoffen', $user )) @php( the_row() )
        @php($count = count(get_sub_field('voedingsstoffenSelect', $user)))
        <div class="row">
            @for ($i = 0; $i < $count; $i++)
                @php( $name = get_sub_field('voedingsstoffenSelect', $user)[$i] )
                @php( $amount = $block[$name] )
                @php( $goal = get_sub_field($name, $user) )
                @php( $percent = round( $amount / $goal * 100 ) )
                <div class="col">
                    <div style="position:relative">
                        <div class="c100 big p{{ $percent }}">
                            <span class="font-family-Avenir font-size-super">{{ $percent }}%</span>
                            <div class="slice">
                                <div class="bar"></div>
                                <div class="fill"></div>
                            </div>
                        <p class="complete-text font-family-primary font-weight-regular"></p>
                        </div>
                    </div>
                    <p class="mt-2 mb-0 text-center">{{$amount}} / {{$goal}}</p>
                    <p class="text-center">{{ $name }}</p>
                </div>
            @endfor
        </div>
    @endwhile
@endcomponent