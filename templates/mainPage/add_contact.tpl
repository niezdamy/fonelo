<div class="modal fade" id="addContact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Dodaj nowy kontakt:</h4>
            </div>

            <form class="form-horizontal" data-toggle="validator" role="form" action="{$conf->action_root}addContact" method="post"> 

                <div class="modal-body">

                    <h4>Imię</h4>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" class="form-control form-name val-input-text" id="inputName" name="inputName">
                        </div>
                    </div>

                    <h4>Nazwisko</h4>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" class="form-control form-surname val-input-text" id="inputSurname" name="inputSurname">
                        </div>
                    </div>

                    <h4>Numer telefonu</h4>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" class="form-control form-telephone val-input-phone" id="inputTelephone" name="inputTelephone">
                        </div>
                    </div>

                    <h4>Adres</h4>
                    <div class="form-group">
                        <div class="col-sm-5">
                            <input type="text" class="form-control form-street val-input-text" id="inputStreet" name="inputStreet" placeholder="Ulica">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-city val-input-city" id="inputCity" name="inputCity" placeholder="Miasto">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control form-postcode val-input-postcode" id="inputPostcode" name="inputPostcode" placeholder="Kod pocztowy">
                        </div>
                    </div>

                    <h4>Grupa</h4>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <select class="form-control" id="inputGroup" name="inputGroup">
                            {foreach $groups as $wiersz}
                                <option>{$wiersz}</option>
                            {/foreach}
                                <option id="add-new-group" value="addNew">Dodaj nową...</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control form-group val-input-text" id="inputNewGroup" name="inputNewGroup" placeholder="Nazwa grupy" style="display:none; margin:0;">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
                    <button type="submit" class="btn btn-primary" name="send" id="save-contact" disabled="true">Zapisz kontakt</button>
                </div>
            </form>

        </div>
    </div>
</div>