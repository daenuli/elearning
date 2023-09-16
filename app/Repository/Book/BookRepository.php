<?php

namespace App\Repository\Book;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repository\Book\BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface
{
    /**
     * @param Request $request
     * 
     * @return Response
     */
    public function index()
    {
        return Book::with(['school_class', 'subject:id,title'])->get();
    }

    /**
     * @param Request $request
     * 
     * @return bool
     */
    public function store(Request $request): bool
    {
        try {

            $book = Book::create([
                'title'      => $request->title,
                'class_id'   => $request->class_id,
                'subject_id' => $request->subject_id,
            ]);

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = $book->title.'.'.$file->extension();
                $book->addMedia($file)->usingFileName($fileName)->toMediaCollection('Book File');
			}

            return true;
        } catch (\Throwable $th) {
            logError($th);
            return false;
        }
    }

    /**
     * @param App\Models\Book $book
     * @param Illuminate\Http\Request $request
     */
    public function update(Request $request, Book $book)
    {
        try {
            $book->update([
                'title'      => $request->title,
                'class_id'   => $request->class_id,
                'subject_id' => $request->subject_id,
            ]);

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = $book->title.'.'.$file->extension();
                $book->addMedia($file)->usingFileName($fileName)->toMediaCollection('Book File');
			}

            return true;
        } catch (\Throwable $th) {
            logError($th);
            return false;
        }
    }
}