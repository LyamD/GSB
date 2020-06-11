@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                @php
                    use App\User;
                @endphp
                <div class="card-body">
                    <h4 class="mt-2 mb-2">Liste des visites</h4>
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="colgroup">ID</th>
                                <th scope="col">Visiteur</th>
                                <th scope="col">Practicien</th>
                                <th scope="col">Date</th>
                                <th scope="col">Motif</th>
                                <th scope="col">Bilan</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($visites as $vis)
                            @php
                            $practicien = User::find($vis['utilisateurs_id']);
                            $visiteur = User::find($vis['visiteurMedicaux_id']);
                            @endphp
                            <tr>
                                <th scope="row">{{$vis['id']}}</th>
                                <td>{{$visiteur['nom'] . " " . $visiteur['prenom']}}</td>
                                <td>{{$practicien['nom'] . " " . $practicien['prenom']}}</td>
                                <td>{{$vis['dateMission']}}</td>
                                <td>{{$vis['motif']}}</td>
                                <td>{{$vis['bilan']}}</td>
                                <td>
                                    <a href="{{  action('VisiteController@show', $vis['id']) }}" class="btn btn-primary">
                                        Afficher
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="container">
                        <div class="row">
                            <a href="{{  action('VisiteController@create') }}" class="btn btn-dark">
                                Créer une visite
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection