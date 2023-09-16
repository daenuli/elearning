<?php

namespace App\Exports;

use App\Models\lesson;
use Illuminate\Support\Carbon;
use App\Models\LessonStudent;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LessonRportsExport implements FromQuery, WithHeadings, WithColumnWidths, WithStyles, WithEvents, WithMapping
{
	use Exportable;

	/**
	 * LessonRportsExport constructor
	 * @param Lesson $lesson
	 */
	public function __construct(private Lesson $lesson)
	{
	}

	public function query()
	{
		return LessonStudent::query()
			->select('students.name', 'lesson_student.video_progress', 'lesson_student.access_date')
			->join('students', 'students.id', '=', 'lesson_student.student_id')
			->where('lesson_student.lesson_id', $this->lesson->id)
            ->where('students.class_id', $this->lesson->class_id)
			->where('students.study_group_id', $this->lesson->study_group_id);
	}

	public function headings(): array
	{
		return [
			[
				'Lesson Title',
				$this->lesson->title,
			],
			[
				'Subject',
				$this->lesson->subject->title,
			],
			[],
			[
				'Student Name',
				'Is present?',
				'Access Date',
				'Proggress (%)',
                'Description'
			]
		];
	}

	public function columnWidths(): array
	{
		return [
			'A' => 30,
			'B' => strlen($this->lesson->title),
			'C' => 25,
			'D' => 25,
			'E' => 25,
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
			'E4' => ['font' => ['bold' => true]],
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
                $event->sheet->getDelegate()->getStyle('A1:E1000')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }

	public function map($item): array
    {
        $description = is_null($item->access_date) 
            ? 'not attending lessons'
            : 'taking lessons';

        $access_date = !is_null($item->access_date)
            ? Carbon::parse($item->access_date)->format('M j, Y')
            : '';

        return [
            $item->name,
            is_null($item->access_date) ? 'No' : 'Yes',
            $access_date,
            $item->video_progress,
            $description,
        ];
    }
}
