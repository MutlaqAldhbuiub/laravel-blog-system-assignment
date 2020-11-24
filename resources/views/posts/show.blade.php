@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('SHOW') }}</div>

                    <div class="card-body">

                        @isset($post)
                            @if(!$GenderPrefer)
                                <div class="alert alert-warning">
                                    <b>This article is not preferred to you, according to your settings.</b>
                                </div>
                            @endif
                            <h2>{{$post->title}}</h2>
                            <p>
                                {{$post->body}}
                            </p>
                            <p>
                                Author : {{ $post->user->name }}
                            </p>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
