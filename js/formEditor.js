/**
 * jQuery script for adding new content from template field
 *
 * NOTE!
 * This script depends on jquery.format.js
 *
 * IMPORTANT!
 * Do not change anything except specific commands!
 */
jQuery(document).ready(function(){
	$('#AddSectionButton').click(function(){
		$('#newSectionForm').slideToggle(250)
	});

	$('#newSectionForm').submit(function(){
		addSection($('input',this).val());
		return false;
	});
	jQuery('.ui-sortable').sortable({
		'placeholder':'fieldsList-placeholder',
		'connectWith':'.connectedSortable',
		'revert':true});
});

function addSection(label){
	var div_id = 'tab-pane-'+label;
	
	$('#formEditor div.tab-content').append($('<div></div>')
		.attr('id',div_id)
		.addClass('tab-pane')
		.append(
			$('<div></div>')
			.append("Some Text!")
			,$('<ul></ul>')
			.addClass('connectedSortable')
			.attr('id',div_id)
			.sortable({
				'placeholder':'fieldsList-placeholder',
				'connectWith':'.connectedSortable',
				'revert':true})
		));
	$('#formEditor ul.nav-tabs').append($('<li></li>')
		.append($('<a></a>')
			.attr('href','#'+div_id)
			.attr('data-toggle','tab')
			.append(label)
		));
	var count = $('#formEditor div.tab-content').children().length;
	if (count == 1){
		$('#formEditor div.tab-content').children().addClass('active');
	}
	$('#formEditor a[href="#'+div_id+'"]').tab('show');
	$('#newSectionForm').slideToggle(250);
}