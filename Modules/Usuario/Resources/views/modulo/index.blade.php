@extends('usuario::layouts.informacoes')

@section('content')
<div class="row justify-content-center align-items-center" style="height:100%">
    <div class="col-xm-12 col-sm-10 col-md-8">
            
        <form class="d-flex" action="" method="get">
            <input type="text" name="nome" class="form-control" placeholder="Nome do módulo"> 
            <button type="submit" class="btn btn-primary d-flex ml-2">
                <i class="material-icons mr-2">search</i>
                Buscar
            </button>
        </form>
        <div class="card mt-4">
            <div class="card-header">
                Modulos
            </div>
            <div class="card-body pb-0 d-flex flex-column align-items-start">
            <buttom class="btn btn-success d-flex mb-3" style="">
                Cadastrar novo módulo <i class="material-icons">add</i>
            </buttom>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Todos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Ativos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Inativos</a>
                </li>
            </ul>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">nome</th>
                            <th scope="col">icone</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Compras</td>
                            <td>shopping_cart</td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <a href="" class="material-icons">edit</a>
                                    <a href="" class="material-icons">delete</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Compras</td>
                            <td>shopping_cart</td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <a href="" class="material-icons">edit</a>
                                    <a href="" class="material-icons">delete</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Compras</td>
                            <td>shopping_cart</td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <a href="" class="material-icons">edit</a>
                                    <a href="" class="material-icons">delete</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Compras</td>
                            <td>shopping_cart</td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <a href="" class="material-icons">edit</a>
                                    <a href="" class="material-icons">delete</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Compras</td>
                            <td>shopping_cart</td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <a href="" class="material-icons">edit</a>
                                    <a href="" class="material-icons">delete</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Compras</td>
                            <td>shopping_cart</td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <a href="" class="material-icons">edit</a>
                                    <a href="" class="material-icons">delete</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Compras</td>
                            <td>shopping_cart</td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <a href="" class="material-icons">edit</a>
                                    <a href="" class="material-icons">delete</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Compras</td>
                            <td>shopping_cart</td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <a href="" class="material-icons">edit</a>
                                    <a href="" class="material-icons">delete</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>     
                </table>
                
                <nav class="align-self-center" aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                    </li>
                </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection