@extends('layouts.master')


@section('articles')
    <section class="blog__section">
        <div class="container primary">
            <div class="titleholder">
                <h1 class="entry-title highlight">التدوينات</h1>
            </div>

            <p class="tracking-mode">
                نظام مراقبة المنشورات بناء على جنسك
                <span style="color:forestgreen">مفعل الان</span>
                <i class="fa fa-filter"></i>
            </p>
            <div class="row blog_row">

                @foreach ($posts as $post)
                    <div class="col-lg-4 col-sm-6 blog__grid">
                        <div class="blog__item">
                            <img src="{{$post->image_url}}">
                            <h3><a href="posts/{{$post->slug}}" class="underText">{{$post->title}}</a></h3>
                            <div class="blog__item--date">{{ $post->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
    @endsection

    </html>
