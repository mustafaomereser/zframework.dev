<?php

namespace Database\Migrations;

#[\AllowDynamicProperties]
class Topics
{
    static $storageEngine = "InnoDB";
    static $charset       = "utf8mb4_general_ci";
    static $table         = "topics";
    static $db            = "local";
    static $prefix        = "";

    public static function columns()
    {
        return [
            'id'        => ['primary'],
            'category'  => ['varchar'],
            'tags'      => ['json'],
            'pin'       => ['bool', 'default:0'],
            'title'     => ['varchar'],
            'slug'      => ['varchar:500'],
            'lang'      => ['varchar:5'],
            'author'    => ['int'],
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
