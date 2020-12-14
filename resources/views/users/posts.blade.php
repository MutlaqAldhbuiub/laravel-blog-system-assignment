@extends('layouts.master')


@section('forms')
    <section class="blog__section" style="text-align: right;">
        <div class="container primary">
            <div class="titleholder">
                <h1 class="entry-title highlight">
                    تدويناتي
                </h1>
            </div>

            <div class="row blog_row">
                @foreach ($posts as $post)
                    <div class="col-lg-4 col-sm-6 blog__grid">
                        <div class="blog__item">
                            <img src="{{$post->image_url}}">
                            <h3><a href="/posts/{{$post->slug}}" class="underText">{{$post->title}}</a></h3>
                            <div class="blog__item--date">{{ $post->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                @endforeach
            </div>.
        </div>
    </section>
@endsection

@section("scripts")
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('body', {
            contentsLangDirection: 'rtl'
        } );
    </script>


@endsection

