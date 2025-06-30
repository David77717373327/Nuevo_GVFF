<?php

namespace Modules\GVFF\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Permission;
use Modules\SICA\Entities\Role;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        // Lista de permisos
        $permissions_admin = [];

        // Consultar aplicación GVFF
        $app = App::where('name', 'GVFF')->firstOrFail();

        // Permiso para el panel de administrador
        $permission = Permission::updateOrCreate(['slug' => 'gvff.index'], [
            'name' => 'Acceso al Panel de Administrador',
            'description' => 'Permite acceder al panel de bienvenida de administrador',
            'description_english' => 'Allows access to the administrator welcome panel',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        // Permisos para el CRUD de Viveros
        $nurseries_permissions = [
            [
                'slug' => 'gvff.admin.nurseries.index',
                'name' => 'Ver lista de viveros',
                'description' => 'Permite ver la lista de viveros',
                'description_english' => 'Allows viewing the list of viveros',
            ],
            [
                'slug' => 'gvff.admin.nurseries.create',
                'name' => 'Crear viveros',
                'description' => 'Permite crear nuevos viveros',
                'description_english' => 'Allows creating new viveros',
            ],
            [
                'slug' => 'gvff.admin.nurseries.store',
                'name' => 'Crear un nuevo vivero',
                'description' => 'Permite crear nuevos viveros',
                'description_english' => 'Creating new viveros',
            ],
            [
                'slug' => 'gvff.admin.nurseries.edit',
                'name' => 'Editar viveros',
                'description' => 'Permite editar viveros existentes',
                'description_english' => 'Allows editing existing viveros',
            ],
            [
                'slug' => 'gvff.admin.nurseries.update',
                'name' => 'Actualizar viveros',
                'description' => 'Permite actualizar un vivero editado',
                'description_english' => 'Allows updating viveros',
            ],
            [
                'slug' => 'gvff.admin.nurseries.destroy',
                'name' => 'Eliminar viveros',
                'description' => 'Permite eliminar viveros',
                'description_english' => 'Allows deleting viveros',
            ],
            [
                'slug' => 'gvff.admin.nurseries.showPlants',
                'name' => 'Mostrar las plantas',
                'description' => 'Permite mostrar las plantas',
                'description_english' => 'Allows displaying plants',
            ],
        ];

        // Crear permisos para Viveros y añadirlos a la lista de permisos del administrador
        foreach ($nurseries_permissions as $perm) {
            $permission = Permission::updateOrCreate(
                ['slug' => $perm['slug']],
                [
                    'name' => $perm['name'],
                    'description' => $perm['description'],
                    'description_english' => $perm['description_english'],
                    'app_id' => $app->id
                ]
            );
            $permissions_admin[] = $permission->id;
        }

        // Permisos para el CRUD de Plantas
        $plants_permissions = [
            [
                'slug' => 'gvff.admin.plants.index',
                'name' => 'Ver lista de plantas',
                'description' => 'Permite ver la lista de plantas',
                'description_english' => 'Allows viewing the list of plants',
            ],
            [
                'slug' => 'gvff.admin.plants.create',
                'name' => 'Crear plantas',
                'description' => 'Permite crear nuevas plantas',
                'description_english' => 'Allows creating new plants',
            ],
            [
                'slug' => 'gvff.admin.plants.store',
                'name' => 'Crear una nueva planta',
                'description' => 'Permite crear nuevas plantas',
                'description_english' => 'Creating new plants',
            ],
            [
                'slug' => 'gvff.admin.plants.edit',
                'name' => 'Editar plantas',
                'description' => 'Permite editar plantas existentes',
                'description_english' => 'Allows editing existing plants',
            ],
            
            [
                'slug' => 'gvff.admin.plants.update',
                'name' => 'Actualizar plantas',
                'description' => 'Permite actualizar una planta editada',
                'description_english' => 'Allows updating plants',
            ],
            [
                'slug' => 'gvff.admin.plants.destroy',
                'name' => 'Eliminar plantas',
                'description' => 'Permite eliminar plantas',
                'description_english' => 'Allows deleting plants',
            ],
            [
                'slug' => 'gvff.admin.plants.sell',
                'name' => 'Vender plantas',
                'description' => 'Permite vender plantas',
                'description_english' => 'Allows selling plants',
            ],
            [
                'slug' => 'gvff.admin.plants.processSell',
                'name' => 'Procesar venta de plantas',
                'description' => 'Permite procesar la venta de plantas',
                'description_english' => 'Allows processing the sale of plants',
            ],
            [
                'slug' => 'gvff.admin.plants.ornamental.create',
                'name' => 'Crear planta ornamental',
                'description' => 'Permite mostrar el formulario para crear plantas ornamentales',
                'description_english' => 'Allows displaying the form to create ornamental plants',
            ],
            [
                'slug' => 'gvff.admin.plants.ornamental.store',
                'name' => 'Almacenar planta ornamental',
                'description' => 'Permite guardar una nueva planta ornamental',
                'description_english' => 'Allows storing a new ornamental plant',
            ],
            [
                'slug' => 'gvff.admin.plants.medicinal.create',
                'name' => 'Crear planta medicinal',
                'description' => 'Permite mostrar el formulario para crear plantas medicinales',
                'description_english' => 'Allows displaying the form to create medicinal plants',
            ],
            [
                'slug' => 'gvff.admin.plants.medicinal.store',
                'name' => 'Almacenar planta medicinal',
                'description' => 'Permite guardar una nueva planta medicinal',
                'description_english' => 'Allows storing a new medicinal plant',
            ],
            [
                'slug' => 'gvff.admin.plants.venta.create',
                'name' => 'Crear planta en venta',
                'description' => 'Permite mostrar el formulario para crear plantas en venta',
                'description_english' => 'Allows displaying the form to create plants for sale',
            ],
            [
                'slug' => 'gvff.admin.plants.venta.store',
                'name' => 'Almacenar planta en venta',
                'description' => 'Permite guardar una nueva planta en venta',
                'description_english' => 'Allows storing a new plant for sale',
            ],
            [
                'slug' => 'gvff.admin.plants.forestal.create',
                'name' => 'Crear planta forestal',
                'description' => 'Permite mostrar el formulario para crear plantas forestales',
                'description_english' => 'Allows displaying the form to create forestal plants',
            ],
            [  
             
                'slug' => 'gvff.admin.plants.forestal.store',
                'name' => 'Almacenar planta forestal',
                'description' => 'Permite guardar una nueva planta forestal',
                'description_english' => 'Allows storing a new forestal plant',
            ],
            [
                'slug' => 'gvff.admin.plants.forestal.createForestal',
                'name' => 'Crear planta forestal',
                'description' => 'Permite mostrar el formulario para crear plantas forestales',
                'description_english' => 'Allows displaying the form to create forestal plants',
            ],
         
            [
                'slug' => 'gvff.admin.plants.forestal.store',
                'name' => 'Almacenar planta forestal',
                'description' => 'Permite guardar una nueva planta forestal',
                'description_english' => 'Allows storing a new forestal plant',
            ],
            [
                'slug' => 'gvff.admin.plants.forestal.storeForestal',
                'name' => 'Almacenar planta forestal',
                'description' => 'Permite guardar una nueva planta forestal',
                'description_english' => 'Allows storing a new forestal plant',
            ],

            [
                'slug' => 'gvff.admin.plants.forestal.createForestal',
                'name' => 'Crear planta forestal',
                'description' => 'Permite mostrar el formulario para crear plantas forestales',
                'description_english' => 'Allows displaying the form to create forestal plants',
            ],

            [
                'slug' => 'gvff.admin.plants.ornamental.lista_ornamental',
                'name' => 'Ver lista de plantas ornamentales',
                'description' => 'Permite ver la lista de plantas ornamentales',
                'description_english' => 'Allows viewing the list of ornamental plants',
            ],
            [
                'slug' => 'gvff.admin.plants.medicinal.lista_medicinal',
                'name' => 'Ver lista de plantas medicinales',
                'description' => 'Permite ver la lista de plantas medicinales',
                'description_english' => 'Allows viewing the list of medicinal plants',
            ],
            [
                'slug' => 'gvff.admin.plants.forestal.lista_forestal',
                'name' => 'Ver lista de plantas forestales',
                'description' => 'Permite ver la lista de plantas forestales',
                'description_english' => 'Allows viewing the list of forestal plants',
            ],
            [
                'slug' => 'gvff.admin.plants.venta.lista_venta',
                'name' => 'Ver lista de plantas en venta',
                'description' => 'Permite ver la lista de plantas en venta',
                'description_english' => 'Allows viewing the list of plants for sale',
            ],

            

            
        ];

        // Crear permisos para Plantas y añadirlos a la lista de permisos del administrador
        foreach ($plants_permissions as $perm) {
            $permission = Permission::updateOrCreate(
                ['slug' => $perm['slug']],
                [
                    'name' => $perm['name'],
                    'description' => $perm['description'],
                    'description_english' => $perm['description_english'],
                    'app_id' => $app->id
                ]
            );
            $permissions_admin[] = $permission->id;
        }

        // Permisos para el CRUD de Faunas
        $faunas_permissions = [
            [
                'slug' => 'gvff.admin.faunas.index',
                'name' => 'Ver lista de faunas',
                'description' => 'Permite ver la lista de faunas',
                'description_english' => 'Allows viewing the list of faunas',
            ],
            [
                'slug' => 'gvff.admin.faunas.create',
                'name' => 'Crear faunas',
                'description' => 'Permite mostrar el formulario para crear faunas',
                'description_english' => 'Allows displaying the form to create faunas',
            ],

            [
                'slug' => 'gvff.admin.faunas.store',
                'name' => 'Almacenar fauna',
                'description' => 'Permite guardar una nueva fauna',
                'description_english' => 'Allows storing a new fauna',
            ],

            [
                'slug' => 'gvff.admin.faunas.edit',
                'name' => 'Editar faunas',
                'description' => 'Permite mostrar el formulario para editar faunas existentes',
                'description_english' => 'Allows displaying the form to edit existing faunas',
            ],
            [
                'slug' => 'gvff.admin.faunas.update',
                'name' => 'Actualizar faunas',
                'description' => 'Permite actualizar una fauna editada',
                'description_english' => 'Allows updating faunas',
            ],
            [
                'slug' => 'gvff.admin.faunas.destroy',
                'name' => 'Eliminar faunas',
                'description' => 'Permite eliminar faunas',
                'description_english' => 'Allows deleting faunas',
            ],

            //permisos para inventario de plantas
            [
                'slug' => 'gvff.admin.plant_inventory.index',
                'name' => 'Ver inventario de plantas',
                'description' => 'Permite ver el inventario de plantas',
                'description_english' => 'Allows viewing the plant inventory',
            ],
            [
                'slug' => 'gvff.admin.plant_inventory.entrance',
                'name' => 'Entrada de inventario de plantas',
                'description' => 'Permite registrar la entrada de plantas al inventario',
                'description_english' => 'Allows registering the entry of plants to the inventory',
            ],
            [
                'slug' => 'gvff.admin.plant_inventory.store',
                'name' => 'Almacenar entrada de inventario de plantas',
                'description' => 'Permite almacenar la entrada de plantas al inventario',
                'description_english' => 'Allows storing the entry of plants to the inventory',
            ],
            [
                'slug' => 'gvff.admin.plant_inventory.sale.index',
                'name' => 'Ver ventas de plantas',
                'description' => 'Permite ver las ventas de plantas realizadas',
                'description_english' => 'Allows viewing the plant sales made',
            ],
            [
                'slug' => 'gvff.admin.plant_inventory.sale.getPlantsByWarehouse',
                'name' => 'Obtener plantas por almacén',
                'description' => 'Permite obtener las plantas disponibles en un almacén específico para la venta',
                'description_english' => 'Allows obtaining available plants in a specific warehouse for sale',
            ],
            [
                'slug' => 'gvff.admin.plant_inventory.sale.searchPerson',
                'name' => 'Buscar persona para venta de plantas',
                'description' => 'Permite buscar una persona para realizar una venta de plantas',
                'description_english' => "Allows searching for a person to make a plant sale",
            ],
            [
                'slug' => 'gvff.admin.plant_inventory.sale.store',
                'name' => "Procesar venta de plantas",
                "description" => "Permite procesar la venta de plantas y actualizar el inventario",
                "description_english" => "Allows processing the sale of plants and updating the inventory",
            ],
           [
               'slug' => "gvff.admin.plant_inventory.sale.history",
               'name' => "Historial de ventas de plantas",
               'description' => "Permite ver el historial de ventas de plantas",
               'description_english' => "Allows viewing the history of plant sales",
           ]

        ];

        // Crear permisos para Faunas y añadirlos a la lista de permisos del administrador
        foreach ($faunas_permissions as $perm) {
            $permission = Permission::updateOrCreate(
                ['slug' => $perm['slug']],
                [
                    'name' => $perm['name'],
                    'description' => $perm['description'],
                    'description_english' => $perm['description_english'],
                    'app_id' => $app->id
                ]
            );
            $permissions_admin[] = $permission->id;
        }
    

        // Consultar rol de administrador
        $rol_admin = Role::where('slug', 'gvff.admin')->first();

        // Asignar permisos al rol administrador
        if ($rol_admin) {
            $rol_admin->permissions()->syncWithoutDetaching($permissions_admin);
        }
    }
}