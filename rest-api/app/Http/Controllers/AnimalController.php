<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public $animals = ["Ayam", "Ikan", "Kucing", "Burung", "Kambing"];

    public function index()
    {
        echo "Menampilkan data animals <br>";
        foreach ($this->animals as $x) {
            echo $x . "<br>";
        };
    }

    public function store(Request $request)
    {
        echo "Menambahkan hewan baru $request->nama <br>";
        array_push($this->animals, $request->nama);
        $this->index();
    }

        public function update(Request $request, $id)
    {   
        echo "Mengupdate data hewan id $id dengan nama $request->nama <br>";
        $this->animals[$id] = $request->nama;
        $this->index();
    }

    public function destroy($id)
    {
        echo "Menghapus data hewan id $id";
        unset($this->animals[$id]);
        $this->index();
    }
}