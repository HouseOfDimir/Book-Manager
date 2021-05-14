<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\users;
use App\Models\jeux;
use App\Models\books;
use App\Models\reservation;
use App\Models\reservationJeu;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = users::whereNull('dateFin')->count();
        $jeux = jeux::whereNull('dateFin')->count();
        $reservedJeux = reservationJeu::whereNull('dateFin')->count();
        $reservedJeuxRetard = reservationJeu::whereNull('dateFin')->where('dateRendu', '<', Date('Ymd'))->count();
        $books = books::whereNull('dateFin')->count();
        $reservedBooks = reservation::whereNull('dateFin')->count();
        $reservedBooksRetard = reservation::whereNull('dateFin')->where('dateRendu', '<', Date('Ymd'))->count();

        return view('home')->with([
                                    'allUsers'        => $users,
                                    'allJeux'         => $jeux,
                                    'unreservedJeux'  => $reservedJeux,
                                    'allBooks'        => $books,
                                    'unreservedBooks' => $reservedBooks,
                                    'reservationRetard' => $reservedBooksRetard,
                                    'reservationJeuRetard' => $reservedJeuxRetard
                                    ]);
    }
}
