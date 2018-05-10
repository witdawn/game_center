<?php

namespace App\Console\Commands;

use App\Models\Question;
use Illuminate\Console\Command;

class CopyQusetions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'copy_active {from?} {to?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '拷贝问题';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $from = trim($this->argument('from'));
        $to = trim($this->argument('to'));
        $questions = Question::where('active_id', $from)->get();
        Question::where('active_id',$to)->delete();
        foreach ($questions as $question) {
            $newq = new Question();
            $newq->active_id = $to;
            $newq->round_number = $question->round_number;
            $newq->title = $question->title;
            $newq->options = $question->options;
            $newq->answer = $question->answer;
            $newq->display_order = $question->display_order;
            $newq->score = $question->score;
            $newq->save();
        }
    }
}
