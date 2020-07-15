@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Make Room</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   
                   <form method="POST" action="/generate-room">
                        @csrf

                        <div class="form-group row">
                            <label for="slug" class="col-md-5 col-form-label text-md-right">
                                Assigned url for your room:
                            </label>

                            <div class="col-md-5">
                                <input id="slug" type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug" value="{{ old('slug') }}" required autofocus>

                                @if ($errors->has('slug'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-5 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    Generate
                                </button>
                            </div>
                        </div>
                    </form>
                   
                   
                   
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
