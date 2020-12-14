@extends('layouts.master')

@section('forms')
    <section class="blog__section" style="text-align: right;">
        <div class="container primary">
            <div class="titleholder">
                <h1 class="entry-title highlight">إنشاء تدوينه</h1>
            </div>

            <span class="tracking-mode">
                المجتمع يحتاج المزيد من المثقفين
:
                💌
            </span>
            <form method="POST" action="{{ route('createPost') }}">
                @csrf
                <div class="form-group">
                    <label for="title" class="zaridRegularFont">
                        العنوان
                        <span style="color:red">*</span>
                    </label>
                    <input type="text" name="title" class="form-control right zaridRegularFont @error('title') is-invalid @enderror" id="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                    @error('title')
                    <span class="invalid-feedback zaridRegularFont" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image_url" class="zaridRegularFont">
                        رابط الصورة
                    </label>
                    <input type="text" name="image_url" class="form-control right zaridRegularFont @error('image_url') is-invalid @enderror" id="image_url" value="{{ old('image_url') }}" autocomplete="image_url" autofocus>

                    @error('image_url')
                    <span class="invalid-feedback zaridRegularFont" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="body" class="zaridRegularFont">
                        المحتوى
                    </label>
                    <textarea class="form-control" name="body" id="bodyInput" rows="3">{!! old('body') !!}</textarea>
                </div>

                <button type="submit" class="btn btn-info zaridRegularFont">إنشاء</button>
            </form>
            <hr>
            <div class="clear-fix">
                &nbsp;
            </div>

            <div class="clear-fix">
                &nbsp;
            </div>

        </div>

    </section>
@endsection
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
@section("scripts")
    <script>
        let bodyInput = document.getElementById("bodyInput");
        CKEDITOR.replace('bodyInput');
    </script>
@endsection

