<?php
namespace App\Http\Controllers;

use App\Models\FavoriteCharacter;
use Illuminate\Http\Request;

class FavoriteCharacterController extends Controller
{
    public function index()
    {
        return response()->json(FavoriteCharacter::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'character_list_id' => 'required|exists:character_lists,id',
            'character_id' => 'required|string|unique:favorite_characters,character_id,NULL,id,character_list_id,' . $request->character_list_id,
            'name' => 'required|string',
            'race' => 'nullable|string',
            'wiki_url' => 'nullable|url',
        ]);

        $favorite = FavoriteCharacter::create($validated);

        return response()->json($favorite, 201);
    }

    public function show($id)
    {
        $favorite = FavoriteCharacter::findOrFail($id);
        return response()->json($favorite);
    }

    public function update(Request $request, $id)
    {
        $favorite = FavoriteCharacter::findOrFail($id);

        $validated = $request->validate([
            'character_list_id' => 'sometimes|required|exists:character_lists,id',
            'character_id' => "sometimes|required|string|unique:favorite_characters,character_id,{$id},id,character_list_id," . ($request->character_list_id ?? $favorite->character_list_id),
            'name' => 'sometimes|required|string',
            'race' => 'nullable|string',
            'wiki_url' => 'nullable|url',
        ]);

        $favorite->update($validated);

        return response()->json($favorite);
    }

    public function destroy($id)
    {
        $favorite = FavoriteCharacter::findOrFail($id);
        $favorite->delete();

        return response()->json(['message' => 'Character removed from favorites.']);
    }
}
