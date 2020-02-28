@extends('layouts.app')

@section('content')
{{-- <div class="col-xl-auto ml-auto d-none d-xl-flex align-items-center">
    <form id="search" class="search-form" role="search" method="get" action="{{ home_url( '/' ) }}">
        <div class="input-group">
            <input id="autocomplete" class="search-field form-control" type="search"
                placeholder="{{ __( 'Zoeken...', 'meetvallei' ) }}"
                value="{{ get_search_query() }}" name="s" aria-label="Zoeken"
                title="{{ __( 'Zoeken naar:', 'meetvallei' ) }}"
                data-no-result="{{ __( 'Geen resultaten gevonden...', 'meetvallei' ) }}" />
            <button type="submit" class="btn btn-primary" aria-label="Zoeken">{{ __('Zoeken', 'meetvallei') }}</button>
        </div>
        <div class="foil">
            <div class="results"></div>
        </div>
    </form>
</div> --}}
    <table>
        <tr>
            <th>
                <span class="fa fa-search form-control-feedback"></span>
                <input type="text"  autocomplete="off" class="form" placeholder="Zoeken...">
            </th>
        </tr>
        <tr>
            <td class="first-td">
                <p><i class="fas fa-seedling"></i>Tomaat2</p>
            </td>
        </tr>
        <tr>
            <td>
                <p><i class="fas fa-seedling"></i>Tomaat2</p>
            </td>
        </tr>
        <tr><div class="result"></div></tr>
    </table>
@endsection
