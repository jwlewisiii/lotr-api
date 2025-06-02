<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteCharacter extends Model
{
    public function characterList()
    {
        return $this->belongsTo(CharacterList::class);
    }

}
