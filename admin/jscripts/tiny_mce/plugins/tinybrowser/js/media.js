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
//wysiwyg.FCKeditor = false;

// Часть абсолютного пути в зависимости от типа
var pathType = "";

function changePathType(){
	switch (type){
		case "images" : pathType = "/assets/images/"; break;
		case "files" :  pathType = "/assets/files/"; break;
		case "flash" : pathType = "/assets/flash/"; break;
		case "media" : pathType = "/assets/media/"; break;
	}
}

// Путь к менеджеру
var rootUrl = window.location.pathname;
rootUrl = rootUrl.replace("/browser.php", "");

// Переменные пути и каталогов
var dirList = "";
var result = "";
var path = $.cookie("BM_path") || '/ <a href="javascript:;" rel="set->cat->" title="' + lng.GO + type + '">' + type + '</a>';

var realPath = $.cookie("BM_realPath") || "";

// Контролер нажатия клавиши
var combPress = [];
combPress[0] = 0;

// Настройки PIXLR
var site_host = window.location.host;
var site_url = "http://" + site_host;

pixlr.settings.exit = site_url + '/manager/media/browser/mcpuk/handlers/exit_modal.php';
pixlr.settings.credentials = false;
pixlr.settings.method = 'get';
pixlr.settings.loc = lang;
pixlr.settings.locktarget = true;
pixlr.settings.referrer = site_host;

var managerControl = "";

var view = "";
var sortType = "";
var resizeThumb = "";

// Поле каталогов
function leftBar(){
	result = "<ul>";
	parseJson(dirList, templateList, "this.Type == 'Cat'");
	result += "</ul>";
	$("#Cat").html(result);
	result = "";
}

// Получения JSON содержимого папки
function getDir(dir){
	tp = type;
	dir = dir || "";
	$.ajax({
		url: rootUrl + "/handlers/json_dir.php",
		data: "dir=" + dir + "&type=" + tp,
		dataType: "json",
		type: "POST",
		error: function (){ return false; },
		success: function(json){
			dirList = json.Dir;
			view = json.View;
			resizeThumb = json.ResizeThumb;
			sortType = json.SortType;
			setView();
			leftBar();
			$("#Loading").remove();
		}
	});
}

// Создание псевдо сессии для мультизагрузки
function checkManager(){
	$.ajax({
		url: rootUrl + "/handlers/check_manager.php",
		async: false,
		dataType: "text",
		type: "POST",
		error: function (){ return false; },
		success: function(res){ managerControl = res; }
	});
}

// Сохранение пользовательских настроек
function savePref(){
	$.ajax({
		url: rootUrl + "/handlers/save_pref.php",
		dataType: "text",
		type: "POST",
		data: "sortType=" + sortType + "&view=" + view
	});
}

// Сохранение Json коллекции
function saveJsonCollection(name, json){
	$.ajax({
		url: rootUrl + "/handlers/save_json_collection.php",
		dataType: "text",
		type: "POST",
		data: "pathType=" + type + "&path=" + realPath + "&name=" + name + "&string=" + json,
		beforeSend: function(){ 
			popupMenu({
				id: "Loading",
				title: lng.LOADING_TITLE,
				main: '<p class="center">' + lng.LOADING_MSG + '</p>'
			});
		},
		success: function(res){
			$("#Loading").remove();
			if (res == 1){
				getDir(realPath);
				setView();
				popupMenu({title: lng.SUCCESS, main: '<p class="center">' + lng.NEW_JSON_COLLECTION_SUCCESS + '</p>'});
			}else popupMessage({title: lng.ERROR, main: res});
		}
	});
}

// Сохранение пользовательских настроек
function savePrefManager(){
	$.ajax({
		url: rootUrl + "/handlers/save_pref_manager.php",
		dataType: "text",
		type: "POST",
		data: "resizeThumb=" + $("#ResizeThumb").val() + "&widthThumb=" + $("#WidthThumb").val() + "&heightThumb=" + $("#HeightThumb").val() + "&resizeImg=" + $("#ResizeImg").val() + "&widthImg=" + $("#WidthImg").val() + "&heightImg=" + $("#HeightImg").val() + "&rewriteName=" + $("#RewriteName").val() + "&rewriteWidth=" + $("#RewriteWidth").val()  + "&systemThumb=" + $("#SystemThumb").val(),
		beforeSend: function(){ 
			popupMenu({
				id: "Loading",
				title: lng.LOADING_TITLE,
				main: '<p class="center">' + lng.LOADING_MSG +'</p>'
			});
		},
		success: function(){
			$("#Loading").remove();
			resizeThumb = $("#ResizeThumb").val();
		}
	});
}

