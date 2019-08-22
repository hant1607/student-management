<?php

namespace App\Repositories;

use App\Http\Requests\StudentRequest;
use App\Models\Result;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

        if(isset($data['min_age'])){
            $minYear = Carbon::now()->subYears($data['min_age']);
            $students->where('birthday', '<', $minYear);
        }
        if(isset($data['max_age'])){
            $maxYear = Carbon::now()->subYears($data['max_age']);
            $students->where('birthday', '>', $maxYear);
        }
        if(isset($data['min_mark'])){
            $students->whereHas('results', function ($query) use ($data) {
                $query->where('mark', '>=', $data['min_mark']);
            });
        }
        if(isset($data['max_mark'])){
            $students->whereHas('results', function ($query) use ($data) {
                $query->where('mark', '<=', $data['max_mark']);
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
        if (isset($data['finish'])) {
            $countSubjects = DB::table('subjects')->count();
            if ($data['finish'] == 1) {
                $students->has('subjects', $countSubjects);
            }
            if ($data['finish'] == 2) {
                //$students = $this->model->withCount('subjects')->having('subjects_count', '<', $countSubjects)->get();
                $students->has('subjects', '<>', $countSubjects);
            }
        }
        return $students->paginate(5);

    }

    public function studentToSendEmail()
    {
        $countSubjects = DB::table('subjects')->count();
        $students = $this->model->has('subjects', $countSubjects)->whereHas('subjects', function ($query){
          $query->havingRaw('AVG(mark) < 5');
        });
        //dd($students->get());
//        $students = [];
//        foreach ($countStudent as $st){
//            $avgMark = $st->results->avg('mark');
//            if($avgMark < 5){
//                $students[] = $st;
//            }
//        }
//        foreach ($countStudent as $st){
//            $avgMark = $st->results->avg('mark');
//        }
//        $students = $countStudent->where($avgMark, '<', 5);
        return $students->paginate(5);
    }
}
