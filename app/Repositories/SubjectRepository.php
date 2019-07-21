<?php
namespace App\Repositories;

use App\Models\Subject;

class SubjectRepository extends EloquentRepository
{

    /**
     * get model
     * @param Subject $subject
     */
    public function getModel()
    {
        return Subject::class;
    }
    public function __construct(Subject $subject)
    {
        parent::__construct($subject);
    }
}