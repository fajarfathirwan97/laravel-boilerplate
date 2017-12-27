<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRole = new RoleUser;
        $role = new Role;
        $role->truncate();
        \DB::beginTransaction();
        try{
            $role = $role->create(['name'=>'admin','slug'=>'admin','uuid'=>\Uuid::generate(4)]);
            $user = \Sentinel::registerAndActivate(['username'=>'superadmin','first_name'=>'admin','last_name'=>'admin','email'=>'admin@boilerplate.com','password'=>'admin','uuid'=>\Uuid::generate(4)]);
            $role->users()->attach($user->id);
        \DB::commit();
        }catch(\Exception $e){
            dd($e->getMessage(),$e->getFile(),$e->getLine());
            \DB::rollback();
        }
    }
}
