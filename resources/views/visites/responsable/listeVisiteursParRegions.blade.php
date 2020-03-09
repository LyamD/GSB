@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Régions dont je suis responsable</div>
                @php
                    use App\Passage;
                    use App\User;
                @endphp

                @foreach ($regions as $region)

                @php
                    $passages = Passage::where('regions_id', $region->id)->orderBy('utilisateurs_id')->get();
                @endphp
                    
                <div class="card">
                    <div class="card-header">
                    <h4>Région : {{$region['nomRegion']}}</h4>
                        <p>Budget global annuel attribué à cette région : {{$region['budgetGlobalAnnuel']}} €</p>
                    </div>

                    @php
                        
                    @endphp
                    
                    <div class="card-body">
                        <h6>Employés actuellement dans cette région</h6>
                        <table class="table">
                            <tr>
                                <th>Nom - Prénom</th>
                                <th>Matricule</th>
                                <th>Prime</th>
                                <th>Avantages</th>
                                <th>Budget alloué</th>
                                <th colspan="2">Action</th>
                            </tr> 
                            
                            @foreach ($passages as $passage)
                                @if ($passage->dateFin == null)
                                @php
                                    $employe = User::find($passage->utilisateurs_id);
                                @endphp
                                <tr>
                                <td>{{$employe['nom']}} - {{$employe['prenom']}}</td>
                                </tr>

                                    
                                @endif
                            @endforeach
                        </table>
                        
                    </div>
                    
                </div>
                @endforeach

                
            </div>
        </div>
    </div>
</div>
@endsection
