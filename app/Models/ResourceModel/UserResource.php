<?php 

namespace App\Models\ResourceModel;

use App\Models\Interfaces\userInterface;
use App\Models\User;
class UserResource implements userInterface{
    public static function find()
    {
        return User::all();
    }

    /**
     * @return array
     */
    public static function findById($id)
    {
        return User::where("id", "=", $id)->first();
    }
}
?>