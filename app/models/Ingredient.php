<?php

class Ingredient extends Eloquent {
    public function recipe() {
     
        return $this->belongsToMany('Recipe');
    }

}