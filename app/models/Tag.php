<?php

class Tag extends Eloquent {

	protected $fillable = array('name');
	
    public function recipe() {
   
        return $this->belongsToMany('Recipe');
    }
  
    public static function boot() {
        parent::boot();
        static::deleting(function($tag) {
            DB::statement('DELETE FROM recipe_tag WHERE tag_id = ?', array($tag->id));
        });
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