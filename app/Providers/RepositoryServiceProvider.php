<?php

namespace App\Providers;

use App\Repository\Book\BookRepository;
use App\Repository\User\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\Lesson\LessonRepository;
use App\Repository\Student\StudentRepository;
use App\Repository\Teacher\TeacherRepository;
use App\Repository\Question\QuestionRepository;
use App\Repository\Book\BookRepositoryInterface;
use App\Repository\User\UserRepositoryInterface;
use App\Repository\Assessment\AssessmentRepository;
use App\Repository\Assignment\AssignmentRepository;
use App\Repository\StudyGroup\StudyGroupRepository;
use App\Repository\Lesson\LessonRepositoryInterface;
use App\Repository\SchoolClass\SchoolClassRepository;
use App\Repository\Student\StudentRepositoryInterface;
use App\Repository\Teacher\TeacherRepositoryInterface;
use App\Repository\Question\QuestionRepositoryInterface;
use App\Repository\Assessment\AssessmentRepositoryInterface;
use App\Repository\Assignment\AssignmentRepositoryInterface;
use App\Repository\StudyGroup\StudyGroupRepositoryInterface;
use App\Repository\Assessment\AssessmentEvaluationRepository;
use App\Repository\Assignment\AssignmentEvaluationRepository;
use App\Repository\SchoolClass\SchoolClassRepositoryInterface;
use App\Repository\Assessment\AssessmentEvaluationRepositoryInterface;
use App\Repository\Assignment\AssignmentEvaluationRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
        $this->app->bind(LessonRepositoryInterface::class, LessonRepository::class);
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
        $this->app->bind(TeacherRepositoryInterface::class, TeacherRepository::class);
        $this->app->bind(QuestionRepositoryInterface::class, QuestionRepository::class);
        $this->app->bind(StudyGroupRepositoryInterface::class, StudyGroupRepository::class);
        $this->app->bind(AssignmentRepositoryInterface::class, AssignmentRepository::class);
        $this->app->bind(AssessmentRepositoryInterface::class, AssessmentRepository::class);
        $this->app->bind(SchoolClassRepositoryInterface::class, SchoolClassRepository::class);
        $this->app->bind(AssignmentEvaluationRepositoryInterface::class, AssignmentEvaluationRepository::class);
        $this->app->bind(AssessmentEvaluationRepositoryInterface::class, AssessmentEvaluationRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}