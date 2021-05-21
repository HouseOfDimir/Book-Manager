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
    
    <h1 class="d-flex justify-content-center">Administration Adhérents</h1>
    <hr>

    <div class="row">
        <div>
            <button type="button" class="btn btn-success addSomething" data-route="{{ route('users.createUser') }}" data-toggle="modal" data-target="#createModal">
                Ajouter un adhérent
            </button>
        </div>
    </div>

    <div class="row  mt-4">
        <table class="table table-bordered table-hover display" id="table">
            <thead class="thead-dark">
				<tr>
					<th scope="col">Nom</th>
					<th scope="col">Prénom</th>
					<th scope="col">Adresse</th>
                    <th scope="col">Code Postal</th>
                    <th scope="col">Ville</th>
					<th scope="col">Age</th>
					<th scope="col">Modifier</th>
					<th scope="col">Supprimer</th>
				</tr>
            </thead>
            <tbody>
                @if($users ?? '')
                    @foreach($users as $user)
                        <tr>
                            <th scope="row">{{ $user->nom }}</th>
                            <th scope="row">{{ $user->prenom }}</th>
                            <th scope="row">{{ $user->adresse }}</th>
                            <th scope="row">{{ $user->zipcode }}</th>
                            <th scope="row">{{ $user->ville }}</th>
                            <th scope="row">{{ $user->age }}</th>
                            <td><button data-route="{{ route('users.toModifyUser') }}" data-modif="{{ route('users.editUser') }}" data-id="{{ $user->id }}" data-toggle="modal" data-target="#createModal" class="btn btn-warning linkToEdit"><i class="fas fa-edit"></i></button></td>
                            <td><button data-route="{{ route('users.deleteUser', $user->id) }}" data-id="{{ $user->id }}" data-toggle="modal" @if(in_array($user->id, $getUsersWithReservations)){{ 'disabled' }}@elseif(in_array($user->id, $getUsersWithReservationsJeu)){{ 'disabled' }}@else{{ '' }}@endif data-target="#deleteModal" class="btn btn-dark linkToDel"><i class="fas fa-trash"></i></button></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
		</table>
    </div>

    @include('partials._modal', ['data' => 'User'])
    @include('partials._modalDelete', ['data' => 'Adhérent'])
</div>

@include('partials._footer')
@endsection