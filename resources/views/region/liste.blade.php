@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                @php
                $user = Auth::user();
                use App\Passage;
                use App\User;
                @endphp
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nom Région</th>
                                <th>Budget golbal annuel</th>
                                <th>Responsable région actuel</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        @foreach ($regions as $i)
                        @php
                        $rep = $i->responsable()->get();
                        @endphp
                        @if ($rep[0]['id'] == Auth::user()->id)
                        <tr class="table-success">

                            @else
                        <tr>
                            @endif
                            <td>
                                <h4 class="">{{ $i['nomRegion']}} </h4>
                            </td>
                            <td>{{ $i['budgetGlobalAnnuel']}}</td>
                            <td>{{ empty($rep[0]['nom']) ? 'Non défini' : $rep[0]['nom'] }}</td>
                            <td>
                                @if (($user->hasPermissionTo('changer_budget_region_all')) || (
                                $user->hasPermissionTo('changer_budget_region') && $user->id == $rep[0]['id']) )
                                <form method="POST" action="{{ action('RegionController@update', $i['id']) }}">
                                    @csrf
                                    @method('PUT')
                                    <input id="budgetGlobalAnnuel" type="number"
                                        class="form-control @error('budgetGlobalAnnuel') is-invalid @enderror"
                                        name="budgetGlobalAnnuel" value="{{ $i['budgetGlobalAnnuel'] }}" required
                                        autofocus>

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
                        @php
                        $passages = Passage::where('regions_id', $i->id)->orderBy('utilisateurs_id')->get();
                        @endphp
                        <tr>
                            <td colspan="5">
                                <h6 class="mt-2">Passage des employés dans cette région</h6>
                                <table class="mb-5">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>Date Début</th>
                                            <th>Date Fin</th>
                                            <th colspan="3">Action</th>
                                        </tr>
                                    </thead>
                                    @foreach ($passages as $passage)
                                    @php
                                        $employee = User::find($passage->utilisateurs_id)
                                    @endphp
                                    @if ($passage->dateFin == null)
                                    <tr class="table-info">
                                        @else
                                    <tr>
                                        @endif
                                        <td>{{$employee['prenom']}}</td>
                                        <td>{{$employee['nom']}}</td>
                                        <td>{{$passage->dateDebut}}</td>
                                        <td>{{$passage->dateFin}}</td>
                                        <td colspan="3">
                                            @if (($user->id == $rep[0]->id &&
                                            $user->hasPermissionTo('changer_employee_region')) ||
                                            $user->hasRole('superAdmin'))
                                            @if ($passage->dateFin == null)
                                            <form method="POST"
                                                action="{{ route('regions.employeeFinPassage', [ 'id' => $i['id'], 'idEmployee' => $employee['id'] ]) }}">
                                                @csrf
                                                @method('PUT')

                                                <input id="dateFin" type="date"
                                                    class="form-control @error('dateFin') is-invalid @enderror"
                                                    name="dateFin" value="{{ old('dateFin') }}" required autofocus>

                                                @error('dateFin')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Terminer passage') }}
                                                </button>
                                            </form>
                                            @else
                                            <form method="POST"
                                                action="{{ route('regions.employeeDeletePassage', [ 'id' => $i['id'], 'idEmployee' => $employee['id'] ]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Supprimer passage') }}
                                                </button>
                                            </form>
                                            @endif
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @if (($user->id == $rep[0]->id &&
                                    $user->hasPermissionTo('changer_employee_region')) || $user->hasRole('superAdmin'))
                                    <tr>
                                        <td colspan="5">
                                            <form method="POST"
                                                action="{{ route('regions.employeeDebutPassage', $i['id']) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col-4">
                                                        @php
                                                        $employees = App\User::role("employe")->get();
                                                        @endphp
                                                        <select name="user_id" class="form-control">
                                                            @foreach ($employees as $employee)
                                                            <option value="{{$employee['id']}}">{{$employee['nom']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-4">
                                                        <input id="dateDebut" type="date"
                                                            class="form-control @error('dateDebut') is-invalid @enderror"
                                                            name="dateDebut" value="{{ old('dateDebut') }}" required
                                                            autofocus>

                                                        @error('dateDebut')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-4">
                                                        <button type="submit" value="Submit" class="btn btn-primary">
                                                            {{ __('Ajouter passage') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                    @endif
                                </table>
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