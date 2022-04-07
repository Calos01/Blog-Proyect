<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PageController extends Controller
{
    //creamos las funciones q llamaremos en el html
    public function posts(){
        //de manera directa cargara los posts de cada usuario con with
        //latest traera los datos mas recientes y paginate lo oredenara en forma de paginacion
      return view('posts',['posts'=>Post::with('user')->latest()->paginate()]);
    }
    public function post(Post $post){
        return view('post',['post'=>$post]);  //aqui cargara solo un post
    }
}
