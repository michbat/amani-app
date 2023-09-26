@extends('admin.layouts.app')
@section('title', 'Tables Index')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark"
            href="{{ route('admin.tables.create') }}"><i class="fas fa-plus mx-2"></i>Ajouter une table</a>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <div class="card-header d-flex flex-column justify-content-center align-items-start">
                <h4>Liste de tables</h4>
                <p>{{ $tables->firstItem() }} à {{ $tables->lastItem() }} sur {{ $tables->total() }} table(s)</p>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Code de la table</th>
                        <th>Places</th>
                        <th class="text-center">Libre</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($tables) > 0)
                        @foreach ($tables as $table)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    <span style="font-weight: 900;">
                                        {{ $table->code }}
                                    </span>
                                </td>
                                <td>
                                    <span style="font-weight: 900;">
                                        {{ $table->seat }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.tables.setisfree', $table->id) }}">
                                        <span class="btn {{ $table->isFree == 1 ? 'btn-success' : 'btn-danger' }} text-dark"
                                            style="border-radius: 50px; min-width: 100px;">
                                            {{ $table->isFree == 1 ? 'Oui' : 'Non' }}
                                        </span>
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">

                                        <a class="btn btn-primary mx-2 text-dark"
                                            href="{{ route('admin.tables.edit', $table->id) }}"><i
                                                class="fas fa-edit mx-2"></i>Editer</a>

                                        <form action="{{ route('admin.tables.destroy', $table->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-danger text-dark confirm"><i
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
    <div class="d-flex justify-content-center mt-5">
        {{ $tables->links() }}
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
                title: 'Suppression d\'une table',
                text: "Voulez-vous supprimer cette table?",
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
