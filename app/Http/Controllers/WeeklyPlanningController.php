<?php

namespace App\Http\Controllers;

use App\Models\WeeklyPlanning;
use App\Models\SecurityGuard;
use Illuminate\Http\Request;

class WeeklyPlanningController extends Controller
{
    /**
     * Afficher la liste des plannings hebdomadaires
     */
    public function index()
    {
        $weeklyPlannings = WeeklyPlanning::with('securityGuard')
            ->orderBy('week_start', 'desc')
            ->get();

        return view('weekly_plannings.index', compact('weeklyPlannings'));
    }

    /**
     * Formulaire de création
     */
    public function create()
    {
        $guards = SecurityGuard::where('categorie', 'Security')->get();

        return view('weekly_plannings.create', compact('guards'));
    }

    /**
     * Enregistrer un planning hebdomadaire
     */
    public function store(Request $request)
    {
        $request->validate([
            'security_guard_id' => 'required|exists:security_guards,id',
            'week_start' => 'required|date',
            'monday' => 'nullable|in:Morning,Night,FullDay',
            'tuesday' => 'nullable|in:Morning,Night,FullDay',
            'wednesday' => 'nullable|in:Morning,Night,FullDay',
            'thursday' => 'nullable|in:Morning,Night,FullDay',
            'friday' => 'nullable|in:Morning,Night,FullDay',
            'saturday' => 'nullable|in:Morning,Night,FullDay',
            'sunday' => 'nullable|in:Morning,Night,FullDay',
        ]);

      
        $exists = WeeklyPlanning::where('security_guard_id', $request->security_guard_id)
            ->where('week_start', $request->week_start)
            ->exists();

        if ($exists) {
            return back()
                ->withErrors('Un planning existe déjà pour cet agent et cette semaine.')
                ->withInput();
        }

        WeeklyPlanning::create($request->all());

        return redirect()
            ->route('weekly-plannings.index')
            ->with('success', 'Planning hebdomadaire créé avec succès.');
    }

    // Afficher le formulaire d'édition
public function edit($id)
{
    $weeklyPlanning = WeeklyPlanning::findOrFail($id);
    $guards = SecurityGuard::where('categorie', 'Security')->get();

    return view('weekly_plannings.edit', compact('weeklyPlanning', 'guards'));
}

// Mettre à jour le planning
public function update(Request $request, $id)
{
    $weeklyPlanning = WeeklyPlanning::findOrFail($id);

    // Validation
    $request->validate([
        'security_guard_id' => 'required|exists:security_guards,id',
        'week_start' => 'required|date',
        'monday' => 'nullable|in:Morning,Night,Full Day',
        'tuesday' => 'nullable|in:Morning,Night,Full Day',
        'wednesday' => 'nullable|in:Morning,Night,Full Day',
        'thursday' => 'nullable|in:Morning,Night,Full Day',
        'friday' => 'nullable|in:Morning,Night,Full Day',
        'saturday' => 'nullable|in:Morning,Night,Full Day',
        'sunday' => 'nullable|in:Morning,Night,Full Day',
    ]);

    // Vérifier doublon (hors planning actuel)
    $exists = WeeklyPlanning::where('security_guard_id', $request->security_guard_id)
        ->where('week_start', $request->week_start)
        ->where('id', '<>', $weeklyPlanning->id)
        ->exists();

    if ($exists) {
        return back()->withErrors('Un planning existe déjà pour cet agent et cette semaine.')->withInput();
    }

    // Mise à jour
    $weeklyPlanning->update($request->all());

    return redirect()->route('weekly-plannings.index')->with('success', 'Planning modifié avec succès.');
}

}
