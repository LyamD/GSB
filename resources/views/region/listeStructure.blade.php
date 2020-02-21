@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Nom Région</th>
                            <th>Budget golbal annuel</th>
                            <th>Responsable région actuel</th>
                            <th colspan="2">Action</th>
                        </tr>
                        @foreach ($regions as $i)
                        @php
                            $rep = $i->responsable()->get();
                        @endphp
                        <tr>
                            <td>{{ $i['nomRegion']}}</td>
                            <td>{{ $i['budgetGlobalAnnuel']}}</td>
                            <td>{{ empty($rep[0]['nom']) ? 'Non défini' : $rep[0]['nom'] }}</td>
                            <td>
                                <form method="POST" action="{{ action('RegionController@update', $i['id']) }}" >
                                    @csrf
                                    @method('PUT')
                                    <input id="nomRegion" type="text" class="form-control @error('nomRegion') is-invalid @enderror" name="nomRegion" value="{{ old('nomRegion') }}" required autofocus>

                                    @error('nomRegion')
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
                                <form method="POST" action="{{ action('RegionController@update', $i['id']) }}" >
                                    @csrf
                                    @method('PUT')
                                    @php
                                        $users = App\User::role("respRegion")->get();
                                    @endphp
                                    <select name="utilisateurs_id" class="form-control">
                                        @foreach ($users as $user)
                                            <option value="{{$user['id']}}">{{$user['nom']}}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Modifier') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>

                    <div class="card card-body">
                        <h6>Ajouter une région</h6>
                        <form method="POST" action="{{route('regions.store')}}">
                            @csrf

                            <div class="form-group row">
                                <label for="nomRegion" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                                <div class="col-md-6">
                                    <input id="nomRegion" type="text" class="form-control @error('nomRegion') is-invalid @enderror" name="nomRegion" value="{{ old('nomRegion') }}" required autofocus>

                                    @error('nomRegion')
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
