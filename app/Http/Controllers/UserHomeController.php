<?php

namespace App\Http\Controllers;

use App\Models\MemberPoint;
use App\Models\Point;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserHomeController extends Controller
{
    public function index(){

        $userId = Auth::id();
        $totalAmount = MemberPoint::getTotalAmountPoint(Auth::id());
        $convertedAmount = MemberPoint::convertPointsToRupiah($totalAmount);

        $user = User::find($userId);
        $expiredPoints = $user->getExpiredPoints();

//        dd($expiredPoints);

        return view('frontend.home.dashboard',[
            'totalAmount'=>$totalAmount,
            'convertedAmount'=>$convertedAmount,
            'expiredPoints' =>$expiredPoints
        ]);
    }
    public function convertPointsToMoney(Request $request, $userId, $amount)
    {
        $user = User::findOrFail($userId);

        // Memanggil fungsi convertPoints dari model User
        $convertedAmount = $user->convertPoints($amount);

        if ($convertedAmount > 0) {
            return response()->json([
                'success' => true,
                'message' => "Poin berhasil dikonversi menjadi uang: $convertedAmount",
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Poin tidak cukup untuk dikonversi atau poin sudah dikonversi sebelumnya.',
            ]);
        }
    }
}
