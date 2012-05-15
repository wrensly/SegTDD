function addTag()
{
	document.getElementById('tag').value += document.getElementById('add').value;
	document.getElementById('add').value = '';

	if(document.getElementById('tag').value != '')
		document.getElementById('tag').value += ',';
}