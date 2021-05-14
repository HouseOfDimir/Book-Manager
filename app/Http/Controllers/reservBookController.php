<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Models\reservation;

class reservBookController extends Controller
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

    public function execute()
    {
        $reservBooks = $this->getReservBook();
        return view('reservation')->with('reservBooks', $reservBooks);
    }

    public function createReservBook(Request $request)
    {
        $request->validate([
            'fkUser' => 'integer|required|exists:adherent,id',
            'fkLivre'  => 'integer|required|exists:livres,id',
            'date'   => 'string|required|max:10'
        ], $this->messages());

        $newDate = \Carbon\Carbon::createFromFormat('d/m/Y', $request->input('date'))
                    ->format('Ymd');

        $reservJeu            = new reservation();
        $reservJeu->fkUser    = $request->input('fkUser');
        $reservJeu->fkLivre   = $request->input('fkLivre');
        $reservJeu->dateDebut = Date('Ymd');
        $reservJeu->dateRendu = $newDate;
        $reservJeu->save();

        return redirect()->back()->with('success', 'Réservation créée avec succès !');
    }

    public function messages()
    {
        return [
            'fkUser.required' => 'Le champ Adhérent est manquant !',
            'fkUser.exists' => 'Cet Adhérent n\'existe pas !',
            'fkLivre.required' => 'Le champ Livre est manquant !',
            'fkLivre.exists' => 'Ce Livre n\'existe pas !'
        ];;
    }

    public function deleteReservBook($fkReservBook)
    {
        $reservBookToDelete = reservation::where('id', $fkReservBook)->update(['dateFin' => date('Ymd')]);

        if($reservBookToDelete){
            return redirect()->route('reservBook.index')->with('success', 'Réservation annulée avec succès !');
        }else{
            return redirect()->route('reservBook.index')->with('error', 'Une erreur est survenue, veuillez contacter votre administrateur !');
        }
    }

    public function editReservBook($fkReservBook)
    {
        $reservBookToReceive = reservation::where('id', $fkReservBook)->update(['dateFin' => date('Ymd')]);

        if($reservBookToReceive){
            return redirect()->route('reservJeu.index')->with('success', 'Réservation terminée avec succès !');
        }else{
            return redirect()->route('reservJeu.index')->with('error', 'Une erreur est survenue, veuillez contacter votre administrateur !');
        }
    }

    public function getReservBook()
    {
        $reservBook = reservation::join('adherent', 'adherent.id', '=', 'reservation.fkUser')
                                    ->join('livres', 'livres.id', '=', 'reservation.fkLivre')
                                    ->whereNull('reservation.dateFin')
                                    ->select('nom', 'prenom', 'titre', 'genre', 'reservation.id', 'etatActuel', 'reservation.dateDebut', 'dateRendu')
                                    ->orderBy('dateRendu', 'asc')
                                    ->get();
        return $reservBook;
    }
}

?>