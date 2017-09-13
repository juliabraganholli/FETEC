@extends('layouts.leitor')

@section('titulo')
	Acervo Fisico | Inicio
@endsection

@section('css')
	<link href="{{url('css/custom/style.css')}}" rel="stylesheet" />
	<link href="{{url('css/libraries/dataTables.bootstrap.min.css')}}" rel="stylesheet" />
@endsection

@section('conteudo')
	<br>
	<div class="content-wrapper" id="conteudo">
		<div class="container-fluid">
			<div class="wrapper">
                            <table class="table table-hover" id="fisico">
    <thead>
      <tr>
        <th>Livro</th>
        <th>Autor</th>
        <th>Data de Publicação</th>
      </tr>
    </thead>
    <tbody>
        @foreach($livros as $livro)
      <tr>
        <td>{{$livro->nome}}</td>
        <td>{{$livro->autor}}</td>
        <td>{{$livro->data}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
			</div>
		</div>
	</div>
@endsection

@section('js')
<script src="{{url('js/libraries/jquery.dataTables.min.js')}}" ></script>
<script>
    
  $('#fisico').DataTable({
        "pageLength": 10, //numero de itens por pagina
        "info" : false,   //informaçoes
        "lengthChange": false,  //usuario mudar itens/pagina
        "order": [[ 1, "asc" ]], //coluna q indica ordem
        "language": {           //linguagem
            "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
        },
        "columnDefs": [
            { "orderable": false, "targets": [-1,-2] } //colunas q n podem ser ordenadas
        ]
    });
$('body > header > div > form > input[type="search"]').on("keyup", function() {
     $('#fisico').DataTable().column( [0] ).search(
    $('body > header > div > form > input[type="search"]').val()).draw();
    });

</script>
<style> 
    #fisico_filter > label ,
    #fisico_filter > label > input[type="search"]{
        display: none;
    }   
</style>
@endsection