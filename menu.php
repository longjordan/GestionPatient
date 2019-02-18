        <?php if(session_status() === PHP_SESSION_NONE){
    			session_start();
		}; ?>
        <div class="navbar">
            <a href="accueil.php" class="nav">Accueil</a>
            <a href="ajoutPatient.php" class="nav">Ajout de patient</a>
            <a style="float: right" href="index.php" class="nav">Déconnexion</a>
            <?php
            if($_SESSION['droit'] == 1){ ?>
            <a style="float: right" href="inscription.php" class="nav">Inscrire utilisateur</a>
            <?php
        	}?>
        	<a style="float: right" id="nomUser"><?php echo $_SESSION['login']?></a>
            
        </div>