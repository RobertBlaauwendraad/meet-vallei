@extends('layouts.app')

@php
        global $wpdb;
        $keyword = "";
        $query = "
            SELECT * 
            FROM wp_posts
            WHERE 1=1
            AND (wp_posts.post_title LIKE '%{$keyword}%')
            AND (wp_posts.post_type IN ('product'))
            AND NOT (wp_posts.post_title='Automatische concepten')
            ORDER BY wp_posts.post_title LIKE '%{$keyword}%' DESC
            LIMIT 20
        ";
        $suggestions = $wpdb->get_results( $query, ARRAY_A );
@endphp
@if($_SERVER['REQUEST_METHOD'] == 'POST')
  @php
        global $wpdb;
        $keyword = esc_sql( $_POST['query'] );
        $query = "
            SELECT * 
            FROM wp_posts
            WHERE 1=1
            AND (wp_posts.post_title LIKE '%{$keyword}%')
            AND wp_posts.post_type IN ('product')
            ORDER BY wp_posts.post_title LIKE '%{$keyword}%' DESC
            LIMIT 20
        ";
        $suggestions = $wpdb->get_results( $query, ARRAY_A );
  @endphp
@endif

@section('content')
    <table class="mt-3">
        <form action="" method="POST">
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
            @if ($suggestions)
                @foreach ( $suggestions as $suggestion )
                    @php
                        $productomschrijving = $suggestion['post_title'];
                        $producturl = site_url()."/producten/".$suggestion['post_name'];
                        $productid = $suggestion['ID'];
                        $taxonomy = 'post_category';
                        $terms = wp_get_post_terms( $productid, $taxonomy );
                    @endphp
                    <tr>
                        <td>
                        <a href="{{ $producturl }}">{{ the_field('productgroepicon', 'category_'.$terms[0]->term_id) }}{{ $productomschrijving }}</a>
                        </td>
                    </tr>
                @endforeach
                @else
                <tr>
                    <td>
                        <p><i class="fas fa-exclamation"></i>Geen resultaten</p>
                    </td>
                </tr>
            @endif
            {{-- <tr>
                <td class="first-td">
                <p><i class="fas fa-seedling"></i></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p><i class="fas fa-seedling"></i>Tomaat2</p>
                </td>
            </tr> --}}
        </form>
    </table>
@endsection
