<?php

use App\Entities\Role;
use App\Entities\User;
use App\Entities\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        factory(User::class, 500)->create();

        $roleClient = Role::where('name', 'Cliente')->first()->id;
        $already_have_role = UserRole::select('user_id')->get()->toArray();
        $users_whitout_role = User::whereNotIn('id', $already_have_role)->select('id')->get()->toArray();
        $final_insert = [];
        foreach($users_whitout_role as $user){
            array_push($final_insert,[
                'user_id' => $user['id'],
                'role_id' => $roleClient,
            ]);
        }
        DB::table('user_roles')->insert($final_insert);

//
    }
}
