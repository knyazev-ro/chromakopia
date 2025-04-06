<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Уведомление о заочном голосовании</title>
    <style>
        body {
            /* font-family: Times New Roman, serif; */
            font-size: 9pt; /* Размер шрифта (12 пунктов) */
        }

        .dotted-line {
            /* font-family: DejaVu Sans, sans-serif; Важно! */
            display: inline-block;
            border-bottom: 1px dashed #000;
            min-width: 200px;
            margin: 0 5px;
        }
    </style>
</head>
<body>
<div class="container mx-auto p-6 leading-relaxed text-justify">
    <p class="mb-8 text-right">Членам Совета директоров<br>ПАО «ТНС энерго Ростов-на-Дону»</p>

    <h2 class="text-center text-xl font-bold mb-6">УВЕДОМЛЕНИЕ</h2>

    <p class="mb-4">
        Настоящим сообщаю Вам о проведении заочного голосования Совета директоров ПАО «ТНС энерго Ростов-на-Дону».<br>
        Итоги заочного голосования Совета директоров будут подводиться по адресу: 
        <span class="dotted-line">{{ $address }}</span> 
        в {{ $meetingTime }} часов по московскому времени 
        <span class="dotted-line">{{ $meetingDate }}</span>.
    </p>

    <p class="mb-4">
        В повестку дня заочного голосования Совета директоров ПАО «ТНС энерго Ростов-на-Дону» включены следующие вопросы:
    </p>

    @foreach($agendaItems as $index => $item)
    <p class="mb-4 font-semibold">ВОПРОС № {{ $index + 1 }}: {{ $item }}</p>
    @endforeach

    <p class="mb-4">
        Заполненный и подписанный опросный лист для заочного голосования по вопросу повестки дня прошу направить по адресу: 
        <span class="dotted-line">{{ $mailingAddress }}</span>,
        предварительно направив его по электронному адресу: 
        <span class="dotted-line">{{ $email }}</span> 
        в срок, не позднее {{ $deadlineTime }} часов по московскому времени 
        <span class="dotted-line">{{ $deadlineDate }}</span>.
    </p>

    <p class="mt-10 text-right">
        Председатель Совета директоров<br>
        ПАО «ТНС энерго Ростов-на-Дону»<br><br>
        ___________________
    </p>
</div>
</body>
</html>