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
                            <th>Nom Région</th>
                            <th>Budget golbal annuel</th>
                            <th>Responsable région actuel</th>
                            <th colspan="2">Action</th>
                        </tr>
                        @foreach ($regions as $i)
                        @php
                            $rep = $i->responsable()->get();
                        @endphp
                        @if ($rep[0]['id'] == Auth::user()->id)
                            <tr class="table-success">
                                
                        @else
                            <tr>
                        @endif
                            <td>{{ $i['nomRegion']}}</td>
                            <td>{{ $i['budgetGlobalAnnuel']}}</td>
                            <td>{{ empty($rep[0]['nom']) ? 'Non défini' : $rep[0]['nom'] }}</td>
                            <td>
                                @php 
                                $user = Auth::user();
                                @endphp
                                @if (($user->hasPermissionTo('changer_budget_all')) || ( $user->hasPermissionTo('changer_budget_region') && $user->id == $rep[0]['id']) )
                                    <form method="POST" action="{{ action('RegionController@update', $i['id']) }}" >
                                        @csrf
                                        @method('PUT')
                                        <input id="budgetGlobalAnnuel" type="number" class="form-control @error('budgetGlobalAnnuel') is-invalid @enderror" name="budgetGlobalAnnuel" value="{{ $i['budgetGlobalAnnuel'] }}" required autofocus>
    
                                        @error('budgetGlobalAnnuel')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Modifier') }}
                                        </button>
                                    </form>
                                @endif
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
