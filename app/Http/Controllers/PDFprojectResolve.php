<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class PDFprojectResolve extends Controller
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
            'adopted_agenda' => [
                'Утверждение годового отчета',
                'Распределение прибыли'
            ],
            'user'=> 'Иван Ивановичь Иванов',
            
        ];

        $pdf = Pdf::loadView('pdf.project-resolve', $data);
        return $pdf->download('notice.pdf');
    }
}
