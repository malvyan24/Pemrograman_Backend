<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get all students
        $students = Student::query();

        // Filter by name if provided
        $name = $request->input('filter.nama');
        if ($name) {
            $students->where('nama', $name);
        }

        // Get sorting parameters
        $order = $request->input('filter.order', 'asc');
        $sort = $request->input('filter.sort', 'nama');

        // Pagination parameters
        $pageLimit = $request->input('page.limit', 1);
        $pageNumber = $request->input('page.number', 1);
        $offset = ($pageNumber - 1) * $pageLimit;

        // Apply sorting and pagination
        $students->orderBy($sort, $order)->offset($offset)->limit($pageLimit);

        // Get total count for pagination
        $studentTotal = Student::query();
        if ($name) {
            $studentTotal->where('nama', $name);
        }
        $totalData = $studentTotal->count();
        $totalPage = ceil($totalData / $pageLimit);

        // Prepare response data
        $pages = [
            'pageLimit' => (int)$pageLimit,
            'pageNumber' => (int)$pageNumber,
            'totalData' => $totalData,
            'totalPage' => $totalPage,
        ];

        $data = [
            'pages' => $pages,
            'table' => $students->get(),
        ];
        if ($data['table']->count() > 0) {
            $result = [
                'message' => 'Success Get All Users',
                'data' => $data,
            ];
        } else {
            $result = [
                'message' => 'Data not found',
            ];
        }
        return response()->json($result, 200);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        #validasi data
        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'jurusan' => 'required',
            'email' => 'required'
        ]);
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::find($id);

        if ($student == null) {
            $data = [
                'message' => 'resource not found'
            ];

            return response()->json($data, 404);
        } else {
            $data = [
                'message' => 'get student by id',
                'data' => $student
            ];
    
            return response()->json($data, 200);
        }
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
