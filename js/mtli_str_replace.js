jQuery(document).ready(function($) {
	content = jQuery('#content').html();
	replace_content = 0;
	for(mime_type in mtli_js_array){
		string_match = new RegExp('href="([^"]+\.'+mtli_js_array[mime_type]+')"','gi');
		if(content.match(string_match)){
			content = content.replace(string_match,'href="\1"  class="mtli_attachment mtli_'+mtli_js_array[mime_type]+'"');
			replace_content=1;
		}
	}
	if(replace_content==1){
		jQuery('#content').html(content);
	}
});