<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Formulário pra virar mendiga</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>

<?php 
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    
    if (empty($_POST["uid"]) || !preg_match("/[A-Za-z0-9]+/",$_POST['uid']) ){
        echo '<div class="resp">oh seu randola, bota alguma coisa aqui.</div>';
    }
    if(empty($_POST["email"]) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        echo '<div class="resp">preencheu igual tua cara né, porra.</div>';
    }
    if(empty($_POST["pwd"]) || !preg_match("/(?=(.*[0-9]))((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.{8,}$/",$_POST['pwd'])){
        echo '<div class="resp">além de feia é burra, nem uma senha descente consegue criar.</div>';
    }
    if( $_POST["pwd"] != $_POST["pwd2"] ){
        echo '<div class="resp">Copia e cola, ta diferente</div>';
    }
    if(!isset($_POST["Mons"])){
        echo '<div class="resp">Confirma aqui, prometo que não é pacto.</div>';
    }
    
    if ( time() < strtotime('+18 years', strtotime($_POST['nasc']) ) ) {
        echo '<div class="resp">precisa ser maior de 18 em, não que se você mentir eu vá saber.</div>';
    }

    function validateCPF($cpf) {
        $cpf = sprintf('%011s', preg_replace('{\D}', '', $cpf));
        if ((strlen($cpf) != 11)
                || ($cpf == '00000000000')
                || ($cpf == '99999999999')) {
            return false;
        }
        for ($t = 8; $t < 10;) {
            for ($d = 0, $p = 2, $c = $t; $c >= 0; $c--, $p++) {
                $d += $cpf[$c] * $p;
            }
            if ($cpf[++$t] != ($d = ((10 * $d) % 11) % 10)) {
                return false;
            }
        }
        return true;
    }

    if (empty($_POST["cpf"]) || !validateCPF($_POST["cpf"]) ){
        echo '<div class="resp">Se esforça pelo menos, esse bagulho ta errado ou vazio.</div>';
    }

}?>

<form action="<?=htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" id="formcad">
    <p>Dados de login:</p>
    <label for="uid">Usuarie:</label>                    <input type="text" name="uid" id="uid" pattern="[A-Za-z0-9]+" required placeholder="Nome Social" value="<?=htmlspecialchars(isset($_POST['uid'])?$_POST['uid']:'');?>" />
    <label for="tel">Telefone:</label>                    <input type="text" name="tel" id="tel" minlength="14" maxlength="15" required placeholder="(**)*****-****" value="<?=htmlspecialchars(isset($_POST['tel'])?$_POST['tel']:'');?>" />
    <label for="email">E-mail:</label>                   <input type="email" name="email" id="email" required placeholder="@gmail.com" value="<?=htmlspecialchars(isset($_POST['email'])?$_POST['email']:'');?>" />
    <label for="pwp">Senha:</label>                      <input type="password" name="pwp" id="pwp" pattern="(?=(.*[0-9]))((?=.*[A-Za-z0-9]))"  required placeholder="******" value="<?=htmlspecialchars(isset($_POST['pwd'])?$_POST['pwd']:'');?>" />
    <label for="pwp2">Confirmar Senha:</label>           <input type="password" name="pwp2" id="pwp2"  required placeholder="******" value="<?=htmlspecialchars(isset($_POST['pwd2'])?$_POST['pwd2']:'');?>" />

    <p> Dados Pessoais Boneca: </p>
    <label for="nome">Apelido de Praça:</label>           <input type="text" name="nome" id="nome" required placeholder="Belle Bellinha"/>
    <label for="cpf">Cpf falso:</label>                   <input type="text" name="cpf" id="cpf" minlength="14" maxlength="14" required placeholder="***.***.***-**" <?=htmlspecialchars(isset($_POST['cpf'])?$_POST['cpf']:'');?>" />
    <label for="Mons">Confirmo gostar de monsters</label>       <input type="checkbox" id="Mons" name="Mons"checked <?php if(isset($_POST['Mons'])):?>checked<?php endif?> />
    <label for="diaa">Data de Nascimento falsa:</label>    <input type="date" id="diaa" name="diaa" value="<?=htmlspecialchars(isset($_POST['nasc'])?$_POST['nasc']:'');?>" />   
    <label for="cor">Cor do seu cabelo</label>             <input type="color" id="cor" name="cor" value="<?=htmlspecialchars(isset($_POST['cor'])?$_POST['cor']:'');?>" />
    <label for="sex">Sexualidade:      </label>                 
    <label for="op1">Yag                                   <INPUT TYPE="RADIO" NAME="sex" VALUE="op1" <?php if(isset($_POST['op1']) && $_POST['op1'] == 'yag'):?>checked<?php endif?>/></label>
    <label for="op2"> Nao Binarie                          <INPUT TYPE="RADIO" NAME="sex" VALUE="op2" <?php if(isset($_POST['op2']) && $_POST['op2'] == 'nb'):?>checked<?php endif?>/></label>
    <label for="op3">Bate bife                             <INPUT TYPE="RADIO" NAME="sex" VALUE="op3" <?php if(isset($_POST['op3']) && $_POST['op3'] == 'btb'):?>checked<?php endif?>/></label>
    <input type="submit"> </input> 
    <input type="reset" value="❌ Limpar"/>
    <input type="submit" value="✔️ Enviar"/>
</form>
	
</body>

</html>


