<?php

namespace App\Modulos\Inicio\Controllers;

use App\Mail\Correo;
use Illuminate\Support\Facades\Mail;
use App\Models\parciale;


use App\Http\Controllers\Controller;
use App\Models\inicio;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listado = parciale::get();
        return view('Inicio::inicio', compact('listado'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = $request->all();
        $datos=  $request->except('_token'); 

        if(parciale::insert($datos)){
            $info = parciale::get();
            foreach($info as $inf){
                echo "
                    <tr>
                        <td>".$inf->nombre."</td>
                        <td>".$inf->parcial1."</td>
                        <td>".$inf->parcial2."</td>
                        <td>".$inf->parcial3."</td>
                        <td>".$inf->final."</td>
                        <td>
                        <button class='btn btn-danger' onclick='eliminarRegistro(".$inf->id.")'>Eliminar</button></td>
                    </tr>
                ";
            }
        }else{

            echo 2;
        }
    }
 
    public function destroy(Request $r)
    {
            $id = $r->input('id');

            if(parciale::findOrFail($id)->delete()){
                $info = parciale::get();
                foreach($info as $inf){
                    echo "
                        <tr>
                            <td>".$inf->nombre."</td>
                            <td>".$inf->parcial1."</td>
                            <td>".$inf->parcial2."</td>
                            <td>".$inf->parcial3."</td>
                            <td>".$inf->final."</td>
                            <td>
                            <button class='btn btn-danger' onclick='eliminarRegistro(".$inf->id.")'>Eliminar</button></td>
                        </tr>
                    ";
                }
            }else{
                echo 2;
            }
    }
}
