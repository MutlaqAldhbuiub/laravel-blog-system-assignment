@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('SHOW') }}</div>

                    <div class="card-body">

                        @isset($post)
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
