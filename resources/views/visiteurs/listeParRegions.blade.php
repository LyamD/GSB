@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Régions dont je suis responsable</div>
                @php
                use App\Passage;
                use App\User;
                use App\VisiteurMedicaux;
                @endphp

                @foreach ($regions as $region)

                @php
                $passages = Passage::where('regions_id', $region->id)->orderBy('utilisateurs_id')->get();
                @endphp

                <div class="card">
                    <div class="card-header">
                        <h4>Région : {{$region['nomRegion']}}</h4>
                        <p>Budget global annuel attribué à cette région : {{$region['budgetGlobalAnnuel']}} €</p>
                    </div>

                    @php

                    @endphp

                    <div class="card-body">
                        <h6>Employés actuellement dans cette région</h6>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th></th>
                                    <th>Nom - Prénom</th>
                                    <th>Matricule</th>
                                    <th>Objectif</th>
                                    <th>Prime</th>
                                    <th>Avantages</th>
                                    <th>Budget alloué</th>
                                    <th>Attribué depuis</th>
                                </tr>
                            </thead>

                            @foreach ($passages as $passage)
                            @if ($passage->dateFin == null)
                            @php
                            $employe = User::find($passage->utilisateurs_id);
                            $visiteur = VisiteurMedicaux::find($employe->id);
                            @endphp
                            <tr>
                                <th>Employé </th>
                                <td>{{$employe['nom']}} - {{$employe['prenom']}}</td>
                                <td>{{$employe['matricule']}}</td>
                                <td>{{$visiteur['objectif']}}</td>
                                <td>{{$visiteur['prime']}}</td>
                                <td>{{$visiteur['avantages']}}</td>
                                <td>{{$visiteur['budget']}}</td>
                                <td>{{$passage['dateDebut']}}</td>
                            </tr>

                            <tr>
                                <th>Modifier le budget</th>
                                <td colspan="3">
                                    <form method="POST" action="{{ action('VisiteurMedicauxController@update', $employe->id) }}">
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
                                </td>
                                <th>Modifier les autres attributs</th>
                                <td colspan="3">
                                <a href="{{ action('VisiteurMedicauxController@edit', $employe->id)}}" class="btn btn-primary">Modifier</a>
                                </td>
                            </tr>


                            @endif
                            @endforeach
                        </table>

                    </div>

                </div>
                @endforeach


            </div>
        </div>
    </div>
</div>
@endsection