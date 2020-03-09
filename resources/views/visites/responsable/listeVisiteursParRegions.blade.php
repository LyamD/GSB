@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Régions dont je suis responsable</div>

                <div class="card">
                    <div class="card-header">
                        <h4>Région : </h4>
                        <p>Budget global annuel attribué à cette région : €</p>
                    </div>
                    
                    <div class="card-body">

                        <table class="table">
                            <tr>
                                <th>Nom - Prénom</th>
                                <th>Matricule</th>
                                <th>Prime</th>
                                <th>Avantages</th>
                                <th>Budget alloué</th>
                                <th colspan="2">Action</th>
                            </tr>  
                        </table>

                    </div>

                </div>

                
            </div>
        </div>
    </div>
</div>
@endsection
