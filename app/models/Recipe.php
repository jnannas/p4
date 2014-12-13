<?php

class Recipe extends Eloquent {
    public function author() {

        return $this->belongsTo('Author');
    }

   	public function ingredients() {
       
        return $this->belongsToMany('Ingredient', 'recipe_ingredient');
    }

    public function tags() {
          
        return $this->belongsToMany('Tag');
    }

}
