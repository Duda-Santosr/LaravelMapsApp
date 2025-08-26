@extends('layouts.app')

@section('title', $location->name . ' - Laravel Maps App')

@section('content')
<div class="row">
    <div class="col-12 d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-map-marker-alt me-2"></i>{{ $location->name }}</h1>
        <div>
            <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-warning me-2">
                <i class="fas fa-edit"></i> Editar
            </a>
            <a href="{{ route('locations.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><i class="fas fa-map me-2"></i>Localização no Mapa</div>
            <div class="card-body">
                <div id="map" style="height: 400px;"></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><i class="fas fa-info-circle me-2"></i>Detalhes</div>
            <div class="card-body">
                <p><strong>Nome:</strong> {{ $location->name }}</p>
                @if($location->category)<p><strong>Categoria:</strong> {{ $location->category }}</p>@endif
                @if($location->description)<p><strong>Descrição:</strong> {{ $location->description }}</p>@endif
                @if($location->address)<p><strong>Endereço:</strong> {{ $location->address }}</p>@endif
                <p><strong>Coordenadas:</strong> {{ $location->latitude }}, {{ $location->longitude }}</p>
                <p><strong>Criado em:</strong> {{ $location->created_at->format('d/m/Y H:i') }}</p>
                @if($location->updated_at != $location->created_at)
                    <p><strong>Atualizado em:</strong> {{ $location->updated_at->format('d/m/Y H:i') }}</p>
                @endif
                <hr>
                <form action="{{ route('locations.destroy', $location->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger w-100" onclick="return confirm('Excluir este local?')">
                        <i class="fas fa-trash"></i> Excluir
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    var map = L.map('map').setView([{{ $location->latitude }}, {{ $location->longitude }}], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    L.marker([{{ $location->latitude }}, {{ $location->longitude }}])
        .addTo(map)
        .bindPopup(`<b>{{ $location->name }}</b><br>{{ $location->address ?? '' }}`)
        .openPopup();
});
</script>
@endsection
