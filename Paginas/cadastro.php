<?php
include '../Templates/header.php';
if(isset($_POST['cadastro']))
    $controller->cadastrar($_POST);
?>
<h1 class="text-center text-uppercase my-5">Cadastre-se</h1>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mb-5">
            <form class="text-center" action="" method="post">
                <div class="form-row">
                    <div class="form-group col">
                        <label class="sr-only" for="email">Nome</label>
                        <input class="form-control" type="text" name="nome" placeholder="Nome">
                    </div>
                    <div class="form-group col">
                        <label class="sr-only" for="email">E-mail</label>
                        <input class="form-control" type="email" name="email" placeholder="E-mail">
                    </div>
                    <div class="form-group col">
                        <label class="sr-only" for="cpf">CPF</label>
                        <input class="form-control" type="text" name="cpf" placeholder="CPF">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-4">
                        <label class="sr-only" for="cep">CEP</label>
                        <input class="form-control" type="text" name="cep" placeholder="CEP">
                    </div>
                    <div class="form-group col">
                        <label class="sr-only" for="logradouro">Logradouro</label>
                        <input class="form-control" type="text" name="logradouro" placeholder="Logradouro">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label class="sr-only" for="bairro">Bairro</label>
                        <input class="form-control" type="text" name="bairro" placeholder="Bairro">
                    </div>
                    <div class="form-group col">
                        <label class="sr-only" for="estado">Estado</label>
                        <select class="form-control" name="estado">
                            <option value="">Estado</option>
                            <option id="AC" value="AC">Acre</option>
                            <option id="AL" value="AL">Alagoas</option>
                            <option id="AP" value="AP">Amapá</option>
                            <option id="AM" value="AM">Amazonas</option>
                            <option id="BA" value="BA">Bahia</option>
                            <option id="CE" value="CE">Ceará</option>
                            <option id="DF" value="DF">Distrito Federal</option>
                            <option id="ES" value="ES">Espiríto Santo</option>
                            <option id="GO" value="GO">Goiás</option>
                            <option id="MA" value="MA">Maranhão</option>
                            <option id="MT" value="MT">Mato Grosso</option>
                            <option id="MS" value="MS">Mato Grosso do Sul</option>
                            <option id="MG" value="MG">Minas Gerais</option>
                            <option id="PA" value="PA">Pará</option>
                            <option id="PB" value="PB">Paraíba</option>
                            <option id="PR" value="PR">Paraná</option>
                            <option id="PE" value="PE">Pernambuco</option>
                            <option id="PI" value="PI">Piauí</option>
                            <option id="RJ" value="RJ">Rio de Janeiro</option>
                            <option id="RN" value="RN">Rio Grande do Norte</option>
                            <option id="RS" value="RS">Rio Grande do Sul</option>
                            <option id="RO" value="RO">Rondônia</option>
                            <option id="RR" value="RR">Roraima</option>
                            <option id="SC" value="SC">Santa Catarina</option>
                            <option id="SP" value="SP">São Paulo</option>
                            <option id="SE" value="SE">Sergipe</option>
                            <option id="TO" value="TO">Tocantins</option>
                        </select>
                    </div>
                    <div class="form-group col">
                        <label class="sr-only" for="cidade">Cidade</label>
                        <input class="form-control" type="text" name="cidade" placeholder="Cidade">
                    </div>
                    <div class="form-group col">
                        <label class="sr-only" for="numero">Número</label>
                        <input class="form-control" type="text" name="numero" placeholder="Número">
                    </div>
                </div>
                <div class="form-group">
                    <label class="sr-only" for="email">Senha</label>
                    <input class="form-control" type="password" name="senha" placeholder="Senha">
                </div>
                <button class="btn btn-primary" type="submit" name="cadastro">
                    Cadastre-se
                </button>
            </form>
        </div>
    </div>
</div>
<?php include '../Templates/footer.php' ?>
