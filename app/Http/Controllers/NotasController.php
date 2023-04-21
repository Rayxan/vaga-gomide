<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotasController extends Controller
{
    public function index()
    {
        $notas = Nota::all();

        // dd($notas);

        return view(
            'welcome',
            [
                'notas' => $notas,
            ]
        );
    }

    public function search()
    {
        # code...
    }
}
