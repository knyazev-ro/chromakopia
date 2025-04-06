<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFsupportSheet extends Controller
{
    public function generateNotice()
    {
        $data = [
            'data' => '6',
            'agenda' => [
                'Утверждение годового отчета',
                'Избрание председателя правления',
                'Распределение прибыли'
            ],
            'selectedOption' => '1',
            'email' => 'TNSrostov@mail.ru',
            'address' => 'ул.Тытино г. Ростов на дону',
            'recipient'=> 'Иван Ивановичь Иванов',
            
        ];

        $pdf = Pdf::loadView('pdf.support-sheet', $data);
        return $pdf->download('notice.pdf');
    }
}
