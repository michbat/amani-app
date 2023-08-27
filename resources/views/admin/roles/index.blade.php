@extends('admin.layouts.app')
@section('title', 'Role List')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info text-dark btn-lg" href="{{ route('admin.roles.create') }}"><i class="fas fa-plus mx-2"></i>Ajouter un
            rôle</a>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <h4>Liste des roles</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nom</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                <span class="btn btn-sm btn-info text-dark" style="border-radius: 50px; min-width: 100px;">
                                    {{ $role->name }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">

                                    <a class="btn btn-primary text-dark mx-2" href="{{ route('admin.roles.edit', $role->id) }}"><i
                                            class="fas fa-edit mx-2"></i>Editer</a>

                                    <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST">
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
        // On récupère la classe du bouton delete

        $('.confirm').click(function(event) {
            // Choisir le formulaire le plus proche du bouton
            let form = $(this).closest("form");

            // Empêcher le formulaire d'être soumis

            event.preventDefault();

            //Configuration de la boîte Alert

            Swal.fire({
                title: 'Suppression de role',
                text: "Voulez-vous supprimer ce rôle?",
                cancelButtonText: "Non",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui'
            }).then((result) => {

                //Si confirmé au niveau de la boîte alert

                if (result.isConfirmed) {
                    form.submit(); // On soumet le formulaire
                }
            })
        });
    </script>
@endsection
