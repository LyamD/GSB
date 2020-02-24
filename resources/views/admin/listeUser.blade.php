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
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>rôles</th>
                            <th>Matricule</th>
                            <th>email</th>
                            <th>date de naissance</th>
                            <th>adresse</th>
                            <th colspan="3">Action</th>
                            <th>TimeStamp</th>
                        </tr>
                        @php
                            use Spatie\Permission\Models\Role;
                            $roles = Role::all();
                        @endphp
                        @foreach ($users as $u)
                        @php
                            $userRole = $u->getRoleNames();
                        @endphp
                        <tr>
                            <td>{{ $u['nom']}}</td>
                            <td>{{ $u['prenom']}}</td>
                            <td>@foreach ($userRole as $r)
                                {{$r}}
                            @endforeach</td>
                            <td>{{ $u['matricule'] }}</td>
                            <td>{{ $u['email']}}</td>
                            <td>{{ $u['dateNaissance']}}</td>
                            <td>{{ $u['adresse'] }}, {{ $u['adresse2'] }}, {{$u['CP']}} {{$u['ville']}}</td>
                            <td colspan="2">
                                <form action="{{route('utilisateurs.changerRole', $u->id )}}">
                                    <select name="role" id="role" class="form-control">
                                        @foreach ($roles as $r)
                                            <option value="{{$r->name}}"> {{$r->name}}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Ajouter/Enlever') }}
                                    </button>
                                </form>
                            </td>
                            <td>supprimer</td>
                            <td>créer le : {{$u['created_at']}}, <br> Dernière modif le : {{$u['updated_at']}}</td>
                        </tr>
                        @if ($u->hasRole('employe') && Auth::user()->hasRole('superAdmin') && $u->matricule == null)
                            <td colspan="10">
                                <form method="POST"
                                            action="{{ route('utilisateurs.genererMatricule', $u['id']) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="dateEmbauche" class="col-md-4 col-form-label text-md-right">{{ __('date d\'embauche') }}</label>
                                                    <input id="dateEmbauche" type="date"
                                                    class="form-control @error('dateEmbauche') is-invalid @enderror"
                                                    name="dateEmbauche" value="{{ old('dateEmbauche') }}" required autofocus>

                                                @error('dateEmbauche')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                </div>
                                                <div class="col-4">
                                                    <button type="submit" value="Submit" class="btn btn-primary">
                                                        {{ __('Génerer Matricule') }}
                                                    </button>
                                                </div>
                                            </div>
                                            </form>
                            </td>
                        @endif
                        @endforeach
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
