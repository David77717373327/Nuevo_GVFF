@extends('gvff::layouts.master')

@section('content')
    <div class="container mx-auto p-6">
        <!-- Botón para abrir el modal -->
        <div class="mb-4">
            <button id="openModalBtn" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition duration-200 {{ $nurseries->isEmpty() ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $nurseries->isEmpty() ? 'disabled' : '' }}>Crear Planta Forestal</button>
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
                <form id="createPlants" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="plant_type" value="forestal">

                    <!-- Sección de Información Básica -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <!-- Vivero -->
                        <div>
                            <label for="nurseries_id" class="block text-sm font-medium text-gray-700 mb-1">Vivero *</label>
                            @if($nurseries->isNotEmpty())
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
    // JavaScript para manejar el modal y la validación del formulario
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('createModal');
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const createPlantForm = document.getElementById('createPlants');
        const submitBtn = document.getElementById('submitBtn');

        if (!createPlantForm) {
            console.error('Form with ID "createPlants" not found');
            return;
        }

        if (!submitBtn) {
            console.error('Submit button with ID "submitBtn" not found');
            return;
        }

        openModalBtn.addEventListener('click', () => {
            console.log('Open modal button clicked');
            modal.classList.remove('hidden');
        });

        closeModalBtn.addEventListener('click', () => {
            console.log('Close modal button clicked');
            modal.classList.add('hidden');
        });

        window.addEventListener('click', function (e) {
            if (e.target === modal) {
                console.log('Clicked outside modal');
                modal.classList.add('hidden');
            }
        });

        createPlantForm.addEventListener('submit', function (e) {
            e.preventDefault();
            console.log('Form submission triggered');

            const requiredFields = ['nurseries_id', 'scientific_name', 'common_name', 'inventory'];
            let hasError = false;
            requiredFields.forEach(field => {
                const input = document.getElementById(field);
                const errorDiv = document.getElementById(`${field}_error`);
                if (!input.value) {
                    errorDiv.textContent = 'Este campo es obligatorio.';
                    errorDiv.classList.remove('hidden');
                    hasError = true;
                } else {
                    errorDiv.classList.add('hidden');
                }
            });

            if (hasError) {
                console.log('Validation failed, stopping submission');
                return;
            }

            const formData = new FormData(this);
            console.log('FormData:', Object.fromEntries(formData));

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || document.querySelector('input[name="_token"]')?.value;
            if (!csrfToken) {
                console.error('CSRF token not found');
                alert('Error: No se encontró el token CSRF.');
                return;
            }
            console.log('CSRF Token:', csrfToken);

            fetch("{{ route('gvff.admin.plants.storeForestal') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => {
                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers.get('Content-Type'));
                return response.text().then(text => {
                    console.log('Raw response:', text);
                    if (!response.ok) {
                        if (response.status === 403) {
                            throw new Error('No tienes permiso para realizar esta acción. Por favor, inicia sesión o verifica tus permisos.');
                        }
                        try {
                            return JSON.parse(text);
                        } catch (e) {
                            throw new Error('Invalid JSON: ' + text);
                        }
                    }
                    return JSON.parse(text);
                });
            })
            .then(data => {
                console.log('Parsed JSON:', data);
                if (data.success) {
                    alert(data.message);
                    modal.classList.add('hidden');
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                if (error.errors) {
                    Object.entries(error.errors).forEach(([key, messages]) => {
                        const errorDiv = document.getElementById(`${key}_error`);
                        if (errorDiv) {
                            errorDiv.textContent = messages.join(', ');
                            errorDiv.classList.remove('hidden');
                        }
                    });
                } else {
                    alert('Error al enviar el formulario: ' + error.message);
                }
            });
        });
    });
</script>
    
@endsection