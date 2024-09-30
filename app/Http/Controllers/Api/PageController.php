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
// - dettaglio del singolo post con tipo e tecnologie associate dato lo slug.
//      Aggiungere la gestione del progetto mancante e dell’immagine mancante
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

    public function allTypes()
    {

        $types = Type::all();

        if ($types) {
            $success = true;
        } else {
            $success = false;
        }

        return response()->json(compact('success', 'types'));
    }

    public function projectBySlug($slug)
    {

        $project = Project::where('slug', $slug)->with('type', 'technologies')->first();

        if ($project) {

            $success = true;

            if ($project->img_path) {
                $project->img_path = asset('storage/' . $project->img_path);
            } else {
                $project->img_path = '/img/no-img.png';
                $project->img_name = 'no image available';
            }
        } else {
            $success = false;
        }

        return response()->json(compact('success', 'project'));
    }

    public function projectsByType($type)
    {
        $prjct_by_type = Type::where('name', $type)->with('projects')->first();

        if ($prjct_by_type) {

            $success = true;

            foreach ($prjct_by_type->projects as $prj) {

                if ($prj->img_path) {
                    $prj->img_path = asset('storage/' . $prj->img_path);
                } else {
                    $prj->img_path = '/img/no-img.png';
                    $prj->img_name = 'no image available';
                }
            }
        } else {
            $success = false;
        }

        return response()->json(compact('success', 'prjct_by_type'));
    }

    // - elenco dei progetti in base alle tecnologie
    public function projectsByTech($tech)
    {
        $prjct_by_tech = Technology::where('name', $tech)->with('projects')->first();

        if ($prjct_by_tech) {

            $success = true;

            foreach ($prjct_by_tech->projects as $prj) {
                if ($prj->img_path) {
                    $prj->img_path = asset('storage/' . $prj->img_path);
                } else {
                    $prj->img_path = '/img/no-img.png';
                    $prj->img_name = 'no image available';
                }
            }
        } else {

            $success = false;
        }

        return response()->json(compact('success', 'prjct_by_tech'));
    }
}
