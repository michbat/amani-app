@extends('admin.layouts.app')
@section('title', 'Menus Index')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('admin.drinks.create') }}"><i
                class="fas fa-plus mx-2"></i>Ajouter une boisson</a>
    </div>
    <div class="card mt-3">
        <div class="card-header d-flex flex-column justify-content-center align-items-start">
            <h4>Liste de boissons</h4>
            <p>{{ $drinks->firstItem() }} à {{ $drinks->lastItem() }} sur {{ $drinks->total() }} boisson(s)</p>
        </div>
        <div class="card-body">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Disponible</th>
                        <th>Commandable</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($drinks) > 0)
                        @foreach ($drinks as $drink)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    <img src="{{ asset($drink->image) }}" alt="{{ $drink->name }}"
                                        style="width: 60px; height: 40px;">
                                </td>
                                <td>
                                    <span class="btn btn-sm btn-success text-dark"
                                        style="border-radius: 50px; min-width: 100px;">
                                        {{ $drink->name }}
                                    </span>
                                </td>
                                <td style="font-weight: bolder">
                                    {{ $drink->category_id === null ? 'Pas de catégorie' : $drink->category->designation }}
                                </td>
                                <td>{{ str()->limit($drink->description, 10) }}</td>
                                <td style="font-weight: bolder">{{ $drink->price }} &euro;</td>
                                <td>
                                    <span
                                        class="btn btn-sm text-dark {{ $drink->available == 1 ? 'btn-info' : 'btn-danger' }}"
                                        style="border-radius: 50px; min-width: 100px;">
                                        {{ $drink->available == 1 ? 'Disponible' : 'Non disponible' }}
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="btn btn-sm text-dark {{ $drink->canBeCommended == 1 ? 'btn-info' : 'btn-danger' }}"
                                        style="border-radius: 50px; min-width: 100px;">
                                        {{ $drink->canBeCommended == 1 ? 'Commandable' : 'Pas commandable' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a class="btn btn-primary text-dark mx-2"
                                            href="{{ route('admin.drinks.edit', $drink->id) }}"><i
                                                class="fas fa-edit mx-2"></i>Editer</a>

                                        <form action="{{ route('admin.drinks.destroy', $drink->id) }}" method="POST">
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
        {{ $drinks->links() }}
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
                title: 'Suppression de la boisson',
                text: "Voulez-vous supprimer cette boisson?",
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
