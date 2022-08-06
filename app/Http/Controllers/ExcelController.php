<?php

namespace App\Http\Controllers;

use App\Exports\PurchaseExport;
use App\Exports\StudentExport;
use Maatwebsite\Excel\Facades\Excel;


class ExcelController extends Controller
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
        return Excel::download(new StudentExport, 'relatório.xls');
    }

    public function studentExcel($id)
    {
        return Excel::download(new PurchaseExport($id), 'relatório-estudante.xls');
    }
}
