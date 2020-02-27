{{--
  Title: Contact
  Description: Blok waar je een contactformulier + contactgegevens kunt tonen
  Category: suiteseven
  Icon: phone
  Keywords: suiteseven contact form formulier gegevens
  Align: full
  SupportsAlign: full
--}}

@component('components.block', ['block' => $block])
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-7 col-lg-6">
        @include('components.heading')
        @if(get_field('form_shortcode'))
          <div class="mt-1 mt-md-2 mt-lg-3">
            {!! get_field('form_shortcode') !!}
          </div>
        @endif
      </div>
      <div class="col-12 col-md-5 col-xl-4 mx-auto">
        @if(get_field('address', 'option') || get_field('telephone', 'option') || get_field('email', 'option') || have_rows('opening_hours', 'option'))
          <h3 class="text-primary">Contactgegevens</h3>
        @endif
        <div class="d-flex flex-column contact__sidebar">
          @if(get_field('address', 'option'))
            {!! get_field('address', 'option') !!}
          @endif
          @if(get_field('telephone', 'option'))
            <a href="tel:{{ preg_replace('/[^0-9,]/', '', get_field('telephone', 'option')) }}" class="text-text-color"><span class="text-primary">T</span> {{ get_field('telephone', 'option') }}</a>
          @endif
          @if(get_field('email', 'option'))
            <a href="mailto:{{ get_field('email', 'option') }}" class="text-text-color"><span class="text-primary">E</span> {{ get_field('email', 'option') }}</a>
          @endif
        </div>
        @if(have_rows('opening_hours', 'option'))
          <h6 class="mt-2 mt-lg-3">Openingstijden</h6>
          <div class="row">
            <div class="col-auto font-weight-bold text-primary d-flex flex-column">
              @while(have_rows('opening_hours', 'option')) @php(the_row())
                <span>
                  @if(get_sub_field('day'))
                    {{ get_sub_field('day') }}
                  @else
                    &nbsp;
                  @endif
                </span>
              @endwhile
            </div>
            <div class="col-auto d-flex flex-column">
              @while(have_rows('opening_hours', 'option')) @php(the_row())
                <span>
                  @if(get_sub_field('time'))
                    {{ get_sub_field('time') }}
                  @else
                    &nbsp;
                  @endif
                </span>
              @endwhile
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
@endcomponent
