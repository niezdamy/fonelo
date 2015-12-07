{extends file=$conf->root_path|cat:"/templates/main.tpl"}


{block name=content}

	 <div>
        <h1>Witaj w Fonelo</h1>
        <p>Zaloguj się aby uzyskać dostęp do konta.</p>

        <form class="form-horizontal" action="{$conf->action_root}zaloguj" method="post">
            <div class="form-group">
                <div class="col-sm-8">
                    <input type="text" class="form-control form-login" id="loginUsername" name="inputUsername" placeholder="Login">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-8">
                    <input type="password" class="form-control form-login" id="loginPassword" name="inputPassword" placeholder="Hasło">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-8">
                    <button id="loginSubmit" type="button" class="btn btn-default">Zaloguj</button>
                </div>
            </div>
        </form>
        <!-- end form -->
        <p id="remind-pass" style="font-size:14px; color:#444; text-decoration:none; cursor:pointer;">Zapomniałeś hasła?</p>
        <p id="create-account" style="color:#444; text-decoration:none; cursor:pointer;">Nie masz jeszcze konta?</p>
        
                    
    </div>

{/block}