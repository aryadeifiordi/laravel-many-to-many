<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;

class ProjectController extends Controller
{
    // Metodo per visualizzare l'elenco dei progetti
    public function index()
    {
        // Recupera tutti i progetti con il relativo tipo
        $projects = Project::with('type')->get();
        return view('admin.projects.index', compact('projects'));
    }

    // Metodo per visualizzare il form di creazione di un nuovo progetto
    public function create()
    {
        // Recupera tutti i tipi e tutte le tecnologie
        $types = Type::all();
        $technologies = Technology::all(); 
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    // Metodo per salvare un nuovo progetto nel database
    public function store(Request $request)
    {
        // Validazione dei dati inviati dal form
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type_id' => 'required|exists:types,id',
            'technologies' => 'array|exists:technologies,id', 
        ]);

        // Creazione di una nuova istanza del modello Project
        $project = new Project;
        $project->name = $validatedData['name'];
        $project->description = $validatedData['description'];
        $project->type_id = $validatedData['type_id'];
        $project->save();

        // Associazione delle tecnologie al progetto
        $project->technologies()->attach($validatedData['technologies']); 

        // Reindirizzamento alla pagina degli indici dei progetti
        return redirect()->route('admin.projects.index');
    }

    // Metodo per visualizzare i dettagli di un singolo progetto
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    // Metodo per visualizzare il form di modifica di un progetto esistente
    public function edit(Project $project)
    {
        // Recupera tutti i tipi e tutte le tecnologie
        $types = Type::all();
        $technologies = Technology::all(); 
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    // Metodo per aggiornare un progetto nel database
    public function update(Request $request, Project $project)
    {
        // Validazione dei dati inviati dal form
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type_id' => 'required|exists:types,id',
            'technologies' => 'array|exists:technologies,id', 
        ]);

        // Aggiornamento dei dati del progetto
        $project->name = $validatedData['name'];
        $project->description = $validatedData['description'];
        $project->type_id = $validatedData['type_id'];
        $project->save();

        // Aggiornamento delle tecnologie associate al progetto
        $project->technologies()->sync($validatedData['technologies']); 

        // Reindirizzamento alla pagina degli indici dei progetti
        return redirect()->route('admin.projects.index');
    }

    // Metodo per eliminare un progetto dal database
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index');
    }
}
