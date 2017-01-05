<?php

namespace AppBundle\Services;

class Info {

    protected $offreNom = array(
        1 => 'Pack light',
        2 => 'Pack Full',
        3 => 'Pack Sur Mesure'
    );

    public function getOffreNom($id) {
        return $this->offreNom[$id];
    }
}