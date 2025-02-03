<?php

namespace App\Jobs;
use App\Mail\UpdateNote;
use App\Traits\EmailTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class DefaultJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use EmailTrait;
    private $email;
    private $content;
    private $subject;
    private $name = null;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $subject, $content, $name = null)
    {
        $this->email = $email;
        $this->content = $content;
        $this->name = $name;
        $this->subject = $subject;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Mail::to($this->email)->send(new UpdateNote($this->subject, $this->content, $this->name));
        }catch (\Exception $e){
            //
        }
    }
}
