<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFnotification1F extends Controller
{
    public function generateNotice()
    {
        $data = [
            'address' => 'г. Ростов-на-Дону, ул. Пушкинская, д. 10, офис 305',
            'meetingTime' => '17:00',
            'meetingDate' => '15 апреля 2025',
            'agendaItems' => [
                'Утверждение годового отчета',
                'Избрание председателя правления',
                'Распределение прибыли'
            ],
            'mailingAddress' => '344002, г. Ростов-на-Дону, а/я 123',
            'email' => 'secretary@tnsk-rostov.ru',
            'deadlineTime' => '17:00',
            'deadlineDate' => '10 апреля 2025'
        ];

        $pdf = Pdf::loadView('pdf.notification1F', $data);
        return $pdf->download('notice.pdf');
    }
}
