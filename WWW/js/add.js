function get_stringParams_from_form(form)
{
	var divs = form.getElementsByTagName('div');
	var string = '~&';

	for (var i = 0; i < divs.length; i ++)
	{
		var inputs = divs[i].getElementsByTagName('input');
		var select = divs[i].getElementsByTagName('select');

		var hiddenDatas = inputs[0].value;

		if (inputs[1])
		{
			if (inputs[1].type === 'text')
			{
				string += ('~~' + inputs[1].name + '~#' + inputs[1].value);
			}

			else if (inputs[1].type === 'radio')
			{
				for (var j = 1; j < inputs.length; j ++)
				{
					if (inputs[j].checked)
					{
						string += ('~~' + inputs[j].name + '~#' + inputs[j].value);
						break;
					}
				}
			}
		}

		else if (select[0] != null)
		{
			string += ('~~' + select[0].name + '~#' + select[0].options[select[0].selectedIndex].value);
		}
	}

	return string.replace('~&~~', '');
}


function send_form_to_db(form, section)
{
	var params = 'section=' + section + '&rows=' + get_stringParams_from_form(form);

	var callback = function(response) {

		var container = form.parentNode;
		var column = container.parentNode;
		column.removeChild(container);
	};

	ajax_request('js/ajax/add.php', params, callback);
}