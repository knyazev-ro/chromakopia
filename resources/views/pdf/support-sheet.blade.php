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
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold text-center mb-4">СОВЕТ ДИРЕКТОРОВ</h2>
    <h3 class="text-lg text-center mb-6">Публичного акционерного общества «ТНС энерго Ростов-на-Дону»</h3>
    
    <h4 class="text-xl font-semibold mb-2">ОПРОСНЫЙ ЛИСТ</h4>
    <p class="mb-4">для голосования по вопросу повестки дня<br>заочного голосования Совета директоров ПАО «ТНС энерго Ростов-на-Дону»,
         проводимого <span class="dotted-line">{{ $data }}</span> апреля 2025 года</p>
    
    <p class="mb-4">Вы можете высказать свое мнение по вопросу, оставив не зачеркнутым вариант ответа, соответствующий Вашему решению.</p>
    
    <h4 class="text-lg font-semibold mb-2">ВОПРОС № 1:</h4>
    @foreach($agenda as $index => $item)
    <p class="mb-6">ВОПРОС № {{ $index + 1 }}: {{ $item }}</p>
    <p class="mb-4">Решение:</p>
    
    <div class="mb-4">
        <label class="inline-flex items-center">
            <input type="radio" name="vote" value="ЗА" class="form-radio"> ЗА
        </label>
        <label class="inline-flex items-center ml-6">
            <input type="radio" name="vote" value="ПРОТИВ" class="form-radio"> ПРОТИВ
        </label>
        <label class="inline-flex items-center ml-6">
            <input type="radio" name="vote" value="ВОЗДЕРЖАЛСЯ" class="form-radio"> ВОЗДЕРЖАЛСЯ
        </label>
    </div>
    @endforeach
    
    <p class="mb-4">
        Заполненный и подписанный опросный лист необходимо направить по электронному адресу: 
        <span class="dotted-line">{{ $email }}</span> либо в оригинале не позднее 17:00 часов по московскому 
        времени <span class="dotted-line">{{ $data }}</span> апреля 2025 года.
    </p>

    <p class="mb-4">
        Опросный лист, поступивший в Общество по истечении вышеуказанного срока, 
        не учитывается при подсчете голосов и подведении итогов голосования.
    </p>
    
    <p class="mb-4">
        Оригинал опросного листа просьба направить по адресу: 
        <span class="dotted-line">{{ $address ?? '' }}</span>, 
        Совет директоров ПАО «ТНС энерго Ростов-на-Дону», 
        <span class="dotted-line">{{ $recipient ?? '' }}</span>.
    </p>
</div>
</body>
</html>
