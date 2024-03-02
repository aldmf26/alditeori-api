<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index(Request $r)
    {
        $searchTerm = $r->s;
        $blog = Blog::select(
            'id',
            'judul',
            'content',
            'img_heading',
            'tags',
            'user_id',
            'created_at as tgl_publish'
         )
         ->when($searchTerm, function ($query) use ($searchTerm) {
            $query->where('judul', 'LIKE', '%' . $searchTerm . '%');
        })
        ->with('user')
        ->paginate(2);
        $data = [
            'title' => 'Blog',
            'blog' =>$blog,
        ];
        return Inertia::render("Blog/Index", $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Add Blog',
        ];
        return Inertia::render("Blog/Add", $data);
    }

    public function create(Request $r)
    {
        Blog::create([
            'judul' => $r->judul,
            'img_heading' => $r->img_heading,
            'content' => $r->content,
            'user_id' => auth()->user()->id
        ]);
        return to_route('blog.index')->with('message', 'Data berhasil disimpan.');
    }
}
