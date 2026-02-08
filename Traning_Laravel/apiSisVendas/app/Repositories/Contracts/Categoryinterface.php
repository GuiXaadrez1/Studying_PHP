<?php

namespace App\Repositories\Contracts;

interface Categoryinterface{

    public function findAllCategory();
    public function findCategory(int $id);
    public function findAllCatagoryActivy();
    public function findCatagoryActivy(int $id);
    public function isIdCategoryDeleted(int $id);
    public function insert(int $idadmin,$data):bool;
    public function update(int $idcategory, $data):bool;
};