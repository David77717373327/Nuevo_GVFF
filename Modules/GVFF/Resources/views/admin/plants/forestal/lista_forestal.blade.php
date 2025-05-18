@extends('gvff::layouts.master')

@section('content')
    <div class="container mx-auto p-6">
        <!-- Botón para abrir el modal -->
        <div class="mb-4">
            <button id="openModalBtn" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition duration-200">Crear Planta Forestal</button>
        </div>

        <div class="mb-8">
            <h3 class="text-2xl font-semibold mb-4">Plantas Forestales</h3>
            @if($plants->where('plant_type', 'forestal')->isNotEmpty())
                <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-green-600 text-white">
                        <tr>
                            <th class="py-3 px-4 text-left">Imagen</th>
                            <th class="py-3 px-4 text-left">Nombre Científico</th>
                            <th class="py-3 px-4 text-left">Nombre Común</th>
                            <th class="py-3 px-4 text-left">Inventario</th>
                            <th class="py-3 px-4 text-left">Descripción</th>
                            <th class="py-3 px-4 text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($plants->where('plant_type', 'forestal') as $plant)
                            <tr class="hover:bg-gray-100">
                                <td class="py-3 px-4">
                                    @if($plant->image)
                                        <img src="{{ asset('storage/' . $plant->image) }}" alt="{{ $plant->common_name }}" class="w-12 h-12 object-cover rounded">
                                    @else
                                        <span class="text-gray-500">Sin imagen</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">{{ $plant->scientific_name }}</td>
                                <td class="py-3 px-4">{{ $plant->common_name }}</td>
                                <td class="py-3 px-4">{{ $plant->inventory }}</td>
                                <td class="py-3 px-4">{{ $plant->characteristics ?? 'Sin descripción' }}</td>
                                <td class="py-3 px-4">
                                    <a href="{{ route('gvff.admin.plants.edit', $plant->id) }}" class="text-blue-600 hover:text-blue-800">Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-600">No hay plantas forestales registradas.</p>
            @endif
        </div>

        <!-- Modal para crear una nueva planta -->
        <div id="createModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg max-h-[90vh] overflow-y-auto">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Crear Nueva Planta Forestal</h2>
                <form id="createPlantForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="plant_type" value="forestal">

                    <!-- Sección de Información Básica -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <!-- Vivero -->
                        <div>
                            <label for="nurseries_id" class="block text-sm font-medium text-gray-700 mb-1">Vivero *</label>
                            @if(isset($nurseries) && $nurseries->isNotEmpty())
                                <select name="nurseries_id" id="nurseries_id" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('nurseries_id') border-red-500 @enderror" required>
                                    <option value="">Seleccione un vivero</option>
                                    @foreach ($nurseries as $nursery)
                                        <option value="{{ $nursery->id }}">{{ $nursery->name }}</option>
                                    @endforeach
                                </select>
                            @else
                                <p class="text-red-500 text-sm">No hay viveros disponibles. Crea un vivero primero.</p>
                                <input type="hidden" name="nurseries_id" value="" disabled>
                            @endif
                            <div id="nurseries_id_error" class="text-red-500 text-xs mt-1 hidden"></div>
                        </div>

                        <!-- Nombre Científico -->
                        <div>
                            <label for="scientific_name" class="block text-sm font-medium text-gray-700 mb-1">Nombre Científico *</label>
                            <input type="text" name="scientific_name" id="scientific_name" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('scientific_name') border-red-500 @enderror" required>
                            <div id="scientific_name_error" class="text-red-500 text-xs mt-1 hidden"></div>
                        </div>

                        <!-- Nombre Común -->
                        <div>
                            <label for="common_name" class="block text-sm font-medium text-gray-700 mb-1">Nombre Común *</label>
                            <input type="text" name="common_name" id="common_name" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('common_name') border-red-500 @enderror" required>
                            <div id="common_name_error" class="text-red-500 text-xs mt-1 hidden"></div>
                        </div>

                        <!-- Tipo de Estructura -->
                        <div>
                            <label for="structure_type" class="block text-sm font-medium text-gray-700 mb-1">Tipo de Estructura</label>
                            <select name="structure_type" id="structure_type" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Seleccione un tipo</option>
                                <option value="tree">Árbol</option>
                                <option value="shrub">Arbusto</option>
                                <option value="herb">Hierba</option>
                            </select>
                        </div>

                        <!-- Familia -->
                        <div>
                            <label for="family" class="block text-sm font-medium text-gray-700 mb-1">Familia</label>
                            <input type="text" name="family" id="family" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <!-- Inventario -->
                        <div>
                            <label for="inventory" class="block text-sm font-medium text-gray-700 mb-1">Inventario *</label>
                            <input type="number" name="inventory" id="inventory" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            <div id="inventory_error" class="text-red-500 text-xs mt-1 hidden"></div>
                        </div>

                        <!-- Disponible -->
                        <div class="flex items-center">
                            <input type="checkbox" name="available" id="available" value="1" checked class="mr-2">
                            <label for="available" class="text-sm font-medium text-gray-700">Disponible</label>
                        </div>
                    </div>

                    <!-- Sección de Detalles Adicionales -->
                    <div class="mb-4">
                        <label for="characteristics" class="block text-sm font-medium text-gray-700 mb-1">Características</label>
                        <textarea name="characteristics" id="characteristics" rows="3" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Imagen</label>
                        <input type="file" name="image" id="image" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="mb-4">
                        <label for="observations" class="block text-sm font-medium text-gray-700 mb-1">Observaciones</label>
                        <textarea name="observations" id="observations" rows="3" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                    </div>

                    <!-- Botones -->
                    <div class="flex justify-end gap-2">
                        <button type="submit" id="submitBtn" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition duration-200">Guardar</button>
                        <button type="button" id="closeModalBtn" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-200">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    // Control del modal
    document.getElementById('openModalBtn').addEventListener('click', function() {
        document.getElementById('createModal').classList.remove('hidden');
    });

    document.getElementById('closeModalBtn').addEventListener('click', function() {
        document.getElementById('createModal').classList.add('hidden');
        clearFormErrors();
    });

    // Cerrar el modal al hacer clic fuera de él
    document.getElementById('createModal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
            clearFormErrors();
        }
    });

    // Enviar el formulario con AJAX
    document.getElementById('createPlantForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        formData.append('_token', '{{ csrf_token() }}'); // Añadir el token CSRF a FormData

        fetch('{{ route("gvff.admin.plants.storeForestal") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Mantener el encabezado por si acaso
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert(data.message || 'Planta creada con éxito.');
                document.getElementById('createModal').classList.add('hidden');
                clearFormErrors();
                location.reload(); // Recargar la página para mostrar la nueva planta
            } else {
                displayErrors(data.errors);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ocurrió un error al crear la planta: ' + error.message);
        });
    });

    // Mostrar errores de validación
    function displayErrors(errors) {
        clearFormErrors();
        for (let field in errors) {
            const errorDiv = document.getElementById(`${field}_error`);
            if (errorDiv) {
                errorDiv.textContent = errors[field][0];
                errorDiv.classList.remove('hidden');
                document.getElementById(field).classList.add('border-red-500');
            }
        }
    }

    // Limpiar errores de validación y estilos
    function clearFormErrors() {
        const errorDivs = document.getElementsByClassName('text-red-500');
        for (let div of errorDivs) {
            div.classList.add('hidden');
            div.textContent = '';
        }
        const inputs = document.getElementsByTagName('input');
        const textareas = document.getElementsByTagName('textarea');
        const selects = document.getElementsByTagName('select');
        for (let input of inputs) {
            input.classList.remove('border-red-500');
        }
        for (let textarea of textareas) {
            textarea.classList.remove('border-red-500');
        }
        for (let select of selects) {
            select.classList.remove('border-red-500');
        }
        document.getElementById('createPlantForm').reset();
    }
</script>
@endsection