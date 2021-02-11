<?php

function debug($var)
{
    echo '<pre style="height:200px;overflow-y: scroll;font-size:.8em;padding: 10px; font-family: Consolas, Monospace; background-color: #000; color: #fff;">';
    print_r($var);
    echo '</pre>';
}

function cleanXSS($notSafe)
{
    return trim(strip_tags($notSafe));
}

function emptyError($errors,$value,$key){
  if(empty($value)){
    $errors[$key] = 'Ce champ ne doit pas être vide.';
  }
  return $errors;
}

function validText($errors,$value,$key,$min,$max){
  if(!empty($value)) {
    if(mb_strlen($value) < $min) {
      $errors[$key] = 'Veuillez renseigner au moins ' .$min . ' caractères';
    } elseif(mb_strlen($value) > $max) {
      $errors[$key] =  'Veuillez renseigner moins de ' .$max . ' caractères';
    }
  } else {
    $errors[$key] = 'Veuillez renseigner ce champ';
  }

  return $errors;
}


function validTextNull($errors,$value,$key,$min,$max){
    if(mb_strlen($value) > 0 && mb_strlen($value) < $min) {
      $errors[$key] = 'Veuillez renseigner au moins ' .$min . ' caractères ou ne mettez rien';
    } elseif(mb_strlen($value) > $max) {
      $errors[$key] =  'Veuillez renseigner moins de ' .$max . ' caractères';
    }
  return $errors;
}


function validMail($errors,$value,$key){
  if(!empty($value)) {
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
    $errors[$key] = 'Ce mail n\'est pas valide';
    }

  }
  else {
    $errors[$key] = 'Veuillez renseigner ce champ';
  }

  return $errors;
}

function validPass($errors,$password1,$key1,$password2,$min,$max){
  if(!empty($password1 && $password2)) {
    if($password1 == $password2){
      if(mb_strlen($password1) < $min) {
        $errors[$key1] = 'Veuillez renseigner au moins' .$min . 'caractères';
      }
      elseif(mb_strlen($password1) > $max) {
        $errors[$key1] =  'Veuillez renseigner moins de ' .$max . 'caractères';
      }
    }
    else {
      $errors[$key1] = 'Veuilez renseigner le même mot de passe';
    }
  }
  else {
    $errors[$key1] = 'Veuillez remplir les champs password';
  }

  return $errors;
}

function validDate($errors,$value,$key){
  // PENSER A METTRE max="9999-12-31" comme attribut dans l'input date
  if(!empty($value)){
    $now = New DateTime("now");
    $datelimit = New DateTime("now");
    $datelimit->sub(new DateInterval('P120Y'));
    $date = New DateTime($value);


    $dateformate = $date->format('m-d-Y');
    $datexplode = explode('-', $dateformate);
    $month = $datexplode[0];
    $day = $datexplode[1];
    $year = $datexplode[2];

    if (checkdate($month, $day, $year) == true){
      if ($date < $datelimit == true) {
        $errors[$key] = 'Maître yoda vous n\'êtes pas...';
      }
      if ($date > $now == true) {
        $errors[$key] = 'Veuillez renseigner une date passée';
      }
    // SI checkdate renvoie false
    }
    else {
      $errors[$key] = 'Veuillez renseigner une date valide';
    }
  }
  // SI DATE EST VIDE
  else {
    $errors[$key] = 'Veuillez renseigner une date';
  }
  return $errors;
}


function validPostal($errors,$value,$key){
  if(!empty($value)){
    if(!is_numeric($value) || strlen($value) != 5) {
      $errors[$key] = 'Veuillez renseigner un code postal à 5 chiffres';
    }
  }
  else {
    $errors[$key] = 'Veuillez renseigner un code postal';
  }
  return $errors;
}


function validPostalNull($errors,$value,$key){
  if(strlen($value) == 0) {
    return $errors;
  }
  if(!is_numeric($value) || strlen($value) != 5) {
    $errors[$key] = 'Veuillez renseigner un code postal à 5 chiffres';
  }
  return $errors;
}


  function validNumber($errors,$value,$key,$min,$max){
      if ($value < $min) {
        $errors[$key] = 'Veuillez renseigner '.$min.' minimum .';
      }elseif ($value > $max) {
        $errors[$key] = 'Veuillez renseigner moins de '.$max.' .';
      }
    return $errors;
  }

  function validYear($errors,$value,$key){
    if(!empty($value)){
      if(!is_numeric($value) || strlen($value) != 4) {
        $errors[$key] = 'Veuillez renseigner une date à 4 chiffres';
      }
    }
    else {
      $errors[$key] = 'Veuillez renseigner une année';
    }
    return $errors;
  }


