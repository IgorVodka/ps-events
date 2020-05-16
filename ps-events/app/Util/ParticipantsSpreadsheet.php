<?php

namespace App\Util;

use App\Model\Event;
use App\Model\Participant;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ParticipantsSpreadsheet
{
    private $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function generate(): StreamedResponse
    {
        $fileName = "{$this->event->name}.xlsx";

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle($this->event->name);

        $columns = $this->getColumns();

        $rows = [
            // Header row
            array_column($columns, 'title')
        ];

        foreach ($this->event->slots as $slot) {
            foreach ($slot->participants as $participant) {
                if (!$participant->activated) {
                    continue;
                }

                $row = [];
                foreach ($columns as $letter => ['key' => $objectKey]) {
                    $row[] = object_get($participant, (string) $objectKey);
                }
                $rows[] = $row;
            }
        }

        $sheet->fromArray($rows);

        $lastColumn = array_key_last($columns);

        $sheet->getStyle("A1:{$lastColumn}1")->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setRGB('DDDDDD');

        foreach (array_keys($columns) as $columnKey) {
            $sheet->getColumnDimension($columnKey)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);

        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"'
        ];

        return response()->streamDownload(
            function () use ($writer) {
                $writer->save('php://output');
            },
            $fileName,
            $headers
        );
    }

    private function getColumns(): array
    {
        return [
            'A' => ['title' => 'ID', 'key' => 'id'],
            'B' => ['title' => 'Время', 'key' => 'slot.name'],
            'C' => ['title' => 'Группа', 'key' => 'group'],
            'D' => ['title' => 'Студ. билет', 'key' => 'student_ticket'],
            'E' => ['title' => 'Email', 'key' => 'email'],
            'F' => ['title' => 'Телефон', 'key' => 'phone'],
            'G' => ['title' => 'VK', 'key' => 'vk_link']
        ];
    }
}
