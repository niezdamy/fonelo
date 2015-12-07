<section id="cd-timeline" class="cd-container cd-container-font">

  {$resID = $user_data['total_trainings']}
  {$resID1 = $resID}

  {foreach $workout_data as $wiersz}
                          
      <div class="cd-timeline-block">
        <div class="cd-timeline-img cd-picture">
          <img src="{$conf->app_root}/images/cd-icon-workout2.svg" alt="Picture" />
        </div>
        <div class="cd-timeline-content">
          <form action="{$conf->action_root}delWorkout" method="post">
          	<button type="submit" class="close" name="id_training" value="{$wiersz['id_training']}"><span aria-hidden="true">&times;</span></button>
          </form>
          <h2>Trening {$resID} {if $resID==$resID1} <span class="label label-primary">Nowy</span>{/if}</h2>
          <p class="text-justify">
          	{$wiersz['description']}
          </p>
            <table class="table">
                <tr>
                    <td><i class="fa fa-clock-o" style="margin-right:10px;"></i>Czas trwania:</td>
                    <td>{$wiersz['duration']}</td>
                </tr>
                <tr>
                    <td><i class="fa fa-heartbeat" style="margin-right:10px;"></i>Średni puls:</td>
                    <td>{$wiersz['hr']}</td>
                </tr>
                <tr>
                    <td><i class="fa fa-cutlery" style="margin-right:10px;"></i> Spalone kalorie:</td>
                    <td>{$wiersz['callories']}</td>
                </tr>
            </table> 
          <span class="cd-date">{$wiersz['date']}</span>
        </div>
      </div>
      {$resID = $resID - 1}

  {/foreach}
  

  
</section>