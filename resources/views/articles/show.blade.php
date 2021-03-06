@extends('layout')

  @section('style')
  <link href="../css/default.css" rel="stylesheet" type="text/css" media="all" />
  <link href="../css/fonts.css" rel="stylesheet" type="text/css" media="all" />
  @endsection

  @section('content')
  <div id="wrapper">
    <div id="page" class="container">
      <div id="content">
        <div class="title">
          <h2>{{ $article->title}}</h2>

        <p><img src="../images/banner.jpg" alt="" class="image image-full" /> </p>
        <p>{{ $article->body }}</p>

        <p style="margin-top: 20px">
            @foreach($article->tags as $tag)
              <a href="/articles?tag={{$tag->name}}">{{$tag->name}}</a>
            @endforeach
        </p>
        </div>
      </div>
    </div>
  </div>
@endsection
