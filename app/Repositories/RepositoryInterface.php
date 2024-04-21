<?php
namespace App\Repositories;

abstract class RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->model = app($this->model());
    }

    abstract public function model();

//    public function storeWithRepository();

}
