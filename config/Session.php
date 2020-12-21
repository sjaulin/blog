<?php

namespace App\config;

/**
 * Work with values on SESSION data.
 */
class Session
{
    private $session;

    public function __construct($session)
    {
        $this->session = $session;
    }

    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public function get($name)
    {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }
    }

    public function show($name)
    {
        if (isset($_SESSION[$name])) {
            $key = $this->get($name);
            $this->remove($name);
            if (!empty($key)) {
                if (is_array($key) && !empty($key['type']) && !empty($key['value'])) {
                    return '<p class="alert alert-' . $key['type'] . '">' . $key['value'] . '</p>';
                }
                return '<p class="alert alert-primary">' . $key . '</p>';
            }
        }
    }

    public function remove($name)
    {
        unset($_SESSION[$name]);
    }

    public function start()
    {
        session_start();
    }
    
    public function stop()
    {
        session_destroy();
    }
}
