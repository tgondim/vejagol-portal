/**
 * Author: Tiago Gondim
 * 23 May 2012
 */
$(function() { 
	$("#divMarcadores").accordion({ header: "h3" });
	
	jQuery(document).ready(function(){
		$('.accordion .head').click(function() {
			$(this).next().toggle('slow');
			return false;
		}).next().hide();
	});	
});

function addJogo(jogo) {
	var idJogo = jogo.timeCasa;
	$('#divMarcadores').append('<h3 id="' + idJogo + '" align="left">'
			+ '<a href="#">' + jogo.data.dayOfMonth + "/" + (jogo.data.month + 1) + "/" + jogo.data.year + ' ' + jogo.timeCasa + ' ' + jogo.placarCasa + ' X ' + jogo.placarVisitante + ' ' + jogo.timeVisitante 
			+ '</a></h3><div id="div' + jogo.timeCasa  + '">' 
			//+ '<br><div class="fb-like" data-href="'+ jogo.link + '" data-send="false" data-width="200" data-show-faces="false"></div>'
			+ '<br>'+ jogo.liga 
			//+ '<div class="fb-comments" data-href="http://www.vejagol.com" data-num-posts="5" data-width="470"></div>'
			+ '<div id="videoLink" style="visibility: hidden;">' + jogo.link + '</div>'
			+ '</div>') 
	.accordion('destroy').accordion({ header: "h3" });
}

function carregando() {
	$('#divMarcadores').empty();
	$('#divMarcadores').html('<br><br><br><br><br><br><br><br><br><img src="images/carregando.gif" alt="Carregando jogos..."/><br><br><br><br><br><br><br><br><br><br><br><br>');
}
		
function getFbComments() {
	$.ajax({
	  url: "fbcomments.html?videoLink=" + videoLink,
	  type: "GET",
	  async: "true",
	  dataType: "html",
	  success: function(html) {
		$("#fbcomments").empty();
		$("#fbcomments").html(html);
	  }});
}

function listarJogos(de, ate, ordem, filtros, ascending) {
	carregando();
	if (de < 0) {
		mainDe = 0;
		mainAte = 10;
	} else {
		mainDe = de;
		mainAte = ate;
	}
	mainOrdem = ordem;
	mainFiltros = filtros;
	mainAscending = ascending;
	
	var listaJogosParameters = {"de" : mainDe, 
			"ate" : mainAte,
			"ordem" : mainOrdem,
			"filtros" : mainFiltros,
			"ascending" : mainAscending};
	$.ajax({
		  url: "//www.vejagol.com/VejaGolWS/ListarJogosServlet",
		  type: "POST",
		  async: "true",
		  dataType: "json",	  
		  data: listaJogosParameters,	  
		  success: function(data) {
			  $('#divMarcadores').empty();
			  if (data.result == "OK") {
				  for (var i = 0; i < data.listaJogos.length; i++) {
					  if (i == 0) {	
						videoLink = data.listaJogos[i].link;
					  }
					  addJogo(data.listaJogos[i]);
				  }
				  $('#divPlayer').html('<iframe id="videoIFrame" width="420" height="315" src="' + videoLink + '" frameborder="0" allowfullscreen></iframe>');				  
				  //getFbComments();
			  } else {
				//faz nada  
			  }
		  }
		});
} 