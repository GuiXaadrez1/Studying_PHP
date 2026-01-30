<?php

namespace App\Repositories\Contracts;

interface AdminInterface{
    public function findAllAdmins():?object;
    public function findAdmin($id):?object;
    public function findAllActivyAdmins():?object;
    public function findActivyAdmin(int $id):?object;
    public function isIdAdminDeleted(int $id):bool;
    public function insert($data,int $idadminfk):bool;
    public function update(int $id,$data):bool;
    public function delete(int $id,$data):bool;
};
