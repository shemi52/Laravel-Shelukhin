<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\StatMail;
use App\Models\Click;
use Illuminate\Support\Facades\Log;

class SendStat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-stat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $article_counts = Click::groupBy('article_id')->get()->map(function($item){
            return ['article_title'=>$item->article_title, 'count'=>$item->count()];
        });
        Click::whereNotNull('article_id')->delete();
        //Log::alert($article_counts);
        $comments = Comment::whereDate('created_at', Carbon::today())->count();
        Mail::to('m.shelukhin@internet.ru')->send(new StatMail($comments,$article_counts));
    }
}