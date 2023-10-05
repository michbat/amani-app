@extends('admin.layouts.app')
@section('title', 'Programmations Index')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('admin.representations.create') }}"><i
                class="fas fa-plus mx-2"></i>Ajouter
            une programmation de spectacle</a>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <div class="card-header d-flex flex-column justify-content-center align-items-start">
                <h4>Programmations</h4>
                {{-- <p>{{ $ingredients->count() }} sur {{ $ingredients->total() }}</p> --}}
                {{-- <p>{{ $ingredients->currentPage() }} sur {{ $ingredients->perPage() }}</p> --}}
                <p>{{ $representations->firstItem() }} à {{ $representations->lastItem() }} sur
                    {{ $representations->total() }} groupe(s)</p>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>N°</th>
                        {{-- <th>Lieu</th> --}}
                        <th>Nom du spectacle</th>
                        <th>Groupe</th>
                        <th>Date</th>
                        <th>Début</th>
                        <th>Fin</th>
                        <th>Annulée</th>
                        <th>Expirée</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($representations) > 0)
                        @foreach ($representations as $representation)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                {{-- <td>
                                    <span style="font-weight: bolder;">
                                        {{ $representation->restaurant->name }}
                                    </span>
                                </td> --}}
                                <td>
                                    <span class="btn btn-info text-dark" style="border-radius: 50px;">
                                        {{ $representation->show->title }}
                                    </span>
                                </td>
                                <td>
                                    <span style="font-weight: bolder;">
                                        {{ $representation->show->band->name }}
                                    </span>
                                </td>
                                <td>
                                    <span style="font-weight: bolder;">
                                        {{ $representation->getRepresentationDateFormat($representation->representationDate) }}
                                    </span>
                                </td>
                                <td>
                                    <span style="font-weight: bolder;">
                                        {{ $representation->startTime }}
                                    </span>
                                </td>
                                <td>
                                    <span style="font-weight: bolder;">
                                        {{ $representation->endTime }}
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="btn {{ $representation->canceled === 0 ? 'btn-success' : 'btn-danger' }} text-dark"
                                        style="border-radius: 50px;">
                                        {{ $representation->canceled === 0 ? 'Non' : 'Oui' }}
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="btn {{ $representation->isExpired === 0 ? 'btn-success' : 'btn-danger' }} text-dark"
                                        style="border-radius: 50px;">
                                        {{ $representation->isExpired === 0 ? 'Non' : 'Oui' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">

                                        <a class="btn btn-primary mx-2 text-dark"
                                            href="{{ route('admin.representations.edit', $representation->id) }}"><i
                                                class="fas fa-edit mx-2"></i>Editer</a>

                                        <form action="{{ route('admin.representations.destroy', $representation->id) }}"
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
        {{ $representations->links() }}
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
                title: 'Suppression d\'une programmation',
                text: "Voulez-vous supprimer cette programmation?",
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
