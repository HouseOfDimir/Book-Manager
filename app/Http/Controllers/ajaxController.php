<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Models\users;
use App\Models\jeux;
use App\Models\books;
use App\Models\reservationJeu;

class ajaxController extends Controller
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

    public function getUser(Request $request)
    {
        if($request->ajax()){
            $this->validate($request, [
                'pattern' => 'string|required'
            ]);

            $users = users::where('nom', 'LIKE', '%' . $request->input('pattern') . '%')
                            ->orWhere('prenom', 'LIKE', '%' . $request->input('pattern') . '%')
                            ->whereNull('dateFin')
                            ->select('nom', 'prenom', 'id')
                            ->take(5)
                            ->get();
            $data = json_decode($users, true);
            $res = array();
            foreach($data as $user){
                $res[] = $user['nom'] . ' ' . $user['prenom'] . ' -- ' . $user['id'];
            }
            return response()->json($res);
        }
    }

    public function getJeu(Request $request)
    {
        if($request->ajax()){
            $this->validate($request, [
                'pattern' => 'string|required'
            ]);

            $jeux = jeux::whereNotIn('id', function($query){
                $query->select('fkLivre')
                        ->from('reservationJeu')
                        ->whereNull('dateFin')
                        ->whereNotNull('dateRendu');
            })->where('libelle', 'LIKE', '%' . $request->input('pattern') . '%')
            ->whereNull('dateFin')
            ->select('libelle', 'id')
            ->take(5)
            ->get();

            $data = json_decode($jeux, true);
            $res = array();
            foreach($data as $jeu){
                $res[] = $jeu['libelle'] . ' -- ' . $jeu['id'];
            }
            return response()->json($res);
        }   
    }

    public function getBook(Request $request)
    {
        if($request->ajax()){
            $this->validate($request, [
                'pattern' => 'string|required'
            ]);

            $books = books::whereNotIn('id', function($query){
                $query->select('fkLivre')
                        ->from('reservation')
                        ->whereNull('dateFin')
                        ->whereNotNull('dateRendu');
            })->where('titre', 'LIKE', '%' . $request->input('pattern') . '%')
            ->whereNull('dateFin')
            ->select('titre', 'id')
            ->take(5)
            ->get();

            $data = json_decode($books, true);
            $res = array();
            foreach($data as $book){
                $res[] = $book['titre'] . ' -- ' . $book['id'];
            }
            return response()->json($res);
        }     
    }
}

?>