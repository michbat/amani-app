@extends('admin.layouts.app')
@section('title', 'Ingredients Index')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('admin.ingredients.create') }}"><i
                class="fas fa-plus mx-2"></i>Ajouter un ingrédient</a>
    </div>
    <div class="card mt-3">
        <div class="card-header d-flex flex-column justify-content-center align-items-start">
            <h4>Liste des ingrédients</h4>
            <p>{{ $ingredients->firstItem() }} à {{ $ingredients->lastItem() }} sur {{ $ingredients->total() }}
                ingrédient(s)</p>
        </div>
        <div class="card-body">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nom de l'ingrédient</th>
                        <th>Type</th>
                        <th class="text-center">Quantité en stock</th>
                        <th class="text-center">Seuil minimum en stock</th>
                        <th class="text-center">Disponibilité</th>
                        <th>Unité (Symbole)</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody id="ingredients">
                    @if (count($ingredients) > 0)
                        @foreach ($ingredients as $ingredient)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    <span class="btn btn-sm btn-success text-dark"
                                        style="border-radius: 50px; min-width: 100px;">
                                        {{ $ingredient->name }}
                                    </span>
                                </td>
                                <td>
                                    <span style="font-weight: 900">
                                        {{ $ingredient->type->name }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span style="font-weight: 900">
                                        {{ $ingredient->quantityInStock }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span style="font-weight: 900">
                                        {{ $ingredient->quantityMinimum }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span style="border-radius: 50px; " class="{{ $ingredient->stockStatus->color() }}">
                                        {{ $ingredient->stockStatus->label() }}
                                    </span>
                                </td>
                                <td>
                                    <span style="font-weight: 900">
                                        {{ $ingredient->unit->name }} ({{ $ingredient->unit->symbol }})
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">

                                        <a class="btn btn-primary mx-2 text-dark"
                                            href="{{ route('admin.ingredients.edit', $ingredient->id) }}"><i
                                                class="fas fa-edit mx-2"></i>Editer</a>

                                        <form action="{{ route('admin.ingredients.destroy', $ingredient->id) }}"
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
                            <td colspan="8" class="text-center">
                                <h2>Pas de données</h2>
                            </td>
                        </tr>

                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-5">
        {{ $ingredients->links() }}
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
                title: 'Suppression de type de produits',
                text: "Voulez-vous supprimer ce type de produits?",
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
