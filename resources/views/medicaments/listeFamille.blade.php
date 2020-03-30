@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Nom Famille</th>
                            <th colspan="2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($familles as $fam)
                            
                            <tr>
                                <td>{{ $fam['nomFamille']}}</td>
                                <td>
                                    <form method="POST" action="{{ action('FamilleMedicamentController@update', $fam['id']) }}" >
                                        @csrf
                                        @method('PUT')
                                        <input id="nomFamille" type="text" class="form-control @error('nomFamille') is-invalid @enderror" name="nomFamille" required>
    
                                        @error('nomFamille')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Modifier') }}
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <div>
                                        <form method="POST" action="{{ action('FamilleMedicamentController@destroy', $fam->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                {{ __('Supprimer') }}
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="card card-body">
                        <h6>Ajouter une famille</h6>
                        <form method="POST" action="{{action('FamilleMedicamentController@store')}}">
                            @csrf

                            <div class="form-group row">
                                <label for="nomFamille" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                                <div class="col-md-6">
                                    <input id="nomFamille" type="text" class="form-control @error('nomFamille') is-invalid @enderror" name="nomFamille" required>

                                    @error('nomFamille')
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
@endsection
