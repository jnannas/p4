<?php

class Tag extends Eloquent {
    public function recipe() {
   
        return $this->belongsToMany('Recipe');
    }

}