@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <table>
                        <tr>
                            <th>Nom Région</th>
                            <th>Budget golbal annuel</th>
                            <th>Responsable Region Actuel</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($regions as $i)
                        @php
                            $rep = $i->responsable()->get();
                        @endphp
                        <tr>
                            <td>{{$i['nomRegion']}}</td>
                            <td>{{$i['budgetGlobalAnnuel']}}</td>
                            <td>{{$rep[0]['nom']}}</td>
                            <td>
                            <form action="{{}}"></form>
                            </td>
                        </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
