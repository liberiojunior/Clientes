<?php


class Produto
{
    private $id;
    private $quantidade;
    private $descricao;
    private $precoCompra;
    private $precoVenda;

    public function __construct($id, $quantidade, $descricao, $precoCompra, $precoVenda){

        $this->id = $id;
        $this->quantidade = $quantidade;
        $this->descricao = $descricao;
        $this->precoCompra = $precoCompra;
        $this->precoVenda = $precoVenda;

    }


    public function view(){

        echo "ID: ". $this->id . "<br>";
        echo "QUANTIDADE: ". $this->quantidade . "<br>";
        echo "DESCRICAO: ". $this->descricao . "<br>";
        echo "PRECO COMPRA: ". $this->precoCompra . "<br>";
        echo "PRECO VENDA: ". $this->precoVenda . "<br>";

    }



}