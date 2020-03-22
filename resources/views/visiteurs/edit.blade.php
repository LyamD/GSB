@extends('layouts.app')

@section('content')
<div class="container">

    @php
    $user = $visiteur->employe()->get();
    @endphp

    <h2>Modifier les données visiteurs de {{$user[0]['prenom']}} {{$user[0]['nom']}}</h2>
    <form action="{{ action('VisiteurMedicauxController@update', $visiteur['id']) }}" method="post">
        @csrf
        @method('PUT')

        <label for="objectif"> Objectif</label>
        <textarea id="objectif"  class="form-control @error('objectif') is-invalid @enderror" name="objectif" required>
            {{ $visiteur['objectif'] }}
        </textarea>

        @error('objectif')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        <label for="avantages">Avantages</label>
        <textarea id="avantages"  class="form-control @error('avantages') is-invalid @enderror" name="avantages" required>
            {{ $visiteur['avantages'] }}
        </textarea>

        @error('avantages')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        <label for="prime">Prime</label>
        <input id="prime" type="number" class="form-control @error('prime') is-invalid @enderror" name="prime"
            value="{{ $visiteur['prime'] }}" required>

        @error('prime')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror


        <button type="submit" class="btn btn-success">Valider</button>
    </form>


</div>
@endsection