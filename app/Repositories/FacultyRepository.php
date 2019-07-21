<?php
namespace App\Repositories;

use App\Models\Faculty;

class FacultyRepository extends EloquentRepository{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Faculty::class;
    }
    public function __construct(Faculty $faculty)
    {
        parent::__construct($faculty);
    }
}
