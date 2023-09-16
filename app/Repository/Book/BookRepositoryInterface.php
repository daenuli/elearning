<?php

namespace App\Repository\Book;

use App\Models\Book;
use Illuminate\Http\Request;

interface BookRepositoryInterface {

    /**
     * @param Request $request
     * 
     * @return Response
     */
    public function index();
    
    /**
     * @param Illuminate\Http\Request $request
     * @return bool
     */
    public function store(Request $request): bool;

    /**
     * @param App\Models\Book $book
     * @param Illuminate\Http\Request $request
     */
    public function update(Request $request, Book $book);
}