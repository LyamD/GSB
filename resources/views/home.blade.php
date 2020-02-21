@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>
                    
                    @can('acceder_region')
                        <a href="{{route('regions.liste')}}" class="btn btn-dark">Accéder au région</a>
                    @endcan

                    @can('changer_budget_region')
                        Changer le budget de mes régions
                    @endcan

                    @can('changer_budget_region_all')
                        Accéder au budget de toutes les régions
                    @endcan

                    @can('controler-region')
                        <a href="{{ action('RegionController@index') }}" class="btn btn-dark">
                            Editer les régions
                        </a>
                    @endcan
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
