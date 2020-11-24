@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('User Settings') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                        @csrf

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">

{{--                                        TODO:: check if the user prefer table has one.--}}

                                        <input type="checkbox" name="gender" id="gender">
                                        {{ $userPrefers->userPrefers }}


                                        <label class="form-check-label" for="gender">
                                            {{ __('Prefer to see my gender posts.') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('update') }}
                                    </button>


                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $error)
                                                <div>{{ $error }}</div>
                                            @endforeach
                                        </div>
                                    @endif


                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
