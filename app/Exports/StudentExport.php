<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StudentExport implements FromView
{
    public function view(): View
    {
        return view('file', [
            'title' => 'Relatório dos Alunos',
            'date' => date('d/m/Y'),
            'students' => Student::all()
        ]);
    }
}
