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
        
        return view(
            'welcome',
            [
                'notas' => $notas,
            ]
        );
    }

    public function search(Request $request)
    {
        $output = "";

        $notas = Nota::where('emitente', 'LIKE', "%$request->search%")
            ->orWhere('serie', 'LIKE', "%$request->search%")
            ->orWhere('UF', 'LIKE', "%$request->search%")
            ->orWhere('n', 'LIKE', "%$request->search%")
            ->orWhere('valor', 'LIKE', "%$request->search%")
            ->orWhere('emissao', 'LIKE', "%$request->search%")
            ->orWhere('mes_ano', 'LIKE', "%$request->search%"
            )->get();

            foreach($notas as $nota)
            {
                $output.=                
                
                '<tr>
                <td> '.$nota->emitente.' </td>
                <td> '.$nota->serie.' </td>
                <td> '.$nota->UF.' </td>
                <td> '.$nota->n.' </td>
                <td><b> '.$nota->valor.' </b></td>
                <td> '.$nota->emissao.' </td>
                <td> '.$nota->mes_ano.' </td>
                </tr>';
            }

            return response($output);
    }
}
