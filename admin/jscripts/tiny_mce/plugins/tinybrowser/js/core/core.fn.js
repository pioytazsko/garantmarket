/*********************************************************************************************
 * MODx PLUGIN: Basic Manager
 * VERSION:     1.0
 * DESCRIPTION: File Manager
 * WRITTEN BY:  Kobezzza (kobezzza@mail.ru)
 * DATE:        29/09/2010
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *********************************************************************************************/
 
// Ажакс без ответа
function ajaxNoReturn(actionType, data, resultF, jsonID, target){
	if (resultF.main === undefined) resultF = { main: resultF };
	resultF.success = resultF.success || lng.SUCCESS;
	resultF.error = resultF.error || lng.ERROR;
	resultF.loadingTitle = resultF.loadingTitle || lng.LOADING_TITLE;
	resultF.loadingMsg = resultF.loadingMsg || lng.LOADING_MSG;
	
	$.ajax({
		url: rootUrl + "/handlers/action.php",
		dataType: "text",
		data: "actionType=" + actionType + data,
		type: "POST",
		error: function (){ return false; },
		beforeSend: function(){ 
			popupMenu({
				id: "Loading",
				title: resultF.loadingTitle,
				main: '<p class="center">' + resultF.loadingMsg +'</p>'
			});
		},
        success: function(res){
			if (res == 1 || res.search("1->") != -1){
				if (actionType == "delete"){
					dirList = deleteElement(dirList, "n != " + jsonID);
					target.remove();
					leftBar();
				}else if (actionType == "rename"){
					res = res.split("->");
					dirList[jsonID].Name = res[1];
					setView();
					leftBar();
				}else{
					getDir(realPath);
					setView();
					leftBar();
				}
				$("#Loading").remove();
				popupMenu({
					title: resultF.success,
					main: '<p class="center">' + resultF.main +'</p>'
				});
			}else{
				$("#Loading").remove();
				popupMenu({
					title: resultF.error,
					main: '<p class="center">' + res +'</p>'
				});
			}
		}
	});
}

// Всплывающее меню
function popupMenu(content, confrm){
	confrm = confrm || 0;
	if (confrm == 0){
		if (content.sendOn === undefined && content.cancelVal === undefined) content.cancelVal = lng.OK;
		content.sendVal = content.sendVal || lng.OK;
		content.cancelVal = content.id == "Loading" ? "[break]" : content.cancelVal || lng.CANCEL;
		content.id = content.id || "alert";
		content.cancel = content.cancel || function(){};
		content.cancelVal = content.cancelVal != "[break]" ? '<input name="CancelBtn" value="' + content.cancelVal + '" type="button" id="CancelBtn_' + content.id + '" />' : "";
		content.sendOn = content.sendOn == true ? content.sendOn = '<input name="SendBtn" type="button" value="' + content.sendVal + '" id="SendBtn_' + content.id + '" />' : content.sendOn = "";
		
		$("body").prepend('<div id="' + content.id + '"><div class="overlay"></div><div class="MenuPos"><div class="PopupTitle">' + content.title + '</div><div class="padding">' + content.main + '<div class="center">' + content.sendOn + content.cancelVal + '</div></div></div></div>');
		$(".overlay, .MenuPos").fadeIn();
		
		var menuPos = $("#" + content.id + " .MenuPos");	
		height = menuPos.height();
		menuPos.css({
			"height" : height + "px", 
			"margin-top": "-" + (height / 2) + "px"
		});	  
		
		$("#SendBtn_" + content.id).click(function(){
			popupMenu({confr: content.confrm, id: content.id}, 1);
		});
		
		$("#CancelBtn_" + content.id).click(function(){
			popupMenu({confr: content.cancel, id: content.id}, 2);
		});
		
		if ($("#SendBtn_" + content.id).length == 0) $("#CancelBtn_" + content.id).focus();
		else $("#SendBtn_" + content.id).focus();
		
		menuPos.keydown(function(e){
			if (e.keyCode == 27){
				popupMenu({confr: content.cancel, id: content.id}, 2);
			}else if (e.keyCode == 17 && $("#SendBtn_" + content.id).length == 1) combPress[0] = 1;
			else if (e.keyCode == 13 && $("#SendBtn_" + content.id).length == 1 && combPress[0] == 1) popupMenu({confr: content.confrm, id: content.id}, 1);
		});
	}else if (confrm == 1){ content.confr(); $("#" + content.id).remove(); }
	else{ content.confr(); $("#" + content.id).remove(); }
}

