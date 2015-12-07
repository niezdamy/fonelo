<div>
    <h1>Zarejestruj się!</h1>
    <form id="register-form" class="form-horizontal" role="form" action="{$conf->action_root}zarejestruj" method="post">
        <div class="col-md-10">
            <p>Podaj wymagane dane</p>
            
            <div class="form-group">
                <div class="col-lg-12">
                    <input type="text"
                    class="form-control form-login" id="inputUsername" name="formUsername" placeholder="Login"
                    data-toggle="tooltip" data-placement="auto" title="Login musi zawierać od 3 do 15 znaków." data-trigger="focus"
                    >
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-12">
                    <input type="text" 
                    class="form-control form-login" id="inputEmail" name="formEmail" placeholder="Adres email" 
                    >
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-12">
                    <input type="password"
                    class="form-control form-login" id="inputPassword" name="formPassword" placeholder="Hasło"
                    data-toggle="tooltip" data-placement="auto" title="Hasło musi zawierać od 5 do 20 znaków." data-trigger="focus" 
                    >
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-12">
                    <input type="password"
                    class="form-control form-login" id="inputPassword2" name="formPassword2" placeholder="Potwierdź hasło"
                    >
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-lg-12">
                    <button type="button" id="registerSubmit" class="btn btn-primary" name="register" disabled="disabled">Zarejestruj</button>
                </div>
            </div>
        </div>
    </form>
</div>