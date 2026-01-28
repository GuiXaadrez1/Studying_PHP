<?php

namespace App\Repositories\Contracts;

interface AdminInterface{
    public function getAllAdmin();
    public function getAdmin(int $id):object;
    public function insert($data):bool;
    public function update(int $id,$data):bool;
};
