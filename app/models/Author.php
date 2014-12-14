<?php

class Author extends Eloquent {

	protected $guarded = array('id', 'created_at', 'updated_at');
	protected $fillable = array('name');

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
