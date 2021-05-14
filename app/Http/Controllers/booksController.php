<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Models\books;
use App\Models\reservation;
use App\Models\reservationJeu;

class booksController extends Controller
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
        $books = $this->getBooks();
        list($getUsersWithReservations, $getUsersWithReservationsJeu) = $this->getUsersWithReservations();
        return view('books')->with(['books'=> $books, 'getUsersWithReservations' => $getUsersWithReservations, 'getUsersWithReservationsJeu' => $getUsersWithReservationsJeu]);
    }

    public function createBook(Request $request)
    {
        $request->validate([
            'code'         => 'bail|required|string|unique:livres|max:255',
            'titre'        => 'string|required',
            'genre'        => 'string|required',
            'auteur'       => 'string|required',
            'appartenance' => 'string|required',
            'etatActuel'   => 'string|required'
        ], $this->messages());

        $Book               = new books();
        $Book->code         = $request->input('code');
        $Book->titre        = $request->input('titre');
        $Book->genre        = $request->input('genre');
        $Book->auteur       = $request->input('auteur');
        $Book->appartenance = $request->input('appartenance');
        $Book->etatActuel   = $request->input('etatActuel');
        $Book->dateDebut    = Date('Ymd');
        $Book->save();

        return redirect()->back()->with('success', 'Livre ajouté avec succès !');
    }

    public function messages()
    {
        return [
            'code.required' => 'Le champ Code est manquant !',
            'code.string' => 'Le champ Code doit être un texte !',
            'code.unique' => 'Ce Code existe déjà pour un autre livre !',
            'titre.required' => 'Le champ Titre est manquant !',
            'titre.string' => 'Le champ Titre doit être un texte !',
            'genre.required' => 'Le champ Genre est manquant !',
            'genre.string' => 'Le champ genre doit être un texte !',
            'auteur.required' => 'Le champ Auteur est manquant !',
            'auteur.string' => 'Le champ Auteur doit être un texte !',
            'appartenance.required' => 'Le champ Appartenance est manquant !',
            'appartenance.string' => 'Le champ Appartenance doit être un texte !',
            'etatActuel.required' => 'Le champ Etat Actuel est manquant !',
            'etatActuel.string' => 'Le champ Etat Actuel doit être un texte !',
        ];
    }

    public function deleteBook($fkBook)
    {
        $BookToDelete = books::where('id', $fkBook)->update(['dateFin' => date('Ymd')]);

        if($BookToDelete){
            return redirect()->route('books.index')->with('success', 'Livre supprimé avec succès !');
        }else{
            return redirect()->route('books.index')->with('error', 'Une erreur est survenue, veuillez contacter votre administrateur !');
        }
    }

    public function toModifyBook(Request $request)
    {
        $Book = books::where('id', $request->input('fkUser'))->whereNull('dateFin')->first();

        if($Book){
            $Book['typeEdit'] = 'Livre';
            return response()->json($Book); 
        }else{
            return response()->json('KO'); 
        }
    }

    public function editBook(Request $request)
    {
        $request->validate([
            'code'         => 'bail|required|string|unique:livres|max:255',
            'titre'        => 'string|required',
            'genre'        => 'string|required',
            'auteur'       => 'string|required',
            'appartenance' => 'string|required',
            'etatActuel'   => 'string|required'
        ], $this->messages());

        $editUser               = books::find($request->input('id'));
        $editUser->code         = $request->input('code');
        $editUser->titre        = $request->input('titre');
        $editUser->genre        = $request->input('genre');
        $editUser->auteur       = $request->input('auteur');
        $editUser->appartenance = $request->input('appartenance');
        $editUser->etatActuel   = $request->input('etatActuel');
        $editUser->save();

        if($editUser){
            return redirect()->route('users.index')->with('success', 'Adhérent modifié avec succès !');
        }else{
            return redirect()->route('users.index')->with('error', 'Une erreur est survenue, veuillez contacter votre administrateur !');
        }
    }

    public function getBooks()
    {
        $books = books::whereNull('dateFin')->get();

        return $books;
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