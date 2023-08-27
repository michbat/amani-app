@extends('user.layouts.app')
@section('title', 'Page Reset Password')
@section('content')
    <div class="row">
        <div class="col-12 col-sm-8 col-lg-6 m-auto">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <h2 class="my-4 text-center">Changement de votre mot de passe</h2>
                    <form action="{{ route('reset.password.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{ $email }}">
                        <div class="form-group mb-4">
                            <input type="password" class="form-control py-2 @error('password') is-invalid @enderror"
                                placeholder="Saisissez votre nouveau mot de passe" name="password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <input type="password" class="form-control py-2 @error('password_confirmation') is-invalid @enderror"
                                placeholder="Confirmez votre nouveau mot de passe" name="password_confirmation">
                            @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success py-2 fs-5 mb-3"
                                style="min-width: 200px;">Changer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
