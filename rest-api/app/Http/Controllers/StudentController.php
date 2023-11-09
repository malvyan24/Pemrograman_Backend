<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    #menggunakan model student intuk mengambil data dari database
    {
        $students = Student::all();

        $data = [
            'message' => 'get all students',
            'data' => $students
        ];

        #mengirim data (json) dan kode 200
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        #mengambil data dari request
        $input = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'jurusan' => $request->jurusan,
            'email' => $request->email
        ];
        
        #menggunakan model student untuk insert data
        $student = Student::create($input);

        $data = [
            'message' => 'data berhasil buat',
            'data' => $student
        ];

        #mengembalikan data (json) dan kode 201
        return response()->json($data, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::find($id);
        $input = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'jurusan' => $request->jurusan,
            'email' => $request->email
        ];
        $student->update($input);
        $data = [
            'message' => 'Students is Update successfully',
            'data' => $student
        ];

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);
        $student->delete();

        $data = [
            'message' => 'Students is Delete successfully',
            'data' => $student
        ];

        return response()->json($data, 200);
    }
}
