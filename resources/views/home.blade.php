@extends('layouts.app')

@section('content')
<div class="container">
    
    <h1 class="d-flex justify-content-center">Acceuil</h1><hr>

    <div class="row mb-4 d-flex justify-content-center">
        <div class="card bg-custom-2 col-md-3 m-1 text-center">
            <div class="card-body">
                <h5 class="card-header">Infos Jeux</h5>
                <div class="row">
                    <div class="col">
                        <p class="card-text">
                            Nombre de jeux: <b>{{ $allJeux }}</b>
                            <br />
                            Nombre de jeux disponibles: <b>{{ $allJeux - $unreservedJeux}}</b>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card bg-custom col-md-3 m-1 text-center">
            <div class="card-body">
                <h5 class="card-header">Infos livres</h5>
                <div class="row">
                    <div class="col">
                        <p class="card-text">
                            Nombre de livres: <b>{{ $allBooks }}</b>
                            <br />
                            Nombre de livres disponibles: <b>{{ $allBooks - $unreservedBooks }}</b>
                        </p>
                    </div> 
                </div>
            </div>
        </div>
        <div class="card col-md-3 m-1 text-center {{ ($reservationRetard || $reservationJeuRetard) ? 'bg-danger' : 'bg-warning' }}">
            <div class="card-body">
                <h5 class="card-header">Infos réservations</h5>
                <div class="row">
                    <div class="col">
                        <p class="card-text">
                            Réservations Jeux: <b>{{ $unreservedJeux }}</b>
                            <br />
                            Réservations Livres: <b>{{ $unreservedBooks }}</b>
                            <br />
                            Réservations Livres retard: <b>{{ $reservationRetard }}</b>
                            <br />
                            Réservations Jeux retard: <b>{{ $reservationJeuRetard }}</b>
                        </p>
                    </div> 
                </div>
            </div>
        </div>
    </div>

    <div class="row d-flex">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('images/adherents.jfif') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Espace Adhérents</h5>
                        <p class="card-text">Cet espace permet la saisie, la modification et la suppression d'adhérents</p>
                        <a href="{{ route('users.index') }}" class="btn button btn btn-primary homeBtn">Accéder</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('images/games.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Espace Jeux</h5>
                        <p class="card-text">Cet espace permet la saisie, la modification et la suppression de jeux</p>
                        <a href="{{ route('jeux.index') }}" class="btn button btn btn-primary homeBtn">Accéder</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('images/books.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Espace Livres</h5>
                        <p class="card-text">Cet espace permet la saisie, la modification et la suppression de livres</p>
                        <a href="{{ route('books.index') }}" class="btn button btn btn-2 btn-primary homeBtn">Accéder</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row d-flex">
        <div class="row row-cols-1 row-cols-md-3 g-4 d-flex justify-content-center">
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('images/01-book.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Réservation Livres</h5>
                        <p class="card-text">Cet espace permet la saisie, la modification et la suppression de réservations livres</p>
                        <a href="{{ route('reservBook.index') }}" class="btn button btn btn-primary homeBtn">Accéder</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('images/02-reservation.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Réservation Jeux</h5>
                        <p class="card-text">Cet espace permet la saisie, la modification et la suppression de réservations jeux</p>
                        <a href="{{ route('reservJeu.index') }}" class="btn button btn btn-primary homeBtn">Accéder</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection