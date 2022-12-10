{{ include('header.php', {title: 'editer utilisateurs'})}}
        <div class='wrapperCentered'>
            <h2>Modifier votre compte</h2>
            <form action="{{ path }}user/update" method="post" class='formulaire-client noBorder'>
                <input type="hidden" name="id" value="{{ user.id }}">
                <label>Nom
                    <input type="text" name="nom" value="{{ user.nom}}">
                </label>
                <label>Adresse
                    <input type="text" name="adresse" value="{{ user.adresse}}">
                </label>
                <label>Courriel
                    <input type="email" name="email" value="{{ user.email}}">
                </label>
                <div>
                {% if session.privilege_id == 1 %}
                    <label for="membership_id">Type d'abonnement </label>
                    <select name="membership_id" id="membership_id">

                        {% for membership in membership %}
                        <!-- Boucle au travers de ma table membership-->
                        <option value="{{ membership.id }}" {% if membership.id == user.membership_id %}
                            selected="selected" {% endif %}>{{membership.membership}}</option>
                        {% endfor %}
                {% endif %}
                        <!-- Si idMembership coressepond a une des valeur id , l'option est selectionner-->
                </div>
                <input type="submit" value="Modifier" class='btnPerdu'>
            </form>
            {% if session.privilege_id == 1 %}
            <form action="{{ path }}user/delete" method="post" class='upNdown'>
                <input type="hidden" name="id" value="{{ user.id}}">
                <input type="submit" value="Effacer">
            </form>
            {% endif %}
        </div>
    </main>

</body>

</html>