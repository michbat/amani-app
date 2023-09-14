@extends('admin.layouts.app')
@section('title', 'Reviews Index')

@section('content')
    <div class="card mt-5 w-100">
        <div class="card-header">
            <h4>Liste des commentaires</h4>
        </div>
        <div class="card-body d-flex justify-content-center">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Commentateur</th>
                        <th>Plat</th>
                        <th>Rating</th>
                        <th>Title</th>
                        <th>Comment</th>
                        <th>Date</th>
                        <th>Publiée</th>
                        <th>Censurée</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($reviews) > 0)
                        @foreach ($reviews as $review)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    <span style="font-weight: 900">
                                        {{ $review->user->firstname }}
                                        {{ $review->user->lastname }}
                                    </span>
                                <td>
                                    <span class="btn btn-sm btn-info text-dark"
                                        style="border-radius: 50px; min-width: 100px;">
                                        {{ $review->plat->name }}
                                    </span>
                                </td>
                                <td>
                                    <span style="font-weight: 900">
                                        {{ $review->rating }}
                                    </span>
                                </td>
                                <td>
                                    <span style="font-weight: 900">
                                        {{ str()->limit($review->title, 10) }}
                                    </span>
                                </td>
                                <td>
                                    <span style="font-weight: 900">
                                        {{ str()->limit($review->comment, 10) }}
                                    </span>
                                <td>
                                    <span style="font-weight: 900">
                                        {{ $review->created_at->format('d/m/Y H:i:s') }}
                                    </span>
                                </td>

                                <td>
                                    <span
                                        class="text-dark btn btn-sm {{ $review->published === 0 ? 'btn-danger' : 'btn-success' }}"
                                        style="border-radius: 50px; min-width: 100px;">
                                        {{ $review->published === 0 ? 'Non publiée' : 'Publiée' }}
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="text-dark btn btn-sm {{ $review->censored === 0 ? 'btn-success' : 'btn-danger' }}"
                                        style="border-radius: 50px; min-width: 100px;">
                                        {{ $review->censored === 0 ? 'Non censurée' : 'censurée' }}
                                    </span>
                                </td>

                                <td>
                                    <div class="d-flex justify-content-center">

                                        <a class="btn btn-warning text-dark mx-2"
                                            href="{{ route('admin.reviews.show', $review->id) }}"><i
                                                class="fas fa-eye mx-2"></i>Voir</a>

                                        <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST">
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
                            <td colspan="10" class="text-center">
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
                title: 'Suppression de commentaire',
                text: "Voulez-vous supprimer ce commentaire?",
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
