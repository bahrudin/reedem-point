<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\PointReadTimeStoreRequest;
use App\Models\Article;
use App\Models\MemberPoint;
use App\Models\User;

class MemberPointController extends Controller
{
    /**
     * Menambah point ke table member-point
     */
    public function pointReadTime(PointReadTimeStoreRequest $request){

        $userId = $request->input('user_id');
        $article = Article::where('slug', $request->input('slug'))->first();

        if ($article) {

            $program = $article->program;

            if ($program) {
                // Point berdasarkan id
                $point = $program->points()->where('id', $article->point_id)->first();

                if ($point) {
                    // User
                    $user = User::find($userId);

                    if ($user) {
                        // Cari atau buat data pada memberPoint
                        $memberPoint = MemberPoint::firstOrNew([
                            'point_id' => $point->id,
                            'program_id' => $program->id,
                            'user_id' => $user->id,
                        ]);

                        // Tambah amount_point dari amount Point
                        $memberPoint->amount_point += $point->amount;
                        $memberPoint->save();

                        return response()->json(['status'=>true,'message' => 'Point success ditambahkan'],200);

                    } else {
                        return response()->json(['status'=>false,'message' => 'User tidak ditemukan','errors'=>$user], 404);
                    }
                } else {
                    return response()->json(['status'=>false,'message' => 'Point tidak ditemukan','errors'=>$point], 404);
                }
            } else {
                return response()->json(['status'=>false,'message' => 'Program tidak ditemukan','errors'=>$program],404);
            }
        } else {
            return response()->json(['status'=>false,'message' => 'Article tidak ditemukan', 'errors'=>$article], 404);
        }
    }
}
