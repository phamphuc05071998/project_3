<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::all();
        return view('programs.index', compact('programs'));
    }

    public function create()
    {
        $products = Product::all();
        return view('programs.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'points' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
        ]);

        $program = Program::create($request->only('name', 'description', 'points', 'start_date', 'end_date'));
        $program->products()->sync($request->products);

        return redirect()->route('programs.index')->with('success', 'Program created successfully.');
    }

    public function edit(Program $program)
    {
        $products = Product::all();
        return view('programs.edit', compact('program', 'products'));
    }

    public function update(Request $request, Program $program)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'points' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
        ]);

        $program->update($request->only('name', 'description', 'points', 'start_date', 'end_date'));
        $program->products()->sync($request->products);

        return redirect()->route('programs.index')->with('success', 'Program updated successfully.');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('programs.index')->with('success', 'Program deleted successfully.');
    }
}
