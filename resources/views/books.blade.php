@extends('layouts.app')

@section('content')
<!--- TODO RAJOUTER DES ICONES AJOUTER LA MAJ AUTO DU NOMBRE DE MESSAGES EN LIVE TANT QUE CE N4EST PAS OUVERT-->
@include('partials._message')
<div class="container">
    
    <h1 class="d-flex justify-content-center">Espace Livres</h1><hr>

    <div class="row">
        <div>
            <button type="button" class="btn btn-success addSomething" data-route="{{ route('books.createBook') }}" data-toggle="modal" data-target="#createModal">
                Ajouter un livre
            </button>
        </div>
    </div>

    <div class="row mt-4">
        <table class="table table-bordered table-hover display" id="table">
            <thead class="thead-dark">
				<tr>
					<th scope="col">Code</th>
					<th scope="col">Titre</th>
					<th scope="col">Auteur</th>
                    <th scope="col">Genre</th>
                    <th scope="col">Appartenance</th>
					<th scope="col">Etat actuel</th>
					<th scope="col">Modifier</th>
					<th scope="col">Supprimer</th>
				</tr>
            </thead>
            <tbody>
                @if($books ?? '')
                    @foreach($books as $book)
                        <tr>
                            <th scope="row">{{ $book->code }}</th>
                            <th scope="row">{{ $book->titre }}</th>
                            <th scope="row">{{ $book->auteur }}</th>
                            <th scope="row">{{ $book->genre }}</th>
                            <th scope="row">{{ $book->appartenance }}</th>
                            <th scope="row">{{ $book->etatActuel }}</th>
                            <td><button data-route="{{ route('books.toModifyBook') }}" data-modif="{{ route('books.editBook') }}" data-id="{{ $book->id }}" data-toggle="modal" data-target="#createModal" class="btn btn-warning linkToEdit"><i class="fas fa-edit"></i></button></td>
                            <td><button data-route="{{ route('books.deleteBook', $book->id) }}" @if(in_array($book->id, $getUsersWithReservations)){{ 'disabled' }}@elseif(in_array($book->id, $getUsersWithReservationsJeu)){{ 'disabled' }}@else{{ '' }}@endif data-toggle="modal" data-target="#deleteModal" class="btn btn-dark linkToDel"><i class="fas fa-trash"></i></button></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
		</table>
    </div>

    @include('partials._modal', ['data' => 'Livre'])
    @include('partials._modalDelete', ['data' => 'Livre'])
</div>
@endsection