<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\PostRequest;
//Agregamos esto para poder eliminar las imagenes de Storage
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //LOs Controlador son para enviar los datos a la vista
        //traemos todos los post mas recientes
        $posts=Post::latest()->get();
        //y lo mostramos en la vista  compact esta traendo al $posts pero sin el $
        return view('posts.index', compact('posts'));//(posts.view)-posts es la carpeta en views y index es el archivo.blade
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //creamos vista para el create en carpeta posts archivo create.blade.php
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //salvar y guardar
        //creamos el Post segun el usuario con un nuevo id en user_id para  guardar
        //con request->all() traemos todos los datos
        $post=Post::create(['user_id'=>auth()->user()->id]+$request->all());
        //imagen
        if($request->file('file')){
            //si encuentra un archivo
            //guardamos la ruta en campo image en la bd y el archivo img en la carpeta posts
            $post->image=$request->file('file')->store('posts','public');//si no encuentra la carpeta posts dentro de public la crea
            $post->save();//guardamos la imagen en carpeta storage/app/public/posts
        }
        //volvemos
        return back()->with('status','creado con exito');//el status hace referencia ala vista .blade.php en donde hay
        //un @if(session('status')) este dara el mensaje si es q retorna correctamente q sera lo q pasamos 'creado con exito'
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    //eLIMINAMOS el metod show ya q le pusimos except en nuestro Route en web.php
    // public function show(Post $post)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //retornamos la vista
        //la ruta esra en views posts es la carpeta y edit el archivo.blade.php
        return view('posts.edit', compact('post'));
        //compact recibira el post q hemos seleccionado gracias al parametro de la funcion $post y nos ayudara
        //a enviarlo a nuestra vista para utilizarlo en el form action="{{route('posts.update',este es el q enviamos->>> $post)}}"
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->all());//editamos el post

        if($request->file('file')){
            //si encuentra un archivo en este caso la imagen
            //PRIMERO ELIMINAMOS LA IMAGEN EXISTENTE
            //en la carpeta public eliminamos la ruta de la imagen q esta en el campo image del post seleccionado q recibimos como parametro($post)
            // y esta ruta de la imagen q esta guardado en la bd es la ruta q esta en el Storage donde esta nuestra imagen  q tambn se eliminara
            //agregamos este if para saber si el post tiene image lo eliminamos
            //ya q con solo el if(file) tambien reconocera al image y al iframe x eso dara error tenemos q especificar con if cual se eliminara
            if($post->image!=""){//si la imagen esta vacia en la bd eliminamos el post
                Storage::disk('public')->delete($post->image);
            }
            //GUARDAMOS LA NUEVA IMAGEN SUBIDA
            //guardamos la ruta en campo image en la bd y el archivo img en la carpeta posts
            $post->image=$request->file('file')->store('posts','public');//si no encuentra la carpeta posts dentro de public la crea
            $post->save();//guardamos la imagen en carpeta storage/app/public/posts
        }


        //volvemos a la ventana anterior y mandamos un mensaje de Actualizado con exito q es un status q sale como una ventana venrde arriba
        return back()->with('status','Actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //PRIMERO ELIMINAMOS LA IMAGEN EXISTENTE
        //ponemos una condicion ya que no deja eliminar un post q no tiene imagen o esta vacia
        if($post->image==""){//si la imagen esta vacia en la bd eliminamos el post
            $post->delete();
        }else{//y si no tambien lo eliminamos
            //en la carpeta public eliminamos la ruta de la imagen q esta en el campo image del post seleccionado q recibimos como parametro($post)
            // y esta ruta de la imagen q esta guardado en la bd es la ruta q esta en el Storage donde esta nuestra imagen  q tambn se eliminara
            Storage::disk('public')->delete($post->image);
            $post->delete();//eliminamos post de la bd
        }
        return back()->with('status','Eliminado con exito');
        //volvemos a la ventana y mandamos un mensaje q elimno con exito
    }
}
