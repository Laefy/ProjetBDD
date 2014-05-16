function check_date_format(string)
{
	var str = string.split('/');
	var day = str[0];
	var month = str[1];
	var year = str[2];

	if (str.length !== 3)
		return false;

	if (day.length !== 2 || month.length !== 2 || year.length !== 4)
		return false;

	if (parseInt(day, 10) === 'NaN' || parseInt(month, 10) === 'NaN' || parseInt(year, 10) === 'NaN')
		return false;

	if (month < 1 || month > 12)
		return false;

	if (year < 1999 || year > 3000)
		return false;

	if (day < 1)
		return false;

	if (((month <= 7 && month % 2 === 1) || (month >= 8 && month % 2 === 0)) && day > 31)
		return false;

	if (((month <= 7 && month % 2 === 0) || (month >= 8 && month % 2 === 1)) && day > 30)
		return false;

	if (month === 2 && day > 28)
		if ((year % 400 === 0 || (year % 4 === 0 && year % 100 === 1)) && day !== 29)
			return false;

	return true;
}

function check_heure_format(string)
{
	var str = string.split(':');
	var hour = str[0];
	var min = str[1];

	if (str.length !== 2)
		return false;


	if (hour.length !== 2 || min.length !== 2)
		return false;


	if (parseInt(hour, 10) === 'NaN' || parseInt(min, 10) === 'NaN')
		return false;


	if (hour < 0 || hour > 23)
		return false;


	if (min < 0 || min > 59)
		return false;


	return true;
}

function check_no_forbidden_char(string)
{
	if (string.replace('~', '') !== string)
		return false;

	return true;
}

function check_string_length(string, format)
{
	var bornes = format.split('-');

	if (bornes[0] === '0' || string === 'NR')
		return true;

	else if (bornes.length === 1)
		return (string.length === bornes[0] ? true : false);
	
	else
		return (string.length >= bornes[0] && string.length <= bornes[1] ? true : false);
}


function check_int_format(string, format)
{
	if (!check_string_length(string, format))
		return false;

	var num = parseInt(string, 10);

	if (num === 'NaN' && string !== '')
		return false;

	return true;
}

function check_float_format(string, format)
{
	var str = string.split(',');
	var fmt = format.split('.');

	if (!check_string_length(str[0], '1-' + fmt[0]))
		return false;

	if (!check_string_length(str[1], '0-' + fmt[1]))
		return false;

	var n1 = parseInt(str[0], 10);
	var n2 = parseInt(str[1], 10);

	if ((n1 === 'NaN' || n2 === 'NaN') && string != '')
		return false;

	if (n1 === 0 && n2 === 0)
		return false;

	return true;
}

function check_text_type(format, string)
{
	var str = format.split('/');
	
	if (str.length !== 1)
	{
		var valid = false;
		for (var i = 0; i < str.length && valid === false; i ++)
			valid = check_text_type(str[i], string) ? true : false;
		
		return valid;
	}

	if (format === 'date')
	{
		return check_date_format(string);
	}

	if (format === 'heure')
	{
		return check_heure_format(string);
	}

	if (!check_no_forbidden_char(string))
	{
		return false;
	}

	var str = format.split(':');

	if (str.length !== 1)
	{
		if (str[0] === 'd')
		{
			return check_int_format(string, str[1]);
		}
		
		else if (str[0] === 'f')
		{
			return check_float_format(string, str[1]);
		}
	}

	return check_string_length(string, format);
}

function check_insertion_text(input, hiddenDatas)
{
	var format = hiddenDatas.split('~/');

	if (!check_text_type(format[0], input))
		return false;

	for (var i = 1; i < format.length; i ++)
	{
		if (input === format[i])
		{
			return false;
		}
	}

	return true;
}

function check_insertion_select(select, hiddenDatas)
{
	return true;
}

function check_insertion_radio(input, hiddenDatas)
{
	return true;
}

function check_insertion(form)
{
	var divs = form.getElementsByTagName('div');

	for (var i = 0; i < divs.length; i ++)
	{
		var inputs = divs[i].getElementsByTagName('input');
		var select = divs[i].getElementsByTagName('select');

		var hiddenDatas = inputs[0].value;
		
		if (hiddenDatas.split('~~')[0] === 'input')
		{
			if (inputs[1].type === 'text')
			{
				if (!check_insertion_text(inputs[1].value, hiddenDatas.split('~~')[1]))
					return false;
			}

			else if (inputs[1].type === 'radio')
			{
				for (var j = 1; j < inputs.length; j ++)
				{
					if (!check_insertion_radio(inputs[j].value, hiddenDatas.split('~~')[1]))
						return false;
				}
			}
		}

		else if (hiddenDatas.split('~~')[0] === 'select')
		{
			if (!check_insertion_select(select[0].options[select[0].selectedIndex].value, hiddenDatas.split('~~')[1]))
				return false;
		}
	}

	return true;
}