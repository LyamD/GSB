@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>N° Médicament</th>
                                <th>Nom</th>
                                <th>Famille</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($medicaments as $med)
                            @php
                                $fam = $med->famille;
                            @endphp
                            <tr>
                            <td>{{$med['numeroProduit']}}</td>
                            <td>{{$med['nomCommercial']}}</td>
                            <td>{{$fam['nomFamille']}}</td>

                                <td>
                                    <a href="{{ action('MedicamentsController@show', $med['id'])}}" class="btn btn-primary">Afficher</a>
                                    <a href="{{ action('MedicamentsController@edit', $med['id'])}}" class="btn btn-primary">Modifier</a>
                                </td>
                                <td>
                                    <form method="POST" action="{{ action('MedicamentsController@destroy', $med['id']) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            {{ __('Supprimer') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
    
                            @endforeach
                        </tbody>
                    </table>

                    <div class="container">
                        <div class="row">
                        <a href="{{action('MedicamentsController@create')}}" class="btn btn-secondary">Ajouter un médicament</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection