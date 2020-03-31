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

                                <td><a href="{{ action('MedicamentsController@show', $med['numeroProduit'])}}" class="btn btn-primary">afficher</a></td>
                                <td>
                                    <form method="POST" action="{{ action('MedicamentsController@destroy', $med['numeroProduit']) }}">
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

                </div>
            </div>
        </div>
    </div>
</div>
@endsection