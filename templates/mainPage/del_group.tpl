<!-- Modal -->
<div class="modal fade bs-example-modal-sm" id="delGroupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Wybierz grupę do usunięcia</h4>
                {if isset($groups)}
                    {foreach $groups as $wiersz}
                        <button type="button" class="btn btn-default del-unique-group" data-group="{$wiersz}">{$wiersz}</button>
                    {/foreach}
                {/if}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Nie</button>
                <button type="button" class="btn btn-primary">Tak</button>
            </div>
        </div>
    </div>
</div>