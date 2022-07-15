<?php

namespace app\classes;

session_start();

class Session
{
    protected $session;

    public function __construct()
    {
        $this->session = $_SESSION;
    }

    public function get(string $key)
    {
        return $this->session[$key];
    }

    public function has(string $key): bool
    {
        return (bool)$this->session[$key];
    }

    public function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
        return $this->get($key);
    }

    public function all(): array
    {
        return $this->session;
    }
}

function session(): Session
{
    return new Session();
}