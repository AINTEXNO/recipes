<?php

namespace app\classes;

interface crudInterface
{
    // create
    public function insert(array $data);
    // read
    public function select(string $sql = "", array $variables = []);
    // update
    public function update(array $data, string $param);
    // delete
    public function delete(string $sql, array $variables);
}