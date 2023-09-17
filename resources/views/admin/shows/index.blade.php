@extends('admin.layouts.app')
@section('title', 'Show Index')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('admin.shows.create') }}"><i
                class="fas fa-plus mx-2"></i>Ajouter un spectacle</a>
    </div>
    <div class="card mt-3">
        <div class="card-header d-flex flex-column justify-content-center align-items-start">
            <h4>Liste des spectacles</h4>
            {{-- <p>{{ $ingredients->count() }} sur {{ $ingredients->total() }}</p> --}}
            {{-- <p>{{ $ingredients->currentPage() }} sur {{ $ingredients->perPage() }}</p> --}}
            <p>{{ $shows->firstItem() }} à {{ $shows->lastItem() }} sur {{ $shows->total() }}
                membre(s)</p>
        </div>
        <div class="card-body">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Titre du show</th>
                        <th>Poster</th>
                        <th>Groupe</th>
                        <th>Description</th>
                        <th class="text-center">Agenda</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($shows) > 0)
                        @foreach ($shows as $show)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    <span class="btn btn-sm btn-info text-dark"
                                        style="border-radius: 50px; min-width: 100px;">
                                        {{ $show->title }}
                                    </span>
                                </td>
                                <td>
                                    <img src="{{ asset($show->poster) }}" alt="{{ $show->title }}"
                                        style="width: 80px; height: 50px;">
                                </td>
                                <td>
                                    <span style="font-weight: 900">
                                        {{ $show->band->name }}
                                    </span>
                                </td>
                                <td>
                                    <span>
                                        {{ str()->limit($show->description, 10) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span
                                        class="btn {{ $show->isScheduled === 1 ? 'btn-success' : 'btn-danger' }} text-dark"
                                        style="border-radius: 50px;">
                                        {{ $show->isScheduled === 1 ? 'Programmé' : 'Annulé' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">

                                        <a class="btn btn-primary mx-2 text-dark"
                                            href="{{ route('admin.shows.edit', $show->id) }}"><i
                                                class="fas fa-edit mx-2"></i>Editer</a>

                                        <form action="{{ route('admin.shows.destroy', $show->id) }}" method="POST">
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
        {{ $shows->links() }}
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
                title: 'Suppression d\'un spectacle',
                text: "Voulez-vous supprimer ce spectacle?",
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
