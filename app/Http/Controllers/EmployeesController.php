<?php
namespace App\Http\Controllers;

use App\Http\Resources\EmployeCollection;
use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new EmployeCollection(Employees::orderBy('id', 'DESC')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:employees,email',
            'phone'      => 'nullable|string|max:20',
            'company_id' => 'required|exists:companies,id',
        ]);

        $employee = Employees::create($validated);

        return response()->json([
            'message' => 'Empleado creado exitosamente',
            'data'    => $employee,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employees $employee)
    {
        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employees $employee)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:employees,email,' . $employee->id,
            'phone'      => 'nullable|string|max:20',
            'company_id' => 'required|exists:companies,id',
        ]);

        $employee->update($validated);

        return response()->json([
            'message' => 'Empleado actualizado exitosamente.',
            'data'    => $employee,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employees $employee)
    {
        $employee->delete();
        return response()->json(['message' => 'Empleado eliminado correctamente.']);
    }
}
