<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Model\Herd;

/**
 *
 * @author pj
 */
interface PackableHerd {

    public function getInternState(): InternHerdState;
}
