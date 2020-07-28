<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticlesController extends Controller
{
    public function show(Article $article){
        //$article = Article::findOrFail($id);

        return view('articles.show', ['article' => $article ]);
    }

    public function index(){
        $articles = Article::latest()->get();

        return view('articles.index', ['articles' => $articles ]);
    }

    public function create(){
      return view('articles.create');
    }

    public function store(){
      Article::create(request()->validate([
        'title' => 'required',
        'excerpt' => 'required',
        'body' => 'required'
      ]));

      /*$article = new Article();

      $article->title = request('title');
      $article->excerpt = request('excerpt');
      $article->body = request('body');

      $article->save();
      */

      return redirect('/articles');

    }

    public function edit(Article $article){
      //$article = Article::find($id);
      return view('articles.edit',['article' => $article]);
    }

    public function update(Article $article){

      $article->update($this->validateArticle());

      //$article = Article::find($id);

      /*$article->title = request('title');
      $article->excerpt = request('excerpt');
      $article->body = request('body');

      $article->save();
      */
      return redirect('/articles/' . $article->id);
    }

    protected function validateArticle(){
      return request()->validate([
        'title' => 'required',
        'excerpt' => 'required',
        'body' => 'required'
      ]);
    }
}
