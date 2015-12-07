<div class="modal fade" id="addWorkout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Dodaj nowy trening:</h4>
      </div>
      
      
      <form class="form-horizontal" data-toggle="validator" role="form" action="{$conf->action_root}addWorkout" method="post">  
        <div class="modal-body">
        
          <h4> Data </h4>
          <div class="form-group">
            <div class="col-sm-12">
              <input type="text" class="form-control form-login" id="inputDate" name="formDate" placeholder="dd-mm-yy">
            </div>
          </div>
          
          <h4> Czas trwania </h4>
          <div class="form-group">
            <div class="col-sm-12">
              <input type="text" class="form-control form-login" id="inputDuration" name="formDuration" placeholder="hh:mm:ss">
            </div>
          </div>

          <h4> Średni puls <small>(optional)</small></h4>
          <div class="form-group">
            <div class="col-sm-12">
              <input type="text" class="form-control form-login" id="inputHR" name="formHR" placeholder="BPM">
            </div>
          </div>

          <h4> Spalone kalorie <small>(optional)</small></h4>
          <div class="form-group">
            <div class="col-sm-12">
              <input type="text" class="form-control form-login" id="inputCallories" name="formCallories" placeholder="kcal">
            </div>
          </div>

          <h4> Rozmiar bica <small>(optional)</small></h4>
          <div class="form-group">
            <div class="col-sm-12">
              <input type="text" class="form-control form-login" id="inputSize" name="formSize" placeholder="cm">
            </div>
          </div>

          <h4> Waga <small>(optional)</small></h4>
          <div class="form-group">
            <div class="col-sm-12">
              <input type="text" class="form-control form-login" id="inputWeight" name="formWeight" placeholder="kg">
            </div>
          </div>

          <h4>Opis treningu <small>(optional)</small></h4>
          <div class="form-group">
            <div class="col-sm-12">
              <textarea class="form-control form-login" rows="4" id="inputDescriptiom" name="formDescription"></textarea>
            </div>
          </div>
          
          </div>
      
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
            <button type="submit" class="btn btn-primary" name="send">Zapisz trening</button>
          </div>

      </form>
      
    </div>
  </div>
</div>