@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white text-center font-weight-bold">Register</div>

                    <div class="card-body">
                        <form action="{{ route('register') }}" method="post">
                            @csrf

                            <div class="form-group mb-4">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                    id="name" name="name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                            <div class="form-group mb-4">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                    id="email" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                            <div class="form-group mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password"
                                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password"
                                    name="password" required>
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                @endif
                            </div>

                            <div class="form-group mb-4">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
