<?php

namespace App\Http\Controllers;

use App\Autor;
use App\Http\Requests;
use Illuminate\Http\Request;
use Storage;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use Image;

class LeitorController extends Controller
{
        
    public function index()
    {
        $url = \Request::fullUrl();
      echo "julia";
    }

    public function mudarSenha(Request $request)
    {
        $this->validate($request,[
            'senha' => 'required|min:6|alpha_num|confirmed'
        ]);

        $leitor = Auth::user();
        $leitor->password = bcrypt($request->input(['senha']));
        if($leitor->update()){
            Session::flash('sucesso','Sua senha foi alterada com sucesso');
        }
        return redirect()->back();
    }


    public function mudarFoto(Request $request)
    {
       $this->validate($request,[
           'foto' => 'required|mimes:jpg,jpeg,png|max:2000'
       ]);

       $leitor = Auth::user();

       if($request->hasFile('foto')){
           $img = $request->file('foto');  //atribuo a img a uma var
           $imgNome = $leitor->id.''.md5($img.microtime()).'.'.$img->getClientOriginalExtension(); //faço um nome randomico + extensao
           $localCapa = public_path('img/leitor/' . $imgNome);   //local junto com a imagem
           Image::make($img)->resize(300,300)->save($localCapa); //salvo a imagem,ja redimensionada

           $imgAntiga = $leitor->foto; //pego o nome da img antiga
           if($imgAntiga !== 'leitor.jpg'){ //só quero deletar a imagem caso n for a padrão
               if(Storage::disk('imgLeitor')->exists($imgAntiga)){
                   Storage::disk('imgLeitor')->delete($imgAntiga); //deleto a img antiga caso exista
               }
           }

           $leitor->foto = $imgNome;//atribuo ao campo o novo nome
           if($leitor->update()){
               Session::flash('sucesso','Sua foto foi atualizada com sucesso');
           }
           return redirect()->back();
       }
    }

    public function contato()
    {
       return view('leitor.contato');
    }

    public function sobre()
    {
        return view('leitor.sobre');
    }

    public function emailContato(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email',
            'nome' => 'required|alpha_spaces',
            'mensagem' => 'required|min:8'
        ]);

        $dados = [
            'nome' => $request->input(['nome']),
            'email' => $request->input(['email']),
            'mensagem' => $request->input(['mensagem']),
        ];

        \Mail::send('leitor.partes.emailContato', $dados, function ($message) use($dados){
            $message->from($dados['email'],$dados['nome']);
            $message->sender($dados['email']);
            $message->to('ppaperium@gmail.com');
            $message->subject('Mensagem de contato de '.$dados['nome']);
            $message->replyTo($dados['email']);
        });

        Session::flash('sucesso','Email de contato enviado com sucesso');
        return redirect()->back();
    }

}
