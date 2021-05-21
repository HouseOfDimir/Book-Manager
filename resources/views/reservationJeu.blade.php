@extends('layouts.app')

@section('content')
<!--- TODO RAJOUTER DES ICONES AJOUTER LA MAJ AUTO DU NOMBRE DE MESSAGES EN LIVE TANT QUE CE N4EST PAS OUVERT-->
@include('partials._message')

<div class="container-fluid loaderC">
    <div class="bookshelf_wrapper">
        <ul class="books_list">
          <li class="book_item first"></li>
          <li class="book_item second"></li>
          <li class="book_item third"></li>
          <li class="book_item fourth"></li>
          <li class="book_item fifth"></li>
          <li class="book_item sixth"></li>
        </ul>
        <div class="shelf"></div>
        <p class="descrLoader">Chargement des données en cours, veuillez patienter...</p>
    </div>
</div>

<div class="container">
    
    <h1 class="d-flex justify-content-center">Espace Réservation Jeux</h1><hr>

    <div class="row">
        <div>
            <button type="button" class="btn btn-success addSomething" data-route="{{ route('reservJeu.createReservJeu') }}" data-toggle="modal" data-target="#createModal">
                Créer une réservation
            </button>
        </div>
    </div>

    <div class="row mt-4">
        <table class="table table-bordered table-hover display" id="table">
            <thead class="thead-dark">
				<tr>
					<th scope="col">Libellé</th>
					<th scope="col">Type</th>
                    <th scope="col">Adhérent</th>
                    <th scope="col">Réservé le:</th>
					<th scope="col">A rendre le:</th>
					<th scope="col">Récupéré ?</th>
					<th scope="col">Supprimer</th>
				</tr>
            </thead>
            <tbody>
                @if($reservJeu ?? '')
                    @foreach($reservJeu as $reservationJeu)
                        <tr>
                            <th scope="row">{{ $reservationJeu->libelle }}</th>
                            <th scope="row">{{ $reservationJeu->type }}</th>
                            <th scope="row">{{ $reservationJeu->nom . ' ' . $reservationJeu->prenom }}</th>
                            <th scope="row">{{ \Carbon\Carbon::createFromFormat('Ymd', $reservationJeu->dateDebut)->format('d/m/Y') }}</th>
                            <th scope="row">{{ \Carbon\Carbon::createFromFormat('Ymd', $reservationJeu->dateRendu)->format('d/m/Y') }}</th>
                            <td><button data-route="{{ route('reservJeu.toModifyReservJeu', $reservationJeu->id) }}" data-toggle="modal" data-target="#sendModal" class="btn btn-warning linkToSend"><i class="far fa-calendar-check"></i></button></td>
                            <td><button data-route="{{ route('reservJeu.deleteReservJeu', $reservationJeu->id) }}"  data-toggle="modal" data-target="#deleteModal" class="btn btn-dark linkToDel"><i class="fas fa-trash"></i></button></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
		</table>
    </div>

    @include('partials._modal', ['data' => 'Réservation Jeu'])
    @include('partials._modalDelete', ['data' => 'Réservation Jeu'])
    @include('partials._sendModal', ['data' => 'Réservation Jeu'])
</div>

@include('partials._footer')
@endsection