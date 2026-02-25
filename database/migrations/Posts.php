<?php

namespace Database\Migrations;

#[\AllowDynamicProperties]
class Posts
{
    static $storageEngine = "InnoDB";
    static $charset       = "utf8mb4_general_ci";
    static $table         = "posts";
    static $db            = "local";
    static $prefix        = "";

    public static function columns()
    {
        return [
            'id'       => ['primary'],
            'target'   => ['varchar'],
            'content'  => ['text'],
            'user_id'  => ['int'],
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
