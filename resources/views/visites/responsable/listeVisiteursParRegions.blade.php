@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Régions dont je suis responsable</div>

                @foreach ($regions as $region)
                    
                <div class="card">
                    <div class="card-header">
                    <h4>Région : {{$region['nomRegion']}}</h4>
                        <p>Budget global annuel attribué à cette région : {{$region['budgetGlobalAnnuel']}} €</p>
                    </div>

                    @php
                        $visiteurs = $region->employee()->get();
                    @endphp
                    
                    <div class="card-body">
                        <h6>Employés dans cette région</h6>
                        <table class="table">
                            <tr>
                                <th>Nom - Prénom</th>
                                <th>Matricule</th>
                                <th>Prime</th>
                                <th>Avantages</th>
                                <th>Budget alloué</th>
                                <th colspan="2">Action</th>
                            </tr> 
                            
                            @foreach ($visiteurs as $visiteur)
                                @if ($visiteur->pivot->dateFin == null)
                                    {{$visiteur->get()->nom}}
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
