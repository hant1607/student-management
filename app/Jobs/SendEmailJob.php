<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Student;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $student;
    public function __construct(Student $student)
    {
        $this->student=$student;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = array(
            'name'=>$this->student->name,
            'email'=>$this->student->user->email,
        );
        Mail::send('admin.students.bad_students',$data, function ($message) use ($data){
           $message->from('nguyenha98nq@gmail.com', 'Admin');
           $message->to($data['email'])->subject('Dear '.$data['name'].' warning email');
        });
    }
}
