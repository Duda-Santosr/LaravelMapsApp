@extends('layouts.app')

@section('title', 'Locais - Laravel Maps App')

@section('content')
<div class="row">
    <div class="col-12 d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-map-marker-alt me-2"></i>Locais Cadastrados</h1>
        <a href="{{ route('locations.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>Adicionar Local
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><i class="fas fa-map me-2"></i>Mapa Interativo</div>
            <div class="card-body">
                <div id="map"></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><i class="fas fa-list me-2"></i>Lista de Locais</div>
            <div class="card-body">
                @if($locations->count())
                    <div class="list-group">
                        @foreach($locations as $location)
                            <div class="list-group-item d-flex justify-content-between align-items-start location-card">
                                <div>
                                    <h6 class="mb-1">{{ $location->name }}</h6>
                                    @if($location->category)
                                        <span class="badge bg-secondary">{{ $location->category }}</span>
                                    @endif
                                    <p class="text-muted small mb-1">
                                        <i class="fas fa-location-arrow me-1"></i>
                                        {{ $location->latitude }}, {{ $location->longitude }}
                                    </p>
                                </div>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('locations.show', $location->id) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-outline-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('locations.destroy', $location->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-outline-danger"
                                                onclick="return confirm('Excluir este local?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-muted">Nenhum local cadastrado</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    var map = L.map('map').setView([-23.5505, -46.6333], 10);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var markers = [];
    var locations = {!! json_encode($locations) !!};

    locations.forEach(loc => {
        let marker = L.marker([loc.latitude, loc.longitude])
            .addTo(map)
            .bindPopup(`<b>${loc.name}</b><br>${loc.address ?? ''}`);
        markers.push(marker);
    });

    if (markers.length > 0) {
        var group = new L.featureGroup(markers);
        map.fitBounds(group.getBounds().pad(0.1));
    }
});
</script>
@endsection
