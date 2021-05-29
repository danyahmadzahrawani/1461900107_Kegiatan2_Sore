<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table("tbl_ruangan")
            ->select("setup_kelas.nama_kelas", "data_siswa.nama_siswa")
            ->join("data_siswa", "data_siswa.id_siswa", "tbl_ruangan.id_siswa")
            ->join("setup_kelas", "setup_kelas.id_kelas", "tbl_ruangan.id_kelas");
        if ($request->has("search")){
            $query->where("setup_kelas.nama_kelas", "LIKE", "%$request->search%")
            ->orWhere("data_siswa.nama_siswa", "LIKE", "%$request->search%");
        }

        $select_join = $query->get();

        return view("index-0107", compact('select_join'));
    }
}