function create_close_icon()
{
	var aclose = document.createElement('a');
	aclose.className = 'icon close';

	aclose.onclick = function() {

		var container = this.parentNode;
		var column = container.parentNode;
		column.removeChild(container);
	};

	return aclose;
}

function create_delete_icon()
{
	var adelete = document.createElement('a');
	adelete.className = 'icon delete';

	adelete.onclick = function() {

		var container = this.parentNode;
		var column = container.parentNode;
		column.removeChild(container);
	};

	return adelete;
}

function create_valid_icon(clickFnc, params)
{
	var valid = document.createElement('a');
	valid.className = 'icon save';
	valid.onclick = function() {
		clickFnc(params);
	};

	return valid;
}



function get_label(name)
{
	switch (name)
	{
		case 'id':
			return 'Identifiant';

		case 'nom':
		case 'nomPart':
		case 'nomEnt':
			return 'Nom';

		case 'prenom':
			return 'Prénom';

		case 'type':
			return 'Type';

		case 'date':
			return 'Date';

		case 'heure':
			return 'Heure';

		case 'lieu':
			return 'Lieu';

		case 'duree':
			return 'Durée';

		case 'soins':
			return 'Soins prodigués';

		case 'pds':
		case 'poids':
			return 'Poids';

		case 'espece':
			return 'Espèce';

		case 'taille':
			return 'Taille';

		case 'client':
			return 'Client';

		case 'prop':
		case 'typeProp':
			return 'Propriétaire';

		case 'race':
			return 'Race';

		case 'genre':
			return 'Genre';

		case 'sterile':
			return 'Stérilisé';

		case 'tatou':
		case 'tatouage':
			return 'Tatouage n°';

		case 'puce':
			return 'Puce n°';

		case 'adresse':
			return 'Adresse';

		case 'ville':
		case 'localite':
			return 'Ville';

		case 'tel':
			return 'Téléphone';

		default:
			return '?';
	}
}

function set_input_size(input)
{
	var div = input.parentNode;
	var name = input.parentNode.getElementsByTagName('span')[0];

	var wDiv = div.offsetWidth;
	var wName = name.offsetWidth;

	var marginRight = input.tagName === 'SELECT' ? 43 : 60;

	var width = wDiv - wName - marginRight;

	input.style.width = width + 'px';
}

function create_detailed_frame(element, array)
{
	var title = document.createElement('h5');
	var text = document.createTextNode(array['section'] + ' n° ' + array['id']);
	title.appendChild(text);
	element.appendChild(title);

	element.appendChild(create_close_icon());

	var form = document.createElement('form');
	element.appendChild(form);

	var rows = array['rows'];

	for (var key in rows)
	{
		form.appendChild(rows[key]);
		set_input_size(rows[key].getElementsByTagName('span')[1]);
	}

	element.appendChild(create_delete_icon());
}

function create_hidden_input(key, value, type)
{
	var input = document.createElement('input');
	input.name = 'datas';
	input.value = value + '~~' + type + '~~' + key;
	input.type = 'hidden';

	return input;
}

function create_input(key, type, value)
{
	value = value || '';

	if (type === 'text')
	{
		var input = document.createElement('input');
		input.name = key;
		input.type = type;
		input.value = value;

		return input;
	}

	else
	{
		var input = document.createElement('select');
		input.name = key;

		return select;
	}
}

function save_in_db()
{
	var div = this.parentNode;

	var datas = div.getElementsByTagName('input')[0];
	var str = datas.value.split('~~');

	var input = str[1] === 'text' ? div.getElementsByTagName('input')[1] : div.getElementsByTagName('select')[0];
	var value = input.value;
	div.removeChild(input);

	datas.value = value + '~~' + str[1] + '~~' + str[0];

	var span = document.createElement('span');
	span.appendChild(document.createTextNode(value));
	div.insertBefore(span, this);

	this.className = 'icon edit';
	this.onclick = edit_db;
}

function edit_db()
{
	var div = this.parentNode;
	var span = div.getElementsByTagName('span')[1];
	div.removeChild(span);

	var datas = div.getElementsByTagName('input')[0];

	var str = datas.value.split('~~');
	var input = create_input(str[2], str[1], str[0]);

	div.insertBefore(input, this);
	set_input_size(input);

	this.className = 'icon save';
	this.onclick = save_in_db;
}

function get_edit_icon()
{
	var aedit = document.createElement('a');
	aedit.className = 'icon edit';
	aedit.onclick = edit_db;

	return aedit;

}

function create_array_from_response(response)
{
	var array = new Object();
	var respArray1 = response.split('~~');

	array['section'] = respArray1[0];
	array['id'] = respArray1[1];

	var respArray2 = respArray1[2].split('~#');
	var nbRows = respArray2.length;

	array['rows'] = new Object();

	for (var i = 0; i < nbRows; i ++)
	{
		var respArray3 = respArray2[i].split('~/');
		var key = respArray3[0];
		var type = respArray3[1];
		var value = respArray3[2];
		var values = value.split('~t');

		if (values[0] === value)
		{
			var div = document.createElement('div');
			var name = document.createElement('span');
			name.appendChild(document.createTextNode(get_label(key) + ' : '));
			div.appendChild(name);

			div.appendChild(create_hidden_input(key, value, type));

			var span = document.createElement('span');
			span.appendChild(document.createTextNode(value));
			div.appendChild(span);

			div.appendChild(get_edit_icon());

			array['rows'][key] = div;
		}

		else
		{
			var div = document.createElement('div');
			div.appendChild(document.createTextNode(get_label(key) + ' : '));

			for (var j = 0; j < values.length; j ++)
			{
				div.appendChild(document.createElement('br'));
				var pre = document.createElement('pre');
				pre.appendChild(document.createTextNode('  '));
				div.appendChild(pre);
				div.appendChild(create_hidden_input(key, values[j], type));

				var span = document.createElement('span');
				span.appendChild(document.createTextNode(values[j]));
				div.appendChild(span);

				div.appendChild(get_edit_icon());
			}

			array['rows'][key] = div;			
		}
	}

	return array;
}

function open_detailed_frame(section, type, id)
{
	var params = 'section=' + section + (type ? '&type=' + type : '') + '&id=' + id;

	var callback = function(response) {

		var array = create_array_from_response(response);

		if (array !== 'null')
		{
			var position = document.getElementById('leftcolumn');

			var frame = document.createElement('section');
			frame.className += ' details';
			position.appendChild(frame);

			create_detailed_frame(frame, array);
		}
	}

	ajax_request('js/ajax/details.php', params, callback);
}