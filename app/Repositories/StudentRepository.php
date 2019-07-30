<?php

namespace App\Repositories;

use App\Http\Requests\StudentRequest;
use App\Models\Result;
use App\Models\Student;
use Carbon\Carbon;

class StudentRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Student::class;
    }

    protected $resultRepository;

    public function __construct(Student $student, Result $result)
    {
        parent::__construct($student);
        $this->resultRepository = $result;
    }

    public function uploadImage(StudentRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $end = $file->getClientOriginalExtension();
            if ($end != 'jpg' && $end != 'png' && $end != 'jpeg') {
                return redirect()->back()->with('error', 'You have to enter image have .jpg or .png or .jpeg');
            }
            $name = $file->getClientOriginalName();
            $file->move(public_path('upload'), $name);
            $data['image'] = $name;
        }
        return $data;
    }

    public function getOne($id)
    {
        return $this->resultRepository->where('student_id', $id)->get();
    }

    public function search($data)
    {
        $students = $this->model->select('*');

        if (isset($data['min_age']) || isset($data['max_age'])) {
            isset($data['min_age']) ? $minAge = Carbon::now()->subYears($data['min_age'])->lastOfYear()->format('Y-m-d') : $minAge = Carbon::now();
            isset($data['max_age']) ? $maxAge = Carbon::now()->subYears($data['max_age'])->firstOfYear()->format('Y-m-d') : $maxAge = 0;

            $students->whereBetween('birthday', [$maxAge, $minAge]);
        }
        if (isset($data['min_mark']) || isset($data['max_mark'])) {
            $students->whereHas('results', function ($query) use ($data) {
                isset($data['min_mark']) ? $minMark = $data['min_mark'] : $minMark = 0;
                isset($data['max_mark']) ? $maxMark = $data['max_mark'] : $maxMark = 10;
                $query->whereBetween('mark', [$minMark, $maxMark]);
            });
        }
        if (isset($data['subject_id'])) {
            $students->whereHas('subjects', function ($query) use ($data) {
                $query->where('subjects.id', $data['subject_id']);
            });
        }
        if (!empty($data['phones'])) {
            $students->where(function ($query) use ($data) {
                foreach ($data['phones'] as $phone) {
                    $query->orWhere('phone', 'REGEXP', Student::PHONES[$phone]);
                }
            });

        }

        return $students->get();

    }
}
