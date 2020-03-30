@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>N° Médicament</th>
                                <th>Nom</th>
                                <th>Famille</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($medicaments as $med)
                            <tr>
                            <td>{{$med['numeroProduit']}}</td>
                            <td>{{$med['nomCommercial']}}</td>
                                <td></td>
                                <td></td>
                                <td></td>
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