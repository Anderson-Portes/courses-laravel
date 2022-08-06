<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PurchaseExport implements FromView
{
    public function __construct(private int $id)
    {
    }

    public function view(): View
    {
        return view('studentfile', [
            'student' => Student::find($this->id)
        ]);
    }
}
