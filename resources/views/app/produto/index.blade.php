@extends('app.layouts.basico')

@section('titulo', 'Produto')

@section('conteudo')

    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-9">

                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 d-flex
                    align-items-center">
                            <li class="breadcrumb-item">
                                <a href="{{ route('app.home') }}" class="link">
                                    <i class="mdi mdi-home-outline fs-4"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Produto</li>
                        </ol>
                    </nav>
                    <h1 class="mb-0 fw-bold">Produto</h1>
                </div>
            </div>
            <div class="col-3">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('produto.create') }}">
                        <button class="btn btn-primary">
                            Novo
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>




    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-c">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Nome do Fornecedor</th>
                                    <th scope="col">Site do Fornecedor</th>
                                    <th scope="col">Peso</th>
                                    <th scope="col">Unidade</th>
                                    <th scope="col">Comprimento</th>
                                    <th scope="col">Altura</th>
                                    <th scope="col">Largura</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produtos as $produto)
                                    <tr>
                                        <td>{{ $produto->nome }}</td>
                                        <td>{{ $produto->descricao }}</td>
                                        <td>{{ $produto->fornecedor->nome }}</td>
                                        <td>{{ $produto->fornecedor->site }}</td>
                                        <td>{{ $produto->peso }}</td>
                                        <td>{{ $produto->unidade_id }}</td>
                                        <td>{{ $produto->itemDetalhe->comprimento ?? '' }}</td>
                                        <td>{{ $produto->itemDetalhe->altura ?? '' }}</td>
                                        <td>{{ $produto->itemDetalhe->largura ?? '' }}</td>
                                        <td class="text-center d-flex justify-content-center">

                                            <a
                                                href="{{ route('produto.edit', ['produto' => Crypt::encrypt($produto->id)]) }}">
                                                <button class="btn">
                                                    <i class="mdi mdi-lead-pencil fs-4"></i>
                                                </button>
                                            </a>

                                            <form method="POST"
                                                action="{{ route('produto.destroy', ['produto' => Crypt::encrypt($produto->id)]) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button" data-nome="{{ $produto->nome }}"
                                                    class="btn btn-delete-produto">
                                                    <i class="mdi mdi-delete-circle fs-4"></i>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="999" class="text-center text-danger">
                                            Não há produtos cadastrados
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="w-100 d-flex justify-content-between">
                            <div class="">
                                <span>
                                    Exibindo {{ $produtos->count() }} pedidos de {{ $produtos->total() }}
                                    @if (count($produtos) != 0)
                                        (de{{ $produtos->firstItem() }} a {{ $produtos->lastItem() }})
                                    @endif
                                </span>

                            </div>
                            <div>
                                <span>
                                    {{ $produtos->links('pagination::bootstrap-4') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
