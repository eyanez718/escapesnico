@extends('layouts.app')

@section('title', '- Agregando compra')

@section('content')
    <div class="container">
        <h1><i class="mdi mdi-plus" aria-hidden="true"></i> Agregando compra</h1>
        <form method="POST" action="{{ route('compras.store') }}">
            @csrf
            <!-- Fecha -->
            <div class="form-group">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" name="fecha" class="form-control" value="{{ old('fecha') }}">
                @error('fecha')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Número factura -->
            <div class="form-group">
                <label for="numero_factura" class="form-label">Número de factura:</label>
                <input type="text" name="numero_factura" class="form-control" value="{{ old('numero_factura') }}">
                @error('numero_factura')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Proveedor -->
            <div class="form-group">
                <label for="id_proveedor">Tipo de uso:</label>
                <select class="form-control" name="id_proveedor">
                    @foreach($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}"
                        {{ old('id_proveedor') == $proveedor->id ? 'selected' : '' }}>{{ $proveedor->nombre }}</option>
                    @endforeach
                    @error('id_proveedor')
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
                        <th>Costo Unitario</th>
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
                                <input type="number" name="insumos[{{ $item['id'] }}][cantidad]" min="1" value="{{ $item['cantidad'] }}" class="form-control form-control-sm" style="width: 80px;" required>
                                <input type="hidden" name="insumos[{{ $item['id'] }}][id]" value="{{ $item['id'] }}">
                            </td>
                            <td>
                                <input type="number" name="insumos[{{ $item['id'] }}][costo_unitario]" min="0" step="0.01" value="{{ $item['costo_unitario'] ?? 0 }}" class="form-control form-control-sm" style="width: 100px;" required>
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
                                <input type="number" name="materials[{{ $item['id'] }}][cantidad]" min="1" value="{{ $item['cantidad'] }}" class="form-control form-control-sm" style="width: 80px;" required>
                                <input type="hidden" name="materials[{{ $item['id'] }}][id]" value="{{ $item['id'] }}">
                            </td>
                            <td>
                                <input type="number" name="materials[{{ $item['id'] }}][costo_unitario]" min="0" step="0.01" value="{{ $item['costo_unitario'] ?? 0 }}" class="form-control form-control-sm" style="width: 100px;" required>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm btn-remove"><i class="mdi mdi-delete" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Opciones -->
            <div class="text-right">    
                <button class="btn btn-dark"><i class="mdi mdi-content-save-edit" aria-hidden="true"></i> Guardar</button>
                <a href="{{ route('compras.index') }}" class="btn btn-secondary"><i class="mdi mdi-cancel" aria-hidden="true"></i> Cancelar</a>
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
            <table class="table table-striped table-hover table-sm">
              <thead>
                <tr>
                  <th>Código</th>
                  <th>Descripción</th>
                  <th>Cantidad</th>
                  <th>Costo Unitario</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                @foreach($insumos as $insumo)
                  <tr>
                    <td>{{ $insumo->codigo }}</td>
                    <td>{{ $insumo->descripcion }}</td>
                    <td>
                      <input type="number" min="1" value="1" class="form-control form-control-sm cantidad-input" data-id="{{ $insumo->id }}" data-tipo="insumo" style="width: 80px;">
                    </td>
                    <td>
                      <input type="number" min="0" step="0.01" value="0" class="form-control form-control-sm costo-input" data-id="{{ $insumo->id }}" data-tipo="insumo" style="width: 100px;">
                    </td>
                    <td>
                      <button class="btn btn-sm btn-success select-item" 
                        data-id="{{ $insumo->id }}" 
                        data-codigo="{{ $insumo->codigo }}" 
                        data-descripcion="{{ $insumo->descripcion }}" 
                        data-tipo="insumo">
                        <i class="mdi mdi-cart-plus" aria-hidden="true"></i>
                      </button>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
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
            <table class="table table-striped table-hover table-sm">
              <thead>
                <tr>
                  <th>Código</th>
                  <th>Descripción</th>
                  <th>Cantidad</th>
                  <th>Costo Unitario</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                @foreach($materiales as $material)
                  <tr>
                    <td>{{ $material->codigo }}</td>
                    <td>{{ $material->descripcion }}</td>
                    <td>
                      <input type="number" min="1" value="1" class="form-control form-control-sm cantidad-input" data-id="{{ $material->id }}" data-tipo="material" style="width: 80px;">
                    </td>
                    <td>
                      <input type="number" min="0" step="0.01" value="0" class="form-control form-control-sm costo-input" data-id="{{ $material->id }}" data-tipo="material" style="width: 100px;">
                    </td>
                    <td>
                      <button class="btn btn-sm btn-success select-item" 
                        data-id="{{ $material->id }}" 
                        data-codigo="{{ $material->codigo }}" 
                        data-descripcion="{{ $material->descripcion }}" 
                        data-tipo="material">
                        <i class="mdi mdi-cart-plus" aria-hidden="true"></i>
                      </button>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
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
          const tipo = button.getAttribute('data-tipo');

          // Buscar inputs cantidad y costo unitario correspondientes
          const cantidadInput = document.querySelector(`input.cantidad-input[data-id="${id}"][data-tipo="${tipo}"]`);
          const costoInput = document.querySelector(`input.costo-input[data-id="${id}"][data-tipo="${tipo}"]`);
          let cantidad = cantidadInput ? parseInt(cantidadInput.value) : 1;
          if (isNaN(cantidad) || cantidad < 1) cantidad = 1;
          let costo_unitario = costoInput ? parseFloat(costoInput.value) : 0;
          if (isNaN(costo_unitario) || costo_unitario < 0) costo_unitario = 0;

          agregarAlListado(tipo, id, codigo, descripcion, cantidad, costo_unitario);

          // Cerrar modal correspondiente
          if(tipo === 'insumo') {
            $('#modalInsumos').modal('hide');
          } else {
            $('#modalMateriales').modal('hide');
          }
        });
      });

      function agregarAlListado(tipo, id, codigo, descripcion, cantidad, costo_unitario) {
        const tbody = document.getElementById('selectedList');

        if(document.querySelector(`tr[data-tipo="${tipo}"][data-id="${id}"]`)) {
          alert('Este ítem ya está agregado.');
          return;
        }

        const tr = document.createElement('tr');
        tr.setAttribute('data-id', id);
        tr.setAttribute('data-tipo', tipo);

        tr.innerHTML = `
          <td><span class="badge badge-secondary text-capitalize">${tipo}</span></td>
          <td>${codigo}</td>
          <td>${descripcion}</td>
          <td>
            <input type="number" name="${tipo}s[${id}][cantidad]" min="1" value="${cantidad}" class="form-control form-control-sm" style="width: 80px;" required>
            <input type="hidden" name="${tipo}s[${id}][id]" value="${id}">
          </td>
          <td>
            <input type="number" name="${tipo}s[${id}][costo_unitario]" min="0" step="0.01" value="${costo_unitario}" class="form-control form-control-sm" style="width: 100px;" required>
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