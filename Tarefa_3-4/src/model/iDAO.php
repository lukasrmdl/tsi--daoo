<?php

namespace tsi_daoo\Tarefa_3\model;

interface iDAO
{
    public function create();
    public function read($id = null);
    public function update();
    public function delete($id);
    
    public function filter(array $filters);
    public function getColumns():array;
}