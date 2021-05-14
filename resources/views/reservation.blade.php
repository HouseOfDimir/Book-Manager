@extends('layouts.app')

@section('content')
<!--- TODO RAJOUTER DES ICONES AJOUTER LA MAJ AUTO DU NOMBRE DE MESSAGES EN LIVE TANT QUE CE N4EST PAS OUVERT-->

@include('partials._message')
<div class="container">

    <h1 class="d-flex justify-content-center">Espace Réservation Livres</h1><hr>

    <div class="row">
        <div>
            <button type="button" class="btn btn-success addSomething" data-route="{{ route('reservBook.createReservBook') }}" data-toggle="modal" data-target="#createModal">
                Créer une réservation
            </button>
        </div>
    </div>

    <div class="row mt-4">
        <table class="table table-bordered table-hover display" id="table">
            <thead class="thead-dark">
				<tr>
					<th scope="col">Titre</th>
					<th scope="col">Genre</th>
					<th scope="col">Adhérent</th>
                    <th scope="col">Réservé le:</th>
                    <th scope="col">A rendre le:</th>
					<th scope="col">Etat actuel</th>
					<th scope="col">Récupéré ?</th>
					<th scope="col">Supprimer</th>
				</tr>
            </thead>
            <tbody>
                @if($reservBooks ?? '')
                    @foreach($reservBooks as $ReservBook)
                        <tr>
                            <th scope="row">{{ $ReservBook->titre }}</th>
                            <th scope="row">{{ $ReservBook->genre }}</th>
                            <th scope="row">{{ $ReservBook->nom . ' ' . $ReservBook->prenom }}</th>
                            <th scope="row">{{ \Carbon\Carbon::createFromFormat('Ymd', $ReservBook->dateDebut)->format('d/m/Y') }}</th>
                            <th scope="row">{{ \Carbon\Carbon::createFromFormat('Ymd', $ReservBook->dateRendu)->format('d/m/Y') }}</th>
                            <th scope="row">{{ $ReservBook->etatActuel }}</th>
                            <td><button data-route="{{ route('reservBook.toModifyReservBook', $ReservBook->id) }}" data-toggle="modal" data-target="#sendModal" class="btn btn-warning linkToSend"><i class="far fa-calendar-check"></i></button></td>
                            <td><button data-route="{{ route('reservBook.deleteReservBook', $ReservBook->id) }}" data-toggle="modal" data-target="#deleteModal" class="btn btn-dark linkToDel"><i class="fas fa-trash"></i></button></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
		</table>
    </div>

    @include('partials._modal', ['data' => 'Réservation Livre'])
    @include('partials._modalDelete', ['data' => 'Réservation Livre'])
    @include('partials._sendModal')
</div>
@endsection