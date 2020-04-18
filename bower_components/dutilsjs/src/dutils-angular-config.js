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

					var uid = response.config.uid;

					var aux=0;
					for (var field in response.data.errors){

						var fieldId = uid ? field + "-" + uid : field;

						if (aux ==0){
							$("#" + fieldId.replace(/\./g,"\\.")).focus();
							aux++;
						}

						addFormError(fieldId,response.data.errors[field]);
					}

					if (response.data.default){
						appAlert(response.data.default);
					}

				}

				return $q.reject(response);
			}
		};
	}]);

}]);

app.service("UIDService", function(){

	var nextId = 1;

	this.generate = function(){
		return nextId++;
	}
});