<?php

namespace App\Enums;

use App\Traits\AllTrait;

enum RoleType:string
{
    use AllTrait;

    case ADMIN = 'ADMIN';
    case DIRECTOR = 'DIRECTOR';
    case COMMITET_DIRECTOR = 'COMMITET_DIRECTOR';

    public function label():string
    {
        return match($this){
            self::ADMIN => 'Секретарь',
            self::DIRECTOR => 'Член совета директоров',
            self::COMMITET_DIRECTOR => 'Член коммитета совета директоров',
        };
    }
}
