<?php
namespace App\Repositories;
use App\Http\Requests\StudentRequest;
use App\Models\Result;
use App\Models\Student;

class StudentRepository extends EloquentRepository{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Student::class;
    }
    protected $resultRepository;
    public function __construct(Student $student, Result $result){
        parent::__construct($student);
        $this->resultRepository = $result;
    }
    public function uploadImage(StudentRequest $request)
    {
        $data = $request->all();
        if($request->hasFile('image')){
            $file = $request->file('image');
            $end = $file->getClientOriginalExtension();
            if($end != 'jpg' && $end != 'png' && $end != 'jpeg'){
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
}
