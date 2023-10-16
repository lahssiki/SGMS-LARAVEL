<?php

namespace App\Http\Controllers;

use App\Models\SecurityGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;



class SecurityGuardController extends Controller
{
    public function index()
    {
        $securityGuards = SecurityGuard::all();
        $ipAddress = request()->ip();

        return view('security-guards.index', compact('securityGuards','ipAddress'));
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

    return view('security-guards.show', compact('securityGuard'));
    
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
    // Validez les données du formulaire
    $validatedData = $request->validate([
        'fullname' => 'required',
        'cin' => 'required|unique:security_guards,cin,'.$id, // Assurez-vous d'exclure l'enregistrement actuel de la validation unique
        'adresse' => 'required|string|max:255',
        'image' => 'nullable|image',
        'categorie' => 'required|in:chef,Security',
    ]);

    // Mettez à jour les données de l'agent de sécurité
    $securityGuard = SecurityGuard::findOrFail($id);
    $securityGuard->update($validatedData);

    // Redirigez l'utilisateur vers la page de détails ou d'affichage de la liste
    return redirect()->route('security-guards.show', $id)->with('success', 'Security Guard updated successfully');
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





