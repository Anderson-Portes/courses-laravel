<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("student.index")->with("students", Student::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::where("end_date", ">", Carbon::now())->where("current_subscribers", "<", "subscribers_quantity")
            ->get();
        return view('student.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|min:9',
            'telephone' => 'nullable|min:8',
            'company' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string|max:2',
            'district' => 'required|string',
            'complement' => 'required|string',
            'number' => 'required|string',
            'course_id' => 'required',
            'cep' => 'required|numeric|min:8',
            'cpf' => 'required|cpf|unique:students',
            'category' => 'required'
        ]);

        $allData = $request->all();


        $allData['type'] = "Usuário";

        $user = User::create($allData);
        $allData['user_id'] = $user->id;

        $newAddress = Address::create($allData);

        $allData['address_id'] = $newAddress->id;

        Student::create($allData);

        $course = Course::find($allData['course_id']);
        $course->current_subscribers = $course->current_subscribers + 1;
        $course->update();

        return back()->with('success', 'Aluno adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus($id)
    {
        $student = Student::find($id);
        $student->update(
            ['paid_out' => !$student->paid_out]
        );

        return back()->with('success', 'Status de pagamento modificado!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $courses = Course::where("end_date", ">", Carbon::now())->where("current_subscribers", "<", "subscribers_quantity")
            ->get();
        return view("student.edit", compact('courses'))->with('student', Student::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|confirmed',
            'cpf' => 'required|cpf',
            'phone' => 'required|min:9',
            'telephone' => 'required|min:8',
            'company' => 'required|string',
            'cep' => 'required|numeric',
            'state' => 'required|string|max:2',
            'city' => 'required|string',
            'district' => 'required|string',
            'number' => 'required|string',
            'course_id' => 'required',
            'category' => 'required'
        ]);

        $student = Student::find($id);

        if (!$student) {
            return back()->withErrors(['Aluno não encontrado.']);
        }

        $allData = $request->all();

        $emailExists = User::where("email", $allData['email'])->first();
        $cpfExists = Student::where("cpf", $allData['cpf'])->first();

        if ($emailExists && $emailExists->id != $student->user_id) {
            return back()->withErrors(['Email indisponível.']);
        }

        if ($cpfExists && $cpfExists->id != $id) {
            return back()->withErrors(['CPF Indísponível.']);
        }

        if ($allData['course_id'] != $student->course_id) {
            if (isset($student->course))
                $student->course->update(
                    ['current_subscribers' => $student->course->current_subscribers - 1]
                );

            $newCourse = Course::find($allData['course_id']);
            $newCourse->update(
                ['current_subscribers' => $newCourse->current_subscribers + 1]
            );
        }

        $student->update($allData);
        $student->address->update($allData);
        $student->user->update($allData);

        return back()->with('success', 'Aluno editado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);

        if ($student) {
            $course = Course::find($student->course_id);
            $course->current_subscribers = $course->current_subscribers - 1;
            $course->update();
            User::destroy($student->user_id);
        }

        return back()->with('success', 'Aluno deletado com sucesso!');
    }
}
