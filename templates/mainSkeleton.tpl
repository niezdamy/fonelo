{include file=$conf->root_path|cat:"/templates/head.tpl"}

<body>

  {$usr_data = $user_data} <!-- DANE O USERZE -->

  <!-- W każdym contencie jest nawigacja, ponieważ dla ilku stron musiała być inna klasa-->

  {block name=content} Błąd przy wczytywaniu szablonu tpl. {/block}

  {block name=modals} Błąd przy wczytywaniu modali. {/block}

  {include file=$conf->root_path|cat:"/templates/messages.tpl"}

  <footer>
    <div class="inner">
      
    </div>
  </footer>
  
  <!-- WYŚWIETLANIE BŁĘDÓW -->  
  {if $msgs->isError()||$msgs->isInfo()}
      {literal}
		  <script>
          	$('#myModal').modal('show');
          </script> 
      {/literal}
  {/if}
  
</body>

</html>
