<?php

namespace App\Http\Controllers\Admin;

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $books = Book::with(['school_class', 'subject:id,title']);
        if ($request->class_id) {
            $books = $books->where('class_id', $request->class_id);
        }

        if ($request->subject_id) {
            $books = $books->where('subject_id', $request->subject_id);
        }

        if ($request->title) {
            $books = $books->where('title', 'like', '%'.$request->title.'%');
        }

        $books = $books->get();

        return response()->json($books, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Books/Index', [
            'subjects' => Subject::all(),
            'classes' => app(SchoolClassRepositoryInterface::class)->index(),
            'books' => $this->repository->index(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Books/Create', [
            'subjects' => Subject::all(),
            'classes' => app(SchoolClassRepositoryInterface::class)->index()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->repository->store($request);

        if ($result) {
            return redirect()->route('admin.books.index')->with('success', 'Book created successfully.');
        }

        return redirect()->route('admin.books.index')->with('error', serverErrorMessage());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return Inertia::render('Admin/Books/Show', [
            'book' => $book
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return Inertia::render('Admin/Books/Edit', [
            'classes' => app(SchoolClassRepositoryInterface::class)->index(),
            'subjects' => Subject::all(),
            'book' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $result = $this->repository->update($request, $book);

        if ($result) {
            return redirect()->route('admin.books.index', $book)->with('success', 'Book updated successfully.');
        }

        return redirect()->route('admin.books.index')->with('error', serverErrorMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully.');
    }
}
