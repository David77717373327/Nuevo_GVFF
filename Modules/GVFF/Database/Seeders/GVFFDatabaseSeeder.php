<?php

namespace Modules\GVFF\Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\User;
use Modules\SICA\Entities\Person;

use Modules\SICA\Entities\Permission;

use Modules\GVFF\Database\Seeders\AppTableSeeder;

class GVFFDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

         $this->call(AppTableSeeder::class);
         $this->call(PeopleTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(RolesTableSeeder::class);
         $this->call(PermissionsTableSeeder::class);


         DB::commit();
        
    }
}