// Поиск элемента массива
function searchElement(array, selector){
	var result;
	$.each(array, function(n, i){
		if (eval(selector)){ result = n; }
	});
	return result;
}
// Удаление элемента массива
function deleteElement(array, selector){
	var result = [];
	$.each(array, function(n, i){
		if (eval(selector)) result.push(this);
	});
	return result;
}
// Парсинг Json
function parseJson(json, template, selector){
	$.each(json, function(n){
		if (eval(selector)){ eval(template); }
	});
}

// Функция сортировки Json
var sortBy = function(field, reverse, primer){
   reverse = (reverse) ? -1 : 1;
   return function(a, b){
       a = a[field];
       b = b[field];
       if (primer !== undefined){
           a = primer(a);
           b = primer(b);
       }
       if (a < b) return reverse * -1;
       if (a > b) return reverse * 1;
       return 0;
   }
}

// Функция обнуления
function setNull(varNull){
	if ($.isArray(varNull)){
		for (var i = 0; i < varNull.length; i++) 
			varNull[i] = 0;
	}else varNull = 0;
}

// Установка шаблона "список"
function setList(){
	result = "<ul>";
	if (sortType != "Name") parseJson(dirList, templateList, filter());
	else{
		parseJson(dirList, templateList, filter() + " && this.Type=='Cat'");
		parseJson(dirList, templateList, filter() + " && this.Type!='Cat'");
	}
	result = result == "<ul>" ? '<div class="BigDescription">' + lng.NOT_FOUND + '</div>' : result + "</ul>";
	$("#MainContent").html(result);
	result = "";
}

// Установка шаблона "таблица"
function setTable(){
	result = "<table><tr><th id=\"Icon\"></th><th id=\"Name\">" + lng.NAME + "</th><th id=\"Filesize\">" + lng.FILESIZE + "</th><th id=\"TablePath\">" + lng.PATH + "</th><th id=\"Action\">" + lng.ACTION + "</th></tr>";
	if (sortType != "Name") parseJson(dirList, templateTable, filter());
	else{
		parseJson(dirList, templateTable, filter() + " && this.Type=='Cat'");
		parseJson(dirList, templateTable, filter() + " && this.Type!='Cat'");
	}
	result = result == "<table><tr><th id=\"Icon\"></th><th id=\"Name\">" + lng.NAME + "</th><th id=\"Filesize\">" + lng.FILESIZE + "</th><th id=\"TablePath\">" + lng.PATH + "</th><th id=\"Action\">" + lng.ACTION + "</th></tr>" ? '<div class="BigDescription">' + lng.NOT_FOUND + '</div>' : result + "</table>";
	$("#MainContent").html(result);
	result = "";
	$("tr:odd").addClass("TdOdd");
}

// Установка шаблона "плитка"
function setPlate(){
	if (sortType != "Name") parseJson(dirList, templatePlate, filter());
	else{
		parseJson(dirList, templatePlate, filter() + " && this.Type=='Cat'");
		parseJson(dirList, templatePlate, filter() + " && this.Type!='Cat'");
	}
	result = result == "" ? '<div class="BigDescription">' + lng.NOT_FOUND + '</div>' : result;
	$("#MainContent").html(result);
	result = "";
}

// Настройка просмотра
function setView(){
	switch (sortType){
		case "Name" : $("a[rel^=set->order]:eq(1)").addClass("active"); break;
		case "Filesize" : $("a[rel^=set->order]:eq(2)").addClass("active"); break;
		case "Format" : $("a[rel^=set->order]:eq(3)").addClass("active"); break;
	}
	switch (view){
		case "table" : {
			$("a[rel^=set->view]:eq(1)").addClass("active");
			$("#Views").removeClass().addClass("TableView");
		} break;
		case "plate" : {
			$("a[rel^=set->view]:eq(2)").addClass("active");
			$("#Views").removeClass().addClass("PlateView");
		} break;
		case "list" : {
			$("a[rel^=set->view]:eq(3)").addClass("active");
			$("#Views").removeClass().addClass("ListView");
		} break;
	}
	dirList.sort(sortBy(sortType, false, function(a){return a.toUpperCase()}));
	switch (view){
		case "list" : return setList(); break;
		case "table" : return setTable(); break;
		case "plate" : return setPlate(); break;
	}
}