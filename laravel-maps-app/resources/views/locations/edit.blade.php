@extends('layouts.app')

@section('title', 'Editar ' . $location->name . ' - Laravel Maps App')

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Cabeçalho -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-edit me-2"></i>Editar Local</h1>
            <a href="{{ route('locations.show', $location->id) }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>Voltar
            </a>
        </div>
    </div>
</div>

<div class="row">
    <!-- Coluna com o mapa -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="fas fa-map me-2"></i>Atualizar Localização</h5>
            </div>
            <div class="card-body">
                <!-- Mapa -->
                <div id="map" style="height: 400px;"></div>
                <small class="text-muted d-block mt-2">
                    <i class="fas fa-info-circle me-1"></i>
                    Clique no mapa para atualizar as coordenadas
                </small>
            </div>
        </div>
    </div>

    <!-- Coluna com o formulário -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><i class="fas fa-edit me-2"></i>Editar Informações</div>
            <div class="card-body">
                <!-- Formulário -->
                <form action="{{ route('locations.update', $location->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nome -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome *</label>
                        <input type="text" id="name" name="name"
                               value="{{ old('name', $location->name) }}"
                               class="form-control @error('name') is-invalid @enderror" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Descrição -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição</label>
                        <textarea id="description" name="description" rows="3"
                                  class="form-control @error('description') is-invalid @enderror">{{ old('description', $location->description) }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Latitude e Longitude -->
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="latitude" class="form-label">Latitude *</label>
                            <input type="number" step="any" id="latitude" name="latitude"
                                   value="{{ old('latitude', $location->latitude) }}"
                                   class="form-control @error('latitude') is-invalid @enderror" required>
                            @error('latitude')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label for="longitude" class="form-label">Longitude *</label>
                            <input type="number" step="any" id="longitude" name="longitude"
                                   value="{{ old('longitude', $location->longitude) }}"
                                   class="form-control @error('longitude') is-invalid @enderror" required>
                            @error('longitude')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <!-- Endereço -->
                    <div class="mb-3">
                        <label for="address" class="form-label">Endereço</label>
                        <input type="text" id="address" name="address"
                               value="{{ old('address', $location->address) }}"
                               class="form-control @error('address') is-invalid @enderror">
                        @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Categoria -->
                    <div class="mb-3">
                        <label for="category" class="form-label">Categoria</label>
                        <select id="category" name="category"
                                class="form-select @error('category') is-invalid @enderror">
                            <option value="">Selecione...</option>
                            <option value="Restaurante" {{ old('category', $location->category) == 'Restaurante' ? 'selected' : '' }}>Restaurante</option>
                            <option value="Hotel" {{ old('category', $location->category) == 'Hotel' ? 'selected' : '' }}>Hotel</option>
                            <option value="Shopping" {{ old('category', $location->category) == 'Shopping' ? 'selected' : '' }}>Shopping</option>
                            <option value="Parque" {{ old('category', $location->category) == 'Parque' ? 'selected' : '' }}>Parque</option>
                            <option value="Museu" {{ old('category', $location->category) == 'Museu' ? 'selected' : '' }}>Museu</option>
                            <option value="Teatro" {{ old('category', $location->category) == 'Teatro' ? 'selected' : '' }}>Teatro</option>
                            <option value="Hospital" {{ old('category', $location->category) == 'Hospital' ? 'selected' : '' }}>Hospital</option>
                            <option value="Escola" {{ old('category', $location->category) == 'Escola' ? 'selected' : '' }}>Escola</option>
                            <option value="Outro" {{ old('category', $location->category) == 'Outro' ? 'selected' : '' }}>Outro</option>
                        </select>
                        @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Botão -->
                    <button type="submit" class="btn btn-warning w-100">
                        <i class="fas fa-save me-1"></i>Atualizar Local
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inicia mapa na posição atual do local
    var map = L.map('map').setView([{{ $location->latitude }}, {{ $location->longitude }}], 15);

    // Camada de tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Marcador inicial
    var marker = L.marker([{{ $location->latitude }}, {{ $location->longitude }}]).addTo(map);

    // Atualiza ao clicar
    map.on('click', function(e) {
        var lat = e.latlng.lat.toFixed(8);
        var lng = e.latlng.lng.toFixed(8);

        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;

        marker.setLatLng([lat, lng]).bindPopup(`
            <div class="text-center">
                <strong>Nova localização:</strong><br>
                Lat: ${lat}<br>Lng: ${lng}
            </div>
        `).openPopup();
    });
});
</script>
@endsection
