<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;
use App\Models\User;
use App\Models\Post;


class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Post $post)
    {
        //validar
        $this->validate($request, [
            'comentario' => 'required|max:255'
        ]);

        //almacenar el resultado
        comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comentario' => $request->comentario
        ]);
 
        //Imprimir el mensaje
        return back()->with('mensaje', 'se comento correctamente');


    }
}
