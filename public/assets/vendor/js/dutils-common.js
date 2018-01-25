function appAlert(message, title) {
	toastr.error(title, message,
		{
			'timeOut': 10000,
			'closeButton': true,
			'progressBar': true
		}
	);
}

function appInfo(mensagem,titulo,timeout) {

	if (!timeout)
		timeout = 10000;

	toastr.info(titulo, mensagem,
		{
			'timeOut': timeout,
			'closeButton': true,
			'progressBar': true
		}
	);
}

function addFormError(field,message){

	var msg = "<div class='help-block validation-error text-red'>" + message + "</div>";

	var hasWarningField = document.getElementById("warning-" + field) !== null;
	var fieldExists = document.getElementById(field) !== null;

	var field = field.replace(/\./g,"\\.");

	if(hasWarningField){
		$("#warning-" + field).html(msg).parent().addClass('has-error');
	}else if(fieldExists){
		$("#" + field).parent().append(msg).addClass('has-error');
	}else{
		appAlert(message);
	}
}

function removeFormErrors(){
	$(".validation-error").remove();
	$(".has-error").removeClass('has-error');
}

function empty(valor){
	return $.trim(valor) === "";
}

function replaceAll(str, find, replace) {
	return str.replace(new RegExp(find, 'g'), replace);
}

function removeMasksAndLeadingZero(vr) {

	if (vr.substr(0, 2) == "0,")
		vr = vr.substr(2);

	while (vr.substr(0, 1) == "0")
		vr = vr.substr(1);

	return onlyNumbers(vr);

}

/**
 * Corrige um bug na data do datepicker do ui.bootstrap, quando não usa uma data UTC
 * @param data
 */
function fixDatepickerDate(data) {

	try {

		var ano = data.getFullYear();
		var mes = data.getMonth();
		var dia = data.getDate();

		return new Date(ano, mes, dia);

	} catch (e) {

		if (data && data.indexOf('-') >= 0) {
			var tmp = data.split("-");
			return new Date(tmp[0], tmp[1] - 1, tmp[2]);
		}

	}

	return "";

}

function isMobile(){
	return $(window).width() <= 703 ? true: false;
}

function loadingCenter(target,show,imageSize){

	if (imageSize == undefined || imageSize == null)
		imageSize = 50;

	loading(target,show,imageSize,'center');

}

function loadingTop(target,show,imageSize, marginTop){

	if (imageSize == undefined || imageSize == null)
		imageSize = 50;

	if (marginTop == undefined || marginTop == null)
		marginTop = '30px';

	loading(target,show,imageSize,marginTop);

}

function loading(target,show,imageSize, spinnerTop){

	if (imageSize == undefined || imageSize == null)
		imageSize = 50;

	if (spinnerTop == undefined || spinnerTop == null)
		spinnerTop = '30px';

	var largura = $("#" + target).width();
	var altura  = $("#" + target).height();

	if (show){

		var loadingDiv = document.createElement("DIV");
		loadingDiv.id = "loading-" + target;
		loadingDiv.style.width = largura + "px";
		loadingDiv.style.height = altura + "px";
		loadingDiv.style.position = "absolute";
		loadingDiv.style.backgroundColor = "rgba(255,255,255,.7)";
		loadingDiv.style.textAlign = "center";
		loadingDiv.style.zIndex = "999999";

		if (spinnerTop == 'center'){
			spinnerTop = ((parseInt(altura)/2) - (imageSize /2)) + "px";
		}

		var spinner = document.createElementNS("http://www.w3.org/2000/svg", 'svg'); //Create a path in SVG's namespace
		spinner.setAttribute("width","50px");
		spinner.setAttribute("height","50px");
		spinner.setAttribute("class","spinner-container");
		$(spinner).css('margin-top', spinnerTop);

		var tamanhoCirculo = (parseInt(imageSize/2));
		var circle = document.createElementNS("http://www.w3.org/2000/svg", 'circle'); //Create a path in SVG's namespace
		circle.setAttribute("cx", tamanhoCirculo + "px"); //Set path's data
		circle.setAttribute("cy",tamanhoCirculo + "px"); //Set path's data
		circle.setAttribute("r", (tamanhoCirculo - 5) + "px"); //Set path's data
		circle.setAttribute("fill","none");
		circle.setAttribute("class","path"); //Set path's data
		spinner.appendChild(circle);

		loadingDiv.appendChild(spinner);

		$(loadingDiv).prependTo($("#" + target));

	}else{
		$("#loading-" + target).remove();
	}

}

