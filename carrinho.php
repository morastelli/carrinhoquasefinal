<?php
    include("conecta.php");

    $comando = $pdo->prepare("SELECT * FROM produtos");
    $resultado = $comando->execute();
    
    while ($linhas = $comando->fetch() )
    {
        $nome = $linhas["nome"]; 
        $preco = $linhas["preco"]; 
        $qtd = $linhas["quantidade"];
    }

    $comando = $pdo->prepare("SELECT * FROM produtos WHERE nome = :nome");
    $comando->bindParam(":nome", $nome);
    $resultado = $comando->execute();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
    <!--ICON NA GUIA-->
    <link rel="icon" href="logo.png">
    <link rel="stylesheet" href="estiloCarrinho.css">
</head>
<body>
    <!--LOGO E SETA-->
    <div class="logo">
        <a href="telaInicial.html"><img src="setaespeculary.jpg" class="seta"></a>
        <img src="logoetexto.png" class="logoTamanho">
    </div> 
     <!--TÍTULO-->
     <div class="titulo">
         <h2>Seu carrinho</h2>
     </div>
     
     <!--PRODUTOS-->
     <div id="prot" class="prot">
        <div name="imagem" id="imagem" class="imagem">
        <?php 
            while ($linhas = $comando->fetch()) 
            {
                $dados_imagem = $linhas["foto"];
                $i = base64_encode($dados_imagem);
                echo("<br> <img src='data:image/jpeg;base64,$i' width='100px'> <br> <br> ");
            }
        ?>
        </div>
        <div class="resto">
            <div class="texto">
                <h4 name="nome" id="nome"><?php echo($nome) ?></h4>
                <h5 name="preco" id="preco">R$<?php echo($preco)?></h5>
            </div>
            <div class="addremove">
                <button id="btn_decrementar" name="adicionar" type="button" class="remove">-</button>
                <p name="quantidade" class="number" id="contador"></p>
                <button id="btn_incrementar" name="remover" type="button" class="add">+</button>
                <?php
                     if(isset($_POST["adicionar"]) )
                     {
                        $comando -> $pdo -> prepare("UPDATE produtos SET quantidade");
                     }
                ?>
            </div>
        </div>
     </Div>
     
     <!--BOTÃO FINALIZE SEU PEDIDO-->
    <div class="alinhaBotao">
        <a href="compra.html"><button>Finalize seu pedido</button></a>
    </div>
</body>
<script>
const btnIncrementar = document.getElementById("btn_incrementar");
const btnDecrementar = document.getElementById("btn_decrementar");
const p$ = document.getElementById("contador");

let contador = 1;

p$.innerHTML = contador;

btnIncrementar.addEventListener("click", function()
{
  contador++;

  preco = <?php echo $preco; ?>;

  preco = preco * contador;

  console.log(preco);

  p$.innerHTML = contador;
})
btnDecrementar.addEventListener("click", function()
{
  contador--;

  preco = preco - <?php echo $preco; ?>;

  console.log(preco);

  p$.innerHTML = contador;
    if (contador <= 0)
    {
        if (window.confirm("Deseja remover o item do carrinho?"))
        {
            prot.style.display = "none"; 
        }

    }
})

console.log(btnIncrementar);
console.log(p$);
</script>
</html>

