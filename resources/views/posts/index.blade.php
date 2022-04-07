@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Articulos
                    {{-- arriba de la tabla al costado del titulo ira el boton CREAR --}}
                    <a href="{{route('posts.create')}}" class="btn btn-sm btn-primary float-rigth">CREAR</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Titulo</th>
                                    {{-- colspan es el NUMERO de celdas q estara en blanco con &nbsp --}}
                                    <th colspan="2">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->id}}</td>
                                    <td>{{$post->title}}</td>
                                    <td>
                                        {{-- ruta para editar los datos --}}
                                        <a href="{{route('posts.edit',$post)}}" class="btn btn-primary btn-sm">Editar</a>
                                    </td>
                                    <td>
                                        {{-- ruta para eliminar articulo o post seleccionado @csrf es de seguridad para el formulario lo protege de ataque--}}
                                        <form action="{{route('posts.destroy',$post)}}" method="POST">
                                            @csrf
                                            {{--DELETE ya que html no tiene method Delete solo POST y GET--}}
                                            @method('DELETE')
                                            <input type="submit" value="Eliminar" class="btn btn-sm btn-danger" onclick="return confirm('¿Estas seguro de Eliminar..?')">
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
