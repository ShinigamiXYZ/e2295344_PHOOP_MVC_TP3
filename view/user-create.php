{{ include('header.php', {title: 'cree un compte'})}}
    <main>
        <div class='wrapperCentered'>
            <h2>Créer votre compte</h2>
            <div>
            <p class="error">{{ errors|raw }}</p>
            </div>
            <form action="{{ path }}user/store" method="post" class='formulaire-client'>
                <label>Nom
                    <input type="text" name="nom" value='{{ user.nom }}'>
                </label>
                <label>Adresse
                    <input type="text" name="adresse" value='{{ user.adresse }}'>
                </label>
                <label>Mot de Passe
                    <input type="text" name="password">
                </label>
                <label>email
                    <input type="email" name="email" value='{{ user.email }}'>
                </label>
                
                <div>
                    <label for="membership_id">Type d'abonnement </label>
                    <select name="membership_id" id="membership_id">
                        <option value="1">Gold</option>
                        <option value="2">Silver</option>
                        <option value="3">Bronze</option>
                    </select>
                </div>

                <div>
                    <label for="user_type_id">Role</label>
                    <select name="user_type_id" id="user_type_id">
                        <option value="2">client</option>
                        <option value="3">entraineur</option>
                    </select>
                </div>

                <div><input type="submit" value="Save"> </div>

            </form>

            <div class='link'>
                <a class='compteLink' href="{{ path }}user/login">Vous avez déja compte?</a>
            </div>
        </div>
    </main>
</body>

</html>