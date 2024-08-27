<?php
//Se a sessão não existir, então inicia a sessão
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

//se a variável de sessão mensagem possuir existir, então deve mostrar a mensagem na tela.
if(isset($_SESSION['mensagem'])): 
?>
	
 <script>
   //Mensagem de alerta javascript do materialize
	window.onload = function(){
		  M.toast({html: '<?php echo $_SESSION['mensagem']; ?>', classes: 'config_toast'});
		
		
	};
</script>

<style>
	.config_toast{
		background-color: #ADB895c2 !important;
		color: #d17587 !important;
		border: #d17587 solid 0.2rem !important;
		border-radius: 1rem !important;
		box-shadow: 1rem 1rem 0.4rem #00000077 !important;
		font-size: 2rem !important;
		padding: 2rem !important;
		font-weight: bold !important;
	}
</style>



<?php 	
endif;
unset($_SESSION['mensagem']);
?>