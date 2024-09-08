<?php

namespace App\Http\Controllers;

use App\Models\Equipement;
use Illuminate\Http\Request;

class EquipementController extends Controller
{

    // NAZAIRE SALOMON SAGNA
    // VOICI LE CRUD POUR AJOUTER LES EQUIPEMENTS AVEC UNE AUTHENTIFICATION

    public function index()
    {
        $equipements = Equipement::all();
        return response()->json($equipements, 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'marque' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'numeroSerie' => 'required|string|unique:equipements,numeroSerie',
            'dateAchat' => 'required|date',
            'codeQr' => 'required|string|unique:equipements,codeQr',
            'localisation' => 'required|string|max:255',
            'garantieExp' => 'required|date',
            'prix' => 'required|numeric',
            'stock' => 'required|integer',
            'magasin_id' => 'required|exists:magasins,id',
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'gestionnaire_id' => 'required|exists:gestionnaires,id',
        ]);

        $equipement = Equipement::create($data);

        return ['equipement' => $equipement];
    }

    /**
     * Afficher un équipement spécifique.
     */
    public function show($id)
    {
        $equipement = Equipement::find($id);

        if (!$equipement) {
            return response()->json(['message' => 'Équipement non trouvé'], 404);
        }

        return response()->json($equipement, 200);
    }

    public function update(Request $request, $id)
    {
        $equipement = Equipement::find($id);

        if (!$equipement) {
            return response()->json(['message' => 'Équipement non trouvé'], 404);
        }

        $data = $request->validate([
            'nom' => 'string|max:255',
            'marque' => 'string|max:255',
            'model' => 'string|max:255',
            'numeroSerie' => 'string|unique:equipements,numeroSerie,' . $equipement->id,
            'dateAchat' => 'date',
            'codeQr' => 'string|unique:equipements,codeQr,' . $equipement->id,
            'localisation' => 'string|max:255',
            'garantieExp' => 'date',
            'prix' => 'numeric',
            'stock' => 'integer',
            'magasin_id' => 'exists:magasins,id',
            'fournisseur_id' => 'exists:fournisseurs,id',
            'gestionnaire_id' => 'exists:gestionnaires,id',
        ]);

        $equipement->update($data);

        return ['equipement' => $equipement];
    }

    public function destroy($id)
    {
        $equipement = Equipement::find($id);

        if (!$equipement) {
            return response()->json(['message' => 'Équipement non trouvé'], 404);
        }

        $equipement->delete();

        return response()->json(['message' => 'Équipement supprimé avec succès'], 200);
    }
}