function maskCurrencyInputBR(campo, prefixo) {

	if (!prefixo && prefixo != "")
		prefixo = "R$ ";

	campo.value = maskCurrencyBR(campo.value, prefixo);

}
function maskCurrencyBR(amount, prefix) {

	if (!amount)
		return "";

	if (!prefix && prefix != "")
		prefix = "R$ ";

	amount = "" + amount;

	if (amount.indexOf(prefix) != -1) {
		amount = amount.substr(prefix.length);
	}

	//Se só veio com uma casa decimal
	if ((amount.indexOf(".") != -1) && amount.indexOf(".") == amount.length-2){
		amount += "0";
	}

	var finalAmount = "";
	var vr = removeMasksAndLeadingZero(amount);

	if (!vr)
		return "";

	var tam = vr.length;

	if (isNaN(vr)) {
		finalAmount = onlyNumbers(vr);
		return maskCurrencyBR(finalAmount, prefix);
	}

	if (tam == 1) {
		finalAmount = prefix + "0,0" + vr;
	}
	if (tam == 2) {
		finalAmount = prefix + "0," + vr;
	}
	if (tam > 2 && tam <= 5) {
		finalAmount = prefix + vr.substr(0, tam - 2) + "," + vr.substr(tam - 2, tam);
	}
	if (tam >= 6 && tam <= 8) {
		finalAmount = prefix + vr.substr(0, tam - 5) + "." + vr.substr(tam - 5, 3) + "," + vr.substr(tam - 2, tam);
	}
	if (tam >= 9 && tam <= 11) {
		finalAmount = prefix + vr.substr(0, tam - 8) + "." + vr.substr(tam - 8, 3) + "." + vr.substr(tam - 5, 3) + "," + vr.substr(tam - 2, tam);
	}
	if (tam >= 12 && tam <= 14) {
		finalAmount = prefix + vr.substr(0, tam - 11) + "." + vr.substr(tam - 11, 3) + "." + vr.substr(tam - 8, 3) + "." + vr.substr(tam - 5, 3) + "," + vr.substr(tam - 2, tam);
	}
	if (tam >= 15 && tam <= 18) {
		finalAmount = prefix + vr.substr(0, tam - 14) + "." + vr.substr(tam - 14, 3) + "." + vr.substr(tam - 11, 3) + "." + vr.substr(tam - 8, 3) + "." + vr.substr(tam - 5, 3) + "," + vr.substr(tam - 2, tam);
	}

	return finalAmount;
}

function maskDateBR(content) {

	var valor = onlyNumbers(content);

	if (!valor)
		return "";

	var aux = valor;

	if (valor.length >= 5) {

		var p1 = valor.substring(0, 2);
		var p2 = valor.substring(2, 4);
		var p3 = valor.substring(4,8);

		aux = p1 + "/" + p2 + "/" + p3;

	} else if (valor.length >= 3) {

		var p1 = valor.substring(0, 2);
		var p2 = valor.substring(2);

		aux = p1 + "/" + p2;
	}

	return aux;

}

function maskDateInputBR(field){

	field.value = maskDateBR(field.value);

}

function maskHours(hours){

	var valor = onlyNumbers(hours);

	if (!valor)
		return "";

	if (valor.length >=3){

		var p1 = valor.substring(0,2);
		var p2 = valor.substring(2,4);

		return p1 + ":" + p2;

	}

	return valor;

}

function maskPersonPINBR(pin){

	var valor = onlyNumbers(pin);

	if (!valor)
		return "";

	if (valor.length >=10){

		var p1 = valor.substring(0,3);
		var p2 = valor.substring(3,6);
		var p3 = valor.substring(6,9);
		var p4 = valor.substring(9,11);

		return p1 + "." + p2 + "." + p3 + "-" + p4;

	}else if (valor.length >= 7){

		var p1 = valor.substring(0,3);
		var p2 = valor.substring(3,6);
		var p3 = valor.substring(6);


		return p1 + "." + p2 + "." + p3;
	}else if (valor.length >= 4){

		var p1 = valor.substring(0,3);
		var p2 = valor.substring(3);


		return p1 + "." + p2 ;
	}

	return valor;

}

