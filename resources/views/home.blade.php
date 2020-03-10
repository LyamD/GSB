@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>
                    
                    @php
                        $reg = Auth::user()->regions()->get();
                    @endphp
                

                    @can('acceder_region')
                        <a href="{{route('regions.liste')}}" class="btn btn-dark">Accéder au région</a>
                    @endcan

                    @can('changer_budget_region')
                        Changer le budget de mes régions
                    @endcan

                    @can('changer_budget_region_all')
                        Accéder au budget de toutes les régions
                    @endcan

                    @can('controler_region')
                        <a href="{{ action('RegionController@index') }}" class="btn btn-dark">
                            Editer les régions
                        </a>
                    @endcan

                    @can('gerer_utilisateurs')
                    <a href="{{ route('utilisateurs.liste') }}" class="btn btn-dark">
                        Gérer les utilisateurs
                    </a>
                    @endcan

                    @can('gerer_visiteurs')
                    <a href="{{  action('VisiteurMedicauxController@index') }}" class="btn btn-dark">
                        Gérer les visiteurs
                    </a>
                    @endcan

                    @can('gerer_visiteurs')
                    {{-- <a href="{{  action('VisiteurMedicauxController@') }}" class="btn btn-dark">
                        Gérer mes visites
                    </a> --}}
                    @endcan

                    @php
                        use App\VisiteurMedicaux;
                        $visiteur = VisiteurMedicaux::find(2);
                    @endphp

                    <form method="POST" action="{{ action('VisiteurMedicauxController@update', $visiteur['id']) }}">
                        @csrf
                        @method('PUT')
                        <input id="budget" type="number"
                            class="form-control @error('budget') is-invalid @enderror"
                            name="budget" value="{{ $visiteur['budget'] }}" required
                            autofocus>

                        @error('budget')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <button type="submit" class="btn btn-primary">
                            {{ __('Valider') }}
                        </button>
                    </form>


                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
