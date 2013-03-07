// DOM ready
$(function() {

// Create the dropdown base
$("<select />").appendTo("nav");

// Create default option "Go to..."
$("<option />", {
	"selected": "selected",
	"value"   : "",
	"text"    : "Go to..."
}).appendTo("nav select");

// Populate dropdown with menu items
$("nav a").each(function() {
 var el = $(this);
 $("<option />", {
	  "value"   : el.attr("href"),
	  "text"    : el.text()
 }).appendTo("nav select");
});

// To make dropdown actually work
// To make more unobtrusive: http://css-tricks.com/4064-unobtrusive-page-changer/
$("nav select").change(function() {
  window.location = $(this).find("option:selected").val();
});

});

jQuery(document).ready(function() {
	jQuery(".inlagg_texten img").each(function (i) {
		if (jQuery(this).width() > 400)
			jQuery(this).addClass('bild_maxad');
	});
});

function empty_search() {
	document.getElementById('s').value = "";
	document.getElementById('s').style.color = "#000";	
	document.getElementById('s').style.fontStyle = "normal";	
}

function empty_comment(obj) {
	obj.value = "";
	obj.style.color = "#000";	
	obj.style.fontStyle="normal";
}
