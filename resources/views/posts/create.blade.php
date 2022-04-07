@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear Articulo</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{-- posts.store para guardar los datos y el enctype es para q nos reconozca el archivo de la imagen--}}
                        <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Titulo *</label>
                                {{-- required para que el campo sea obligatorio --}}
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <br>
                            <div>
                                {{-- imagen son de typo file para q se puede subir un archivo --}}
                                <label>Imagen</label>
                                <input type="file" name="file" >
                            </div>
                            <div>
                                <label>Contenido *</label>
                                <textarea name="body" rows="6" class="form-control" required></textarea>
                            </div>
                            <div>
                                <label>Contenido embebido</label>
                                <textarea name="iframe" class="form-control"></textarea>
                            </div>
                            <br>
                            <div>
                                @csrf
                                <input type="submit" value="Enviar" class="btn btn-sm btn-primary">
                            </div>

                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
