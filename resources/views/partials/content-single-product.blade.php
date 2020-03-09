<article @php post_class() @endphp>

@php
    $user = get_current_user_id();
    $id = get_the_ID();
    $amount = 1;
    $date = date("Ymd");
    $taxonomy = 'post_category';
    $terms = wp_get_post_terms( $id, $taxonomy );
@endphp
@if($_SERVER['REQUEST_METHOD'] == 'POST')
  @php
        global $wpdb;
        $amount = esc_sql( $_POST['amount'] );
        $query = "
            INSERT INTO foodlog (user, product, amount, date)
            VALUES ($user, $id, $amount, $date)
        ";
        $wpdb->query($query);
  @endphp
@endif
    <table class="solo my-3">
        <form action="{{ get_permalink( get_page_by_path( 'invoeren' ) ) }}" method="POST">
            <tr>
                <th>
                    <div class="row">
                        <div class="col">
                            <span class="fa fa-search form-control-feedback"></span>
                            <input type="text"  autocomplete="off" class="form" name="query" placeholder="Zoeken...">
                        </div>
                        <div class="col-auto px-4">
                            <button type="submit" class="btn btn-primary">Zoeken</button>
                        </div>    
                    </div>
                </th>
            </tr>
        </form>
    </table>
    <header>
      <h1 class="entry-title">{!! get_the_title() !!}</h1>
    </header>
    <div class="entry-content">
        <h4>{{ the_field('productgroepicon', 'category_'.$terms[0]->term_id) }} {{ $terms[0]->name }}</h4>
        <h5>Per 100 {{ get_field('meeteenheid') }}</h5>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Energie: {{ get_field('Energie') }}kJ</li>
            <li class="list-group-item">Vetten: {{ get_field('Vetten') }}g</li>
            <li class="list-group-item">Verzadigd vet: {{ get_field('Verzadigd-vet') }}g</li>
            <li class="list-group-item">Koolhydraten: {{ get_field('Koolhydraten') }}g</li>
            <li class="list-group-item">Suiker: {{ get_field('Suiker') }}g</li>
            <li class="list-group-item">Vezels: {{ get_field('Vezels') }}g</li>
            <li class="list-group-item">Eiwitten: {{ get_field('Eiwitten') }}g</li>
            <li class="list-group-item">Natrium: {{ get_field('Natrium') }}mg</li>
        </ul>
    </div>
    <footer>
        <form class="mt-4" action="" method="POST">
            <div class="row">
                <input type="number" class="form-control col-1" name="amount" min="1" value="{{ $amount }}">
                <button type="submit" class="btn btn-primary col-auto">Toevoegen</button>
                @if($_SERVER['REQUEST_METHOD'] == 'POST')
                    <div class="btn alert-primary col-auto ml-2" role="alert">
                        {{ $amount }} keer {!! get_the_title() !!} toegevoegd!
                    </div>
                @endif 
            </div>
        </form>    
    </footer>
  </article>
  