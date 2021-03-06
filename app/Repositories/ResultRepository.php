<?php

namespace App\Repositories;

use App\Models\Result;

class ResultRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Result::class;
    }

    public function __construct(Result $result)
    {
        parent::__construct($result);
    }

}
