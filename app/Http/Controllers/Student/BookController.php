<?php

namespace App\Http\Controllers\Student;

use App\Models\Book;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Repository\Book\BookRepositoryInterface;
use App\Repository\SchoolClass\SchoolClassRepositoryInterface;

class BookController extends Controller
{
    /**
     * ClassController constructor
     * @param App\Repository\Custom\BookRepositoryInterface $repository
     */
    public function __construct(private BookRepositoryInterface $repository)
    {
    }

    public function index()
    {
        return Inertia::render('Student/Books/Index', [
            'subjects' => Subject::all(),
            'classes' => app(SchoolClassRepositoryInterface::class)->index(),
            'books' => $this->repository->index()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return Inertia::render('Student/Books/Show', [
            'book' => $book
        ]);
    }

    /**
     * @param Book $book
     * 
     * @return [type]
     */
    public function download(Book $book)
    {
        $media = $book->getFirstMedia('Book File');

        if ($media && file_exists($media->getPath())) {
            return response()->download($media->getPath());
        }

        return redirect()->route('student.books.index')->with('warning', 'Book file does not exist.');
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $books = Book::with('school_class', 'subject');

        if ($request->class_id) {
            $books = $books->where('class_id', $request->class_id);
        }

        if ($request->subject_id) {
            $books = $books->where('subject_id', $request->subject_id);
        }

        $books = $books->get();
        return response()->json($books, 200);
    }

}
