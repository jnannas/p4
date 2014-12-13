<?php

class Author extends Eloquent {
    public function recipe() {

        return $this->hasMany('Recipe');
    }
}
