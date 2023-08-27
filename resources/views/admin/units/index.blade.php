@extends('admin.layouts.app')
@section('title', 'Units Index')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('admin.units.create') }}"><i
                class="fas fa-plus mx-2"></i>Ajouter une unité de mesure</a>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <h4>Liste des unités de mesure</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nom de l'unité de mesure</th>
                        <th>Symbole</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($units) > 0)
                        @foreach ($units as $unit)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    <span class="btn btn-sm btn-info text-dark"
                                        style="border-radius: 50px; min-width: 100px;">
                                        {{ $unit->name }}
                                    </span>
                                </td>
                                <td>
                                    <span style="font-weight: 900;">
                                        {{ $unit->symbol }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">

                                        <a class="btn btn-primary mx-2 text-dark"
                                            href="{{ route('admin.units.edit', $unit->id) }}"><i
                                                class="fas fa-edit mx-2"></i>Editer</a>

                                        <form action="{{ route('admin.units.destroy', $unit->id) }}" method="POST">
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
                title: 'Suppression d\'unité de mesure',
                text: "Voulez-vous supprimer cette unité de mesure?",
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
