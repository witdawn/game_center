<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TakeTest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $a;
    private $b;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($a, $b)
    {
        $this->a = $a;
        $this->b = $b;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Log::info($this->a . '测试队列' . $this->b);
    }
}
