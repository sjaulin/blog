<?php

namespace App\src\constraint;
use App\config\Request;

/**
 * Set rules to used on constraints.
 */
class Constraint
{

    private $request;
    protected $session;
    
    public function __construct()
    {
        $this->request = new Request();
        $this->session = $this->request->getSession();
    }

    public function notBlank($name, $value)
    {
        if (empty($value)) {
            $this->session->set('alert_' . $name, array('type' => 'danger', 'value' => 'Le champ ' . $name . ' est vide'));
            return $name;
        }
    }

    public function noTags($name, $value)
    {
        if ($value != strip_tags($value)) {
            $this->session->set('alert_' . $name, array('type' => 'danger', 'value' => 'Le champ ' . $name . ' contient des caractères interdits'));
            return $name;
        }
    }

    public function minLength($name, $value, $minSize)
    {
        if (strlen($value) < $minSize) {
            $this->session->set('alert_' . $name, array('type' => 'danger', 'value' => 'Le champ ' . $name . ' doit contenir au moins '.$minSize.' caractères'));
            return $name;
        }
    }

    public function maxLength($name, $value, $maxSize)
    {
        if (strlen($value) > $maxSize) {
            $this->session->set('alert_' . $name, array('type' => 'danger', 'value' => 'Le champ ' . $name . ' doit contenir au maximum '.$maxSize.' caractères'));
            return $name;
        }
    }
}
