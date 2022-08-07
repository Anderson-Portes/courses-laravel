<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Purchase;
use App\Models\Student;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('check_user_type:Admin', [
            'except' => [
                'deleteStudentPurchase'
            ]
        ]);

        $this->middleware('auth', [
            'only' => [
                'deleteStudentPurchase'
            ]
        ]);
    }

    public function studentPurchases($id)
    {
        $student = Student::find($id);
        $courses = Course::where('current_subscribers', '<', 'subscribers_quantity')
            ->where('end_date', '>', now())->get()->sortDesc();

        if (!$student) {
            return back()->withErrors(['Aluno não encontrado']);
        }

        return view('purchase.index', compact('student', 'courses'));
    }

    public function addStudentPurchase($id, Request $request)
    {
        $request->validate([
            'course_id' => 'required|numeric'
        ]);

        $student = Student::find($id);

        if (!$student) {
            return back()->withErrors(['Aluno não encontrado.']);
        }

        $allData = $request->all();
        $allData['student_id'] = $id;

        if ($student->purchases->firstWhere("course_id", $allData['course_id'])) {
            return back()->withErrors(['O aluno ja possui esse curso']);
        }

        Purchase::create($allData);

        $course = Course::find($allData['course_id']);
        $course->update([
            'current_subscribers' => $course->current_subscribers + 1
        ]);

        return back()->with('success', 'Novo curso adicionado para o aluno.');
    }

    public function deleteStudentPurchase($id)
    {
        $purchase = Purchase::find($id);

        if (!$purchase) {
            return back()->withErrors(['Compra não encontrada.']);
        }

        $purchase->course->update([
            'current_subscribers' => $purchase->course->current_subscribers - 1
        ]);

        $purchase->delete();

        return back()->with('success', 'Compra deletada com sucesso.');
    }

    public function updateStudentPurchaseStatus($id)
    {
        $purchase = Purchase::find($id);

        if (!$purchase) {
            return back()->withErrors(['Compra não encontrada.']);
        }

        $purchase->update([
            'paid_out' => !$purchase->paid_out
        ]);

        return back()->with('success', 'Status da compra modificado com sucesso.');
    }
}
