{extends file=$conf->root_path|cat:"/templates/main.tpl"}


{block name=content}

	<div>
        <h1>Przypomnij hasło:</h1>
        <form id="remind-form" class="form-horizontal" role="form" action="{$conf->action_root}przypomnij" method="post">
            <div class="col-md-10">
                <p>Podaj zarejestrowany adres email!</p>
                
                <div class="form-group">
                    <div class="col-lg-12">
                        <input type="text" class="form-control form-login" id="inputRemindEmail" name="formEmail" placeholder="Adres email" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <button type="button" id="remindSubmit" class="btn btn-primary" name="remind" disabled="disabled">Wygeneruj hasło</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

{/block}