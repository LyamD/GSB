@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                @php
                    use App\Medicaments;
                    $fam = $medicament->famille;
                @endphp
                <div class="card-body">
                    <div class="row">
                    <div class="col-3">Numéro de produit : {{$medicament['numeroProduit']}}</div>
                        <div class="col-3">Nom Commercial : {{$medicament['nomCommercial']}}</div>
                        <div class="col-3">Effets : {{$medicament['effets']}}</div>
                        <div class="col-3">Contre indications : {{$medicament['contreIndications']}}</div>
                    </div>
                    <div class="row">
                        <div class="col-3">Prix d'échantillon : {{$medicament['prixEchantillon']}}</div>
                        <div class="col-3">Famille : {{$fam['nomFamille']}}</div>
                        <div class="col-3">Crée le : {{$medicament['created_at']}}</div>
                        <div class="col-3">Dernière modification : {{$medicament['updated_at']}}</div>
                    </div>

                    <h4 class="mt-5">Interaction avec d'autre composants</h4>
                    <table class="table">
                        <thead>
                            <th>Numéro Produit</th>
                            <th>Nom Commercial</th>
                            <th>Interaction</th>
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