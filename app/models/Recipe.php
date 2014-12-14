<?php

class Recipe extends Eloquent {

	protected $guarded = array('id', 'created_at', 'updated_at');
	 
    public function author() {

        return $this->belongsTo('Author');
    }

   	public function ingredients() {
       
        return $this->belongsToMany('Ingredient', 'recipe_ingredient');
    }

    public function tags() {
          
        return $this->belongsToMany('Tag');
    }

    public static function search($query) {
        
        if($query) {

            $recipes = Recipe::with('tags','author')
            ->whereHas('author', function($q) use($query) {
                $q->where('name', 'LIKE', "%$query%");
            })
            ->orWhereHas('tags', function($q) use($query) {
                $q->where('name', 'LIKE', "%$query%");
            })
            ->orWhere('recipeName', 'LIKE', "%$query%")
            ->get();
        }

        else {
            $recipes = Recipe::with('tags','author')->get();
        }
        return $recipes;
    }



}
