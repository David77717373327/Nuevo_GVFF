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

            //// Permisos para el CRUD de Herramientas

            [
                'slug' => 'gvff.admin.tools.index',
                'name' => 'Ver lista de herramientas',
                'description' => 'Permite ver la lista de herramientas disponibles',
                'description_english' => 'Allows viewing the list of available tools',
            ],
            [
                'slug' => 'gvff.admin.tools.assign',
                'name' => 'Asignar herramienta',
                'description' => 'Permite mostrar el formulario para asignar herramientas a una labor',
                'description_english' => 'Allows displaying the form to assign tools to a labor',
            ],
            [
                'slug' => 'gvff.admin.tools.store',
                'name' => 'Almacenar asignación de herramienta',
                'description' => 'Permite guardar la asignación de una herramienta a una labor',
                'description_english' => 'Allows storing the assignment of a tool to a labor',
            ],
            [
                'slug' => 'gvff.admin.tools.assigned',
                'name' => 'Ver herramientas asignadas',
                'description' => 'Permite ver la lista de herramientas asignadas',
                'description_english' => 'Allows viewing the list of assigned tools',
            ],
            [
                'slug' => 'gvff.admin.tools.release',
                'name' => 'Liberar herramienta',
                'description' => 'Permite liberar una herramienta asignada',
                'description_english' => 'Allows releasing an assigned tool',
            ],
            [
                'slug' => 'gvff.admin.tools.create',
                'name' => 'Crear herramienta',
                'description' => 'Permite mostrar el formulario para crear una nueva herramienta',
                'description_english' => 'Allows displaying the form to create a new tool',
            ],
            [
                'slug' => 'gvff.admin.tools.store',
                'name' => 'Almacenar herramienta',
                'description' => 'Permite guardar una nueva herramienta',
                'description_english' => 'Allows storing a new tool',
            ],
            
            [
                'slug' => 'gvff.admin.tools.storeAssign',
                'name' => 'Almacenar asignación de herramienta',
                'description' => 'Permite guardar la asignación de una herramienta a una labor',
                'description_english' => 'Allows storing the assignment of a tool to a labor',
            ],

            [   'slug' => 'gvff.admin.labors.index',
                'name' => 'Ver lista de labores',
                'description' => 'Permite ver la lista de labores',
                'description_english' => 'Allows viewing the list of labors',
            ],
            [
                'slug' => 'gvff.admin.labors.create',
                'name' => 'Crear labor',
                'description' => 'Permite mostrar el formulario para crear una nueva labor',
                'description_english' => 'Allows displaying the form to create a new labor',
            ],
            [
                'slug' => 'gvff.admin.labors.store',
                'name' => 'Almacenar labor',
                'description' => 'Permite guardar una nueva labor',
                'description_english' => 'Allows storing a new labor',
            ],
            [
                'slug' => 'gvff.admin.labors.edit',
                'name' => 'Editar labor',
                'description' => 'Permite mostrar el formulario para editar una labor existente',
                'description_english' => 'Allows displaying the form to edit an existing labor',
            ],
            [
                'slug' => 'gvff.admin.labors.update',
                'name' => 'Actualizar labor',
                'description' => 'Permite actualizar una labor editada',
                'description_english' => 'Allows updating labors',
            ],
            [
                'slug' => 'gvff.admin.labors.destroy',
                'name' => 'Eliminar labor',
                'description' => 'Permite eliminar una labor',
                'description_english' => 'Allows deleting labors',
            ],

            //permisos para suministros
            [
                'slug' => 'gvff.admin.supplies.index',
                'name' => 'Ver lista de suministros',
                'description' => 'Permite ver la lista de suministros',
                'description_english' => 'Allows viewing the list of supplies',
            ],
            [
                'slug' => 'gvff.admin.supplies.create',
                'name' => 'Crear suministro',
                'description' => 'Permite mostrar el formulario para crear un nuevo suministro',
                'description_english' => 'Allows displaying the form to create a new supply',
            ],
            [
                'slug' => 'gvff.admin.supplies.store',
                'name' => 'Almacenar suministro',
                'description' => 'Permite guardar un nuevo suministro',
                'description_english' => 'Allows storing a new supply',
            ],
            [
                'slug' => 'gvff.admin.supplies.edit',
                'name' => 'Editar suministro',
                'description' => 'Permite mostrar el formulario para editar un suministro existente',
                'description_english' => 'Allows displaying the form to edit an existing supply',
            ],
            [
                'slug' => 'gvff.admin.supplies.update',
                'name' => 'Actualizar suministro',
                'description' => 'Permite actualizar un suministro editado',
                'description_english' => 'Allows updating supplies',
            ],
            [
                'slug' => 'gvff.admin.supplies.destroy',
                'name' => 'Eliminar suministro',
                'description' => 'Permite eliminar un suministro',
                'description_english' => 'Allows deleting supplies',
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