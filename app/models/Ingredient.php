<?php

class Ingredient extends Eloquent {

	protected $fillable = array('name');

    public function recipe() {
     
        return $this->belongsToMany('Recipe');
    }

  public static function getIdNamePair() {
		$ingredients = Array();
		$collection = Ingredient::all();
		foreach($collection as $ingredient) {
			$ingredients[$ingredient->id] = $ingredient->name;
		}
		return $ingredients;
	}

}