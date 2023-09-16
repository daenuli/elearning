<?php

namespace App\Exports;

use App\Models\Teacher;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TeachersExport implements FromArray, WithHeadings, WithColumnWidths, WithStyles, WithEvents, WithMapping
{
    private $columns = array(
        'name',
        'email',
        'education',
        'gender',
        'religion',
        'appointment_decree',
        'date'
    );

    private $headings = array(
        'Name',
        'Email',
        'Education',
        'Gender',
        'religion',
        'Appointment Decree',
        'TMT: Date',
        'Delete Teacher',
    );

    public function array(): array
    {
        return Teacher::get($this->columns)->toArray();

    }

    public function headings(): array
    {
        return $this->headings;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 40,
            'B' => 40,
            'C' => 20,
            'D' => 20,
            'E' => 20,
            'F' => 30,
            'G' => 30,
            'H' => 30,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            'A1' => ['font' => ['bold' => true]],
            'B1' => ['font' => ['bold' => true]],
            'C1' => ['font' => ['bold' => true]],
            'D1' => ['font' => ['bold' => true]],
            'E1' => ['font' => ['bold' => true]],
            'F1' => ['font' => ['bold' => true]],
            'G1' => ['font' => ['bold' => true]],
            'H1' => ['font' => ['bold' => true]],
        ];
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:H1000')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            },
        ];
    }

    /**
    * @var Teacher $teacher
    */
    public function map($teacher): array
    {
        return [
            $teacher['name'],
            $teacher['email'],
            $teacher['education'],
            $teacher['gender'],
            $teacher['religion'],
            $teacher['appointment_decree'],
            Carbon::parse($teacher['date'])->format('m/d/Y'),
            'No'
        ];
    }
}
