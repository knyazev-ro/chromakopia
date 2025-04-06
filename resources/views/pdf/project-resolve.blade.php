<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            /* font-family: Times New Roman, serif; */
            font-size: 9pt; /* Размер шрифта (12 пунктов) */
        }

        .dotted-line {
            /* font-family: DejaVu Sans, sans-serif; Важно! */
            display: inline-block;
            justify-content:center;
            border-bottom: 1px dashed #000;
            min-width: 200px;
            margin: 0 5px;
        }
    </style>
</head>
<body>
<div class="container mx-auto p-6 leading-relaxed text-justify">
    <h2 class="text-center text-xl font-bold mb-6">ПРОЕКТ РЕШЕНИЯ</h2>

    <p class="mb-4">
        по вопросу повестки дня заочного голосования<br>
        Совета директоров ПАО «ТНС энерго Ростов-на-Дону»<br>
        <span class="dotted-line">{{ $data }}</span> апреля 2025 года
    </p>

    <h3 class="font-semibold mt-6 mb-2">ПОВЕСТКА ДНЯ:</h3>

    @foreach($agenda as $index => $item)
    <p class="mb-4 font-semibold">ВОПРОС № {{ $index + 1 }}: {{ $item }}</p>
    @endforeach

    <h3 class="font-semibold mt-6 mb-2">ПРОЕКТ РЕШЕНИЯ ПО ВОПРОСУ ПОВЕСТКИ ДНЯ:</h3>
    <p class="mb-6">Проект решения по вопросу № 1:</p>
    @foreach($adopted_agenda as $index => $item)
    <p class="mb-6">Проект решения по вопросу № 1: -- {{ $index + 1 }}: {{ $item }}</p>
    @endforeach

    <p class="mt-10 text-right">
        Председатель Совета директоров<br>
        ПАО «ТНС энерго Ростов-на-Дону»<br><br>
        <span class="dotted-line">{{ $user }}</span>
    </p>
</div>
</body>
</html>