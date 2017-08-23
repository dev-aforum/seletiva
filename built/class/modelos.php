<?
	class MODELOS {
		var $cnx = null;
		var $error = "";
		var $allOk = false;

		function MODELOS($cnxObj){
			if(is_a($cnxObj, "SQLAPI")){
				$this->cnx = &$cnxObj;
				$this->error = "";
				$this->allOk = true;

			}else{
				$this->error = "ERRO DE CONFIGURAÇAO DAS CLASSES";
				$this->allOk = false;
				$this->cnx = null;
			}
		}

		//funcao para retornar os modelos do site
		function get_modelos($tipo){
			if($this->allOk){
				$d = Date("d") - 1;
				$m = Date("m");
				$y = Date("Y") - 13;
				$inicio = mktime(0,0,0,$m,$d,$y);

				// pegando o grupo development
				$query2 = $this->cnx->execute("select id from grupos_modelos where lower(nome) like '%development%'");
				$data2 = $query2->fetch_object();

				if($tipo == "masculino"){
					/* masculino
					  SEXO MASCULINO = 1
					  ACIMA DE 13 ANOS
					  ATIVO
					  NÃO ESTÃO NO GRUPO DEVELOPMENT
					*/
					$query = $this->cnx->execute("select a.*, b.nome as olhos, c.nome as cabelos from modelos as a, cores_olhos as b, cores_cabelos as c where b.id=a.cor_olhos and c.id=a.cor_cabelo and a.disponivel_no_site='1' and a.sexo=1 and a.nascimento <= $inicio and a.status=1 order by a.nome_artistico");
					while($data = $query->fetch_object()){
						// verificando se está no grupo development
						$query3 = $this->cnx->execute("select count(id) as id from grupos_modelos_modelos where grupo='$data2->id' and modelo='$data->id'");
						$data3 = $query3->fetch_object();
						if($data3->id == 0){
							$modelos[$data->id]['nome'] = $data->nome;
							$modelos[$data->id]['nome_artistico'] = $data->nome_artistico;
							$modelos[$data->id]['nascimento'] = $data->nascimento;
							$modelos[$data->id]['altura'] = $data->altura;
							$modelos[$data->id]['peso'] = $data->peso;
							$modelos[$data->id]['cintura'] = $data->cintura;
							$modelos[$data->id]['quadril'] = $data->quadril;
							$modelos[$data->id]['busto'] = $data->busto;
							$modelos[$data->id]['manequim'] = $data->manequim;
							$modelos[$data->id]['sapato'] = $data->sapato;
							$modelos[$data->id]['olhos'] = $data->olhos;
							$modelos[$data->id]['cabelos'] = $data->cabelos;
						}
					}
					$this->modelos = &$modelos;
					return true;
				}
				elseif($tipo == "feminino"){
					/* masculino
					  SEXO FEMININO = 2
					  ACIMA DE 13 ANOS
					  ATIVO
					  NÃO ESTÃO NO GRUPO DEVELOPMENT
					*/
					$query = $this->cnx->execute("select a.*, b.nome as olhos, c.nome as cabelos from modelos as a, cores_olhos as b, cores_cabelos as c where b.id=a.cor_olhos and c.id=a.cor_cabelo and a.disponivel_no_site='1' and a.sexo=2 and a.nascimento <= $inicio and a.status=1 order by a.nome_artistico");
					while($data = $query->fetch_object()){
						// verificando se está no grupo development
						$query3 = $this->cnx->execute("select count(id) as id from grupos_modelos_modelos where grupo='$data2->id' and modelo='$data->id'");
						$data3 = $query3->fetch_object();
						if($data3->id == 0){
							$modelos[$data->id]['nome'] = $data->nome;
							$modelos[$data->id]['nome_artistico'] = $data->nome_artistico;
							$modelos[$data->id]['nascimento'] = $data->nascimento;
							$modelos[$data->id]['altura'] = $data->altura;
							$modelos[$data->id]['peso'] = $data->peso;
							$modelos[$data->id]['cintura'] = $data->cintura;
							$modelos[$data->id]['quadril'] = $data->quadril;
							$modelos[$data->id]['busto'] = $data->busto;
							$modelos[$data->id]['manequim'] = $data->manequim;
							$modelos[$data->id]['sapato'] = $data->sapato;
							$modelos[$data->id]['olhos'] = $data->olhos;
							$modelos[$data->id]['cabelos'] = $data->cabelos;
						}
					}
					$this->modelos = &$modelos;
					return true;
				}
				elseif($tipo == "kids"){
					/* masculino
					  ABAIXO DE 13 ANOS
					  ATIVO
					*/
					$query = $this->cnx->execute("select a.*, b.nome as olhos, c.nome as cabelos from modelos as a, cores_olhos as b, cores_cabelos as c where b.id=a.cor_olhos and c.id=a.cor_cabelo and a.disponivel_no_site='1' and a.nascimento > $inicio and a.status=1 order by a.nome_artistico");
					while($data = $query->fetch_object()){
						// verificando se está no grupo development
						$query3 = $this->cnx->execute("select count(id) as id from grupos_modelos_modelos where grupo='$data2->id' and modelo='$data->id'");
						$data3 = $query3->fetch_object();

						if($data3->id == 0){
							$modelos[$data->id]['nome'] = $data->nome;
							$modelos[$data->id]['nome_artistico'] = $data->nome_artistico;
							$modelos[$data->id]['nascimento'] = $data->nascimento;
							$modelos[$data->id]['altura'] = $data->altura;
							$modelos[$data->id]['peso'] = $data->peso;
							$modelos[$data->id]['cintura'] = $data->cintura;
							$modelos[$data->id]['quadril'] = $data->quadril;
							$modelos[$data->id]['busto'] = $data->busto;
							$modelos[$data->id]['manequim'] = $data->manequim;
							$modelos[$data->id]['sapato'] = $data->sapato;
							$modelos[$data->id]['olhos'] = $data->olhos;
							$modelos[$data->id]['cabelos'] = $data->cabelos;
						}
					}
					$this->modelos = &$modelos;
					return true;
				}
				elseif($tipo == "development"){
					/* masculino
					  ESTÁ NO GRUPO DEVELOPMENT
					  ATIVO
					*/
					$query = $this->cnx->execute("select a.*, b.nome as olhos, c.nome as cabelos from modelos as a, cores_olhos as b, cores_cabelos as c where b.id=a.cor_olhos and c.id=a.cor_cabelo and a.disponivel_no_site='1' and a.nascimento <= $inicio and a.status=1 order by a.nome_artistico");
					while($data = $query->fetch_object()){
						// verificando se está no grupo development
						$query3 = $this->cnx->execute("select count(id) as id from grupos_modelos_modelos where grupo='$data2->id' and modelo='$data->id'");
						$data3 = $query3->fetch_object();
						if($data3->id != 0){
							$modelos[$data->id]['nome'] = $data->nome;
							$modelos[$data->id]['nome_artistico'] = $data->nome_artistico;
							$modelos[$data->id]['nascimento'] = $data->nascimento;
							$modelos[$data->id]['altura'] = $data->altura;
							$modelos[$data->id]['peso'] = $data->peso;
							$modelos[$data->id]['cintura'] = $data->cintura;
							$modelos[$data->id]['quadril'] = $data->quadril;
							$modelos[$data->id]['busto'] = $data->busto;
							$modelos[$data->id]['manequim'] = $data->manequim;
							$modelos[$data->id]['sapato'] = $data->sapato;
							$modelos[$data->id]['olhos'] = $data->olhos;
							$modelos[$data->id]['cabelos'] = $data->cabelos;
						}
					}
					$this->modelos = &$modelos;
					return true;
				}
				else{
					$this->error = "Tipo inválido.";
					return false;
				}
			}
			else{
				return false;
			}
		}

		// funcao para retornar os dados do modelo
		function get_dados_modelo($modelo){
			if($this->allOk){
				$query = $this->cnx->execute("select a.*, b.nome as olhos, c.nome as cabelos from modelos as a, cores_olhos as b, cores_cabelos as c where b.id=a.cor_olhos and c.id=a.cor_cabelo and a.id='$modelo'");
				$data = $query->fetch_object();
				// verificando se é	development
				$query2 = $this->cnx->execute("select id from grupos_modelos where lower(nome) like '%development%'");
				$data2 = $query2->fetch_object();

				$query3 = $this->cnx->execute("select count(id) as id from grupos_modelos_modelos where grupo='$data2->id' and modelo='$data->id'");
				$data3 = $query3->fetch_object();
	
				if(!$data->nome_artistico){
					$dados['nome'] = $data->nome;
				}
				else{
					$dados['nome'] = $data->nome_artistico;
				}
				$dados['nascimento'] = $data->nascimento;
				$dados['idade'] = $this->calc_idade($data->nascimento);
				$dados['altura'] = $data->altura;
				$dados['peso'] = $data->peso;
				$dados['cintura'] = $data->cintura;
				$dados['quadril'] = $data->quadril;
				$dados['busto'] = $data->busto;
				$dados['manequim'] = $data->manequim;
				$dados['sapato'] = $data->sapato;
				$dados['olhos'] = $data->olhos;
				$dados['cabelos'] = $data->cabelos;
				$dados['sexo'] = $data->sexo;
				$dados['development'] = $data3->id;
				$this->dados = $dados;
				return true;

			}
			else{
				return false;
			}
		}

		// funcao para calcular idade
		function calc_idade($nascimento, $base = 0){
			if($nascimento){
				if($base == 0){
					// calculando a idade
					$idade = Date("Y") - Date("Y", $nascimento);
					if(Date("m") < Date("m", $nascimento)) $idade--;
					if(Date("m") == Date("m", $nascimento) && Date("d") < Date("d", $nascimento)) $idade--;
					return $idade;
				}
				else{
					// calculando a idade
					$idade = Date("Y", $base) - Date("Y", $nascimento);
					if(Date("m", $base) < Date("m", $nascimento)) $idade--;
					if(Date("m", $base) == Date("m", $nascimento) && Date("d", $base) < Date("d", $nascimento)) $idade--;
					$this->base = 1;
					return $idade;
				}
			}
			else{
				return false;
			}
		}

		// funcao para encurtar o nome
		function encurta($nome){
			if(!$nome){
				return $nome;
			}
			else{
				$names = explode(" ", $nome);
				if(count($names) == 1){
					return $nome;
				}
				else{
					$nome = $names[0]." ".strtoupper(substr($names[1], 0, 1)).".";
					return $nome;
				}
			}
		}
	}
?>