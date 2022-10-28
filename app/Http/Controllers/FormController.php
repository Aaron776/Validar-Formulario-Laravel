<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // el metodo requets y el metoddo validate son los encargados de validar los campos de un formulario
use App\Models\Form;

class FormController extends Controller
{
    public function index(Request $request){
        return view('form.index');
    }

    public function guardar(Request $request){
        $request->validate([ // aqui estoy usando el metodo validate() para validar los campos de mi formulario
            'nombre'=> 'required',
            'email'=> 'required | email | unique:forms', // aqui ponemos para validar que sea requerido , que sea del tipo email y que sea unico
            'edad'=> 'required  | numeric', // aqui validadmos que sea requerido y que sea del tipo numerico
            'password'=> 'required | confirmed', // aqui validamos que sea requerido y ademas que sea confrimado con un campo parecido en este caso el campo password_confrimation
            'password_confirmation'=> 'required',
        ],

        // Tambien podemos poner mensajes de validacion personalizados
        [
            'nombre.required'=>'Este campo es obligatorio',
            'edad.numeric'=>'Este campo debe ser numerico',
            'edad.required'=>'Este campo es obligatorio',
        ] 

      
        );

        $form=new Form;
        $form->nombre=$request->nombre;
        $form->email=$request->email;
        $form->edad=$request->edad;
        $form->password=$request->password;
        $form->password_confirmation=$request->password_confirmation;

        $form->save();
        return back()->with('success','¡Formulario validado correctamente y registro exitoso!');


    }
}
