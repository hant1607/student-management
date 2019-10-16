<?php

namespace Tests\Unit\Repositories;

use App\Models\ClassModel;
use App\Models\Result;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use App\Repositories\StudentRepository;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Factory as Faker;

class StudentTest extends TestCase
{
    protected $data, $studentRepository;
    /**
     * A basic unit test example.
     *
     * @return void
     */
//    public function testExample()
//    {
//        $this->assertTrue(true);
//    }

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $class = ClassModel::select('id')->get();
        $user = factory(User::class)->create();
        $faker = Faker::create();
        $this->data = [
            'name' => $faker->name,
            'user_id' => $user->id,
            'class_id' => $class->shuffle()->first()->id,
            'birthday' => $faker->date('Y-m-d', 'now'),
            'gender' => rand(1, 2),
            'phone' => $faker->phoneNumber,
            'image' => $faker->image(public_path('upload'), 100, 70, null, false)
        ];

        $this->studentRepository = new StudentRepository(new Student, new Result);
    }

    public function tearDown(): void
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
    }

    public function testCreate()
    {
        $student = $this->studentRepository->create($this->data);
        $this->assertInstanceOf(Student::class, $student);
        $this->assertEquals($this->data['name'], $student->name);
        $this->assertEquals($this->data['user_id'], $student->user_id);
        $this->assertEquals($this->data['class_id'], $student->class_id);
        $this->assertEquals($this->data['birthday'], $student->birthday);
        $this->assertEquals($this->data['gender'], $student->gender);
        $this->assertEquals($this->data['phone'], $student->phone);
        $this->assertEquals($this->data['image'], $student->image);
    }

    public function testFind()
    {
        $student = factory(Student::class)->create();
        $found = $this->studentRepository->find($student->id);
        $this->assertInstanceOf(Student::class, $found);
        $this->assertEquals($found->name, $student->name);
        $this->assertEquals($found->user_id, $student->user_id);
        $this->assertEquals($found->class_id, $student->class_id);
        $this->assertEquals($found->birthday, $student->birthday);
        $this->assertEquals($found->gender, $student->gender);
        $this->assertEquals($found->phone, $student->phone);
        $this->assertEquals($found->image, $student->image);
    }

    public function testUpdate()
    {
        $student = factory(Student::class)->create();
        $studentUpdate = $this->studentRepository->update($student->id, $this->data);
        $this->assertInstanceOf(Student::class, $studentUpdate);
        $this->assertEquals($this->data['name'], $studentUpdate->name);
        $this->assertEquals($this->data['user_id'], $studentUpdate->user_id);
        $this->assertEquals($this->data['class_id'], $studentUpdate->class_id);
        $this->assertEquals($this->data['birthday'], $studentUpdate->birthday);
        $this->assertEquals($this->data['gender'], $studentUpdate->gender);
        $this->assertEquals($this->data['phone'], $studentUpdate->phone);
        $this->assertEquals($this->data['image'], $studentUpdate->image);
    }

    public function testDelete()
    {
        $student = factory(Student::class)->create();
        $studentDelete = $this->studentRepository->delete($student->id);
        $this->assertTrue($studentDelete);
    }

//    public function testUploadImage()
//    {
//        $image = $this->studentRepository->uploadImage($this->data);
//        $this->assertInstanceOf(Student::class, $image);
//        $this->assertEquals($image->image, $this->data['image']);
//    }

    public function testSearch()
    {
        $data['min_age'] = '20';
        $data['max_age'] = '30';
        $data['min_mark'] = '4';
        $data['max_mark'] = '7';
        $subject = Subject::select('id')->get();
        $data['subject_id'] = $subject->shuffle()->first()->id;
        $data['phones'] = ['1'];
        //$data['finish'] = rand(1,2);

        $student = $this->studentRepository->search($data)->first();

        $this->assertInstanceOf(Student::class, $student);
        //$this->assertArrayHasKey($data['phones'], $student->phone);
        $this->assertGreaterThanOrEqual($data['min_age'], Carbon::now()->diffInYears($student->birthday));
        $this->assertLessThanOrEqual($data['max_age'], Carbon::now()->diffInYears($student->birthday));
        if (!empty($student->results) && !empty($student->results->first())) {
            $this->assertGreaterThanOrEqual($data['min_mark'], $student->results->first()->mark);
            $this->assertLessThanOrEqual($data['max_mark'], $student->results->first()->mark);
        }
        $this->assertEquals($student->subjects->first()->subject_id, $data['subject_id']);
    }
}
