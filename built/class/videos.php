<?
	class VIDEOS {
		
		var $cnx = null;
		var $error = "";
		var $allOk = false;

		function VIDEOS($cnxObj){
			if(is_a($cnxObj, "SQLAPI")){
				$this->cnx = &$cnxObj;
				$this->error = "";
				$this->allOk = true;
			}
			else{
				$this->error = "ERRO DE CONFIGURAÇÃO DAS CLASSES";
				$this->allOk = false;
				$this->cnx = null;
			}
		}

		###
		# VIDEOS
		###

		//funcao para adicionar um parceiro
		function add_video_modelo($modelo, $p, $nome){
			if($this->allOk){
				if(!$modelo){
					$this->error = "Falta do parâmetro modelo";
					return false;
				}
				elseif(!$p){
					$this->error = "Falta do parâmetro posição";
					return false;
				}
				elseif(!$nome){
					$this->error = "Falta do parâmetro video";
					return false;
				}
				else{
					$q = $this->cnx->execute("select id from videos_modelos where modelo='$modelo' and posicao='$posicao'");
					$d = $q->fetch_object();
					if($d->id){
						return $this->alt_video_modelo($modelo, $p, $nome);
					}
					else{
						if($this->cnx->dothis("insert into videos_modelos(modelo, posicao, video) values('$modelo', '$p', '$nome')")){
							return true;
						}
						else{
							$this->error = "Erro ao inserir no banco de dados.";
							return false;
						}
					}
				}
			}
			else{
				return false;
			}
		}

		//funcao para adicionar um parceiro
		function alt_video_modelo($modelo, $p, $nome){
			if($this->allOk){
				if(!$modelo){
					$this->error = "Falta do parâmetro modelo";
					return false;
				}
				elseif(!$p){
					$this->error = "Falta do parâmetro posição";
					return false;
				}
				elseif(!$nome){
					$this->error = "Falta do parâmetro video";
					return false;
				}
				else{
					if($this->cnx->dothis("update videos_modelos set video='$nome' where modelo='$modelo' and posicao='$p'")){
						return true;
					}
					else{
						$this->error = "Erro ao alterar no banco de dados.";
						return false;
					}
				}
			}
			else{
				return false;
			}
		}

		// funcao para apagar parceiros
		function del_video_modelo($modelo, $p){
			if($this->allOk){
				if(!$modelo){
					$this->error = "Falta do parâmetro modelo";
					return false;
				}
				elseif(!$p){
					$this->error = "Falta do parâmetro posição";
					return false;
				}
				else{
					if($this->cnx->dothis("delete from videos_modelos where modelo='$modelo' and posicao='$p'")){
						return true;
					}
					else{
						$this->error = "Erro ao apagar o video: ".$this->cnx->error;
						return false;
					}
				}
			}
			else{
				return false;
			}
		}

		// funcao para retornar os videos
		function get_videos_modelo($modelo){
			if($this->allOk){
				if(!$modelo){
					$this->error = "Falta do parâmetro modelo";
					return false;
				}
				else{
					$q = $this->cnx->execute("select id, posicao, video from videos_modelos where modelo='$modelo' order by posicao");
					while($d = $q->fetch_object()){
						$videos[$d->posicao] = $d->video;
					}
					$this->videos = $videos;
					return true;
				}
			}
			else{
				return false;
			}
		}
	}
?>