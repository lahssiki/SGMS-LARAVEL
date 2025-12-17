<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SecurityGuard;
use App\Models\WeeklyPlanning;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;



class SecurityGuardController extends Controller
{
    public function index()
    {
        // Total des agents
        $totalGuards = SecurityGuard::count();

        // Statistiques par catégorie
        $categories = SecurityGuard::select('categorie')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('categorie')
            ->pluck('total', 'categorie');

        // Liste des agents
        $securityGuards = SecurityGuard::latest()->get();

        return view('security-guards.index', compact(
            'securityGuards',
            'totalGuards',
            'categories'
        ));
    }
    
    public function create(){
        if (Gate::allows('manage-posts')) {
        $categories = SecurityGuard::distinct('categorie')->pluck('categorie');

        return view('security-guards.create', compact('categories'));
    } else {
        abort(403, 'Permission denied');
    }
    }

    public function store(Request $request)
{
    $request->validate([
        'fullname' => 'required|string|max:255',
        'cin' => 'required|string|unique:security_guards,cin|max:255',
        'adresse' => 'required|string|max:255',
        'image' => 'nullable|image',
        'categorie' => 'required|in:chef,Security',
    ]);

    $data = $request->all();

    // Handle image upload if provided
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('security_guard_images', 'public');
        $data['image'] = $imagePath;
    }

    SecurityGuard::create($data);

    return redirect()->route('security-guards.index')->with('success', 'Security guard added successfully.');
}
public function show($id)
{
    $securityGuard = SecurityGuard::findOrFail($id);

    $plannings = WeeklyPlanning::where('security_guard_id', $id)
        ->orderBy('week_start', 'desc')
        ->get();
    return view('security-guards.show', compact('securityGuard', 'plannings'));
    
}
public function edit($id)
{
    if (Gate::allows('manage-posts')) {
    $securityGuard = SecurityGuard::findOrFail($id);

    return view('security-guards.edit', compact('securityGuard'));
} else {
    abort(403, 'Permission denied');
}
}

public function update(Request $request, $id)
{
    $securityGuard = SecurityGuard::findOrFail($id);

    // Validation
    $validatedData = $request->validate([
        'fullname'  => 'required|string|max:255',
        'cin'       => 'required|unique:security_guards,cin,' . $id,
        'adresse'   => 'required|string|max:255',
        'image'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'categorie' => 'required|in:chef,Security',
    ]);

    // ✅ Gestion de l’image
    if ($request->hasFile('image')) {

        // Supprimer l’ancienne image si existe
        if ($securityGuard->image && Storage::disk('public')->exists($securityGuard->image)) {
            Storage::disk('public')->delete($securityGuard->image);
        }

        // Enregistrer la nouvelle image
        $validatedData['image'] = $request->file('image')->store('guards', 'public');
    }

    // ✅ Mise à jour en une seule fois
    $securityGuard->update($validatedData);

    return redirect()
        ->route('security-guards.show', $securityGuard->id)
        ->with('success', 'Security Guard updated successfully');
}
public function destroy($id)
{
    if (Gate::allows('manage-posts')) {
    $securityGuard = SecurityGuard::findOrFail($id);
    $securityGuard->delete();

    return redirect()->route('security-guards.index')
        ->with('success', 'Security Guard deleted successfully');
    } else {
        abort(403, 'Permission denied');
    }
}



}





