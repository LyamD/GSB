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
                            <th>Action</th>
                        </thead>

                        <tbody>
                            @foreach ($specialites as $spec)
                            <tr>
                                <td> {{$spec->nomSpecialite}} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-6">
                            <form method="POST" action="{{action('SpecialitesController@store')}}">
                            @csrf

                            <div class="form-group row">
                                <label for="nomSpecialite" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                                <div class="col-md-6">
                                    <input id="nomSpecialite" type="text" class="form-control @error('nomSpecialite') is-invalid @enderror" name="nomSpecialite" value="{{ old('nomSpecialite') }}" required autofocus>

                                    @error('nomSpecialite')
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
