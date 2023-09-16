<?php

namespace App\Exports;

use App\Models\Assignment;
use Illuminate\Support\Carbon;
use App\Models\AssignmentStudent;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AssignmentsExport implements FromQuery, WithHeadings, WithColumnWidths, WithStyles, WithEvents, WithMapping
{
	use Exportable;

	/**
	 * AssignmentsExport constructor
	 * @param Assignment $assignment
	 */
	public function __construct(private Assignment $assignment)
	{
	}

	public function query()
	{
		return AssignmentStudent::query()
			->select(
				'students.name', 
				'assignment_student.submitted_at', 
				'assignment_student.marks_obtained', 
				'assignment_student.file_path'
			)
		->join('students', 'students.id', '=', 'assignment_student.student_id')
		->where('assignment_student.is_completed', true)
		->where('assignment_student.assignment_id', $this->assignment->id);
	}

	public function headings(): array
	{
		return [
			[
				'Assignment Title',
				$this->assignment->title,
			],
			[
				'Subject',
				$this->assignment->subject->title
			],
			[],
			[
				'Name of Student',
				'Submitted Date',
				'Marks Obtained',
				'File',
			]
		];
	}

	public function columnWidths(): array
	{
		return [
			'A' => 30,
			'B' => strlen($this->assignment->title),
			'C' => 30,
			'D' => 80,
		];
	}

	public function styles(Worksheet $sheet)
	{
		return [
			'A1' => ['font' => ['bold' => true]],
			'A2' => ['font' => ['bold' => true]],
			'A4' => ['font' => ['bold' => true]],
			'B4' => ['font' => ['bold' => true]],
			'C4' => ['font' => ['bold' => true]],
			'D4' => ['font' => ['bold' => true]],
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
                $event->sheet->getDelegate()->getStyle('A1:D1000')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }

	public function map($row): array
    {
        return [
            $row->name,
            Carbon::parse($row->submitted_at)->format('M j, Y'),
            $row->marks_obtained,
            $row->file_path_label,
        ];
    }
}
