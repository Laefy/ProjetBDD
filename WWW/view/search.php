<div id="search_container">

	<section id="search">

		<form name="search" method="POST" action="index.php?to=research">

			<input type="hidden" name="search" value=true />

			<p>
				<input type="text" name="keyword" value="Rechercher..." class="default" onFocus="focus_text_input(this);" onBlur="blur_text_input(this, 'Rechercher...');" /><br/>
				parmis
				<select name="search_area">
					<option value="all" selected="selected">Tout</option>
					<option value="consult">Consultations</option>
					<option value="register">Registre Animalier</option>
					<option value="individual">Particuliers</option>
					<option value="professional">Professionnels</option>
				</select>
			</p>

			<p id="submit_search" onClick="submit_form('search')" title="Je m'appelle Tchong, et je suis un ornithorynque chinois."></p>

		</form>

	</section>

</div>