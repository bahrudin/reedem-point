<?php

namespace App\Listeners;

use App\Events\ArticleRead;
use App\Models\Point;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Carbon\Carbon;

class AddPointsForArticleRead
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ArticleRead $event): void
    {
        $user = $event->user;
        $article = $event->article;

        // Hitung durasi membaca (asumsikan waktu artikel dibaca disimpan dalam kolom read_at)
//        $readDuration = $user->articles()->where('article_id', $article->id)->first()->pivot->read_at;
        $readDuration = new Carbon($user->articles()->where('article_id', $article->id)->first()->pivot->read_at);



//        if ($readDuration && $readDuration->diffInSeconds(Carbon::now()) >= 15) {
        if ($readDuration && $readDuration->diffInSeconds(Carbon::now()) >= 15) {
            // Tambahkan poin jika waktu membaca lebih dari 15 detik
//            Point::create([
////                'user_id' => $user->id,
//                'amount' => 1, // Jumlah poin yang ingin Anda berikan
//                'description' => 'Read article', // Deskripsi poin
//                'created_at' => Carbon::now(),
//                // tambahkan kolom lain yang diperlukan
//            ]);
        }
    }
}
