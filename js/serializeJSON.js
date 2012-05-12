/**
 * jQuery script for serializing a form into JSON
 */
(function($){
	$.fn.serializeJSON = function(){
		var json = {};
		jQuery.map($("input", this).serializeArray(), function(n, i) {
		  json[n['name']] = n['value'];
		});
		return json;
	}

	$.fn.serializeOptionsJSON = function(){
		var json = {};
		var value = [];
		var label = [];
		jQuery.map($("input", this).serializeArray(), function(n, i) {
		  if(i%2 === 0) value.push(n['value'])
		  else label.push(n['value'])
		});
		for (var i=0; i < value.length; i++) json[value[i]] = label[i];
		return json;
	}
})(jQuery);