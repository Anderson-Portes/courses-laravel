<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('check_user_type:Usuário');
    }

    public function __invoke()
    {
        return view('cart.index');
    }

    public function addCourseOnCart($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return back()->withErrors(['Curso não encontrado.']);
        }

        if (Auth::user()->student->purchases->firstWhere("course_id", $id)) {
            return back()->withErrors(['Você ja possui esse curso.']);
        }

        Purchase::create([
            'course_id' => $id,
            'student_id' => Auth::user()->student->id
        ]);

        $course->update([
            'current_subscribers' => $course->current_subscribers + 1
        ]);

        return back()->with('success', 'Curso adicionado ao carrinho.');
    }
}
