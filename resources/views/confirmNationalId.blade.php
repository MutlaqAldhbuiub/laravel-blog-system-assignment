@extends('layouts.app')

@section('content')
<form action="{{route('authorized')}}" method="post">
@method('PUT')
    
@csrf
    @national_id
    <div class="form-group row">
            <label for="national_id"
            class="col-md-4 col-form-label text-md-right">{{ __('National ID') }}</label>

            <div class="col-md-6">
            <input id="national_id" type="text"
                class="form-control @error('national_id') is-invalid @enderror" name="national_id"
                value="{{ old('national_id')  }}" required autocomplete="national_id" autofocus>
                @error('national_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    @endif

    @gender
    <fieldset class="form-group">
    <div class="row">
      <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="gender" id="gender1" value="male" checked>
          <label class="form-check-label" for="gridRadios1">
            Male
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="gender" id="gender2" value="female">
          <label class="form-check-label" for="gridRadios2">
            Female
          </label>
        </div>
      </div>
    </div>
  </fieldset>
    @error('gender')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  @endif

    <div class="form-group row mb-0">
        <div class="col-md-8 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Continue') }}
            </button>
        </div>
    </div>
</form>
@endsection
