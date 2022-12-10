{{ include('header.php', {title: 'creation entrainement'})}}
    <main>
        <div class='wrapperCentered'>
            <h2>Créer un entrainement personalisé</h2>
            <form action="{{ path }}training/store" method="post" class='formulaire-client'>
                <label>description
                    <input type="text" name="description">
                </label>
                <div>
                    <label for="training_type_id">Type d'entrainement </label>
                    <select name="training_type_id" id="training_type_id">
                        <option value="1">Push</option>
                        <option value="2">Pull</option>
                        <option value="3">Leg</option>
                        <option value="4">Cardio</option>
                        <option value="5">H.I.T</option>
                    </select>
                </div>

                <div><input type="submit" value="Save"> </div>

            </form>
        </div>
    </main>
</body>

</html>