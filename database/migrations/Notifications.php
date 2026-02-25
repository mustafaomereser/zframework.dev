<?php

namespace Database\Migrations;

#[\AllowDynamicProperties]
class Notifications
{
    static $storageEngine = "InnoDB";
    static $charset       = "utf8mb4_general_ci";
    static $table         = "notifications";
    static $db            = "local";
    static $prefix        = "";

    public static function columns()
    {
        return [
            'id'      => ['primary'],
            'user_id' => ['int'],
            'seen'    => ['bool', 'default:0'],
            'timestamps'
        ];
    }

    # e.g. a self seeder 
    # public static function oncreateSeeder()
    # {
    #     $user = new User;
    #     $user->insert([
    #         'username'  => 'admin',
    #         'password'  => Crypter::encode('admin'),
    #         'email'     => Str::rand(15) . '@localhost.com',
    #         'api_token' => Str::rand(60)
    #     ]);
    # }
}
