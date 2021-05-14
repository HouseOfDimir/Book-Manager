<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Models\jeux;
use App\Models\reservation;
use App\Models\reservationJeu;

class jeuxController extends Controller
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
        $jeux = $this->getJeu();
        list($getUsersWithReservations, $getUsersWithReservationsJeu) = $this->getUsersWithReservations();
        return view('jeux')->with(['jeux'=> $jeux, 'getUsersWithReservations' => $getUsersWithReservations, 'getUsersWithReservationsJeu' => $getUsersWithReservationsJeu]);
    }

    public function createJeu(Request $request)
    {
        $request->validate([
            'libelle' => 'bail|required|string|unique:jeux|max:255',
            'age'     => 'string|required|',
            'type'    => 'string|required'
        ], $this->messages());

        $Jeu            = new jeux();
        $Jeu->libelle   = $request->input('libelle');
        $Jeu->age       = $request->input('age');
        $Jeu->type      = $request->input('type');
        $Jeu->dateDebut = Date('Ymd');
        $Jeu->save();

        return redirect()->back()->with('success', 'Exercice ajouté avec succès !');
    }

    public function messages()
    {
        return [
            'libelle.required' => 'Le champ Libellé est manquant !',
            'libelle.string' => 'Le champ Libellé doit être un texte !',
            'libelle.unique' => 'Ce Libellé existe déjà pour un autre jeu !',
            'age.required' => 'Aucun âge saisi !',
            'type.required' => 'Le champ Type est manquant',
            'type.string' => 'Le champ Type doit être un texte !'
        ];
    }

    public function deleteJeu($fkJeu)
    {
        $JeuToDelete = jeux::where('id', $fkJeu)->update(['dateFin' => date('Ymd')]);

        if($JeuToDelete){
            return redirect()->route('jeux.index')->with('success', 'Jeu supprimé avec succès !');
        }else{
            return redirect()->route('jeux.index')->with('error', 'Une erreur est survenue, veuillez contacter votre administrateur !');
        }
    }

    public function toModifyJeu(Request $request)
    {
        $Jeu = jeux::where('id', $request->input('fkUser'))->whereNull('dateFin')->first();

        if($Jeu){
            $Jeu['typeEdit'] = 'Jeu';
            return response()->json($Jeu);
        }else{
            return response()->json('KO');
        }
    }

    public function editJeu(Request $request)
    {
        $request->validate([
            'libelle' => 'bail|required|string|max:255',
            'age'     => 'string|required|',
            'type'    => 'string|required'
        ], $this->messages());

        $Jeu            = jeux::find($request->input('id'));
        $Jeu->libelle   = $request->input('libelle');
        $Jeu->age       = $request->input('age');
        $Jeu->type      = $request->input('type');
        $Jeu->dateDebut = Date('Ymd');
        $Jeu->save();

        if($Jeu){
            return redirect()->route('jeux.index')->with('success', 'Jeu modifié avec succès !');
        }else{
            return redirect()->route('jeux.index')->with('error', 'Une erreur est survenue, veuillez contacter votre administrateur !');
        }
    }

    public function getJeu()
    {
        $jeux = jeux::whereNull('dateFin')->get();

        return $jeux;
    }

    public function getUsersWithReservations()
    {
        $getUsersWithReservations = reservation::whereNull('dateFin')
                                                ->select('fkLivre')
                                                ->distinct()
                                                ->get();

        $getUsersWithReservationsJeu = reservationJeu::whereNull('dateFin')
                                                ->select('fkLivre')
                                                ->distinct()
                                                ->get();
                                                
        $getUsersWithReservations = json_decode($getUsersWithReservations, true);
        $res = array();
        foreach($getUsersWithReservations as $book){
            $res[] = $book['fkLivre'];
        }

        $getUsersWithReservationsJeu = json_decode($getUsersWithReservationsJeu, true);
        $res1 = array();
        foreach($getUsersWithReservationsJeu as $book){
            $res1[] = $book['fkLivre'];
        }
        return array($res, $res1);
    }
}

?>