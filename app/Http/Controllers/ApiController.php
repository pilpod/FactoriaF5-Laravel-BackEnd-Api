<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function index()
    {
        $dishes = Dish::all();

        return response()->json($dishes);

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'required|url',
            'ingredients' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $dish = Dish::create([
            'name' => $request->name,
            'img' => $request->img,
            'ingredients' => $request->ingredients,
            'price' => $request->price,
        ]);

        $dish->save();

        return response()->json($dish);
    }

    public function show($id)
    {
        $dish = Dish::find($id);
        if($dish->count()) {
            return response()->json($dish);
        }
    }

    public function destroy($id)
    {
        $dish = Dish::find($id);
        if($dish->count()) {
            $dish->delete();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'required|url',
            'ingredients' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $dish = Dish::find($id);

        $dish->name = $request->name;
        $dish->ingredients = $request->ingredients;
        $dish->img = $request->img;
        $dish->price = $request->price;

        $dish->save();

        return response()->json($dish);

    }
}
