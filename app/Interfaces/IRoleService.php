<?php

namespace App\Interfaces;

interface IRoleService
{
    
    public function setPolicy(int $user_id, string $role_type, string $act): void;
    
    public function deletePolicy(int $user_id, string $role_type, string $act): void;    

    public function getPermission(int $user_id, string $obj, string $act);
}
