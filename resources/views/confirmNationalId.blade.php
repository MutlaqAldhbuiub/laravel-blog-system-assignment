@extends('layouts.master')

@section('forms')
    <section class="blog__section" style="text-align: right;">
        <div class="container primary">
            <div class="titleholder">
                <h1 class="entry-title highlight">
                    تحديث معلوماتك
                </h1>
            </div>

            <span class="tracking-mode">
                الرجاء تحديث البيانات, لكن تستطيع تصفح الموقع.
:
                ⚠️
            </span>
            <form method="POST" action="{{route('authorized')}}">
                @method('PUT')
                @csrf
                @national_id
                <div class="form-group">
                    <label for="national_id" class="zaridRegularFont">
                        رقم الهوية
                    </label>
                    <input type="text" name="national_id" class="form-control right zaridRegularFont @error('national_id') is-invalid @enderror" id="national_id" value="{{ old('national_id') }}" required autocomplete="national_id" autofocus>

                    @error('national_id')
                    <span class="invalid-feedback zaridRegularFont" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                @endif

                @gender
                <label for="" class="zaridRegularFont">الجنس</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gender1" value="male" checked>
                    <label class="form-check-label zaridRegularFont" for="exampleRadios1">
                        ذكر
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gender2" value="female">
                    <label class="form-check-label zaridRegularFont" for="exampleRadios2">
                        إنثى
                    </label>
                </div>
                @error('gender')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @endif

                <button type="submit" class="btn btn-info zaridRegularFont">🚀 تحديث </button>
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

