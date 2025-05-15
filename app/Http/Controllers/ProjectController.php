<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $posts = Project::all();
        return view('project', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        Project::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('crud.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $post = Project::findOrFail($id);
        $post->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('crud.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $post = Project::findOrFail($id);
        $post->delete();

        return redirect()->route('crud.index')->with('success', 'Data berhasil dihapus!');
    }
}
