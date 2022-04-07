<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{//ESTE Slug despues de instalar revisamos su github para copiar el codigo q se encuentra en Updating your Eloquent Models
    use Sluggable;
    //Esto es para recibir datos de forma masiva
    //solo se recibiran los datos q pusimos en el array hacia el campo en la bd establecido
    protected $fillable=['title','body','iframe','image','user_id',];
     /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
       //modificamos lo q copiamos de github de slug el return agregando un onUpdate
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate'=> true
            ]
        ];
    }

    //belongs to=un Post tiene un user
    public function user(){
        return $this->belongsTo(User::class);
    }
    //metodo para hacer q el body osea el text solo sea de 140 caracteres
    //para q reconozca en el html usamos el get Atributte y al medio ponemos el nombre GetExcerpt
    //por estandar el propio laravel en el html lo reconocera como get_excerpt
    public function getGetExcerptAttributte(){
        //este metodo en el html tendra el nombre de get_excerpt
        return substr($this->body,0,140);//body sera el texto
        //substr= substrae desde 0 al 140 caracter
    }
    public function getGetImageAttribute(){
        if($this->image){
//si la image del post existe retornar la url de la image q se encuentra en "storage/la ruta q se encuentra en la bd($this->image)"
            return url("storage/$this->image");
        }
        //para q funciones el storage debe ser publico por eso le creamos un acceso directo con
        //php artisan storage:link
    }

}
