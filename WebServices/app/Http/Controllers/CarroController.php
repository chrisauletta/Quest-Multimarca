<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carro;

class CarroController extends Controller{

	public function buscarCarros(){
		return Carro::with('user')->get();
	}
    
	public function salvarCarros(Request $request){
		$user = $request->user();

		$retorno = array();
		
		$dados = $request->all();
		$link = $dados['link'];

		$arrayAnuncios = $this->buscarAnuncios($link);
		
		foreach($arrayAnuncios as $key => $value){
			$retorno[$key]['nome_veiculo'] = $value['nome_veiculo'];
			if(empty(Carro::where('nome_veiculo', '=', $value['nome_veiculo'])->first())){
				$value['user_id'] = $user['id'];
				$value['link'] = $link;
				Carro::create($value);
				$retorno[$key]['result'] = "Cadastro com sucesso";
			}else{
				$retorno[$key]['result'] = "Anuncio ja existente";
			}
		}
		return $retorno;
	}
 
	public function buscarAnuncios($link){
        $url = file_get_contents($link);

        $retorno = array();
        preg_match_all('/<h2 class="card__title ui-title-inner">(.+)<\/+h2>/', $url, $conteudo);
    
        foreach($conteudo[1] as $value){
            preg_match('/">(.+)/',$value,$mach);
            $retorno[]['nome_veiculo'] = substr($mach[1], 0, -4);
        }
    
        preg_match_all('/<span class="card-list__info">(.+?)<\/+span>/s', $url, $conteudo);
    
        $iterador = 0;
        $temp = 0;
        $index = 0;
        while(!empty($conteudo[1][$iterador])){
            $temp++;
            switch ($temp) {
				case 1:
					$retorno[$index]['ano'] = trim($conteudo[1][$iterador]);
				break;
				case 2:
					$retorno[$index]['quilometragem'] = trim($conteudo[1][$iterador]);
				break;
				case 3:
					$retorno[$index]['combustivel'] = trim($conteudo[1][$iterador]);
				break;
				case 4:
					$retorno[$index]['cambio'] = trim($conteudo[1][$iterador]);
				break;
				case 5:
					$retorno[$index]['portas'] = trim($conteudo[1][$iterador]);
				break;
				case 6:
					$retorno[$index]['cor'] = trim($conteudo[1][$iterador]);
				break;
			}
            if($temp == 6){
                $index++;
                $temp = 0;
            }
            $iterador++;
        }
		return $retorno;
    }

	public function deletarCarro($id){
		try{
			Carro::destroy($id);
			return true;
		}catch(\Exception $e) {
			return $e;
		}
	}
}
