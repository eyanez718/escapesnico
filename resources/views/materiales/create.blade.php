@extends('layouts.app')

@section('title', '- Agregando material')

@section('content')
    <div class="container">
        <h1><i class="mdi mdi-plus" aria-hidden="true"></i> Agregando material</h1>
        <form method="POST" action="{{ route('materiales.store') }}">
            @csrf
            <!-- Código -->
            <div class="form-group">
                <label for="codigo" class="form-label">Código:</label>
                <input type="text" name="codigo" class="form-control" value="{{ old('codigo') }}">
                @error('codigo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Descripción -->
            <div class="form-group">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion') }}">
                @error('descripcion')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Tipo de uso -->
            <div class="form-group">
                <label for="id_tipo_uso">Tipo de uso:</label>
                <select class="form-control" name="id_tipo_uso">
                    @foreach($tiposUso as $tipoUso)
                        <option value="{{ $tipoUso->id }}"
                        {{ old('id_tipo_uso') == $tipoUso->id ? 'selected' : '' }}>{{ $tipoUso->nombre }}</option>
                    @endforeach
                    @error('id_tipo_uso')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                </select>
            </div>
            <!-- Tipo de vehículo -->
            <div class="form-group">
                <label for="id_tipo_vehiculo">Tipo de vehículo:</label>
                <select class="form-control" name="id_tipo_vehiculo">
                    @foreach($tiposVehiculo as $tipoVehiculo)
                        <option value="{{ $tipoVehiculo->id }}"
                        {{ old('id_tipo_vehiculo') == $tipoVehiculo->id ? 'selected' : '' }}>{{ $tipoVehiculo->nombre }}</option>
                    @endforeach
                </select>
                @error('id_vehiculo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Marca de vehículo -->
            <div class="form-group">
                <label for="id_marca">Marca de vehículo:</label>
                <select class="form-control" name="id_marca" id="id_marca">
                    @foreach($marcasVehiculo as $marcaVehiculo)
                        <option value="{{ $marcaVehiculo->id }}"
                        {{ old('id_marca') == $marcaVehiculo->id ? 'selected' : '' }}>{{ $marcaVehiculo->nombre }}</option>
                    @endforeach
                </select>
                @error('id_marca')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Modelo vehículo -->
             <div class="form-group">
                <label for="id_modelo">Modelo de vehículo:</label>
                <select name="id_modelo" id="id_modelo" class="form-control" disabled>
                    @if(!(old('id_modelo')))
                        <option value="">Seleccione un modelo</option>
                    @endif
                </select>
                @if(old('id_modelo'))
                    <span id="id_modelo_old" hidden>{{ old('id_modelo') }}</span>
                @endif
                @error('id_modelo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Cantidad -->
            <div class="form-group">
                <label for="cantidad" class="form-label">Cantidad:</label>
                <input type="number" name="cantidad" class="form-control" value="{{ old('cantidad') }}">
                @error('cantidad')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Costo unitario -->
            <div class="form-group">
                <label for="costo_unitario" class="form-label">Costo unitario:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input type="text" name="costo_unitario" class="form-control" value="{{ old('costo_unitario') }}">
                </div>
                @error('costo_unitario')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Opciones -->
            <div class="text-right">    
                <button class="btn btn-dark"><i class="mdi mdi-content-save-edit" aria-hidden="true"></i> Guardar</button>
                <a href="{{ route('materiales.index') }}" class="btn btn-secondary"><i class="mdi mdi-cancel" aria-hidden="true"></i> Cancelar</a>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categoriaSelect = document.getElementById('id_marca');
            const subcategoriaSelect = document.getElementById('id_modelo');

            categoriaSelect.addEventListener('change', function () {
                const categoriaId = this.value;

                // Limpia y desactiva el select de subcategorías
                subcategoriaSelect.innerHTML = '<option>Cargando...</option>';
                subcategoriaSelect.disabled = true;

                if (categoriaId) {
                    fetch(`marcas_vehiculo/obtener_modelos/${categoriaId}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Error en la respuesta del servidor');
                            }
                            return response.json();
                        })
                        .then(data => {
                            var agregueOpcion = false;
                            subcategoriaSelect.innerHTML = '';
                            data.forEach(sub => {
                                const option = document.createElement('option');
                                option.value = sub.id;
                                option.textContent = sub.nombre;
                                subcategoriaSelect.appendChild(option);
                                agregueOpcion = true
                            });
                            if (agregueOpcion) {
                                subcategoriaSelect.disabled = false;
                                var componenteIdModeloAnterior = document.getElementById('id_modelo_old');
                                if (componenteIdModeloAnterior != null) {
                                    var idModeloAnterior = componenteIdModeloAnterior.innerText;
                                    if (idModeloAnterior != '') {
                                        subcategoriaSelect.value = idModeloAnterior;
                                        componenteIdModeloAnterior.innerText = null;
                                    }
                                }
                            } else {
                                subcategoriaSelect.innerHTML = '<option value="">Seleccione un modelo</option>'
                                subcategoriaSelect.disabled = true;
                            }
                        })
                        .catch(error => {
                            subcategoriaSelect.innerHTML = '<option>Error al cargar</option>';
                            console.error('Error:', error);
                        });
                } else {
                    subcategoriaSelect.innerHTML = '<option value="">Seleccione un modelo</option>';
                    subcategoriaSelect.disabled = true;
                }
            });

            // Ejecuta el evento change automáticamente al cargar
            if (categoriaSelect.value) {
                categoriaSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>
@endsection