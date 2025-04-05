<?php

namespace App\Enums;

use App\Traits\AllTrait;

enum MeetingFormatType: int
{
    use AllTrait;

    case IN_PERSON = 1;         // Очно
    case REMOTE = 2;            // Заочно
    case HYBRID = 3;            // Очно-заочно (Видеоконференция)

    public function label(): string
    {
        return match($this) {
            self::IN_PERSON => 'Очно',
            self::REMOTE => 'Заочно',
            self::HYBRID => 'Очно-заочно (Видеоконференция)',
        };
    }
}
