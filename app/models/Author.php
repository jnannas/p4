<?php

class Author extends Eloquent {
    public function recipe() {

        return $this->hasMany('Recipe');
    }

    public static function getIdNamePair() {
		$authors = Array();
		$collection = Author::all();
		foreach($collection as $author) {
			$authors[$author->id] = $author->name;
		}
		return $authors;
	}
}
