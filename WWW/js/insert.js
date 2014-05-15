function create_insert_text_input(element, label, format, forbidden = '')
{
	var hidden = document.createElement('input');
	hidden.type = 'hidden';
	hidden.value = format + (forbidden !== '' ? '~/' + forbidden : '');
	element.appendChild(hidden);

	var input = document.createElement('input');
	input.type = 'text';
	input.name = label;
	input.value = '';
	element.appendChild(input);
}

function create_insert_select(element, label, optStr, dyn = 'static')
{
	var hidden = document.createElement('input');
	hidden.type = 'hidden';
	hidden.value = dyn;
	element.appendChild(hidden);

	var select = document.createElement('select');
	select.name = label;

	var optArray = optStr.split('~]');

	if (dyn === 'dyn')
	{
		for (var i = 0; i < optArray.length; i ++)
		{
			var datas = optArray[i].split('~&');
			var opt = document.createElement('option');
			opt.value = datas[0];
			opt.appendChild(document.createTextNode(datas[1]));
			select.appendChild(opt);
		}
	}

	else
	{
		for (var i = 0; i < optArray.length; i ++)
		{
			var opt = document.createElement('option');
			opt.value = optArray[i];
			opt.appendChild(document.createTextNode(optArray[i]));
			select.appendChild(opt);
		}
	}

	element.appendChild(select);
}

function create_insert_radio(element, label, values)
{
	var hidden = document.createElement('input');
	hidden.type = 'hidden';
	element.appendChild(hidden);
	element.appendChild(document.createElement('br'));

	var valArray = values.split('~]');
	for (var i = 0; i < valArray.length; i ++)
	{
		var datas = valArray[i].split('~&');

		var radio = document.createElement('input');
		radio.type = 'radio';
		radio.name = label;
		radio.value = datas[0];
		element.appendChild(radio);
		element.appendChild(document.createTextNode(datas[0]));
		element.appendChild(document.createElement('br'));

		hidden.value = (i === 0 ? '' : '~~') + valArray[i];
	}	

	element.style.height = (28 + valArray.length * 18) + 'px';
}

function create_insert_list(element, label)
{
	var hidden = document.createElement('input');
	hidden.type = 'hidden';
	hidden.value = label;
	element.appendChild(hidden);
}


function set_insert_input_size(input, type)
{
	var div = input.parentNode;
	var x = input.offsetLeft;
	var w = (type == 'text' ? 340 : 354) - x;
	input.style.width = w + 'px';
}


function save_insert()
{
	var container = this.parentNode;
	var form = container.getElementsByTagName('form')[0];

	var section = form.name;

	alert('faire sauvegarde');
}


function create_insert_frame(element, array, section)
{
	var title = document.createElement('h5');
	var text = document.createTextNode('* ' + array['title'] + ' *');
	title.appendChild(text);
	element.appendChild(title);

	element.appendChild(create_close_icon());

	var form = document.createElement('form');
	form.name = section;
	element.appendChild(form);

	var rows = array['rows'];

	for (var key in rows)
	{
		form.appendChild(rows[key]);

		var inputs = rows[key].getElementsByTagName('input');
		for (var i = 0; i < inputs.length; i ++)
		{
			if (inputs[i].type === 'text')
				set_insert_input_size(inputs[i], 'text');
		}

		var selects = rows[key].getElementsByTagName('select');
		for (var i = 0; i < selects.length; i ++)
		{
			set_insert_input_size(selects[i], 'select');
		}
	}

	element.appendChild(create_valid_icon(save_insert));
}

function create_insert_array_from_response(response)
{
	var array = new Object();
	
	var respArray1 = response.split('~~');						/* 0 => title, 1 => lignes */
	array['title'] = respArray1[0];

	var respArray2 = respArray1[1].split('~#');					/* sépare chaque ligne */
	var nbRows = respArray2.length;

	array['rows'] = new Object();

	for (var i = 0; i < nbRows; i ++)
	{
		var respArray3 = respArray2[i].split('~/');				/* 0 => label, 1 => type, 2, 3, ... => argType */

		var label = respArray3[0];
		var type = respArray3[1];

		var div = document.createElement('div');
		div.appendChild(document.createTextNode(get_label(label) + ' : '));

		switch (type)
		{
			case 'text':
				create_insert_text_input(div, label, respArray3[2], respArray3[3]);
				break;

			case 'select':
				create_insert_select(div, label, respArray3[2], respArray3[3]);
				break;

			case 'radio':
				create_insert_radio(div, label, respArray3[2]);
				break;

			case 'default':
				create_insert_list(div, label);
				break;
		}

		array['rows'][i] = div;
	}

	return array;
}

function open_insert_frame(section)
{
	var params = 'section=' + section;

	var callback = function(response) {
	alert(response);
		var array = create_insert_array_from_response(response);

		if (array !== 'null')
		{
			var position = document.getElementById('leftcolumn');

			var frame = document.createElement('section');
			frame.className += ' details insert';
			position.appendChild(frame);

			create_insert_frame(frame, array, section);
		}
	};

	ajax_request('js/ajax/insert.php', params, callback);
}