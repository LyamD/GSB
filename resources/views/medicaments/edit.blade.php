@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @php
                use App\Medicaments;
            @endphp
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <div class="container">
                        <form method="POST" action="{{action('MedicamentsController@update', $medicament['id'])}}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="numeroProduit">Numéro de produit</label>
                                        <input id="numeroProduit" value="{{$medicament['numeroProduit']}}" type="text"
                                            class="form-control @error('numeroProduit') is-invalid @enderror"
                                            name="numeroProduit" required>

                                        @error('numeroProduit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nomCommercial">Nom Commercial</label>
                                        <input id="nomCommercial" value="{{$medicament['nomCommercial']}}" type="text"
                                            class="form-control @error('nomCommercial') is-invalid @enderror"
                                            name="nomCommercial" required>

                                        @error('nomCommercial')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="effets">Effets</label>
                                        <textarea id="effets" class="form-control @error('effets') is-invalid @enderror"
                                            name="effets" required>{{$medicament['effets']}}</textarea>

                                        @error('effets')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contreIndications">Contres-indications</label>
                                        <textarea id="contreIndications"
                                            class="form-control @error('contreIndications') is-invalid @enderror"
                                            name="contreIndications"
                                            required> {{$medicament['contreIndications']}}</textarea>

                                        @error('contreIndications')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="prixEchantillon">Prix d'échantillons</label>
                                        <input id="prixEchantillon" value="{{$medicament['prixEchantillon']}}"
                                            type="number"
                                            class="form-control @error('prixEchantillon') is-invalid @enderror"
                                            name="prixEchantillon" required>

                                        @error('prixEchantillon')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="familleID">Famille</label>
                                        <select class="form-control" id="familleID" name="familleID">
                                            @foreach ($familles as $fam)
                                            <option value="{{$fam['id']}}">{{$fam['nomFamille']}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Modifier') }}
                            </button>
                        </form>

                        <div class="row">
                            <h4 class="mt-5">Interaction avec d'autre composants</h4>
                            <table class="table">
                                <thead>
                                    <th>Numéro Produit</th>
                                    <th>Nom Commercial</th>
                                    <th>Interaction</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($interactions as $item)
                                    @php
                                    $medInt = Medicaments::find($item->Produit_id);
                                    if ($medInt->is($medicament)) {
                                    $medInt = Medicaments::find($item->Produit_1_id);
                                    }
                                    @endphp

                                    <tr>
                                        <td>{{$medInt['numeroProduit']}}</td>
                                        <td>{{$medInt['nomCommercial']}}</td>
                                        <td>{{$item->interaction}}</td>
                                        <td>
                                            <form method="POST" action="{{ action('InteractionsController@destroy', $item['id']) }}">
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
                    <div class="container">
                        <h3 class="mt-5">Ajouter une interaction</h3>
                        <div class="row">
                            <form method="POST" class="form-inline" action="{{action('InteractionsController@store')}}">
                                @csrf
                                @method('POST')

                                <input type="hidden" name="Produit_id" value="{{$medicament['id']}}">

                                <div class="form-group mb-2">
                                    <label for="Produit_1_id">Medicament</label>
                                    <select class="form-control mx-2" id="Produit_1_id" name="Produit_1_id">
                                        @foreach ($medliste as $meds)
                                        <option value="{{$meds['id']}}">{{$meds['numeroProduit']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mx-4 mb-2">
                                    <label for="interaction">Interaction</label>
                                    <textarea id="interaction"
                                        class="form-control-lg mx-2 @error('interaction') is-invalid @enderror"
                                        name="interaction" required> </textarea>

                                    @error('interaction')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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