<?php

namespace App\Http\Controllers;

use App\Models\TaskCategory;
use Illuminate\Http\Request;

class TaskCategoryController extends Controller
{
    public function index()
    {
        $categories = TaskCategory::orderBy('name')->paginate(10);
        return view('category.index', compact('categories'));
    }

    public function create()
    {   
        $category = null;
        return view('category.create', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|max:50']);
        TaskCategory::create(['name' => $request->name]);
        return redirect()->route('category.index')->with('success', 'Category added successfully');
    }

    public function edit(TaskCategory $category)
    {
        return view('category.create', compact('category'));
    }

    public function update(Request $request, TaskCategory $category)
    {
        $request->validate(['name' => 'required|max:50']);
        $category->update(['name' => $request->name]);
        return redirect()->route('category.index')->with('success', 'Category updated successfully');
    }

    public function destroy(TaskCategory $category)
    {
        $category->delete();
        return redirect()->route('category.index')->with('danger', 'Category deleted successfully');
    }
}
