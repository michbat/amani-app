@extends('admin.layouts.app')
@section('title', 'Galléries Index')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('admin.galleries.create') }}"><i
                class="fas fa-plus mx-2"></i>Ajouter un média dans la galerie</a>
    </div>
    <div class="card mt-3">
        <div class="card-header d-flex flex-column justify-content-center align-items-start">
            <h4>Liste des médias</h4>
            {{-- <p>{{ $ingredients->count() }} sur {{ $ingredients->total() }}</p> --}}
            {{-- <p>{{ $ingredients->currentPage() }} sur {{ $ingredients->perPage() }}</p> --}}
            <p>{{ $galleries->firstItem() }} à {{ $galleries->lastItem() }} sur {{ $galleries->total() }}
                médias(s)</p>
        </div>
        <div class="card-body">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Titre</th>
                        <th>Propriétaire</th>
                        <th>Image</th>
                        <th>Type</th>
                        <th>vidéo ID</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($galleries) > 0)
                        @foreach ($galleries as $gallery)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    <span class="btn btn-sm btn-success text-dark"
                                        style="border-radius: 50px; min-width: 100px;">
                                        {{ $gallery->title }}
                                    </span>
                                </td>
                                <td>
                                    <span style="font-weight: 900">
                                        {{ $gallery->restaurant->name }} Restaurant
                                    </span>
                                </td>

                                <td>
                                    <img src="{{ asset($gallery->image) }}" alt="{{ $gallery->title }}" width="60">
                                </td>
                                <td class="text-center">
                                    <span style="border-radius: 50px; " class="{{ $gallery->galleryType->color() }}">
                                        {{ $gallery->galleryType->label() }}
                                    </span>
                                </td>
                                <td>
                                    <span>
                                        {{ $gallery->videoId }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">

                                        <a class="btn btn-primary mx-2 text-dark"
                                            href="{{ route('admin.galleries.edit', $gallery->id) }}"><i
                                                class="fas fa-edit mx-2"></i>Editer</a>

                                        <form action="{{ route('admin.galleries.destroy', $gallery->id) }}" method="POST">
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
        {{ $galleries->links() }}
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
                title: 'Suppression de média dans la galerie',
                text: "Voulez-vous supprimer ce média de la galerie?",
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
