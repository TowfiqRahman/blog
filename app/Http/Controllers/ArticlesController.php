<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Tag;

class ArticlesController extends Controller
{
    public function show(Article $article){
        //$article = Article::findOrFail($id);

        return view('articles.show', ['article' => $article ]);
    }

    public function index(){
      if(request('tag')){
        $articles = Tag::where('name',request('tag'))->firstOrFail()->articles;
      }
        else{
        $articles = Article::latest()->get();
      }
        return view('articles.index', ['articles' => $articles ]);
    }

    public function create(){
      return view('articles.create',[
        'tags' => Tag::all()
      ]);
    }

    public function store(){
      $this->validateArticle();
      $article = new Article(request(['title','excerpt','body']));
      //$article = new Article($this->validateArticle());
      $article->user_id = 1;
      $article->save();

      $article->tags()->attach(request('tags'));
      /*$article = new Article();

      $article->title = request('title');
      $article->excerpt = request('excerpt');
      $article->body = request('body');

      $article->save();
      */

      return redirect('articles');

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
      return redirect(route('articles.show', $article));
    }

    protected function validateArticle(){
      return request()->validate([
        'title' => 'required',
        'excerpt' => 'required',
        'body' => 'required',
        'tags' => 'exists:tags,id'
      ]);
    }
}
