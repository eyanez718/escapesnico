@extends('layouts.app')

@section('title', '- Agregando orden de trabajo')

@section('content')
    <div class="container">
        <h1><i class="mdi mdi-plus" aria-hidden="true"></i> Agregando orden de trabajo</h1>
        <form method="POST" action="{{ route('ordenes_trabajo.store') }}">
            @csrf
            
            <div class="form-row">
                <!-- Fecha -->
                <div class="form-group col-md-6">
                    <label for="fecha" class="form-label">Fecha:</label>
                    <input type="date" name="fecha" class="form-control" value="{{ old('fecha') }}">
                    @error('fecha')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Empresa -->
                <div class="form-group col-md-6">
                    <label for="empresa" class="form-label">Empresa:</label>
                    <input type="text" name="empresa" class="form-control" value="{{ old('empresa') }}">
                    @error('empresa')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <!-- Patente -->
                <div class="form-group col-md-4">
                    <label for="patente" class="form-label">Patente:</label>
                    <input type="text" name="patente" class="form-control" value="{{ old('patente') }}">
                    @error('patente')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Modelo vehiculo -->
                <div class="form-group col-md-4">
                    <label for="id_modelo_vehiculo">Modelo de vehiculo:</label>
                    <select class="form-control" name="id_modelo_vehiculo">
                        @foreach($modelosVehiculo as $modeloVehiculo)
                            <option value="{{ $modeloVehiculo->id }}"
                            {{ old('id_modelo_vehiculo') == $modeloVehiculo->id ? 'selected' : '' }}>{{ $modeloVehiculo->marcaVehiculo->nombre }} {{ $modeloVehiculo->nombre }}</option>
                        @endforeach
                        @error('id_modelo_vehiculo')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </select>
                </div>
                <!-- Tipo vehiculo -->
                <div class="form-group col-md-4">
                    <label for="id_tipo_vehiculo">Tipo de vehiculo:</label>
                    <select class="form-control" name="id_tipo_vehiculo">
                        @foreach($tiposVehiculo as $tipo_vehiculo)
                            <option value="{{ $tipo_vehiculo->id }}"
                            {{ old('id_tipo_vehiculo') == $tipo_vehiculo->id ? 'selected' : '' }}>{{ $tipo_vehiculo->nombre }}</option>
                        @endforeach
                        @error('id_tipo_vehiculo')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </select>
                </div>
            </div>
            <div class="form-row">
                <!-- Trabajo realizado 1 -->
                <div class="form-group col-md-3">
                    <label for="trabajo_realizado_1">Trabajo realizado 1:</label>
                    <select class="form-control" name="trabajo_realizado_1">
                        <option value="0">Selaccionar trabajo</option>
                        @foreach($trabajosRealizados as $trabajoRealizado)
                            <option value="{{ $trabajoRealizado['id'] }}"
                            {{ old('trabajo_realizado_1') == $trabajoRealizado['id'] ? 'selected' : '' }}>{{ $trabajoRealizado['nombre'] }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Trabajo realizado 2 -->
                <div class="form-group col-md-3">
                    <label for="trabajo_realizado_2">Trabajo realizado 2:</label>
                    <select class="form-control" name="trabajo_realizado_2">
                        <option value="0">Selaccionar trabajo</option>
                        @foreach($trabajosRealizados as $trabajoRealizado)
                            <option value="{{ $trabajoRealizado['id'] }}"
                            {{ old('trabajo_realizado_2') == $trabajoRealizado['id'] ? 'selected' : '' }}>{{ $trabajoRealizado['nombre'] }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Trabajo realizado 3 -->
                <div class="form-group col-md-3">
                    <label for="trabajo_realizado_3">Trabajo realizado 3:</label>
                    <select class="form-control" name="trabajo_realizado_3">
                        <option value="0">Selaccionar trabajo</option>
                        @foreach($trabajosRealizados as $trabajoRealizado)
                            <option value="{{ $trabajoRealizado['id'] }}"
                            {{ old('trabajo_realizado_3') == $trabajoRealizado['id'] ? 'selected' : '' }}>{{ $trabajoRealizado['nombre'] }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Trabajo realizado 4 -->
                <div class="form-group col-md-3">
                    <label for="trabajo_realizado_4">Trabajo realizado 4:</label>
                    <select class="form-control" name="trabajo_realizado_4">
                        <option value="0">Selaccionar trabajo</option>
                        @foreach($trabajosRealizados as $trabajoRealizado)
                            <option value="{{ $trabajoRealizado['id'] }}"
                            {{ old('trabajo_realizado_4') == $trabajoRealizado['id'] ? 'selected' : '' }}>{{ $trabajoRealizado['nombre'] }}</option>
                        @endforeach
                    </select>
                </div>
                @error('trabajo_realizado')                
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Operador -->
            <div class="form-group">
                <label for="id_usuario">Operador:</label>
                <select class="form-control" name="id_usuario">
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}"
                        {{ old('id_usuario') == $usuario->id ? 'selected' : '' }}>{{ $usuario->nombre }}</option>
                    @endforeach
                    @error('id_usuario')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </select>
            </div>
            <!-- Insumos y Materiales -->
            <!-- Botones para abrir modales -->
            <button type="button" class="btn btn-dark float-right mb-3" data-toggle="modal" data-target="#modalInsumos"><i class="mdi mdi-plus" aria-hidden="true"></i> Agregar insumo</button>
            <span class="float-right">&nbsp;</span>
            <button type="button" class="btn btn-dark float-right mb-3" data-toggle="modal" data-target="#modalMateriales"><i class="mdi mdi-plus" aria-hidden="true"></i> Agregar material</button>
            <!-- Listado principal donde se agregan -->
            <h2>Materiales e insumos:</h2>
            @error('productos')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <!-- Tabla de ítems -->
            <table class="table table-striped table-hover table-sm" id="selectedListTable">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody id="selectedList">
                    @php
                        $oldInsumos = old('insumos', []);
                        $oldMateriales = old('materials', []);
                    @endphp

                    @foreach($oldInsumos as $id => $item)
                        <tr data-tipo="insumo" data-id="{{ $item['id'] }}">
                            <td><span class="badge badge-secondary text-capitalize">insumo</span></td>
                            <td>{{ collect($insumos)->firstWhere('id', $item['id'])->codigo ?? '' }}</td>
                            <td>{{ collect($insumos)->firstWhere('id', $item['id'])->descripcion ?? '' }}</td>
                            <td>
                                <input type="number" name="insumos[{{ $item['id'] }}][cantidad]" min="1" max="{{ $item['cantmax'] }}" value="{{ $item['cantidad'] }}" class="form-control form-control-sm" style="width: 80px;" required>
                                <input type="hidden" name="insumos[{{ $item['id'] }}][id]" value="{{ $item['id'] }}">
                                <input type="hidden" name="insumos[{{ $item['id'] }}][cantmax]" value="{{ $item['cantmax'] }}">
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm btn-remove"><i class="mdi mdi-delete" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                    @endforeach

                    @foreach($oldMateriales as $id => $item)
                        <tr data-tipo="material" data-id="{{ $item['id'] }}">
                            <td><span class="badge badge-secondary text-capitalize">material</span></td>
                            <td>{{ collect($materiales)->firstWhere('id', $item['id'])->codigo ?? '' }}</td>
                            <td>{{ collect($materiales)->firstWhere('id', $item['id'])->descripcion ?? '' }}</td>
                            <td>
                                <input type="number" name="materials[{{ $item['id'] }}][cantidad]" min="1" max="{{ $item['cantmax'] }}" value="{{ $item['cantidad'] }}" class="form-control form-control-sm" style="width: 80px;" required>
                                <input type="hidden" name="materials[{{ $item['id'] }}][id]" value="{{ $item['id'] }}">
                                <input type="hidden" name="materials[{{ $item['id'] }}][cantmax]" value="{{ $item['cantmax'] }}">
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm btn-remove"><i class="mdi mdi-delete" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Maquinas -->
            <h2>Maquinas</h2>
            <!-- Tabla de ítems -->
            <table class="table table-striped table-hover table-sm" id="selectedListTable">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Tiempo de uso</th>
                        <th>Cambio combustible</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($maquinas as $maquina)
                        <tr>
                            <td>{{ $maquina->nombre }}<input type="text" name="maquinas[{{ $maquina['id'] }}][id]" value="{{ $maquina['id'] }}" hidden></td>
                            <td><input type="number" name="maquinas[{{ $maquina['id'] }}][minutos_uso]" min="0" value="0" class="form-control form-control-sm" style="width: 80px;" required></td>
                            <td>
                                @if($maquina->usa_combustible)
                                    <input type="checkbox" class="form-check-input" name="maquinas[{{ $maquina['id'] }}][cambio_combustible]" value="1">
                                @else
                                    <input type="checkbox" class="form-check-input" name="maquinas[{{ $maquina['id'] }}][cambio_combustible]" value="1" disabled>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Opciones -->
            <div class="text-right">    
                <button class="btn btn-dark"><i class="mdi mdi-content-save-edit" aria-hidden="true"></i> Guardar</button>
                <a href="{{ route('ordenes_trabajo.index') }}" class="btn btn-secondary"><i class="mdi mdi-cancel" aria-hidden="true"></i> Cancelar</a>
            </div>
        </form>
    </div>

    <!-- Modal de Insumos -->
    <div class="modal fade" id="modalInsumos" tabindex="-1" role="dialog" aria-labelledby="modalInsumosLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Seleccionar Insumo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            @if(count($insumos)>0)
                <table class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($insumos as $insumo)
                        <tr>
                            <td>{{ $insumo->codigo }}</td>
                            <td>{{ $insumo->descripcion }}</td>
                            <td>
                            <input type="number" min="1" max="{{ $insumo->cantidad }}" value="1" class="form-control form-control-sm cantidad-input" data-id="{{ $insumo->id }}" data-tipo="insumo" style="width: 80px;">
                            </td>
                            <td>
                            <button class="btn btn-sm btn-success select-item" 
                                data-id="{{ $insumo->id }}" 
                                data-codigo="{{ $insumo->codigo }}" 
                                data-descripcion="{{ $insumo->descripcion }}" 
                                data-cantmax="{{ $insumo->cantidad }}"
                                data-tipo="insumo">
                                <i class="mdi mdi-cart-plus" aria-hidden="true"></i>
                            </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info"><i class="mdi mdi-info" aria-hidden="true"></i> No hay insumos en el stock.</div>
            @endif
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Materiales -->
    <div class="modal fade" id="modalMateriales" tabindex="-1" role="dialog" aria-labelledby="modalMaterialesLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Seleccionar Material</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            @if(count($materiales)>0)
                <table class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materiales as $material)
                        <tr>
                            <td>{{ $material->codigo }}</td>
                            <td>{{ $material->descripcion }}</td>
                            <td>
                            <input type="number" min="1" max="{{ $material->cantidad }}" value="1" class="form-control form-control-sm cantidad-input" data-id="{{ $material->id }}" data-tipo="material" style="width: 80px;">
                            </td>
                            <td>
                            <button class="btn btn-sm btn-success select-item" 
                                data-id="{{ $material->id }}" 
                                data-codigo="{{ $material->codigo }}" 
                                data-descripcion="{{ $material->descripcion }}" 
                                data-cantmax="{{ $material->cantidad }}"
                                data-tipo="material">
                                <i class="mdi mdi-cart-plus" aria-hidden="true"></i>
                            </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info"><i class="mdi mdi-info" aria-hidden="true"></i> No hay materiales en el stock.</div>
            @endif
          </div>
        </div>
      </div>
    </div>

    <!-- Scripts -->
    <script>
      document.querySelectorAll('.select-item').forEach(button => {
        button.addEventListener('click', () => {
          const id = button.getAttribute('data-id');
          const codigo = button.getAttribute('data-codigo');
          const descripcion = button.getAttribute('data-descripcion');
          const cantmax = button.getAttribute('data-cantmax');
          const tipo = button.getAttribute('data-tipo');

          // Buscar inputs cantidad correspondientes
          const cantidadInput = document.querySelector(`input.cantidad-input[data-id="${id}"][data-tipo="${tipo}"]`);
          let cantidad = cantidadInput ? parseInt(cantidadInput.value) : 1;
          if (isNaN(cantidad) || cantidad < 1) cantidad = 1;

          agregarAlListado(tipo, id, codigo, descripcion, cantidad, cantmax);

          // Cerrar modal correspondiente
          if(tipo === 'insumo') {
            $('#modalInsumos').modal('hide');
          } else {
            $('#modalMateriales').modal('hide');
          }
        });
      });

      function agregarAlListado(tipo, id, codigo, descripcion, cantidad, cantmax) {
        const tbody = document.getElementById('selectedList');

        if(document.querySelector(`tr[data-tipo="${tipo}"][data-id="${id}"]`)) {
          alert('Este ítem ya está agregado.');
          return;
        }

        const tr = document.createElement('tr');
        tr.setAttribute('data-id', id);
        tr.setAttribute('data-tipo', tipo);
        tr.setAttribute('data-cantmax', cantmax);

        tr.innerHTML = `
          <td><span class="badge badge-secondary text-capitalize">${tipo}</span></td>
          <td>${codigo}</td>
          <td>${descripcion}</td>
          <td>
            <input type="number" name="${tipo}s[${id}][cantidad]" min="1" max="${cantmax}" value="${cantidad}" class="form-control form-control-sm" style="width: 80px;" required>
            <input type="hidden" name="${tipo}s[${id}][id]" value="${id}">
            <input type="hidden" name="${tipo}s[${id}][cantmax]" value="${cantmax}">
          </td>
          <td>
            <button type="button" class="btn btn-danger btn-sm btn-remove"><i class="mdi mdi-delete" aria-hidden="true"></i></button>
          </td>
        `;

        tbody.appendChild(tr);

        // BORRADO DINAMICO, no anda post recarga con vuelta fallida de datos
        /*tr.querySelector('.btn-remove').addEventListener('click', () => {
          tr.remove();
        });*/
      }

        document.getElementById('selectedList').addEventListener('click', function (e) {
            if (e.target.classList.contains('btn-remove') || e.target.classList.contains('mdi-delete')) {
                const row = e.target.closest('tr');
                if (row) row.remove();
            }
        });
    </script>
@endsection