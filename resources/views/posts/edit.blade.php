@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Articulo</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
{{-- la ruta es posts.update q es actualizar y recibe $post desde el PostController en el metodo edit gracias a compact  --}}
                    {{-- metodo post para modificar en la bd y enctype con form-data pa q la bd reonozca la ruta de imagen q esta en storage --}}
                    <form action="{{route('posts.update',$post)}}" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Titulo *</label>
                            {{-- debido a q es input ponemos value para mostrar el dato--}}
                            {{--'title' es la validacion sino encuentra validacion para confirmar pasara al sigiente--}}
                            {{-- old para recordar el dato(titulo del post) q obtendremos de la bd con $post->title (title es el campo en la bd)--}}
                            <input type="text" name="title" class="form-control" required value="{{old('title',$post->title)}}">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Imagen</label>
                            {{-- con el comando php artisan storage:link podemos crear el link para poder mostrar la imagen obtenida de la ruta storage q esta en la bd --}}
                            {{-- offset-3 lo movemos un poco mas a la derecha para q se vea bn la imagen al centro ya q tiene col-6 --}}
                            {{--en el src ya poderemos poner el link con url para poder traer la ruta de la img q esta en la bd en el campo image --}}
                            <img class="col-6 offset-3" src="{{url('storage/'.$post->image)}}" alt="">
                            {{--mt es el margintop--}}
                            <input class="col-12 mt-4" type="file" name="file" >
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Contenido *</label>
                            {{-- debido a q es textarea  ya no ponemos value para mostrar el dato--}}
                            {{--'body' es la validacion sino encuentra validacion para confirmar pasara al sigiente--}}
                            {{-- old para recordar el dato(titulo del post) q obtendremos de la bd con $post->body (body es el campo en la bd)--}}
                            <textarea name="body" rows="6" class="form-control" required>{{old('body',$post->body)}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Contenido embebido</label>
                            {{--igual q el anterior pero esto no es requerido no necesita required--}}
                            <textarea name="iframe" class="form-control">{{old('iframe',$post->iframe)}}</textarea>
                        </div>
                        <div class="form-group">
                            {{--csrf para seguridad en form y PUT para actualizar ya q html no tiene es metod solo tiene get y post--}}
                            @csrf
                            @method('PUT')
                            <input type="submit" class="btn btn-sm btn-primary" value="Actualizar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
