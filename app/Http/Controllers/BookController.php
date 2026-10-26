<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (Category::count() == 0) {
            Category::insert(['name' => 'sach tre cong'],
                ['name' => 'sach thieu nhi'],
                ['name' => 'sach nguoi lon'],
        );
        }
        $Search = request()->query('search');
        $Books = Book::with('category')->when($Search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                ->orWhere('author', 'like', "%{$search}%");
        })->orderBy('id', 'desc')->get();
        $Categories = Category::all();
        return view('books.index', compact('Books', 'Categories','Search'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);
        Book::create($request->all());
        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book, $id)
    {
        //
        $Book = Book::findOrFail($id);
        $Categories = Category::all();
        return view('books.edit', compact('Book', 'Categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book, $id)
    {
        //
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);
        $book = Book::findOrFail($id);
        $book->update($request->all());
        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book, $id)
    {
        //
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
