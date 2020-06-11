@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                @php

                @endphp
                <div class="card-body">
                    <h4 class="mt-2 mb-2">Modifier la visite n°{{$visite['id']}} </h4>

                    <div class="container">
                        <form method="POST" action="{{ action('VisiteController@update', $visite['id']) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="motif">Motif</label>
                                        <textarea id="motif" class="form-control @error('motif') is-invalid @enderror"
                                            name="motif" rows="5" required>{{$visite['motif']}}</textarea>

                                        @error('motif')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bilan">Bilan</label>
                                        <textarea id="bilan" class="form-control @error('bilan') is-invalid @enderror"
                                            name="bilan" rows="5">{{$visite['bilan']}}</textarea>

                                        @error('bilan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="utilisateurs_id">Practicien</label>
                                        <select class="form-control" id="utilisateurs_id" name="utilisateurs_id">
                                            @foreach ($practiciens as $prac)
                                            <option value="{{$prac['id']}}" @if($prac['id']==$visite['utilisateurs_id'])
                                                selected @endif>
                                                {{$prac['nom'] . " " . $prac['prenom']}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="visiteurMedicaux_id">Visiteurs</label>
                                        <select class="form-control" id="visiteurMedicaux_id"
                                            name="visiteurMedicaux_id">
                                            @foreach ($visiteurs as $vis)
                                            <option value="{{$vis['id']}}"
                                                @if($vis['id']==$visite['visiteurMedicaux_id']) selected @endif>
                                                {{$vis['nom'] . " " . $vis['prenom']}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="form-group">
                                    <label for="dateMission">Date</label>
                                    <input type="date" id="dateMission" value="{{$visite['dateMission']}}"
                                        class="form-control @error('dateMission') is-invalid @enderror"
                                        name="dateMission" rows="5">

                                    @error('dateMission')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Valider') }}
                                </button>
                            </div>

                        </form>
                    </div>

                    <div class="container">
                        <h4 class="mt-5">Médicaments présenté</h4>
                        <table class="table">
                            <thead>
                                <th>Numéro Produit</th>
                                <th>Nom Commercial</th>
                                <th>Nombre d'échantillons offert</th>
                                <th>Coût</th>
                                <th>Supprimer</th>
                            </thead>
                            <tbody>
                                @foreach ($medicaments as $med)
                                @php
                                $nbOffert = $med->pivot->offert;
                                $cout = $med['prixEchantillon'] * $nbOffert;
                                @endphp
                                <tr>
                                    <td> {{$med['numeroProduit']}} </td>
                                    <td> {{$med['nomCommercial']}} </td>
                                    <td> {{$nbOffert}} </td>
                                    <td> {{$cout}}€ </td>
                                    <td>
                                        <form method="POST" action="{{ action('VisiteController@removeOffert') }}">
                                            @csrf
                                            <input type="hidden" value=" {{$visite['id']}} " name="visite_id">
                                            <input type="hidden" value=" {{$med['id']}} " name="medicament_id">
                                            <button type="submit" class="btn btn-danger">
                                                {{ __('Supprimer') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <form method="POST" action=" {{action('VisiteController@addOffert')}} ">
                                @csrf
                                <input type="hidden" value=" {{$visite['id']}} " name="visite_id">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="medicament_id">Médicaments présenté</label>
                                        <select class="form-control" id="medicament_id" name="medicament_id">
                                            @foreach ($allMedicaments as $med)
                                            <option value="{{$med['id']}}">
                                                {{$med['numeroProduit'] . " " . $med['nomCommercial']}}
                                            </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nbOffert">Nombre d'échantillons offert</label>
                                        <input id="nbOffert" value="0"
                                            class="form-control @error('nbOffert') is-invalid @enderror" name="nbOffert"
                                            required>

                                        @error('nbOffert')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Ajouter') }}
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection