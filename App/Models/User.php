<?php

namespace App\Models;

use zFramework\Core\Abstracts\Model;
use zFramework\Core\Traits\DB\softDelete;

class User extends Model
{
    use softDelete;

    public $table       = "users";
    public $_not_found  = 'User is not found.';

    public $special_columns = [
        'email'          => 'email',
        'password'       => 'password',
        'passwordencode' => 'crypter' # crypter | md5
    ];
}
