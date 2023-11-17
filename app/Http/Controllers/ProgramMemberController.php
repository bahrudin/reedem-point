<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\ProgramMemberStoreRequest;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class ProgramMemberController extends Controller
{
    public function create()
    {
        $programs = Program::all()->pluck('name','id')->toArray();
        return view('frontend.programs.joint', ['title'=>'Joint Program', 'programs'=>$programs]);
    }

    public function store(ProgramMemberStoreRequest $request)
    {
        try {
            $user = User::find(Auth::id());
            //$user->programMembership->contains('name', $request->name
            $saved = $user->programs()->attach($request->program_id);
            if ($saved) {
                return response()->json([
                    "status" => true,
                    "message" => "Operasi berhasil dilakukan",
                    "data" => $saved,
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Terjadi kesalahan dalam proses permintaan",
                "error_message" => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
