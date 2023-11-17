<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    public function content()
    {
        $articles = Article::query()->where('is_publish', 1)->latest()->paginate(5);
        $title = 'Content Article';
        return view('frontend.articles.list', compact('articles', 'title'));
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
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $article = Article::with(['program.points' => function ($query) {
            $query->select(['id', 'program_id', 'amount', 'point_type']);
        }])->where('slug', $slug)->first();

        $typePoint = $article->program->points->first()->point_type;

        $user = Auth::user();
        $user->articles()->attach($article, ['read_at' => now()]);

        return view('frontend.articles.show', [
            'article' => $article,
            'title' => $article->title,
            'typePoint' => $typePoint
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
