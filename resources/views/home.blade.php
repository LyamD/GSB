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
                    
                    @can('gerer_specialites')
                    <a href="{{  action('SpecialitesController@index') }}" class="btn btn-dark">
                        Liste des specialites
                    </a>
                    @endcan
                    
                    @can('gerer_visite')
                    <a href="{{  action('VisiteController@index') }}" class="btn btn-dark">
                        liste des visites
                    </a>
                    @endcan

                    @can('gerer_medicaments')
                    <a href="{{  action('MedicamentsController@index') }}" class="btn btn-dark">
                        Liste des medicaments
                    </a>
                    @endcan

                    @can('gerer_medicaments')
                    <a href="{{  action('FamilleMedicamentController@index') }}" class="btn btn-dark">
                        Liste des familles de médicaments
                    </a>
                    @endcan



                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
