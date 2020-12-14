@extends('layouts.master')

@section('moreCSS')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/4.12.0/bootstrap-social.min.css">
    <style>
        /**
 * Special thanks to: http://blog.koalite.com/bbg/
 */
        .btn-twitch {
            color: #FFFFFF;
            background-color: #6441A5;
            border-color: #2F1F4E;
        }

        .btn-twitch:hover,
        .btn-twitch:focus,
        .btn-twitch:active,
        .btn-twitch.active,
        .open .dropdown-toggle.btn-twitch {
            color: #FFFFFF;
            background-color: #472e75;
            border-color: #2F1F4E;
        }

        .btn-twitch:active,
        .btn-twitch.active,
        .open .dropdown-toggle.btn-twitch {
            background-image: none;
        }

        .btn-twitch.disabled,
        .btn-twitch[disabled],
        fieldset[disabled] .btn-twitch,
        .btn-twitch.disabled:hover,
        .btn-twitch[disabled]:hover,
        fieldset[disabled] .btn-twitch:hover,
        .btn-twitch.disabled:focus,
        .btn-twitch[disabled]:focus,
        fieldset[disabled] .btn-twitch:focus,
        .btn-twitch.disabled:active,
        .btn-twitch[disabled]:active,
        fieldset[disabled] .btn-twitch:active,
        .btn-twitch.disabled.active,
        .btn-twitch[disabled].active,
        fieldset[disabled] .btn-twitch.active {
            background-color: #6441A5;
            border-color: #2F1F4E;
        }

        .btn-twitch .badge {
            color: #6441A5;
            background-color: #FFFFFF;
        }
    </style>
@endsection

@section('forms')
    <section class="blog__section" style="text-align: right;">
        <div class="container primary">
            <div class="titleholder">
                <h1 class="entry-title highlight">تسجيل الدخول</h1>
            </div>

            <span class="tracking-mode">
                المجتمع يحتاج المزيد من المثقفين
:
                💌
            </span>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="title" class="zaridRegularFont">
                        رقم الهوية
                    </label>
                    <input type="text" name="national_id" class="form-control right zaridRegularFont @error('national_id') is-invalid @enderror" id="national_id" value="{{ old('national_id') }}" required autocomplete="national_id" autofocus>

                    @error('national_id')
                    <span class="invalid-feedback zaridRegularFont" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="password" class="zaridRegularFont">
                        الرقم السري
                    </label>
                    <input type="password" name="password" class="form-control zaridRegularFont @error('password') is-invalid @enderror" id="password" value="{{ old('password') }}" required autocomplete="password" autofocus>

                    @error('password')
                    <span class="invalid-feedback zaridRegularFont" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="form-check">
                            <span class="zaridRegularFont">
                                تذكرني
                            </span>
                            <input type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                        </div>
                    </div>
                </div>

                @if (Route::has('password.request'))
                    <a class="btn btn-link zaridRegularFont" href="{{ route('password.request') }}">
                        نسيت كلمة المرور؟
                    </a>
                @endif
                <button type="submit" class="btn btn-primary zaridRegularFont">دخول</button>
            </form>
            <div class="clear-fix">
                &nbsp;
            </div>

            <div class="soicalButtons">
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">

                        <div id="fb-root"></div>
                        <a href="{{ route('social.login', ['provider' => "facebook"]) }}">
                            <div class="fb-login-button" data-size="medium" data-button-type="login_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false" data-width=""></div>
                        </a>
                        <div class="clear-fix">&nbsp;</div>
                        <a class="btn btn-social btn-twitter" href="{{ route('social.login', ['provider' => "twitter"]) }}">
                            <span class="fa fa-twitter"></span>
                            Sign in with Twitter
                        </a>
                        <div class="clear-fix">&nbsp;</div>

                        <a class="btn btn-twitch" href="{{ route('social.login', ['provider' => "twitch"]) }}">
                            <img src="https://assets.stickpng.com/thumbs/580b57fcd9996e24bc43c540.png" width="20" height="20" alt="twitch logo"> Login with Twitch
                        </a>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="clear-fix">
                &nbsp;
            </div>

        </div>

    </section>
@endsection

@section("scripts")
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0&appId=1529262360592733&autoLogAppEvents=1" nonce="J9WBnpd3"></script>

@endsection

