{{ include('header.php', {title: 'login'})}}
   
    <main>
        
        <div class='wrapperCentered'>
            <h2>Connectez-vous a votre compte</h2>
            
            <form action="{{ path }}user/auth" method="post" class='formulaire-client loggin'>
                
                <label>Entrez votre courriel
                    <input type="email" name="email" value="{{ user.email }}">
                </label>
                <div class="erreur_utilisateur">{{ errors|raw }}</div>
                <label>Entrez votre mot de passe
                    <input type="password" name="password">
                </label>
                <div><input type="submit" value="Connecter"></div>
            </form>
            <div class='link'>
                <a class='compteLink' href="{{ path }}user/create">Vous n'avez pas de compte?</a>
            </div>
        </div>
    </main>
</body>
</html>