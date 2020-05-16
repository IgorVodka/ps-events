<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SeederOfEverything extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eventId = DB::table('events')->insertGetId([
           'name' => 'Донорство (25 февраля 2020)',
           'description' => Str::random(32),
           'agreement' => 'Я подтверждаю, что:
                        <ul>
                            <li>ознакомлен(а) с правилами проведения мероприятия</li>
                            <li>буду соблюдать режим питания до сдачи крови</li>
                            <li>мой вес более 50 кг.</li>
                        </ul>',
           'notification_letter' => 'Какой-то подтверждающий текст. Если хотите отменить, пишите сюда-то блабла.',
           'closing_time' => time() + 3600
        ]);

        $slotId = DB::table('slots')->insertGetId([
            'event_id' => $eventId,
            'name' => '10:00',
            'capacity' => 1
        ]);

        DB::table('slots')->insert([
            'event_id' => $eventId,
            'name' => '10:30',
            'capacity' => 2
        ]);

        DB::table('slots')->insert([
           'event_id' => $eventId,
           'name' => '11:00',
           'capacity' => 3
       ]);

        DB::table('participants')->insert([
            'slot_id' => $slotId,
            'name' => Str::random(32),
            'group' => Str::random(32),
            'student_ticket' => Str::random(16),
            'email' => Str::random(32),
            'phone' => Str::random(32),
            'vk_link' => Str::random(32)
        ]);
    }
}
