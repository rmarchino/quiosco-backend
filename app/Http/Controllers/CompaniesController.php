<?php
namespace App\Http\Controllers;

use App\Http\Resources\CompanyCollection;
use App\Models\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new CompanyCollection(Companies::orderBy('id', 'DESC')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:companies,email',
            'logo'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'website' => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $company = Companies::create($validated);

        return response()->json(['message' => 'Compañía creada exitosamente.', 'data' => $company], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Companies $company)
    {
        return response()->json(['data' => $company]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Companies $company)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:companies,email,' . $company->id,
            'logo'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'website' => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('logo')) {

            //Eliminar anterior si existe
            if ($company->logo && Storage::disk('public')->exists($company->logo)) {
                Storage::disk('public')->delete($company->logo);
            }
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $company->update($validated);
        return response()->json([
            'message' => 'Compañía actualizada exitosamente.',
            'data'    => $company,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Companies $company)
    {
        if ($company->logo && Storage::disk('public')->exists($company->logo)) {
            Storage::disk('public')->delete($company->logo);
        }

        // Eliminamos siempre el registro
        $company->delete();
    
        return response()->json(['message' => 'Compañía eliminada correctamente.']);
    }
}
