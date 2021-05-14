@extends('layouts.app')

@section('content')
<!--- TODO RAJOUTER DES ICONES AJOUTER LA MAJ AUTO DU NOMBRE DE MESSAGES EN LIVE TANT QUE CE N4EST PAS OUVERT-->
@include('partials._message')
<div class="container">
    
    <h1 class="d-flex justify-content-center">Espace Jeux</h1><hr>

    <div class="row">
        <div>
            <button type="button" class="btn btn-success addSomething" data-route="{{ route('jeux.createJeu') }}" data-toggle="modal" data-target="#createModal">
                Ajouter un jeu
            </button>
        </div>
    </div>

    <div class="row mt-4">
        <table class="table table-bordered table-hover display" id="table">
            <thead class="thead-dark">
				<tr>
					<th scope="col">Libellé</th>
					<th scope="col">Age</th>
					<th scope="col">Type</th>
					<th scope="col">Modifier</th>
					<th scope="col">Supprimer</th>
				</tr>
            </thead>
            <tbody>
                @if($jeux ?? '')
                    @foreach($jeux as $jeu)
                        <tr>
                            <th scope="row">{{ $jeu->libelle }}</th>
                            <th scope="row">{{ $jeu->age }}</th>
                            <th scope="row">{{ $jeu->type }}</th>
                            <td><button data-route="{{ route('jeux.toModifyJeu') }}" data-modif="{{ route('jeux.editJeu') }}" data-id="{{ $jeu->id }}" data-toggle="modal" data-target="#createModal" class="btn btn-warning linkToEdit"><i class="fas fa-edit"></i></button></td>
                            <td><button data-route="{{ route('jeux.deleteJeu', $jeu->id) }}" @if(in_array($jeu->id, $getUsersWithReservations)){{ 'disabled' }}@elseif(in_array($jeu->id, $getUsersWithReservationsJeu)){{ 'disabled' }}@else{{ '' }}@endif data-toggle="modal" data-target="#deleteModal" class="btn btn-dark linkToDel"><i class="fas fa-trash"></i></button></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
		</table>
    </div>

    @include('partials._modal', ['data' => 'Jeu'])
    @include('partials._modalDelete', ['data' => 'Jeu'])
</div>
@endsection