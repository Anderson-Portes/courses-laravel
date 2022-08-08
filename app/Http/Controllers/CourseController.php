<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;

class CourseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('check_user_type:Admin', [
            'except' => 'show'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("course.index")->with("courses", Course::all()->sortDesc());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("course.create");
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
            'name' => 'required|unique:courses',
            'description' => 'nullable|string',
            'price' => 'required',
            'start_date' => 'required|date|after:tomorrow',
            'end_date' => 'required|date|after:start_date',
            'subscribers_quantity' => 'required',
            'file' => [File::types(['pdf', 'docx', 'pptx', 'zip'])],
            'photo' => 'required|image'
        ]);

        $courseData = $request->all();

        $fileName = time() . $request->file('file')->getClientOriginalName();
        $filePath = $request->file('file')->storeAs('files', $fileName, 'public');
        $courseData['file_name'] = "/storage/" . $filePath;

        $photoName = time() . $request->file('photo')->getClientOriginalName();
        $photoPath = $request->file('photo')->storeAs('images', $photoName, 'public');
        $courseData['photo_name'] = "/storage/" . $photoPath;

        Course::create($courseData);
        return back()->with('success', 'Curso adicionado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return redirect("cursos");
        }

        return view("course.edit", compact('course'));
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
            'name' => 'required',
            'description' => 'nullable|string',
            'price' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'subscribers_quantity' => 'required',
            'file' => ['nullable', File::types(['pdf', 'docx', 'pptx', 'zip'])],
            'photo' => 'nullable|image'
        ]);

        $course = Course::find($id);

        if (!$course) {
            return redirect("cursos");
        }

        $courseData = $request->all();
        $courseExists = Course::firstWhere('name', $courseData['name']);

        if ($courseExists && $courseExists->id != $id) {
            return back()->withErrors(['Este curso ja existe.']);
        }

        if ($request->file('file')) {
            $fileName = time() . $request->file('file')->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('files', $fileName, 'public');
            $courseData['file_name'] = "/storage/" . $filePath;
        }

        if ($request->file('photo')) {
            $photoName = time() . $request->file('photo')->getClientOriginalName();
            $photoPath = $request->file('photo')->storeAs('images', $photoName, 'public');
            $courseData['photo_name'] = "/storage/" . $photoPath;
        }

        $course->update($courseData);
        return back()->with('success', 'Curso editado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Course::destroy($id);
        return back()->with('success', 'Curso excluido com sucesso.');
    }
}
