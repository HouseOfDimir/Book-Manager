<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Models\reservationJeu;

class reservJeuController extends Controller
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
        $reservJeu = $this->getReservJeu();
        return view('reservationJeu')->with('reservJeu', $reservJeu);
    }

    public function createReservJeu(Request $request)
    {
        $request->validate([
            'fkUser' => 'integer|required|exists:adherent,id',
            'fkJeu'  => 'integer|required|exists:jeux,id',
            'date'   => 'string|required|max:10'
        ], $this->messages());

        $newDate = \Carbon\Carbon::createFromFormat('d/m/Y', $request->input('date'))
                    ->format('Ymd');

        $reservJeu            = new reservationJeu();
        $reservJeu->fkUser    = $request->input('fkUser');
        $reservJeu->fkLivre     = $request->input('fkJeu');
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
            'fkJeu.required' => 'Le champ Jeu est manquant !',
            'fkJeu.exists' => 'Ce Jeu n\'existe pas !'
        ];
    }

    public function deleteReservJeu($fkReservJeu)
    {
        $reservJeuToDelete = reservationJeu::where('id', $fkReservJeu)->update(['dateFin' => date('Ymd')]);

        if($reservJeuToDelete){
            return redirect()->route('reservJeu.index')->with('success', 'Réservation annulée avec succès !');
        }else{
            return redirect()->route('reservJeu.index')->with('error', 'Une erreur est survenue, veuillez contacter votre administrateur !');
        }
    }

    public function editReservJeu($fkReservJeu)
    {
        $reservJeuToReceive = reservationJeu::where('id', $fkReservJeu)->update(['dateFin' => date('Ymd')]);

        if($reservJeuToReceive){
            return redirect()->route('reservJeu.index')->with('success', 'Réservation terminée avec succès !');
        }else{
            return redirect()->route('reservJeu.index')->with('error', 'Une erreur est survenue, veuillez contacter votre administrateur !');
        }
    }

    public function getReservJeu()
    {
        $reservJeu = reservationJeu::join('adherent', 'adherent.id', '=', 'reservationJeu.fkUser')
                                    ->join('jeux', 'jeux.id', '=', 'reservationJeu.fkLivre')
                                    ->whereNull('reservationJeu.dateFin')
                                    ->select('nom', 'prenom', 'libelle', 'type', 'reservationJeu.id', 'reservationJeu.dateDebut', 'dateRendu')
                                    ->orderBy('dateRendu', 'asc')
                                    ->get();
        return $reservJeu;
    }
}

?>