@extends('user.layouts.app')
@section('content')
    <section class="d-flex justify-content-center align-items-center h-100">
        <div class="container my-5">
            <div class="row g-5">
                <div class="col-lg-6 col-sm-12">
                    <div class="card text-center h-100">
                        <div class="card-header bg-success text-white">
                            <div class="row align-items-center h-100">
                                <div class="col-3">
                                    <i class="fas fa-box-open fa-5x"></i>
                                </div>
                                <div class="col">
                                    <h2>Mes Commandes</h2>
                                    <p>Commandes,factures</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer h-100 d-flex flex-column justify-content-center align-items-center">
                            <h5>
                                <a href="{{ route('user.index.orders') }}"
                                    class="mt-auto btn btn-outline-success btn-lg">Cliquez ici <i
                                        class="fa fa-arrow-alt-circle-right mx-2"></i></a>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="card text-center h-100">
                        <div class="card-header bg-success text-white">
                            <div class="row align-items-center h-100">
                                <div class="col-3">
                                    <i class="fas fa-key fa-5x"></i>
                                </div>
                                <div class="col">
                                    <h2>Mot de passe</h2>
                                    <p>Modification de mot de passe</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer h-100 d-flex flex-column justify-content-center align-items-center">
                            <h5>
                                <a href="{{ route('user.edit.password') }}"
                                    class="mt-auto btn btn-outline-success btn-lg mt-auto">Cliquez ici <i
                                        class="fa fa-arrow-alt-circle-right mx-2"></i></a>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="card text-center h-100">
                        <div class="card-header bg-success text-white">
                            <div class="row align-items-center h-100">
                                <div class="col-3">
                                    <i class="fas fa-user fa-5x"></i>
                                </div>
                                <div class="col">
                                    <h2>Editer mon profil</h2>
                                    <p>Modification de votre profil</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer h-100 d-flex flex-column justify-content-center align-items-center">
                            <h5>
                                <a href="{{ route('user.edit.profile') }}"
                                    class="mt-auto btn btn-outline-success btn-lg">Cliquez ici <i
                                        class="fa fa-arrow-alt-circle-right mx-2"></i></a>
                            </h5>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6 col-sm-12">
                    <div class="card text-center h-100">
                        <div class="card-header bg-success text-white">
                            <div class="row align-items-center h-100">
                                <div class="col-3">
                                    <i class="fas fa-trash fa-5x"></i>
                                </div>
                                <div class="col">
                                    <h2>Supprimer mon compte</h2>
                                    <p>Suppression définitive de votre compte</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer h-100 d-flex flex-column justify-content-center align-items-center">
                            <form action="{{ route('user.delete.account', ['user' => auth()->user()]) }}" method="POST" id="formulaire">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="mt-auto btn btn-outline-success btn-lg confirm">Cliquez ici<i
                                        class="fa fa-arrow-alt-circle-right mx-2"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                title: 'Suppression d\'un compte',
                text: "Voulez-vous vraiment supprimer votre compte ?",
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
