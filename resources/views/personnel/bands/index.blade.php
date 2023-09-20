@extends('personnel.layouts.app')
@section('title', 'Bands Index')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('personnel.bands.create') }}"><i
                class="fas fa-plus mx-2"></i>Ajouter
            un groupe de musique</a>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <div class="card-header d-flex flex-column justify-content-center align-items-start">
                <h4>Liste des groupes de musique</h4>
                {{-- <p>{{ $ingredients->count() }} sur {{ $ingredients->total() }}</p> --}}
                {{-- <p>{{ $ingredients->currentPage() }} sur {{ $ingredients->perPage() }}</p> --}}
                <p>{{ $bands->firstItem() }} à {{ $bands->lastItem() }} sur {{ $bands->total() }} groupe(s)</p>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nom du groupe</th>
                        <th>Membres</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($bands) > 0)
                        @foreach ($bands as $band)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    <span class="btn btn-sm btn-info text-dark"
                                        style="border-radius: 50px; min-width: 100px;">
                                        {{ $band->name }}
                                    </span>
                                </td>
                                <td>
                                    <span style="font-weight: bolder;">
                                        {{ $band->member }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">

                                        <a class="btn btn-primary mx-2 text-dark"
                                            href="{{ route('personnel.bands.edit', $band->id) }}"><i
                                                class="fas fa-edit mx-2"></i>Editer</a>

                                        <form action="{{ route('personnel.bands.destroy', $band->id) }}" method="POST">
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
        {{ $bands->links() }}
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
                title: 'Suppression de groupe de musique',
                text: "Voulez-vous supprimer ce groupe?",
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
