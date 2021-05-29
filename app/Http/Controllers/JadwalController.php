<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table("tbl_jadwal")
            ->select("setup_kelas.nama_kelas","setup_pelajaran.nama_pelajaran", "data_guru.nama_guru")
            ->join("data_guru", "data_guru.id_guru", "tbl_jadwal.id_guru")
            ->join("setup_pelajaran", "setup_pelajaran.id_pelajaran", "tbl_jadwal.id_pelajaran")
            ->join("setup_kelas", "setup_kelas.id_kelas", "tbl_jadwal.id_kelas");
        if ($request->has("search")){
            $query->where("setup_kelas.nama_kelas", "LIKE", "%$request->search%")
            ->orWhere("setup_pelajaran.nama_pelajaran", "LIKE", "%$request->search%")
            ->orWhere("data_guru.nama_guru", "LIKE", "%$request->search%");
        }

        $select_join = $query->get();

        return view("index-0107", compact('select_join'));
    }
}