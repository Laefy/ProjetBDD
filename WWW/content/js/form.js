function has_class(element, className)
{
	return !(element.className === element.className.replace(className, ''));
}

function remove_class(element, className)
{
	element.className = element.className.replace(className, '');
}

function blur_text_input(input, defaultValue)
{
	if (!input.value)
	{
		input.value = defaultValue;
		input.className += 'default';
	}
}

function focus_text_input(input)
{
	if (has_class(input, 'default'))
	{
		input.value = '';
		remove_class(input, 'default');
	}
}

function submit_form(form_name, num=0)
{
	var form = document.getElementsByName(form_name)[num];
	form.submit();
}