function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function formatageDate($valueDate)
{
  return date('d/m/Y à H:i',strtotime($valueDate));
}

function formatageShortDate($valueDate)
{
  return date('d/m/Y',strtotime($valueDate));
}



function isLoggedUser()
{
  if(!empty($_SESSION['user'])) {
    if(!empty($_SESSION['user']['id']) && is_numeric($_SESSION['user']['id'])) {
      if(!empty($_SESSION['user']['pseudo'])) {
        if(!empty($_SESSION['user']['role'])) {
          if($_SESSION['user']['role'] == 'user') {
            if(!empty($_SESSION['user']['ip']) && $_SESSION['user']['ip'] == $_SERVER['REMOTE_ADDR']) {
              return true;
            }
          }
        }
      }
    }
  }
  return false;
}


function isLoggedAdmin()
{
  {
    if(!empty($_SESSION['user'])) {
      if(!empty($_SESSION['user']['id']) && is_numeric($_SESSION['user']['id'])) {
        if(!empty($_SESSION['user']['pseudo'])) {
          if(!empty($_SESSION['user']['role'])) {
            if($_SESSION['user']['role'] == 'admin') {
              if(!empty($_SESSION['user']['ip']) && $_SESSION['user']['ip'] == $_SERVER['REMOTE_ADDR']) {
                return true;
              }
            }
          }
        }
      }
    }
    return false;
  }

}



function monthIntegerToString(int $month){

  switch ($month) {
    case 0:
        break;
    case 1:
        $month = 'Janvier';
        break;
    case 2:
        $month = 'Février';
        break;
    case 3:
        $month = 'Mars';
        break;
    case 4:
        $month = 'Avril';
        break;
    case 5:
        $month = 'Mai';
        break;
    case 6:
        $month = 'Juin';
        break;
    case 7:
        $month = 'Juillet';
        break;
    case 8:
        $month = 'Août';
        break;
    case 9:
        $month = 'Septembre';
        break;
    case 10:
        $month = 'Octobre';
        break;
    case 11:
        $month = 'Novembre';
        break;
    case 12:
        $month = 'Décembre';
        break;
  }
  return $month;


}


/**
 * Insert des valeurs dans la table d'une base de donnée.
 *
 * @param PDO $pdo
 * @param string $table
 * @param array<string> $columns
 * @param array<string> $values
 * @return null
 */
function insert($pdo, $table, $columns, $values)
{
    if (!is_array($columns) || !is_array($values)) return;

    $bindValues = [];
    for ($i = 0; $i < count($values); $i++) {
        $bindValues[] = ':value' . $i;
    }

    $strBindValues = implode(', ', $bindValues);
    $strColumns = implode(', ', $columns);

    $sql = 'INSERT INTO ' . $table . ' (' . $strColumns . ') VALUES (' . $strBindValues . ')';
    $query = $pdo->prepare($sql);
    for ($i = 0; $i < count($values); $i++) {
        $query->bindValue(':value' . $i, $values[$i]);
    }
    $query->execute();
}

function showJson($data)
{
  header("Content-type: application/json");
  $json = json_encode($data, JSON_PRETTY_PRINT);
  if($json) {
    die($json);
  } else {
    die('error in json encoding');
  }
}



///// HEXA TO IP //////


function splite($iphexa){

  $ip_split = str_split($iphexa,2);
  return $ip_split;
}


function convertToByte($value,$tableau_conv){
  $unite_hex = $value[1];
  $dizaine_hex = $value[0];
  $unite = $tableau_conv[$unite_hex][0];
  $dizaine = $tableau_conv[$dizaine_hex][0];
  $total = $dizaine * 16 + $unite;
  return $total;
}

function hexatoIp($tableau_conv,$broke_ip)
{

  $array = array();
  for ($i = 0; $i < count($broke_ip); $i++)
  {
    $value = $broke_ip[$i];
    $ip = convertToByte($value,$tableau_conv);
    $array[] = $ip;

    if($i < 3)
    {
      $array[$i] .= '.';
    }


  }
  $ip = implode($array);
  return $ip;
}
