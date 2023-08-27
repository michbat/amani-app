@extends('admin.layouts.app')
@section('title', 'Menus Index')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('admin.menus.create') }}"><i
                class="fas fa-plus mx-2"></i>Ajouter un menu</a>
    </div>
    <div class="card mt-3">
        <div class="card-header d-flex flex-column justify-content-center align-items-start">
            <h4>Liste de menus</h4>
            {{-- <p>{{ $ingredients->count() }} sur {{ $ingredients->total() }}</p> --}}
            {{-- <p>{{ $ingredients->currentPage() }} sur {{ $ingredients->perPage() }}</p> --}}
            <p>{{ $menus->firstItem() }} à {{ $menus->lastItem() }} sur {{ $menus->total() }} menu(s)</p>
        </div>
        <div class="card-body">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Ingrédients</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Disponible</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($menus) > 0)
                        @foreach ($menus as $menu)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}"
                                        style="width: 60px; height: 40px;">
                                </td>
                                <td>
                                    <span class="btn btn-sm btn-success text-dark"
                                        style="border-radius: 50px; min-width: 100px;">
                                        {{ $menu->name }}
                                    </span>
                                </td>
                                <td style="font-weight: bolder">
                                    {{ $menu->category_id === null ? 'Pas de catégorie' : $menu->category->designation }}
                                </td>
                                {{-- <td>
                                    @if ($recipe->ingredients->count() > 0)
                                        @foreach ($recipe->ingredients as $ingredient)
                                            <span class="btn btn-sm btn-warning text-dark"
                                                style="border-radius: 50px; min-width: 100px;">
                                                {{ $ingredient->name }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span>
                                            pas d'ingrédients
                                        </span>
                                    @endif
                                </td> --}}
                                <td class="text-center">
                                    <span style="font-weight: 900">

                                        {{-- {{ $menu->ingredients->count() > 0 ? $menu->ingredients->count() . ' ingrédient(s)' : 'Non' }} --}}
                                        {{ $menu->ingredients->count() ?? 0 }}
                                    </span>
                                </td>
                                <td>{{ str()->limit($menu->description, 10) }}</td>
                                <td style="font-weight: bolder">{{ $menu->price }}</td>
                                <td>
                                    <span
                                        class="btn btn-sm text-dark {{ $menu->available == 1 ? 'btn-info' : 'btn-warning' }}"
                                        style="border-radius: 50px; min-width: 100px;">
                                        {{ $menu->available == 1 ? 'Disponible' : 'Non disponible' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">

                                        <a class="btn btn-warning text-dark mx-2"
                                            href="{{ route('admin.menus.show', $menu->id) }}"><i
                                                class="fas fa-tags mx-2"></i>({{ $menu->tags->count() }}) Tags</a>

                                        <a class="btn btn-primary text-dark mx-2"
                                            href="{{ route('admin.menus.edit', $menu->id) }}"><i
                                                class="fas fa-edit mx-2"></i>Editer</a>

                                        <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST">
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
        {{ $menus->links() }}
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
                title: 'Suppression de menu',
                text: "Voulez-vous supprimer ce menu?",
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
