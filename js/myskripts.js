$(document).ready(function(){$('#speedzakaz').hide();$('#voprozad').hide();$('#voprozad2').hide();$('#speedclick').toggle(function(){$('#speedzakaz').slideDown(1000);},function(){$('#speedzakaz').slideUp(2000);});$('#voprozadclick').toggle(function(){$('#voprozad').slideDown(1000);},function(){$('#voprozad').slideUp(2000);});$('#izmc').toggle(function(){$('#voprozad2').slideDown(100);},function(){$('#voprozad2').slideUp(2000);});$('.imageitems img').attr('height',120).attr('width',160);$('.levlcat img').attr('height',100).attr('width',140);$('#small img').attr('height',90).attr('width',110);$('.look img').attr('height',120).attr('width',160);$('.opis_punct:even').addClass('bs');});