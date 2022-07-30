<?php

namespace App\Http\Controllers;

use App\Models\Student;
use PDF;

class PdfController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('check_user_type:Admin');
    }

    public function index()
    {
        $students = Student::all();

        $data = [
            'title' => 'Relatório dos estudantes',
            'date' => date('d/m/Y'),
            'students' => $students
        ];

        $pdf = PDF::loadView('file', $data);

        return $pdf->download('relatório.pdf');
    }
}
