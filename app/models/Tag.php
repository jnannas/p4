<?php

class Tag extends Eloquent {

	protected $fillable = array('name');
	
    public function recipe() {
   
        return $this->belongsToMany('Recipe');
    }
  
  public static function getIdNamePair() {
		$tags = Array();
		$collection = Tag::all();
		foreach($collection as $tag) {
			$tags[$tag->id] = $tag->name;
		}
		return $tags;
	}
}