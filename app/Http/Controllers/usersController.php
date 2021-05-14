<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Models\users;
use App\Models\reservation;
use App\Models\reservationJeu;

class usersController extends Controller
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
        $users = $this->getUsers();
        list($getUsersWithReservations, $getUsersWithReservationsJeu) = $this->getUsersWithReservations();
        return view('users')->with(['users'=> $users, 'getUsersWithReservations' => $getUsersWithReservations, 'getUsersWithReservationsJeu' => $getUsersWithReservationsJeu]);
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'nom' => 'bail|required|string|max:255',
            'prenom' => 'string|required',
            'adresse' => 'string|required',
            'zipcode' => 'string|required|max:5',
            'ville' => 'string|required',
            'age' => 'string|required|max:100'
        ], $this->messages());

        $User            = new users();
        $User->nom       = $request->input('nom');
        $User->prenom    = $request->input('prenom');
        $User->age       = $request->input('age');
        $User->adresse   = $request->input('adresse');
        $User->zipcode   = $request->input('zipcode');
        $User->ville     = $request->input('ville');
        $User->dateDebut = Date('Ymd');
        $User->save();

        return redirect()->back()->with('success', 'Adhérent ajouté avec succès !');
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le champ Nom est manquant !',
            'nom.string' => 'Le champ Nom doit être un texte !',
            'prenom.required' => 'Le champ Prénom est manquant !',
            'age.integer' => 'Le champ Age doit être un nombre !',
            'age.required' => 'Le champ Age est manquant !',
            'adresse.string' => 'Le champ Adresse doit être un texte !',
            'adresse.required' => 'Le champ Adresse est manquant !',
            'prenom.string' => 'Le champ Prénom doit être un texte !',
            'zipcode.required' => 'Le champ Code Postal est manquant !',
            'zipcode.string' => 'Le champ Code Postal doit être un texte !',
            'ville.required' => 'Le champ Ville est manquant !',
            'ville.string' => 'Le champ ville doit être un texte !',
            'zipcode.max' => 'Le champ Code postal est de 5 caractères maximum !'
        ];
    }

    public function deleteUser($fkUser)
    {
        $userToDelete = users::where('id', $fkUser)->update(['dateFin' => date('Ymd')]);

        if($userToDelete){
            return redirect()->route('users.index')->with('success', 'Adhérent supprimé avec succès !');
        }else{
            return redirect()->route('users.index')->with('error', 'Une erreur est survenue, veuillez contacter votre administrateur !');
        }
    }

    public function toModifyUser(Request $request)
    {
        $User = users::where('id', $request->input('fkUser'))->whereNull('dateFin')->first();

        if($User){
            $User['typeEdit'] = 'User';
            return response()->json($User);
        }else{
            return response()->json('KO');
        }
    }

    public function editUser(Request $request)
    {
        $request->validate([
            'nom'     => 'bail|required|string|max:255',
            'prenom'  => 'string|required',
            'adresse' => 'string|required',
            'zipcode' => 'string|required|max:5',
            'ville'   => 'string|required',
            'age'     => 'integer|required|max:100'
        ], $this->messages());

        $editUser          = users::find($request->input('id'));
        $editUser->nom     = $request->input('nom');
        $editUser->prenom  = $request->input('prenom');
        $editUser->adresse = $request->input('adresse');
        $editUser->zipcode = $request->input('zipcode');
        $editUser->ville   = $request->input('ville');
        $editUser->age     = $request->input('age');
        $editUser->save();

        if($editUser){
            return redirect()->route('users.index')->with('success', 'Adhérent modifié avec succès !');
        }else{
            return redirect()->route('users.index')->with('error', 'Une erreur est survenue, veuillez contacter votre administrateur !');
        }
    }

    public function getUsers()
    {
        $users = users::whereNull('dateFin')->get();

        return $users;
    }

    public function getUsersWithReservations()
    {
        $getUsersWithReservations = reservation::whereNull('dateFin')
                                                ->select('fkUser')
                                                ->distinct()
                                                ->get();

        $getUsersWithReservationsJeu = reservationJeu::whereNull('dateFin')
                                                ->select('fkUser')
                                                ->distinct()
                                                ->get();
                                                
        $getUsersWithReservations = json_decode($getUsersWithReservations, true);
        $res = array();
        foreach($getUsersWithReservations as $book){
            $res[] = $book['fkUser'];
        }

        $getUsersWithReservationsJeu = json_decode($getUsersWithReservationsJeu, true);
        $res1 = array();
        foreach($getUsersWithReservationsJeu as $book){
            $res1[] = $book['fkUser'];
        }
        return array($res, $res1);
    }
}

?>