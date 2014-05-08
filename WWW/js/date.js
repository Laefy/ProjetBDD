function get_real_month(month)
{
	switch (month)
	{
		case '1':
			return 'JAN';

		case '2':
			return 'FEV';

		case '3':
			return 'MARS';

		case '4':
			return 'AVR';

		case '5':
			return 'MAI';
			
		case '6':
			return 'JUIN';
			
		case '7':
			return 'JUIL';
			
		case '8':
			return 'AOUT';
			
		case '9':
			return 'SEPT';
			
		case '10':
			return 'OCT';
			
		case '11':
			return 'NOV';
			
		case '12':
			return 'DEC';
	}
}

function set_calendar()
{
	var now = new Date();
	var year, month, day, time;

	/* Récupération de la date actuelle */
	year = now.getFullYear().toString();
	month = (now.getMonth() + 1).toString();
	day = now.getDate().toString();
	time = now.toLocaleTimeString();

	/* Ajout du calendrier */
	document.getElementById('identity_calendar').innerHTML = day + '<br/>' + get_real_month(month);

	/* Conversion au format standard */
	if (month.length < 2)
	{
		month = '0' + month;
	}

	if (day.length < 2)
	{
		day = '0' + day;
	}

	/* Création des paramètres pour l'appel à AJAX */
	var params = 'year=' + year + '&month=' + month + '&day=' + day + '&time=' + time;

	/* Fonction de callback */
	var callback = function(response)
	{
		var rdv = document.getElementById('identity_rdv');

		/* Si pas de rendez-vous */
		if (response === 'false')
		{
			rdv.innerHTML = 'Vous n\'avez aucun rendez-vous pr&eacute;vu aujourd\'hui.';
		}

		/* Sinon, on indique l'heure */
		else
		{
			rdv.innerHTML = 'Votre prochain rendez-vous est pr&eacute;vu &agrave; ' + response + '.';
		}
		
	}

	ajax_request('js/ajax/date.php', params, callback);
}
