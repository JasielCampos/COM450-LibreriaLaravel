<?php

namespace App\Http\Controllers;

use App\Models\student;
use App\Http\Requests\StorestudentRequest;
use App\Http\Requests\UpdatestudentRequest;

use Dompdf\Dompdf;
use Dompdf\Options;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('student.index', [
            'students' => student::Paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorestudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(StorestudentRequest $request)
    // {
    //     student::create($request->validated());

    //     return redirect()->route('students');
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = student::find($id)->first();
        return $student;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(student $student)
    {
        return view('student.edit', [
            'student' => $student
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatestudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    // public function update(UpdatestudentRequest $request, $id)
    // {
    //     $student = student::find($id);
    //     $student->name = $request->name;
    //     $student->address = $request->address;
    //     $student->gender = $request->gender;
    //     $student->class = $request->class;
    //     $student->age = $request->age;
    //     $student->phone = $request->phone;
    //     $student->email = $request->email;
    //     $student->save();

    //     return redirect()->route('students');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        student::find($id)->delete();
        return redirect()->route('students');
    }


    // Generar CarnetPdf
    // public function generatePDF($id)
    // {
    //     $student = Student::findOrFail($id);

    //     $options = new Options();
    //     $options->set('isHtml5ParserEnabled', true);
    //     $options->set('isPhpEnabled', true);

    //     $dompdf = new Dompdf($options);

    //     $html = view('pdf.student', compact('student'));

    //     $dompdf->loadHtml($html);
    //     $dompdf->setPaper('A4', 'portrait');

    //     $dompdf->render();
    //     $dompdf->stream("carnet_estudiante_$student->name.pdf");
    // }

    public function generatePDF($id)
    {
        $student = Student::findOrFail($id);

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);

        $html = view('pdf.student', compact('student'));

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        // Stream the PDF to the browser with option 'Attachment' set to false
        return $dompdf->stream("carnet_estudiante_$student->name.pdf", ['Attachment' => false]);
    }

    public function store(StorestudentRequest $request)
    {
        $data = $request->validated();

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $data['photo'] = $fileName; // This should save the filename to the database
        }

        // The create method should save the student with the photo filename
        Student::create($data);

        return redirect()->route('students');
    }


    public function update(UpdatestudentRequest $request, $id)
    {
        $data = $request->validated();
        $student = Student::find($id);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $data['photo'] = $fileName;
        }

        $student->update($data);

        return redirect()->route('students');
    }

}