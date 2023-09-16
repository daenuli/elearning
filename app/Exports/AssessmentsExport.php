<?php

namespace App\Exports;

use App\Models\Assessment;
use Illuminate\Support\Carbon;
use App\Models\AssessmentStudent;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AssessmentsExport implements FromQuery, WithHeadings, WithColumnWidths, WithStyles, WithEvents, WithMapping
{
	use Exportable;

	/**
	 * AssessmentsExport constructor
	 * @param Assessment $assessment
	 */
	public function __construct(private Assessment $assessment)
	{
	}

	public function query()
	{
		return AssessmentStudent::query()
			->select('students.name', 'assessment_student.submitted_at', 'assessment_student.marks_obtained')
			->join('students', 'students.id', '=', 'assessment_student.student_id')
			->where('assessment_student.status', 'Completed')
			->where('assessment_student.assessment_id', $this->assessment->id);
	}

	public function headings(): array
	{
		return [
			[
				'Assignment Title',
				$this->assessment->title,
			],
			[
				'Subject',
				$this->assessment->subject->title,
			],
			[],
			[
				'Name of Student',
				'Submitted Date',
				'Marks Obtained',
			]
		];
	}

	public function columnWidths(): array
	{
		return [
			'A' => 30,
			'B' => 30,
			'C' => 30,
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
                $event->sheet->getDelegate()->getStyle('A1:C1000')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }

	public function map($assessment): array
    {
        return [
            $assessment->name,
            Carbon::parse($assessment->submitted_at)->format('M j, Y'),
            $assessment->marks_obtained,
        ];
    }
}
