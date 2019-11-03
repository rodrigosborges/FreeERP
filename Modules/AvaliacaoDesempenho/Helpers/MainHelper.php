<?php

class mainHelper{

	/**
	* Função estática - Trata array de dados da tabela p/ exibição em selects
	* @param array $array - array c/ valores da tabela
	* @param string $value - Valor do option do select
	* @param string $descri - Texto do option
	* @return array $newArray - Array c/ valores atribuidos
	* @author Rafael Domingues Teixeira
	*/

	public static function fixArray2($field, $originals) {

		$prepend = array('' => mb_strtoupper(Lang::get('application.form.select.empty', [ 'field' => $field ]), 'UTF-8'));

		return $prepend + $originals;
	}

	public static function fixArray($array,$value,$descri,$firstopt='SELECIONE',$descri2=null) {
		$newArray = array(''=>$firstopt);

		foreach ($array as $array) {
			if ($descri2!=null) {
				$newArray[$array[$value]] = "nome: " . $array[$descri]. ", {$descri2}: " . $array[$descri2];
			} else {
				$newArray[$array[$value]] = $array[$descri];
			}
		}
		return $newArray;
	}

	/**
	* Função estática - Transforma valores de array em maiusculas
	* OBS: Todo os valores de array e sub-arrays serão modificados.
	* @param array $array - array c/ valores a serem alterados
	* @param array $excepts - array c/ valores a serem ignorados
	* @return array $values - Array c/ valores alterados
	* @author Rafael Domingues Teixeira
	*/
	public static function toUpperCase($values,$excepts){
		foreach ($values as $key => $value) {
			if (in_array($key,$excepts)) continue;

			if (is_array($value)) {
				$values[$key] = mainHelper::toUpperCase($value,$excepts);
			}else {
				$values[$key] = mb_strtoupper($value);
			}
		}
		return $values;
	}

	/**
	* Função estática - Retorna as cidades de acordo ID do estado
	* com os valores formatados p/ exibição em select
	* @param int $id - ID de Estado
	* @author Rafael Domingues Teixeira
	*/
	public static function selectCidades($id){
		$cidades = QuerieHelper::findelements('estado', 'cidades', $id);
		return Self::fixArray($cidades,'id','nome');
	}

	/**
	* Função estática - Retorna as unidades de acordo ID da secretaria
	* com os valores formatados p/ exibição em select
	* @param int $id - ID de Secretaria
	* @author Camila Pereira Sales
	*/
	public static function selectUnidade($id){
		$unidade = QuerieHelper::findelements('Secretaria', 'unidades', $id);
		return Self::fixArray($unidade,'id','nome');
	}

	/**
	* Função estática - retorna um valor c/ a mascara solicitada
	* @param string $val - valor a ser atribuido mascara
	* @param string $mask - Mascara utilizada (ex: ###.###.###-##)
	* @return string $maskared - valor c/ mascara atribuida
	* @author Rafael Domingues Teixeira
	*/
	public static function mask($val, $mask){
		$maskared = '';
		$k = 0;
		for($i = 0; $i<=strlen($mask)-1; $i++){
			if($mask[$i] == '#'){
				if(isset($val[$k]))
				$maskared .= $val[$k++];
			}else{
				if(isset($mask[$i]))
				$maskared .= $mask[$i];
			}
		}
		return $maskared;
	}

	/**
	* Função estática - Exporta tabela p/ arquivo EXCEL
	* @param string $table - tabela formatada
	* @author Rafael Domingues Teixeira
	*/
	public static function exportExcel($table){
		header("Content-type: application/msexcel; charset=utf-8");
		header("Content-Disposition: attachment; filename=relatorio.xls"); // Nome que arquivo será salvo
		print chr(255) . chr(254) . mb_convert_encoding($table, 'UTF-16LE', 'UTF-8');
	}

	/**
	* Função estática - Exporta conteúdo p/ arquivo PDF
	* @param string $content - conteúdo a ser exportado
	* @param string $style - formatação da página importada. *[paper: ... position: ...]*
	* @return $pdf - página em PDF
	* @author Wiatan Oliveira Silva
	* @author Rafael Domingues Teixeira
	*/
	public static function exportPdf($content,$style){
		$pdf = App::make('dompdf');
		$pdf->setPaper($style['paper'], $style['position']);
		$pdf->loadHTML($content);
		return $pdf;
	}

	/**
	* Função estática - Verifica se conexão com IP está disponível ou não.
	* @param string $ip - IP de conexão
	* @param string $port - porta de conexão
	* @return int $connected - Valor true ou false de acordo com conexão
	* @author Rafael Domingues Teixeira
	* @since 23/02/2018
	*/
	public static function check_ip($ip, $port){
		$connected = @fsockopen($ip, $port);
		fclose($connected);
		return $connected;
	}
}
?>
