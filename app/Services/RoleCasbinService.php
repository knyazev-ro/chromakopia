<?php

namespace App\Services;

use App\Interfaces\IRoleService;
use Lauthz\Facades\Enforcer;

class RoleCasbinService implements IRoleService
{
    public function setPolicy(int $user_id, string $obj, string $act='access'): void
    {
        Enforcer::addPolicy("U$user_id", $obj, $act);
    }
    
    public function deletePolicy(int $user_id, string $obj, string $act='access'): void
    {
        Enforcer::removeFilteredPolicy("U$user_id", $obj, $act);
    }

    public function getPermission(int $user_id, string $obj, string $act){
        return Enforcer::hasPermissionForUser("U$user_id", $obj, $act);
    }
}
