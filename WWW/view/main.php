<section id="mainframe">

	<?php

		$section = $page->get_section();

		print('<h1>'.$page->get_title());

		if ($section == 'consult' || $section == 'directory' || $section == 'register')
		{
			print('<a id="add" onClick="open_insert_frame(\''.$section.'\');"></a>');
		}

		print('</h1>');

		include('view/'.$section.'.php');
	?>	

</section>