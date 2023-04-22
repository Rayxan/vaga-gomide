<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotasController extends Controller
{
    public function index()
    {

        $search = request('search');
        // dd($search);

        if($search) {
            $notas = Nota::where(function ($query) use ($search) {
                $query->where('emitente', 'LIKE', "%$search%")
                      ->orWhere('serie', 'LIKE', "%$search%")
                      ->orWhere('UF', 'LIKE', "%$search%")
                      ->orWhere('n', 'LIKE', "%$search%")
                      ->orWhere('valor', 'LIKE', "%$search%")
                      ->orWhere('emissao', 'LIKE', "%$search%")
                      ->orWhere('mes_ano', 'LIKE', "%$search%");
            })->get();

        } else {
            $notas = Nota::all();
        }

        return view(
            'welcome',
            [
                'notas' => $notas,
                'search' => $search,
            ]
        );
    }

    public function search()
    {
        # code...
    }
}
