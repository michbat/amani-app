@extends('personnel.layouts.app')
@section('title', 'Plats Index')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('personnel.plats.create') }}"><i
                class="fas fa-plus mx-2"></i>Ajouter un plat</a>
    </div>
    <div class="card mt-3">
        <div class="card-header d-flex flex-column justify-content-center align-items-start">
            <h4>Liste de plats</h4>
            <p>{{ $plats->firstItem() }} à {{ $plats->lastItem() }} sur {{ $plats->total() }} plat(s)</p>
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
                    @if (count($plats) > 0)
                        @foreach ($plats as $plat)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    <img src="{{ asset($plat->image) }}" alt="{{ $plat->name }}"
                                        style="width: 60px; height: 40px;">
                                </td>
                                <td>
                                    <span class="btn btn-sm btn-success text-dark"
                                        style="border-radius: 50px; min-width: 100px;">
                                        {{ $plat->name }}
                                    </span>
                                </td>
                                <td style="font-weight: bolder">
                                    {{ $plat->category_id === null ? 'Pas de catégorie' : $plat->category->designation }}
                                </td>
                                <td class="text-center">
                                    <span style="font-weight: 900">
                                        {{ $plat->ingredients->count() ?? 0 }}
                                    </span>
                                </td>
                                <td>{{ str()->limit($plat->description, 10) }}</td>
                                <td style="font-weight: bolder">{{ $plat->price }}</td>
                                <td>
                                    <span
                                        class="btn btn-sm text-dark {{ $plat->available == 1 ? 'btn-info' : 'btn-danger' }}"
                                        style="border-radius: 50px; min-width: 100px;">
                                        {{ $plat->available == 1 ? 'Disponible' : 'Non disponible' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">

                                        <a class="btn btn-warning text-dark mx-2"
                                            href="{{ route('personnel.plats.show', $plat->id) }}"><i
                                                class="fas fa-tags mx-2"></i>({{ $plat->tags->count() }}) Tags</a>

                                        <a class="btn btn-primary text-dark mx-2"
                                            href="{{ route('personnel.plats.edit', $plat->id) }}"><i
                                                class="fas fa-edit mx-2"></i>Editer</a>

                                        <form action="{{ route('personnel.plats.destroy', $plat->id) }}" method="POST">
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
                            <td colspan="9" class="text-center">
                                <h2>Pas de données</h2>
                            </td>
                        </tr>

                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-5">
        {{ $plats->links() }}
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
                title: 'Suppression de plat',
                text: "Voulez-vous supprimer ce plat?",
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
