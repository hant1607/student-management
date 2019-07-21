<?php
namespace App\Repositories;
use App\Http\Requests\StudentRequest;
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
    public function __construct(Student $student){
        parent::__construct($student);
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
}
