<?php

namespace App\Repositories;

use App\Models\Student;
use App\Models\User;

class UserRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return User::class;
    }

    protected $studentRepository;

    public function __construct(User $user, Student $student)
    {
        parent::__construct($user);
        $this->studentRepository = $student;
    }

    public function getStudentLogin($id){
        return $this->studentRepository->where('user_id', $id)->get();
    }
}
