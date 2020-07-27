<?php

  include('header.php');
?>

<!-- Container -->
<div id="band" class="container text-center">
  <h2>SISTEMA BREJAS ON ROAD</h2>
  <p>
	A cervejaria BrejaOnRoad é uma cervejaria cigana, similar a cervejaria Mikkeller, e necessita criar um sistema para registrar os dados das cervejarias e das cervejas do Brasil. Para cada cervejaria ela armazena o nome, o CNPJ, dados de contato (e-mails,telefones) e a página da internet. Também é interessante saber a cidade e o estado da cervejaria. É interessante, se possível, armazenar o logotipo da empresa. Cada cervejaria utiliza de fábricas para produção de cerveja. Essas fábricas contém a aparelhagem necessária para fabricação da cerveja. A BrejaOnRoad não necessita saber o endereço completo da fábrica, apenas a cidade/estado. Interessante notar que uma cervejaria pode usar várias fábricas, em épocas distintas, enquanto podem existir fábricas ‘comunitárias’ que não pertençam a nenhuma cervejaria. Caso uma fábrica seja usada exclusivamente por uma cervejaria, pode-se deduzir que a fábrica pertençaa essa cervejaria. Além da localização da fábrica, é interessante guardar o nome da fábrica, a capacidade de produção (em litros). Também é importante saber se ela possui ou não espaço de armazenamento de estoque, e se possuir, saber qual é essa capacidade.<br><br>
        Toda cervejaria produz inúmeras cervejas. Como a cerveja é um produto com prazo de validade de 6 meses (segundo as regras do Brasil), é importante saber a data defabricação de cada cerveja. Para cada cerveja deve-se saber o seu nome comercial, guardar a imagem do rótulo (se possível), informar a sua coloração (segundo a escala SRM americana), seu IBU (International Bitter Unit), ou índice de amargor. Cada cerveja é de um determinado tipo (todo tipo de cerveja possui um nome, um copo ideal para degustação, país origem). Cada cerveja tem sua própria receita, em uma receita estão contidas as informações das quantidades de lúpulo, malte, levedura e água utilizada. É bem importante saber quais receitas respeitam o Reinheitsgebot (Lei depureza Alemã). Caso a cerveja não respeite, é preciso saber quais são os ingredientes extras e quais as quantidades de cada um. Não há limite para o número de ingredientes de uma receita, mas é importante saber as instruções de cada receita.Toda cerveja tem a assinatura de um mestre cervejeiro, e a BrejaOnRoad pode querer saber várias informações dos mestres cervejeiros como nome, cidade, estado e outros dados pessoais. Mestres cervejeiros podem ou não estarem associados à cervejarias.Por fim, a BrejasOnRoad quer manter registros de eventos cervejeiros. Cada evento sempre é patrocinado por uma ou mais cervejarias (que injetam dinheiro no evento).Necessário saber a datas dos eventos, a quantidade de público, se houve ingresso(valor) ou se foi gratuito. O custo estimado do evento também deve ser registrado. Vale ressaltar que um evento pode vender qualquer cerveja (mesmo aquela diferentedos patrocinadores), mas o evento mantém registros do(s) valore(s) unitários de venda(conforme cada medida em ml) e o valor total arrecadado com a venda de cadacerveja.
  </p>
</div>

<?php
  include('footer.php');
?>

</body>
</html>

