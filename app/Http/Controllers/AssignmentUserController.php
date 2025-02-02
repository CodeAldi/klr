<?php

namespace App\Http\Controllers;

use App\Models\AssignmentUser;
use App\Models\LaborKomputer;
use App\Models\User;
use Illuminate\Http\Request;

class AssignmentUserController extends Controller
{
    function index() {
        $assignment = AssignmentUser::all()->groupBy('labor_komputer_id');
        // dd($assignment[1]);
        $kalab = User::doesntHave('assignment')->where('role','kepala labkom')->get();
        $teknisi = User::doesntHave('assignment')->where('role','teknisi labkom')->get();
        $labor = LaborKomputer::doesntHave('assignment')->get();
        return view('admin.assignmentUser')
        ->with('title','Assignment staff labor')
        ->with('assignment',$assignment)
        ->with('kalab',$kalab)
        ->with('teknisi',$teknisi)
        ->with('labor',$labor);
    }
    function store(Request $request) {
        $validatedData = $request->validate([
            'kalab' => 'required',
            'teknisi' => 'required',
            'labor' => 'required',
        ]);
        $assignment = new AssignmentUser();
        $assignment->user_id = $validatedData['kalab'];
        $assignment->labor_komputer_id= $validatedData['labor'];
        $assignment->save();

        $assignment = new AssignmentUser();
        $assignment->user_id = $validatedData['teknisi'];
        $assignment->labor_komputer_id = $validatedData['labor'];
        $assignment->save();
        return back();
    }
    function destroy($id) {
        $assignment = AssignmentUser::where('labor_komputer_id',$id)->get();
        if (count($assignment)>1) {
            foreach ($assignment as $key => $value) {
                $value->delete();
            }
        } else {
            $assignment[0]->delete();
        }
        
        return back();
    }
}
