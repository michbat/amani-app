@extends('admin.layouts.app')
@section('title', 'User Edit')

@section('content')
    <div class="card mt-5">
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary text-dark"><i
                    class="fas fa-caret-left mx-2"></i>Revenir à l'index</a>
        </div>
        <div class="card-body">
            <div class="container">
                <form class="form-signup" action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <h2 class="text-center py-5">Mise à jour des informations de l'utilisateur</h2>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control py-2 @error('firstname') is-invalid @enderror"
                                    name="firstname" placeholder="Prénom" value="{{ $user->firstname }}">
                                @error('firstname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <input type="text" class="form-control py-2 @error('lastname') is-invalid @enderror"
                                        name="lastname" placeholder="Nom" value="{{ $user->lastname }}">
                                    @error('lastname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control py-2 @error('email') is-invalid @enderror"
                            placeholder="Adresse e-mail" name="email" value="{{ $user->email }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control py-2 @error('phone') is-invalid @enderror"
                            placeholder="Votre numéro de téléphone" name="phone" value="{{ $user->phone }}">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="form-group">
                        <select class="form-control" name="role_id">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" @selected($user->hasRole($role->name) ? $role->name : '')>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                            @error('role_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="status">
                            @foreach ($ustatuts as $ustatut)
                                <option value="{{ $ustatut->value }}" @selected($user->status->value === $ustatut->value)>
                                    {{ $ustatut->value }}
                                </option>
                            @endforeach
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </select>
                    </div>

                    <div class="text-center my-5">
                        <button type="submit" class="btn btn-primary btn-block py-2 fs-5 text-dark"
                            style="min-width: 200px;"><i class="far fa-edit mx-2"></i>Mise à
                            jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom_css')
    <style>
        .card {
            max-width: 800px !important;
            margin: 0 auto;
            box-shadow: 5px 8px 5px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 15px
        }

        .form-signup {
            margin: 0 auto;
            max-width: 600px;
        }
    </style>

@endsection
