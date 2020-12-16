<?php

namespace App\src\constraint;

/**
 * Set rules to used on constraints.
 */
class Constraint
{
    public function notBlank($name, $value)
    {
        if (empty($value)) {
            return '<p class="alert alert-danger" role="alert">Le champ '.$name.' est vide</p>';
        }
    }

    public function minLength($name, $value, $minSize)
    {
        if (strlen($value) < $minSize) {
            return '<p class="alert alert-danger" role="alert">Le champ '.$name.' doit contenir au moins '.$minSize.' caractères</p>';
        }
    }

    public function maxLength($name, $value, $maxSize)
    {
        if (strlen($value) > $maxSize) {
            return '<p class="alert alert-danger" role="alert">Le champ '.$name.' doit contenir au maximum '.$maxSize.' caractères</p>';
        }
    }
}