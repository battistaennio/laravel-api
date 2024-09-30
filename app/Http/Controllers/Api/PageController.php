<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;



// API da realizzare:
// - elenco di tutti i progetti con associato il tipo e le tecnologie (con o senza paginazione)
// - elenco di tutte le tecnologie
// - elenco di tutti i tipi
// BONUS
// - dettaglio del singolo post con tipo e tecnologie associate dato lo slug. Aggiungere la gestione del progetto mancante e dell’immagine mancante
// - elenco dei progetti in base al tipo
// - elenco dei progetti in base alle tecnologie


class PageController extends Controller
{
    public function allProjects()
    {

        $projects = Project::orderBy('id', 'desc')->with('type', 'technologies')->get();

        if ($projects) {
            $success = true;
        } else {
            $success = false;
        }

        return response()->json(compact('success', 'projects'));
    }

    public function allTechs()
    {

        $techs = Technology::all();

        if ($techs) {
            $success = true;
        } else {
            $success = false;
        }

        return response()->json(compact('success', 'techs'));
    }
}
