const uid = document.getElementById('uid');
const tel = document.getElementById('tel');
const email = document.getElementById('email');
const pwd = document.getElementById('pwd');
const pwd2 = document.getElementById('pwd2');
const nome = document.getElementById('nome');
const cpf = document.getElementById('cpf');
const Mons = document.getElementById('Mons');
const diaa = document.getElementById('diaa');

function validate(item) {
  item.setCustomValidity('');
  item.checkValidity();

  if (item == pwd2) {
    if (item.value === pwd.value) item.setCustomValidity('');
    else item.setCustomValidity('Não ta igual porra, faz direito');
  }

  if (item == diaa) {
    let hoje = new Date();

    let dnasc = new Date(diaa.value);
    let idade = hoje.getFullYear() - dnasc.getFullYear();
    let m = hoje.getMonth() - dnasc.getMonth();
    if (m < 0 || (m === 0 && hoje.getDate() < dnasc.getDate())) {
      idade--;
    }
    if (idade >= 0) document.getElementById('idade').value = idade + ' anos ';
    else document.getElementById('idade').value = "só se for na ultíma encarnação";

    if (idade > 130) item.setCustomValidity('Ta mumificada filha?');
    else if (idade >= 18) item.setCustomValidity('');
    else item.setCustomValidity('No minimo mente que tem 18 né puta');
  }

  if (item == cpf) { 
    let numCPF = cpf.value.replace(/[^0-9]/g , "");
    if ( validateCPF(numCPF) ) item.setCustomValidity('');
    else item.setCustomValidity('pago quanto na id falsa? pq ta podre');
  }
}

function validateCPF(cpf){
  var number, digits, sum, i, result, equal_digits;
  equal_digits = 1;
  if (cpf.length < 11)
    return false;
  for (i = 0; i < cpf.length - 1; i++)
    if (cpf.charAt(i) != cpf.charAt(i + 1)) {
      equal_digits = 0;
      break;
    }
  if (!equal_digits) {
    number = cpf.substring(0, 9);
    digits = cpf.substring(9);
    sum = 0;
    for (i = 10; i > 1; i--)
      sum += number.charAt(10 - i) * i;
    result = sum % 11 < 2 ? 0 : 11 - sum % 11;
    if (result != digits.charAt(0))
      return false;
    number = cpf.substring(0, 10);
    sum = 0;
    for (i = 11; i > 1; i--)
      sum += number.charAt(11 - i) * i;
    result = sum % 11 < 2 ? 0 : 11 - sum % 11;
    if (result != digits.charAt(1))
      return false;
    return true;
  }
  else
    return false;
}

function maskCPF() {
  let strCPF = cpf.value;
  if (strCPF.length == 3 || strCPF.length == 7) cpf.value += ".";
  if (strCPF.length == 11) cpf.value += "-";

  validate(cpf);
}


function maskTel() {
  let strtel = tel.value;
  if (strtel.length == 2) {
    tel.value += ") ";
    tel.value = "(" + tel.value;
  }
  if (strtel.length == 10) tel.value += "-";
}

uid.addEventListener('input',   function () { validate(uid) });
tel.addEventListener('input',   function () { maskTel() });
email.addEventListener('input', function () { validate(email) });
pwd.addEventListener('input',   function () { validate(pwd) });
pwd2.addEventListener('input',  function () { validate(pwd2) });
nome.addEventListener('input',  function () { validate(nome) });
cpf.addEventListener('input',   function () { maskCPF() });
Mons.addEventListener('input',  function () { validate(Mons) });
diaa.addEventListener('input',   function () { validate(diaa) });


pwd.addEventListener('invalid', function () {
  if (pwd.value === '') {
    pwd.setCustomValidity('Bota a senha');
  } else {
    pwd.setCustomValidity('Tu quer ser hackeada vadia? bota pelo menos 8 digitos, um numero, uma letra maiuscula, uma minuscula e um simbolo.');
  }
});