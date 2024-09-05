<?php
/**
 * Função que calcula dias úteis no mês
 * 
 * @autor Carlos Maniero <carlosmaniero@gmail.com>
 */


function dias_uteis($mes,$ano){
  
  $uteis = 0;
  // Obtém o número de dias no mês 
  // (http://php.net/manual/en/function.cal-days-in-month.php)
  $dias_no_mes = $num = cal_days_in_month(CAL_GREGORIAN, $mes, $ano); 

  for($dia = 1; $dia <= $dias_no_mes; $dia++){

    // Aqui você pode verifica se tem feriado
    // ----------------------------------------
    // Obtém o timestamp
    // (http://php.net/manual/pt_BR/function.mktime.php)
    $timestamp = mktime(0, 0, 0, $mes, $dia, $ano);
    $semana    = date("N", $timestamp);

    if($semana < 6) $uteis++;

  }

  return $uteis;

}


// Invocando a função
echo dias_uteis(date('m'),date('Y')); // Recebe dias úteis do mês atual
//echo dias_uteis(6,2019); // Recebe dias úteis do mês 1 de 2012



$dataAtual=date('Y-m-d');
    $data1=date('Y-m-01');
function getDiasUteis($dtInicio, $dtFim, $feriados = []) {
    $tsInicio = strtotime($dtInicio);
    $tsFim = strtotime($dtFim);

    $quantidadeDias = 0;
    while ($tsInicio <= $tsFim) {
        // Verifica se o dia é igual a sábado ou domingo, caso seja continua o loop
        $diaIgualFinalSemana = (date('D', $tsInicio) === 'Sat' || date('D', $tsInicio) === 'Sun');
        // Verifica se é feriado, caso seja continua o loop
        $diaIgualFeriado = (count($feriados) && in_array(date('Y-m-d', $tsInicio), $feriados));

        $tsInicio += 86400; // 86400 quantidade de segundos em um dia

        if ($diaIgualFinalSemana || $diaIgualFeriado) {
            continue;
        }

        $quantidadeDias++;
    }

    return $quantidadeDias;
}

//echo getDiasUteis('2019-06-01', '2019-06-10'); // 25
echo getDiasUteis($data1, $dataAtual); // 25
//echo PHP_EOL;




?>