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

    public function updateTags($new = array()) {

        foreach($new as $tag) {
            if(!$this->tags->contains($tag)) {
                $this->tags()->save(Tag::find($tag));
            }
        }

        foreach($this->tags as $tag) {
            if(!in_array($tag->pivot->tag_id,$new)) {
                $this->tags()->detach($tag->id);
            }
        }
    }

        public function updateIngredients($new = array()) {
   
        foreach($new as $ingredient) {
            if(!$this->ingredients->contains($ingredient)) {
                $this->ingredients()->save(Ingredient::find($ingredient));
            }
        }

        foreach($this->ingredients as $ingredient) {
            if(!in_array($ingredient->pivot->ingredient_id,$new)) {
                $this->ingredients()->detach($ingredient->id);
            }
        }
    }

}
