@extends('admin.layouts.app')
@section('title', 'Catégories Index')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('admin.categories.create') }}"><i class="fas fa-plus mx-2"></i>Ajouter une
            catégorie de recettes</a>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <h4>Liste des catégories</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Image</th>
                        <th>Designation</th>
                        <th>Description</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($categories) > 0)
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    <img src="{{ asset($category->image) }}" alt="{{ $category->designation }}"
                                        style="width: 60px;">
                                </td>
                                <td>
                                    <span class="btn btn-sm btn-info text-dark"
                                        style="border-radius: 50px; min-width: 100px;">
                                        {{ $category->designation }}
                                    </span>
                                </td>
                                <td>{{ str()->limit($category->description, 10) }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">

                                        <a class="btn btn-primary text-dark mx-2"
                                            href="{{ route('admin.categories.edit', $category->id) }}"><i
                                                class="fas fa-edit mx-2"></i>Editer</a>

                                        <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger text-dark confirm"><i
                                                    class="fas fa-trash mx-2"></i>Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center">
                                <h2>Pas de données</h2>
                            </td>
                        </tr>

                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // On récupère la classe '.confirm' du bouton delete

        $('.confirm').click(function(event) {
            // Choisir le formulaire qui contient bouton
            let form = $(this).closest("form");

            // Empêcher le comportement par défaut du formulaire

            event.preventDefault();

            //Configuration de la boîte Alert

            Swal.fire({
                title: 'Suppression de catégorie',
                text: "Voulez-vous supprimer cette catégorie?",
                cancelButtonText: "Non",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui'
            }).then((result) => {

                //Si confirmé au niveau de la boîte alert en appuyant sur Oui

                if (result.isConfirmed) {
                    form.submit(); // On soumet le formulaire
                }
            })
        });
    </script>
@endsection
