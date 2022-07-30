<?php

namespace App\Http\Controllers;

use App\Exports\StudentExport;
use Illuminate\Http\Request;
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
}
