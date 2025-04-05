<?php

namespace Database\Factories;

use App\Models\Agenda;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agenda>
 */
class AgendaFactory extends Factory
{
    // protected $model = Agenda::class;

    public function definition(): array
    {
        $title = [
            'Обсуждение квартальных финансовых отчетов',
            'Планирование стратегии развития на 2025 год',
            'Внедрение новой системы KPI для отделов',
            'Оптимизация внутренних бизнес-процессов',
            'Пересмотр корпоративной политики удаленной работы',
            'Запуск программы лояльности для клиентов',
            'Оценка эффективности маркетинговых кампаний',
            'Обновление политики информационной безопасности',
            'Подготовка к ежегодной аудиторской проверке',
            'Разработка плана цифровой трансформации',
            'Обсуждение слияния с компанией "ТехноПартнер"',
            'Реорганизация структуры управления',
            'Внедрение ESG-стандартов в бизнес',
            'Планирование корпоративного тимбилдинга',
            'Обсуждение результатов опроса сотрудников',
            'Закупка нового офисного оборудования',
            'Переговоры с поставщиками о новых условиях',
            'Подготовка к выставке "Инновации 2025"',
            'Обучение сотрудников работе с CRM-системой',
            'Разработка антикризисного плана',
            'Обсуждение ребрендинга компании',
            'Внедрение системы биометрического доступа',
            'Планирование корпоративного Нового года',
            'Оценка рисков кибербезопасности',
            'Создание программы наставничества',
            'Пересмотр системы премирования',
            'Запуск внутреннего портала для сотрудников',
            'Подготовка годового отчета для акционеров',
            'Обсуждение аренды нового офисного пространства',
            'Разработка плана по сокращению углеродного следа',
            'Внедрение AI-инструментов для аналитики',
            'Обсуждение партнерства с университетами',
            'Планирование хакатона для сотрудников',
            'Обновление корпоративного кодекса этики',
            'Оценка необходимости релокации штаб-квартиры',
            'Запуск программы wellness для сотрудников',
            'Подготовка к сертификации ISO 9001',
            'Обсуждение создания дочерней компании',
            'Разработка плана по диверсификации бизнеса',
            'Презентация нового продукта для инвесторов'
        ];

        return [
            'name' => fake()-> randomElement($title),
        ];
    }
}
