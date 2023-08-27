@extends('admin.layouts.app')
@section('title', 'Users Index')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('admin.users.create') }}"><i
                class="fas fa-plus mx-2"></i>Ajouter un
            utilisateur</a>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <h4>Comptes d'utilisateurs</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Rôle</th>
                        <th>Status du compte</th>
                        <th>Token</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                <span style="font-weight: 900">
                                    {{ $user->firstname }}
                                </span>
                            </td>
                            <td>
                                <span style="font-weight: 900">
                                    {{ $user->lastname }}
                                </span>
                            </td>
                            <td>
                                <span style="font-weight: 900">
                                    {{ $user->email }}
                                </span>
                            </td>
                            <td>
                                <span style="font-weight: 900">
                                    {{ $user->phone }}
                                </span>
                            </td>
                            <td>
                                <span class="btn btn-sm btn-success text-dark  px-1"
                                    style="border-radius: 50px; min-width: 100px;">{{ $user->role_id === null ? 'Pas de role' : $user->role->name }}</span>
                            </td>
                            <td>
                                <span
                                    class="{{ $user->status->color() }}"
                                    style="border-radius: 50px; min-width: 100px;">{{ $user->status->label() }}</span>


                            </td>
                            <td> {{ Str::limit($user->token, 10) }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-warning mx-2 text-dark"
                                        href="{{ route('admin.users.show', $user->id) }}"><i
                                            class="fas fa-eye mx-2"></i>Voir</a>
                                    <a class="btn btn-primary mx-2 text-dark"
                                        href="{{ route('admin.users.edit', $user->id) }}"><i
                                            class="fas fa-edit mx-2"></i>Editer</a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger text-dark confirm"><i
                                                class="fas fa-trash mx-2"></i>Supprimer</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        //the confirm class that is being used in the delete button
        $('.confirm').click(function(event) {

            //This will choose the closest form to the button
            let form = $(this).closest("form");

            //don't let the form submit yet
            event.preventDefault();

            //configure sweetalert alert as you wish
            Swal.fire({
                title: 'Suppression de compte utilisateur',
                text: "Voulez-vous supprimer ce compte utilisateur?",
                cancelButtonText: "Non",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui'
            }).then((result) => {

                //in case of deletion confirm then make the form submit
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
    </script>
@endsection
