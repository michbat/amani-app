@extends('admin.layouts.app')
@section('title', 'Restaurant Index')

@section('content')
    <div class="card mt-3">
        <div class="card-header">
            <h4>Les informations de notre restaurant</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Fixe</th>
                        <th>GSM</th>
                        <th>Email</th>
                        <th>Ouvert</th>
                        <th>Facebook</th>
                        <th>Twitter</th>
                        <th>Instagram</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $restaurant->id }}</td>
                        <td>
                            <span style="font-weight: 900">{{ $restaurant->name }}</span>
                        </td>
                        <td>
                            <span style="font-weight: 900">{{ str()->limit($restaurant->phone, 3) }}</span>
                        </td>
                        <td>
                            <span style="font-weight: 900">{{ str()->limit($restaurant->gsm, 3) }}</span>
                        </td>
                        <td>
                            <span style="font-weight: 900">{{ $restaurant->email }}</span>
                        </td>
                        <td>
                            <span
                                class="btn {{ $restaurant->opened === 1 ? 'btn-success' : 'btn-danger' }} text-dark" style="border-radius: 50px;">{{ $restaurant->opened == 1 ? 'Oui' : 'Non' }}</span>
                        </td>
                        <td>
                            <span style="font-weight: 900">{{ str()->limit($restaurant->facebookLink, 5) }}</span>
                        </td>
                        <td>
                            <span style="font-weight: 900">{{ str()->limit($restaurant->twitterLink, 5) }}</span>
                        </td>
                        <td>
                            <span style="font-weight: 900">{{ str()->limit($restaurant->instagramLink, 5) }}</span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-warning mx-2 text-dark"
                                    href="{{ route('admin.restaurants.show', $restaurant->id) }}"><i
                                        class="fas fa-eye mx-2"></i>Voir</a>
                                <a class="btn btn-primary mx-2 text-dark"
                                    href="{{ route('admin.restaurants.edit', $restaurant->id) }}"><i
                                        class="fas fa-edit mx-2"></i>Editer</a>

                            </div>
                        </td>
                    </tr>
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
                title: 'Suppression de tag',
                text: "Voulez-vous supprimer ce tag?",
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
