@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($posts as $post)

            <div class="card">
                <div class="card-body">
                    {{-- si existe imagen en la bd imprimir la img mediante la ruta de la bd --}}
                    {{--para q funcione la url la carpeta storage donde se encuentra la img tiene q ser publica --}}
                    {{--por eso en consola primero ponemos php artisan storage:link para crear acceso directo en public de storage--}}
                    @if($post->image)
                    {{--clase de bootstrap para q el contenido multimedia iframe este bien puesto responsive--}}
                    <div class="embed-responsive embed-responsive-16by9">
                        <img src="{{$post->get_image}}" class="card-img-top">
                            {{--get_image estara en Post.php como getGetImageAttribute--}}
                    </div>
                    <br>
                    @endif
                    @if($post->iframe)
                    {{--se cambio la clase de bootstrap xq no salia bn el iframe se cambio x ratio y sale perfecto responsivo--}}
                    <div class="ratio ratio-16x9">
                        {{--Si encuentra el iframe q es el link iframe de un video o podcast(yt o souncloud) se pondra aca--}}
                            {!! $post->iframe !!}
                            {{--Usamos !! para q reconozca como un html y no nos imprima rl link iframe sino el contenido multimedia--}}
                    </div>
                    <br>
                    @endif
                    <h5 class="card-title">{{$post->title}}</h5>
                    <p class="card-text">
                        {{-- le muestra solo una parte del contenido de post este metodo se configuro en Post.php --}}
                        {{$post->get_excerpt}}
                        {{-- link de leer mas le redigira a una nueva pag solo del post q eligio --}}
                        <a href="{{route('post',$post)}}">Leer mas</a>
                    </p>
                    <p class="text-muted mb-0">
                        {{-- em cursiva y &ndash para poner guion  --}}
                        <em>
                            {{-- trae el nombre del user del post --}}
                            &ndash;{{$post->user->name}}
                        </em>
                        {{-- traemos la fecha --}}
                        {{$post->created_at->format('d M Y')}}
                    </p>
                </div>
            </div>
            @endforeach
            {{$posts->Links("pagination::bootstrap-4")}}
        </div>
    </div>
</div>
@endsection
