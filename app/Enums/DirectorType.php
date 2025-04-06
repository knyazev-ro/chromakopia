<?php

namespace App\Enums;

use App\Traits\AllTrait;

enum DirectorType: int
{
    use AllTrait;

    case BOARD_MEMBER = 1;
    case COMMITTEE_MEMBER = 2;
    case ADMIN = 3;

    public function label(): string
    {
        return match ($this) {
            self::COMMITTEE_MEMBER => 'Член комитета',
            self::BOARD_MEMBER => 'Член совета',
            self::ADMIN => "Администратор"
        };
    }
}