function maskCompanyPINBR(pin){    // Esta eh a function que formata o cnpj.

	var valor = onlyNumbers(pin);

	if (!valor)
		return "";

	if (valor.length >=13){

		var p1 = valor.substring(0,2);
		var p2 = valor.substring(2,5);
		var p3 = valor.substring(5,8);
		var p4 = valor.substring(8,12);
		var p5 = valor.substring(12,14);

		return p1 + "." + p2 + "." + p3 + "/" + p4 + "-" + p5;

	}else if (valor.length >=9){

		var p1 = valor.substring(0,2);
		var p2 = valor.substring(2,5);
		var p3 = valor.substring(5,8);
		var p4 = valor.substring(8,12);

		return p1 + "." + p2 + "." + p3 + "/" + p4;

	}else if (valor.length >= 6){

		var p1 = valor.substring(0,2);
		var p2 = valor.substring(2,5);
		var p3 = valor.substring(5);

		return p1 + "." + p2 + "." + p3;

	}else if (valor.length >= 3){

		var p1 = valor.substring(0,2);
		var p2 = valor.substring(2);

		return p1 + "." + p2 ;
	}

	return valor;

}

function maskPhoneNumberBR(number){

	var valor = onlyNumbers(number);

	if (!valor) return "";

	if (valor.length >=7){

		var p1 = valor.substring(0,2);
		var p2 = valor.substring(2,6);
		var p3 = valor.substring(6,11);

		return "(" + p1 + ")" + p2 + "-" + p3;

	}else if (valor.length >= 3){

		var p1 = valor.substring(0,2);
		var p2 = valor.substring(2);


		return "(" + p1 + ")" + p2 ;
	}

	return valor;

}

function maskZipCodeBR(campo){

	if (isMobile())
		return;

	$("#" + campo).keyup(function(){

		var valor = onlyNumbers(this.value);
		if (valor.length >=6){

			var p1 = valor.substring(0,2);
			var p2 = valor.substring(2,5);
			var p3 = valor.substring(5);

			if (p3.length >3)
				p3 = p3.substring(0,3);

			this.value = p1 + "." + p2 + "-" + p3;

		}else if (valor.length >= 3){

			var p1 = valor.substring(0,2);
			var p2 = valor.substring(2);

			this.value = p1 + "." + p2;
		}else{
			this.value = valor;
		}

	});

}

function arrRemove(arr,object){

	var index = arr.indexOf(object);
	if (index != -1) {
		arr.splice(index, 1);
	}

}

function onlyNumbers(valor) {

	if (!valor)
		return;

	return valor.replace(/[^0-9]/gi, '');

}

function toggleFormRow(){
	$(".form-row").toggle();
	$(".table-row").toggle();
}

function getDefaultLineChartOptions(){

	var options = {
		tooltips: {
			enabled: true
		},
		title : {
			display : true
		},
		legend : {
			position : 'bottom'
		},
		animation: {
			onComplete: function() {

				var ctx = this.chart.ctx;

				ctx.textAlign = "center";
				ctx.textBaseline = "bottom";

				for (var i=0;i<this.chart.config.data.datasets.length;i++){

					var dataset = this.chart.config.data.datasets[i];

					var _meta = dataset._meta;

					for (var idx in _meta){

						var metaobj = _meta[idx];

						ctx.fillStyle = dataset.strokeColor;
						metaobj.dataset._points.forEach(function(p) {
							ctx.fillText(p._chart.config.data.datasets[p._datasetIndex].data[p._index], p._model.x, p._model.y - 10);
						});
					}

				}
			}
		}
	};

	return options;

}

function copyProperties(srcObj, destObj) {
	for (var key in destObj) {
		if(destObj.hasOwnProperty(key) && srcObj.hasOwnProperty(key)) {
			destObj[key] = srcObj[key];
		}
	}
}