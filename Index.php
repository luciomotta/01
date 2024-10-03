
<?php
    include_once("Templates/header.php");
    include_once("Process/pizza.php");

?>

    <div class="main-banner">
        <h1>Faça seu Pedido</h1>
    </div>
    <div id="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2> Monte a pizza como desejar:</H2>
                    <!---Um FORM que tem um action que faz um POST em PHP p\ o BD--->
                    <form action="process/pizza.php" method="post" id="pizza-form">
                        <!---Recebe a variavel que tem um Array de valor das tabelas--->
                        <div class="form-group">
                            <label for="borda">Borda:</label>
                            <select name="Borda" id="borda" placeholder="Sabor da Borda" class="form-control">
                                <option value="" >Selecione a borda</option>
                                <?php foreach($bordas as $borda):?>
                                    <option value="<?= $borda['ID']?>"><?= $borda["tipo"]?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!---Recebe a variavel que tem um Array de valor das tabelas--->
                        <div class="form-group">
                            <label for="Massa">Massa:</label>
                            <select name="Massa" id="Massa" placeholder="Sabor da Massa" class="form-control">
                                <option value="" >Selecione a Massa</option>
                                <?php if(isset($massas) && is_array($massas)): ?>
                                    <?php foreach($massas as $Massa):?>
                                        <option value="<?= $Massa['ID']?>"><?= $Massa["tipo"]?></option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="">Nenhuma massa disponível</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <!---Recebe a variavel que tem um Array de valor das tabelas--->
                        <div class="form-group">
                            <label for="Sabores">Sabores:</label>
                            <select multiple name="Sabores[]" id="Sabor" placeholder="Sabor da Sabores" class="form-control">
                                <?php foreach($sabores as $Sabor):?>
                                    <option value="<?= $Sabor['ID']?>"><?= $Sabor["nome"]?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <!---Botão--->
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Fazer Pedido"></input>
                        </div>
                    </form>
            </div>
        </div>
    </div>
    </div>

<?php
    include_once("Templates/footer.php");
?>