@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Liste des spécialités</div>

                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <th>Nom</th>
                            <th colspan="4">Action</th>
                        </thead>

                        <tbody>
                            @foreach ($specialites as $spec)
                            <tr>
                                <td> {{$spec->nomSpecialite}} </td>
                                <td colspan="3">
                                    <div>
                                        <form method="POST"
                                            action="{{ action('SpecialitesController@update', $spec->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <input id="nomSpecialite" type="text"
                                                class="form-control @error('nomSpecialite') is-invalid @enderror"
                                                name="nomSpecialite" value="{{ $spec['nomSpecialite'] }}" required
                                                autofocus>

                                            @error('nomSpecialite')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Modifier') }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <form method="POST" action="{{ action('SpecialitesController@destroy', $spec->id) }}">
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

                    

                    <div class="row mt-5">
                        
                        <div class="col-6">
                            <form method="POST" action="{{action('SpecialitesController@store')}}">
                                @csrf
                                <h4>Ajouter une spécialité</h4>
                                <div class="form-group row mt-4">
                                    <label for="nomSpecialite"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                                    <div class="col-md-6">
                                        <input id="nomSpecialite" type="text"
                                            class="form-control @error('nomSpecialite') is-invalid @enderror"
                                            name="nomSpecialite" value="{{ old('nomSpecialite') }}" required autofocus>

                                        @error('nomSpecialite')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Ajouter') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection