<?php
namespace App\Http\Controllers;

use App\Models\CharacterList;
use Illuminate\Http\Request;

class CharacterListController extends Controller
{
    public function index()
    {
        return response()->json(CharacterList::with('favoriteCharacters')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:character_lists,name',
        ]);

        $list = CharacterList::create($validated);

        return response()->json($list, 201);
    }

    public function show($id)
    {
        $list = CharacterList::with('favoriteCharacters')->findOrFail($id);
        return response()->json($list);
    }

    public function update(Request $request, $id)
    {
        $list = CharacterList::findOrFail($id);

        $validated = $request->validate([
            'name' => "required|string|unique:character_lists,name,{$id}",
        ]);

        $list->update($validated);

        return response()->json($list);
    }

    public function destroy($id)
    {
        $list = CharacterList::findOrFail($id);
        $list->delete();

        return response()->json(['message' => 'List deleted successfully']);
    }
}
