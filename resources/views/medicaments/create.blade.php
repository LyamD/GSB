@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <div class="container">
                    <form method="POST" action="{{action('MedicamentsController@store')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="numeroProduit">Numéro de produit</label>
                                    <input id="numeroProduit" type="text" class="form-control @error('numeroProduit') is-invalid @enderror" name="numeroProduit" required>

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
                                    <input id="nomCommercial" type="text" class="form-control @error('nomCommercial') is-invalid @enderror" name="nomCommercial" required>

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
                                    <textarea id="effets"  class="form-control @error('effets') is-invalid @enderror" name="effets" required></textarea>

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
                                    <textarea id="contreIndications" class="form-control @error('contreIndications') is-invalid @enderror" name="contreIndications" required> </textarea>

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
                                    <input id="prixEchantillon" type="text" class="form-control @error('prixEchantillon') is-invalid @enderror" name="prixEchantillon" required>

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