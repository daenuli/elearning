<?php

namespace App\Exports;

use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\StudyGroup;
use Carbon\Carbon;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StudentsExport implements FromArray, WithHeadings, WithColumnWidths, WithStyles, WithEvents, WithMapping
{
    private $columns = array(
        'name',
        'email',
        'NISN_number',
        'class_id',
        'study_group_id',
        'place_of_birth',
        'gender',
        'religion',
        'date_of_birth',
    );

    private $headings = array(
        'Name',
        'Email',
        'NISN',
        'Class',
        'Study Group',
        'Place of Birth',
        'Gender',
        'religion',
        'Date of Birth',
        'Delete Student',
    );

    public function array(): array
    {
        return Student::whereHas('user')->get($this->columns)->toArray();

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
            'G' => 20,
            'H' => 20,
            'I' => 20,
            'J' => 20,
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
            'I1' => ['font' => ['bold' => true]],
            'J1' => ['font' => ['bold' => true]],
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
                $event->sheet->getDelegate()->getStyle('A1:J1000')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }

    /**
    * @var Student $student
    */
    public function map($student): array
    {
        $class = SchoolClass::find($student['class_id']);
        $study_group = StudyGroup::find($student['study_group_id']);

        return [
            $student['name'],
            $student['email'],
            $student['NISN_number'],
            $class?->name,
            $study_group?->name,
            $student['place_of_birth'],
            $student['gender'],
            $student['religion'],
            Carbon::parse($student['date_of_birth'])->format('m/d/Y'),
            'No'
        ];
    }
}
