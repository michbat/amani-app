@extends('admin.layouts.app')
@section('title', 'Ajouter un plat')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('admin.plats.index') }}"><i
                class="fas fa-clipboard-list mx-2"></i>Revenir à l'index</a>
    </div>
    <div class="card mt-3">
        <form action="{{ route('admin.plats.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
                <h4>Ajout d'un plat</h4>
            </div>
            <div class="card-body">
                <div class="form-group row mb-4">
                    <div class="col-sm-12">
                        <label for="name" class="form-label">Nom du plat</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nom du menu"
                            value="{{ old('name') }}">

                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <div class="col-sm-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" id="tiny" cols="30" rows="30" class="form-control"
                            placeholder="Description de la recette"></textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <div class="col-sm-12">
                        <label for="price" class="form-label">Catégorie du plat</label>
                        <select class="form-control selectric" name="category_id">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->designation }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <div class="col-sm-12">
                        <label for="price" class="form-label">Prix du plat</label>
                        <input type="number" min="0.00" max="1000.00" step="0.25" name="price"
                            class="form-control" value="{{ old('price') }}">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="form-label text-left col-12" for="image-upload">Image</label>
                    <div class="col-sm-12">
                        <div id="image-preview" class="image-preview mb-2">
                            <label for="image-upload" id="image-label">Choisir un fichier</label>
                            <input type="file" name="image" id="image-upload" />
                        </div>
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="form-label text-left col-12" for="available">Disponibilité</label>
                    <div class="col-sm-12">
                        <select class="form-control selectric" name="available" id="available">
                            <option value="1">Disponible</option>
                            <option value="0">Non Disponible</option>
                        </select>
                        @error('available')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Ajout des ingredients  --}}

            <div class="card mt-5">
                <div class="card-header">
                    <h4>Choisir des ingredients du plat: </h4>
                </div>
                <div class="card-body m-3">

                    @if ($errors->has('ingredients'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong> {{ $errors->first('ingredients') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if ($errors->has('ingredients.*'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong> {{ $errors->first('ingredients.*') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <table class="table">
                        <tbody>
                            @foreach ($ingredients as $ingredient)
                                <tr>
                                    <td>
                                        <div class="form-group mb-0">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input ingredient-enable"
                                                    data-id="{{ $ingredient->id }}" id="{{ $ingredient->name }}">
                                                <label class="custom-control-label mx-4"
                                                    for="{{ $ingredient->name }}">{{ $ingredient->name }}
                                                    ({{ $ingredient->unit->name }})
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="number" name="ingredients[{{ $ingredient->id }}]"
                                                min="0.0000" max="1000.00" step="0.0025"
                                                data-id="{{ $ingredient->id }}" disabled
                                                class="ingredient-amount form-control" placeholder="Quantité"
                                                style="max-width: 200px">
                                        </div>
                                    <td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer mb-4">
                <button type="submit" class="btn btn-primary btn-lg px-5 text-dark" style="min-width: 200px;"><i
                        class="fas fa-plus-circle mx-2"></i>Ajouter</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/page/features-post-create.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // On récupère tous les checkbox dans le DOM ayant la classe .ingredient-enable

            const ingredientEnableItems = document.querySelectorAll(
                '.ingredient-enable'); //On obtient une NodeList qui contient des éléments checkbox


            // On parcourt cette NodeList avec la boucle foreach

            ingredientEnableItems.forEach(function(elt) {
                // Lorsqu'on clique sur un checkbox de la liste
                elt.addEventListener('click', function() {
                    // On récupère l'attribut 'data-id' de la checkbox
                    const id = elt.getAttribute('data-id');

                    // On vérifie si le checkbox est coché. Renvoie true ou false
                    const enabled = elt.checked;

                    // On récupère l'input element dont la classe est .ingredient-amount et dont l'attribut data-id a la même valeur que celle de la checkbox
                    const ingredientAmountElement = document.querySelector(
                        '.ingredient-amount[data-id="' + id + '"]');

                    // Si cet élément input est trouvé

                    if (ingredientAmountElement) {
                        // On active ou désactive le input element en fonction de la valeur booléenne de la variable enabled (checkbox coché ou pas)
                        ingredientAmountElement.disabled = !enabled;

                        // On met la variable à nul  pour pouvoir acceuillir un autre élément à la prochaine itération.
                        ingredientAmountElement.value = null;
                    }
                });
            });
        });
    </script>

@endsection