// Обновление папки
function setRefresh(dir){
	tp = type;
	dir = dir || "";
	$.ajax({
		url: rootUrl + "/handlers/refresh.php",
		dataType: "text",
		type: "POST",
		data: "dir=" + dir + "&type=" + tp,
		beforeSend: function(){ 
			popupMenu({
				id: "Loading",
				title: lng.LOADING_TITLE,
				main: '<p class="center">' + lng.LOADING_MSG +'</p>'
			});
		},
		success: function(res){
			$("#Loading").remove();
			if (res != 1) popupMenu({title: lng.ERROR, main: '<p class="center">' + res + "</p>"});
			else getDir(dir);
		}
	});
}

// Очистка временных файлов
function deleteTemp(){
	$.ajax({
		url: rootUrl + "/handlers/delete_temp.php",
		dataType: "text",
		type: "POST"
	});
}

// Фильтр JSON
function filter(){
	var result;
	var value = $.trim($("input[name='Search']").val());	
	if (value != lng.SEARCH && value != "") result = "this.Name.search(/" + value + "/i) != -1";
	else result = 1;
	return result;
}

function SetTVUrl(fileUrl){
	with (window.top){
		opener.SetUrl(fileUrl);
		close();
		opener.focus();
	}
}

$(function(){
	changePathType();
	$(".menu, #Pref").hide();
	$("#MainContent, #LeftBar").css("height", $(window).height() - 64 + "px");
	$("#Cat").css("height", $(window).height() - 225 + "px");
	$("#Pref").css("width", $(window).width() - 205 + "px");
	
	$("#PathText").html(path);
	getDir(realPath);
	
	switch (type){
		case "images" : $("#Root a:eq(0)").addClass("active"); break;
		case "media" : $("#Root a:eq(1)").addClass("active"); break;
		case "flash" : $("#Root a:eq(2)").addClass("active"); break;
		case "files" : $("#Root a:eq(3)").addClass("active"); break;
	}
	
	if ($("#ResizeThumb").val() == 1) $("#WidthThumb, #HeightThumb").attr("disabled", false);
		else $("#WidthThumb, #HeightThumb").attr("disabled", true);
	if ($("#ResizeImg").val() == 1) $("#WidthImg, #HeightImg").attr("disabled", false);
		else $("#WidthImg, #HeightImg").attr("disabled", true);
	
	$("#ResizeThumb").change(function(){
		if ($(this).val() == 1) $("#WidthThumb, #HeightThumb").attr("disabled", false);
		else $("#WidthThumb, #HeightThumb").attr("disabled", true);
	});
	$("#ResizeImg").change(function(){
		if ($(this).val() == 1) $("#WidthImg, #HeightImg").attr("disabled", false);
		else $("#WidthImg, #HeightImg").attr("disabled", true);
	});
	$("#SavePref").click(function(){ savePrefManager(); });
	
	$("input[name='Search']").bind("focus blur keyup", function(e){
		var value = $.trim($(this).val());
		
		if (e.type == "focus") $("#Search").addClass("SearchFocus");
		else if (e.type == "blur") $("#Search").removeClass("SearchFocus");
		
		if (value == lng.SEARCH && e.type == "focus") $(this).val("");
		else if (value == "" && e.type == "blur") $(this).val(lng.SEARCH);
		else if (e.type == "keyup") setView();
	});
	
	$(window).resize(function(){
		var height = $(this).height();
		var width = $(this).width();
		$("#Pref").css("width", width - 205 + "px");
		$("#MainContent, #LeftBar").css("height", height - 64 + "px");
		$("#Cat").css("height", height - 225 + "px");
		if ($("iframe").length != 0) $("iframe").css({"height": height - 48 + "px", "width": width - 66 + "px"});
	});
	
	$("body").click(function(e){
		if ($(e.target).attr("id").search(/(?=Order|Views|Create)/) == -1 && $(e.target).attr("href") != "javascript:;") $(".menu").hide();
		if (!$(e.target).attr("rel") || $(e.target).attr("rel").search("go->file") == -1) $("#Helper").remove();
		
		var target = $(e.target).parent().attr("rel");
		target = target === undefined ? $(e.target) : $(e.target).parent();
		
		if (target.attr("href") !== undefined)
			if (target.attr("rel").search("rename->") != -1){
				target.each(function(){
					var rel = $(this).attr("rel").split("->");
					switch (view){
						case "table" : var $this = $(this).parents("tr").find("a[rel^='go']"); break;
						case "plate" : var $this = $(this).parents(".plate").find("a[rel^='go']"); break;
						case "list" : var $this = $(this).parents("li").find("a[rel^='go']"); break;
					}
					popupMenu({
						id: "Rename",
						sendOn: true,
						title: lng.RENAME_TITLE,
						main: '<p class="center"><input id="RenameText" type="text"></p>',
						confrm: function(){
							var value = $.trim($("#RenameText").val());
							if (value == ""){
								$("#Rename").remove();
								popupMenu({
									title: lng.ERROR,
									main: '<p class="center">' + lng.RENAME_ERROR + "</p>"
								});
							}else ajaxNoReturn(rel[0], "&new=" + value + "&pathType=" + type + "&path=" + realPath + "&old=" + rel[1], lng.RENAME_SUCCESS, rel[2], $this);
						}
					});
				});
			}else if (target.attr("rel").search("go->") != -1){
				target.each(function(){						   
					var rel = $(this).attr("rel").split("->");
					switch (rel[1]){
						case "refresh" : {
							setRefresh(realPath);
						} break;
						case "cat" : {
							realPath += rel[2] + "/";
							$.cookie("BM_realPath", realPath);
							path += ' / <a href="javascript:;" rel="set->cat->' + realPath + '" title="' + lng.GO + rel[2] + '">' + rel[2] + "</a>";
							getDir(realPath);
							$.cookie("BM_path", path);
							$("#PathText").html(path);
						} break;
						case "img" : {
							if (resizeThumb == 0 || rel[4] == "None"){
								fileUrl = unescape(rel[2]);
								if (tv == "true") SetTVUrl(fileUrl);
								else window.top.SetUrl(fileUrl);		
							}else{
								$("#Helper").remove();
								$("body").append('<div id="Helper"><ul><li><a href="javascript:;" rel="go->file->' + rel[2] + '">' + lng.ORIGINAL + '</a></li><li><a href="javascript:;" rel="go->file->' + rel[4] + '">' + lng.THUMB + '</a></li></ul></div>');
								var width = $("#Helper").width();
								$("#Helper").css({"top": e.pageY + "px", "left": e.pageX - width / 2 + "px"});
							}
						} break;
						case "file" : {
							fileUrl = unescape(rel[2]);
							if (tv == "true") SetTVUrl(fileUrl);
							else window.top.SetUrl(fileUrl);	
						} break;
					}
				});
			}else if (target.attr("rel").search("delete->") != -1){
				target.each(function(){
					var rel = $(this).attr("rel").split("->");
					switch (view){
						case "table" : var $this = $(this).parents("tr"); break;
						case "plate" : var $this = $(this).parents(".plate"); break;
						case "list" : var $this = $(this).parents("li"); break;
					}
					switch (rel[1]){
						case "file" : {
							popupMenu({
								id: "delete",
								sendOn: true,
								title: lng.DELETE_FILE_TITLE,
								main: '<p class="center">' + lng.DELETE_FILE_MAIN + "</p>",
								confrm: function(){
									ajaxNoReturn(rel[0], "&pathType=" + type + "&delType=" + rel[1] + "&path=" + realPath + "&name=" + rel[2], lng.DELETE_FILE_SUCCESS, rel[3], $this);
								}
							});
						} break;
						case "cat" : {
							popupMenu({
								id: "delete",
								sendOn: true,
								title: lng.DELETE_CAT_TITLE,
								main: '<p class="center">' + lng.DELETE_CAT_MAIN + "</p>",
								confrm: function(){
									ajaxNoReturn(rel[0], "&pathType=" + type + "&delType=" + rel[1] + "&path=" + rel[2], lng.DELETE_CAT_SUCCESS, rel[3], $this);
								}
							});
						} break;
					}
				});
			}else if (target.attr("rel").search("edit->") != -1){
				target.each(function(){
					var rel = $(this).attr("rel").split("->");
					pixlr.overlay.show({image: site_url + "/assets/images/" + realPath + rel[1], title: rel[1], target: site_url + '/manager/media/browser/mcpuk/handlers/save_image.php?path=' + realPath + "&pathType=" + type + "&oldName=" + rel[1]});
				});
			}else if (target.attr("rel").search("set->") != -1){
				target.each(function(){						   
					var rel = $(this).attr("rel").split("->");
					switch (rel[1]){
						case "cat" : {
							realPath = rel[2];
							$.cookie("BM_realPath", realPath);
							var cnt = realPath.split("/");
							var pathArr = path.split(" / ");
							path = "";
							for (var i = 0; i < cnt.length; i++){
								if (i != 0) path += " / " + pathArr[i];
								else path += pathArr[i];
							}
							getDir(realPath);
							$.cookie("BM_path", path);
							$("#PathText").html(path);
						} break;
						case "order" : {
							switch (rel[2]){
								case "name" : {
									sortType = "Name";
									$("a[rel^=set->order]:eq(1)").addClass("active").parent("li").siblings().find("a").removeClass("active");
									savePref();
									setView();
									$(this).parents(".menu").hide();
								} break;
								case "size" : {
									sortType = "Filesize";
									$("a[rel^=set->order]:eq(2)").addClass("active").parent("li").siblings().find("a").removeClass("active");
									savePref();
									setView();
									$(this).parents(".menu").hide();
								} break;
								case "format" : {
									sortType = "Format";
									$("a[rel^=set->order]:eq(3)").addClass("active").parent("li").siblings().find("a").removeClass("active");
									savePref();
									setView();
									$(this).parents(".menu").hide();
								} break;
								default: $(this).siblings("ul").toggle().parents("li").siblings().find(".menu").hide();
							}
						} break;
						case "root" : {
							switch (rel[2]){
								case "images" : {
									type = "images";
									changePathType();
									getDir();
									path = '/ <a href="javascript:;" rel="set->cat->" title="' + lng.GO + type + '">' + type + '</a>';
									$("#PathText").html(path);
									realPath = "";
									$("#Root a:eq(0)").addClass("active").parent("li").siblings("li").find("a").removeClass("active");
								} break;
								case "media" : {
									type = "media";
									changePathType();
									getDir();
									path = '/ <a href="javascript:;" rel="set->cat->" title="' + lng.GO + type + '">' + type + '</a>';
									$("#PathText").html(path);
									realPath = "";
									$("#Root a:eq(1)").addClass("active").parent("li").siblings("li").find("a").removeClass("active");
								} break;
								case "flash" : {
									type = "flash";
									changePathType();
									getDir();
									path = '/ <a href="javascript:;" rel="set->cat->" title="' + lng.GO + type + '">' + type + '</a>';
									$("#PathText").html(path);
									realPath = "";
									$("#Root a:eq(2)").addClass("active").parent("li").siblings("li").find("a").removeClass("active");
								} break;
								case "files" : {
									type = "files";
									changePathType();
									getDir();
									path = '/ <a href="javascript:;" rel="set->cat->" title="' + lng.GO + type + '">' + type + '</a>';
									$("#PathText").html(path);
									realPath = "";
									$("#Root a:eq(3)").addClass("active").parent("li").siblings("li").find("a").removeClass("active");
								} break;
							}
						} break;
						case "view" : {
							switch (rel[2]){
								case "list" : {
									view = "list";
									$("a[rel^=set->view]:eq(3)").addClass("active").parent("li").siblings().find("a").removeClass("active");
									$("#Views").removeClass().addClass("ListView");
									savePref();
									setView();
									$(this).parents(".menu").hide();
								} break;
								case "plate" : {
									view = "plate";
									$("a[rel^=set->view]:eq(2)").addClass("active").parent("li").siblings().find("a").removeClass("active");
									$("#Views").removeClass().addClass("PlateView");
									savePref();
									setView();
									$(this).parents(".menu").hide();
								} break;
								case "table" : {
									view = "table";
									$("a[rel^=set->view]:eq(1)").addClass("active").parent("li").siblings().find("a").removeClass("active");
									$("#Views").removeClass().addClass("TableView");
									savePref();
									setView();
									$(this).parents(".menu").hide();
								} break;
								default: $(this).siblings("ul").toggle().parents("li").siblings().find(".menu").hide();
							}
						} break;
						case "create" : {
							$(this).siblings("ul").toggle().parents("li").siblings().find(".menu").hide();
						} break;
					}
				});
			}else if (target.attr("rel").search("create->") != -1) {
				target.each(function(){	
					var rel = $(this).attr("rel").split("->");
					switch (rel[1]){
						case "newImage" : {
							pixlr.overlay.show({target: site_url + '/manager/media/browser/mcpuk/handlers/save_image.php?path=' + realPath + "&pathType=" + type});
							$(this).parents(".menu").hide();
							
						} break;
						case "jsonCollection" : {
							var jsonCollection = "";
							var leng = $("input[name='JsonCollection']:checked").length;
							var checked = $("input[name='JsonCollection']:checked");
							if (leng == 0){
								popupMenu({
									title: lng.ERROR,
									main: '<p class="center">' + lng.NEW_JSON_COLLECTION_ERROR_2 + "</p>"
								});
								break;
							}
							for (var i = 0; i < leng; i++){
								if (i == leng - 1) jsonCollection += checked.eq(i).val();
								else jsonCollection += checked.eq(i).val() + "{!}";
							}
							popupMenu({
								id: "JsonCollection",
								sendOn: true,
								title: lng.NEW_JSON_COLLECTION_TITLE,
								main: '<p class="center"><input id="CollectionName" type="text"></p>',
								confrm: function(){
									var value = $.trim($("#CollectionName").val());
									if (value == ""){
										$("#JsonCollection").remove();
											popupMenu({
												title: lng.ERROR,
												main: '<p class="center">' + lng.NEW_JSON_COLLECTION_ERROR_1 + "</p>"
											});
									}else saveJsonCollection(value, jsonCollection);
								}
							});
							$(this).parents(".menu").hide();
							
						} break;
						case "newFolder" : {
							popupMenu({
								id: "NewFolder",
								sendOn: true,
								title: lng.NEW_CAT_TITLE,
								main: '<p class="center"><input id="CatName" type="text"></p>',
								confrm: function(){
									var value = $.trim($("#CatName").val());
									if (value == ""){
										$("#NewFolder").remove();
											popupMenu({
											title: lng.ERROR,
											main: '<p class="center">' + lng.NEW_CAT_ERROR + "</p>"
										});
									}else ajaxNoReturn(rel[0], "&pathType=" + type + "&path=" + realPath + "&name=" + value, lng.NEW_CAT_SUCCESS);
								}
							});
							$(this).parents(".menu").hide();
						} break;
					}
				});
			}else if (target.attr("rel") == "upload"){
				target.each(function(){
					var rel = $(this).attr("rel").split("->");
					$(".menu").hide();
					popupMenu({
						id: "Uploadify",
						title: lng.UPLOAD_TITLE,
						cancelVal: lng.CLOSE,
						main: '<p class="center"><input type="button" value="' + lng.UPLOAD + '" id="Uploader"><div id="fileQueue"></div></p>',
						cancel: function(){
							deleteTemp();
							getDir(realPath);
						}
					});
					
					$("#Uploader").uploadify({
						"uploader": "flash/uploadify.swf",
						"script": "handlers/uploadify.php",
						"cancelImg": "images/cancel.png",
						"width": "79",
						"height": "22",
						"buttonImg": "languages/" + language + "_upload.png",
						"queueID": "fileQueue",
						"auto": true,
						"multi": true,
						"onSelectOnce": function(){
							checkManager();
							$("#Uploader").uploadifySettings("scriptData", {"pathType": type, "file": managerControl, "path": realPath});
						},
						"onComplete": function(e, q, f, r){ if (r != 1) alert(r); },
						"onAllComplete": function(){ deleteTemp(); }
					}); 
				});
			}else if (target.attr("rel").search("show->") != -1){
				target.each(function(){
					var rel = $(this).attr("rel").split("->");
					switch (rel[1]){
						case "pref" : {
							$("#MainContent").hide();
							$("#WindowType").attr("rel", "show->manager").html(lng.MANAGER);
							$("#Pref").show();
						} break;
						case "manager" : {
							getDir(realPath);
							$("#Pref").hide();
							$("#WindowType").attr("rel", "show->pref").html(lng.PREF);
							$("#MainContent").show();
						} break;
					}
				});
			}
	});
	
	$(document).keyup(function(e){ setNull(combPress); });
});