{if isset($contact_data)}
	{$lp=1}
    <table class="table" id="contact-table">
		<thead>
			<tr>
				<th>Lp</th>
				<th>Imię</th>
				<th>Nazwisko</th>
				<th>Telefon</th>
				<th>Miasto</th>
				<th>Ulica</th>
				<th>Kod pocztowy</th>
				<th>Edycja</th>
				<th>Usuń</th>
			</tr>
		</thead>
		<tbody>
		{foreach $contact_data as $wiersz}
			
			<tr>
				<td>{$lp}</td>
				<td id="name-{$wiersz['id_contact']}">{$wiersz['name']}</td>
				<td id="surname-{$wiersz['id_contact']}">{$wiersz['surname']}</td>
				<td id="telephone-{$wiersz['id_contact']}">{$wiersz['telephone']}</td>
				<td id="city-{$wiersz['id_contact']}">{$wiersz['city']}</td>
				<td id="street-{$wiersz['id_contact']}">{$wiersz['street']}</td>
				<td id="postcode-{$wiersz['id_contact']}">{$wiersz['postcode']}</td>
				<td><span class="to-edit-contact" data-id="{$wiersz['id_contact']}"><i class="fa fa-pencil-square-o"> Edytuj</i></span></td>
				<td>
					<form action="{$conf->action_root}delContact" method="post">
						<button type="submit" class="close" id="id_contact" name="id_contact" value="{$wiersz['id_contact']}"><span aria-hidden="true">&times;</span></button>
					</form>
				</td>
			</tr>

			{$lp = $lp+1}
		{/foreach}
		</tbody>

	</table>
{else}
	<div class="alert alert-warning" role="alert">Twoja książka kontaktów jest pusta.</div>
{/if}


