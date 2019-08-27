<?php

namespace App\Repositories;

use App\Models\Result;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
    protected $subjectRepository;
    protected $resultRepository;

    public function __construct(User $user, Student $student, Subject $subject, Result $result)
    {
        parent::__construct($user);
        $this->studentRepository = $student;
        $this->subjectRepository = $subject;
        $this->resultRepository = $result;
    }

    public function getStudentLogin($id)
    {
        return $this->studentRepository->where('user_id', $id)->get();
    }

    public function getSubjectNotStudy()
    {
        $subjects = Subject::doesntHave('result');
//        $resultStudied = $this->resultRepository->where('student_id', $studentId)->get();
//        $idStudied = [];
//        foreach ($resultStudied as $temp) {
//            $idStudied[] = $temp['subject_id'];
//        }
//        $subjects = DB::table('subjects')->whereNotIn('id', $idStudied)->get();
        return $subjects->paginate(10);
    }
}
