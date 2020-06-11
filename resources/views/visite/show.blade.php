@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                @php
                use App\User;
                $practicien = User::find($visite['utilisateurs_id']);
                $visiteur = User::find($visite['visiteurMedicaux_id']);
                @endphp
                <div class="card-body">
                    <h3 class="mt-2 mb-2">Visite N°{{$visite['id']}}</h3>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                Practicien : {{$practicien['nom'] . " " . $practicien['prenom']}}
                            </div>
                            <div class="col-md-6">
                                Visiteur : {{$visiteur['nom'] . " " . $visiteur['prenom']}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                Motif : <br>
                                {{$visite['motif']}}
                            </div>
                            <div class="col-md-4">
                                Bilan : <br>
                                {{$visite['bilan']}}
                            </div>
                            <div class="col-md-4">
                                Date : <br>
                                {{$visite['dateMission']}}
                            </div>
                        </div>
                    </div>

                    <div class="container">
                            <h4 class="mt-5">Médicaments présenté</h4>
                            <table class="table">
                                <thead>
                                    <th>Numéro Produit</th>
                                    <th>Nom Commercial</th>
                                    <th>Nombre d'échantillons offert</th>
                                    <th>Coût</th>
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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection