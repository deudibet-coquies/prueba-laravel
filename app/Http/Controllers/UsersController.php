<?php

namespace App\Http\Controllers;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $response = Users::all();
        $responseData = [];
        foreach ($response as $data) {
            $camelData = collect($data)->mapWithKeys(function ($value, $key) {
                return [Str::camel($key) => $value];
            })->toArray();
            array_push($responseData,$camelData);
        }
        
        return $responseData;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Convertir los nombres de atributos de camelCase a snake_case
        $data = collect($request->all())->mapWithKeys(function ($value, $key) {
            return [Str::snake($key) => $value];
        })->toArray();

        // Guardar los datos en la base de datos
        $user = Users::create($data);


        $response = collect($user)->mapWithKeys(function ($value, $key) {
            return [Str::camel($key) => $value];
        })->toArray();

        // Retornar la respuesta
        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Users::findOrFail($id);


        $response = collect($user)->mapWithKeys(function ($value, $key) {
            return [Str::camel($key) => $value];
        })->toArray();

        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Users::findOrFail($id);

        $data = collect($request->all())->mapWithKeys(function ($value, $key) {
            return [Str::snake($key) => $value];
        })->toArray();

        $user->update($data);
        $response = collect($user)->mapWithKeys(function ($value, $key) {
            return [Str::camel($key) => $value];
        })->toArray();
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Users::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'Usuario eliminado correctamente']);
    }
}


