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
                        @endforeach
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
