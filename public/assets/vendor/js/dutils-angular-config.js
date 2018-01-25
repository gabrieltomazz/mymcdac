app.config(['$httpProvider', function($httpProvider){

	$httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
	$httpProvider.interceptors.push(['$q',function($q) {

		var redirectedToLoginpage = false;

		return {

			'request': function(config) {
				$(".block-on-load").prop('disabled',true);

				if (!config.timeout){
					config.timeout = 10000;
				}

				return config;
			},

			'response' : function(response){

				$(".block-on-load").prop('disabled',false);
				removeFormErrors();

				return response;
			},
			'responseError': function(response) {

				$(".block-on-load").prop('disabled',false);
				removeFormErrors();

				if (response.status == '901') {
					if (!redirectedToLoginpage) {
						redirectedToLoginpage = true;
						appAlert("Usuário não logado ou sessão expirada. Por favor, identifique-se novamente.");

						var url = '/auth/login';
						window.location.href = url;
					}
					return $q.reject(response);
				}

				if (response.status == '403'){

					appAlert('Você não tem permissão para executar esta ação.');

				}else if (response.status == '401'){

					appAlert('Sessão expirada');
					window.location.href = "/auth/login";

				}else if (response.status == '404'){

					appAlert(response.data);

				}else if (response.status == '500'){

					var mensagemPadrao = "Erro inesperado. Por favor, tente novamente em alguns minutos.";
					appAlert(mensagemPadrao);

				}else if (response.status == -1){

					appAlert("Erro de comunicação com o servidor. Aguarde um pouco e tente novamente.");

				}

				//Tratamento padrao de exibicao de erros em forms
				if (response.status == 422 && !response.config.ignore422){

					var aux=0;
					for (var field in response.data){

						if (aux ==0){
							$("#" + field.replace(/\./g,"\\.")).focus();
							aux++;
						}

						addFormError(field,response.data[field]);
					}

					if (response.data.error){
						appAlert(response.data.error);
					}

				}

				return $q.reject(response);
			}
		};
	}]);

}]);