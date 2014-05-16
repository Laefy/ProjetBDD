function create_table(element, array)
{
	var table = document.createElement('table');
	var title = array[0];
	var columns = array[1];
	var rows = array[2];
	var nbcolums = columns.length;
	var nbrows = rows.length;

	/* Création du titre si nécessaire */
	if (title)
	{
		var caption = document.createElement('caption');
		var name = document.createTextNode(title);

		caption.appendChild(name);
		table.appendChild(caption);
	}

	/* Création de l'entête */
	var thead = document.createElement('thead');
	var tr = document.createElement('tr');

	for (var key = 0; key < nbcolums; key ++)
	{
		var th = document.createElement('th');
		var column = document.createTextNode(columns[key]);

		th.appendChild(column);
		tr.appendChild(th);
	}

	thead.appendChild(tr);
	table.appendChild(thead);

	/* Création du corps du tableau */
	var tbody = document.createElement('tbody');

	for (var keyR = 0; keyR < nbrows; keyR ++)
	{
		var tr = document.createElement('tr');

		for (var keyC = 0; keyC < nbcolums; keyC ++)
		{
			var td = document.createElement('td');
			var cell = document.createTextNode(rows[keyR][keyC]);

			td.appendChild(cell);
			tr.appendChild(td);
		}

		tbody.appendChild(tr);
	}

	table.appendChild(tbody);
	element.appendChild(table);
}

function create_array_from_respString(response)
{
	var array = [];
	var respArray = response.split('~/');

	var title = respArray[0];
	var columns = respArray[1].split('~*');
	var rowsArray = respArray[2].split('~|');
	var rows = [];

	for (var key = 0; key < rowsArray.length; key ++)
	{
		rows.push(rowsArray[key].split('~*'));
	}

	array.push(title);
	array.push(columns);
	array.push(rows);

	return array;
}

function get_datas_in_table(section, type, page)
{
	type = type || '';
	page = page || 1;

	var params = 'section=' + section + '&type=' + type + '&page=' + page;

	var callback = function(response) {
		
		var respArray = response.split('~~');

		if (respArray[0] !== 'null')
		{
			var array = create_array_from_respString(respArray[1]);
			var frame = document.getElementById('mainframe');

			create_table(frame, array);
		}

		else
		{
			var mainframe = document.getElementById('mainframe');
			var par = document.createElement('p');
			var text = document.createTextNode(respArray[1]);

			par.appendChild(text);
			mainframe.appendChild(par);
		}
	}

	ajax_request('js/ajax/table.php', params, callback, false);
}

function associate_detailed_frame_link(table, section, type)
{
	type = type || '';

	if (table)
	{
		var rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
		var nbrows = rows.length;

		for (var i = 0; i < nbrows; i ++)
		{
			rows[i].onclick = function() {

				var id = this.getElementsByTagName('td')[0].innerHTML;
				open_detailed_frame(section, type, id); 
			};
		}
	}
}



