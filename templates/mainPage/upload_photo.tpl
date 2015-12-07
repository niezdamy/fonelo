<!-- Modal -->
<div class="modal fade bs-example-modal-sm" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Zmień swoje zdjęcie profilowe.</h4>
      </div>
      <div class="modal-body">
      	<p class="text-justify">
        	Możesz tutaj zmienić swoje zdjęcie profilowe. Pamiętaj, aby jego pojemność nie przekraczała 256kb, a rozmiary najlepiej 600x300px.
        </p>
      </div>
      <div class="modal-footer">
      	<form enctype="multipart/form-data" action="{$conf->action_root}uploadPhoto" method="post">
        	<div class="col-sm-6">
            	<input type="hidden" name="MAX_FILE_SIZE" value="256000" />
            	<input name="plik" type="file" class="btn btn-default"/>
            </div>
            <div class="col-sm-6">
            	<button type="submit" class="btn btn-default">Dodaj zdjęcie</button>
            	<button type="button" class="btn btn-default" data-dismiss="modal">Anuluj</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>