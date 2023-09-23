@extends('personnel.layouts.app')
@section('title', 'Editer un plat')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('personnel.plats.index') }}"><i
                class="fas fa-clipboard-list mx-2"></i>Revenir à l'index</a>
    </div>

    <div class="card mt-3">
        <form action="{{ route('personnel.plats.update', $plat->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-header">
                <h4>Editer un plat</h4>
            </div>
            <div class="card-body">
                <div class="form-group row mb-4">
                    <div class="col-sm-12">
                        <label for="name" class="form-label">Nom du plat</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nom du plat"
                            value="{{ $plat->name }}">

                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <div class="col-sm-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" id="tiny" cols="30" rows="30" class="form-control"
                            placeholder="Description du plat">{{ $plat->description }}</textarea>
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
                                <option value="{{ $category->id }}"
                                    {{ $category->id === $plat->category_id ? 'selected' : '' }}>
                                    {{ $category->designation }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-danger">
                                {{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <div class="col-sm-12">
                        <label for="price" class="form-label">Prix du plat</label>
                        <input type="number" min="0.00" max="1000.00" step="0.25" name="price"
                            class="form-control" value="{{ $plat->price }}">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="form-label text-left col-12" for="image-upload">Image</label>
                    <div class="col-sm-12">
                        <div style="background-image: url({{ asset($plat->image) }}); background-size:cover; background-position:center;"
                            id="image-preview" class="image-preview mb-2">
                            <label for="image-upload" id="image-label">Choisir un fichier</label>
                            <input type="file" name="image" id="image-upload" />
                        </div>
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <div class="col-sm-6">
                        <label class="form-label text-left" for="available">Disponibilité</label>
                        <select class="form-control selectric" name="available" id="available">
                            <option {{ $plat->available == 1 ? 'selected' : '' }} value="1">Disponible</option>
                            <option {{ $plat->available == 0 ? 'selected' : '' }} value="0">Non Disponible</option>
                        </select>
                        @error('available')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label text-left" for="canBeCommended">Commandable</label>
                        <select class="form-control selectric" name="canBeCommended" id="canBeCommended">
                            <option {{ $plat->canBeCommended == 1 ? 'selected' : '' }} value="1">Commandable</option>
                            <option {{ $plat->canBeCommended == 0 ? 'selected' : '' }} value="0">Non Commandable
                            </option>
                        </select>
                        @error('canBeCommended')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Editer des ingredients  --}}

            <div class="card mt-5">
                <div class="card-header">
                    {{-- On affiche dans l'entête de la carte des ingredients qui composent le menu --}}
                    <h4>Editer des ingredients du plat: </h4>
                    @foreach ($plat->ingredients as $ingredient)
                        <span class="btn btn-warning text-dark mx-2">{{ $ingredient->name }}
                            ({{ $ingredient->pivot->amount }} {{ $ingredient->unit->name }})
                        </span>
                    @endforeach
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
                                                <input {{ $ingredient->value ? 'checked' : null }} type="checkbox"
                                                    class="custom-control-input ingredient-enable"
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
                                            <input type="number" value="{{ $ingredient->value ?? null }}"
                                                name="ingredients[{{ $ingredient->id }}]" min="0.0000" max="1000.00"
                                                step="0.0025" data-id="{{ $ingredient->id }}"
                                                {{ $ingredient->value ? null : 'disabled' }}
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
                        class="fas fa-edit mx-2"></i>Editer</button>
            </div>

        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/page/features-post-create.js') }}"></script>
    <script>
        // Lorsque les éléments du DOM sont chargés

        document.addEventListener('DOMContentLoaded', function() {

            // On récupère tous les checkbox dans le DOM ayant la classe .ingredient-enable

            const ingredientEnableItems = document.querySelectorAll(
                '.ingredient-enable'); //On obtient une NodeList qui contient des éléments checkbox


            // On parcourt cette NodeList avec la boucle foreach

            ingredientEnableItems.forEach(function(elt) {
                // Lorsqu'on clique sur un checkbox de la liste
                elt.addEventListener('click', function() {
                    const id = elt.getAttribute(
                        'data-id'); // On récupère l'attribut 'data-id' de la checkbox
                    const enabled = elt
                        .checked; // On vérifie si le checkbox est coché. Renvoie true ou false

                    // On récupère l'input element dont la classe est .ingredient-amount dont l'attribut data-id a la même valeur que celle de la checkbox

                    const ingredientAmountElement = document.querySelector(
                        '.ingredient-amount[data-id="' + id + '"]');

                    // Si cet élément input est trouvé

                    if (ingredientAmountElement) {
                        // On active ou désactive le input element en fonction de la valeur booléenne de la variable enable
                        ingredientAmountElement.disabled = !enabled;
                        ingredientAmountElement.value =
                            null; // On met la variable à nulle  pour pouvoir acceuillir un autre élément à la prochaine itération.
                    }
                });
            });
        });
    </script>
@endsection
