<?php

namespace App\Repositories;

use App\Http\Requests\ClassRequest;
use App\Models\ClassModel;

class ClassRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return ClassModel::class;
    }

    public function __construct(ClassModel $class)
    {
        parent::__construct($class);
    }

}
