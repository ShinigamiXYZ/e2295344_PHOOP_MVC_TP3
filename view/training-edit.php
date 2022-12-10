{{ include('header.php', {title: 'editer entraineemnt'})}}
  <div class='wrapperCentered'>  
        <h2>Modifier votre Entrainement</h2>
        <form action="{{ path }}training/update" method="post" class='formulaire-client noBorder'>
            <input type="hidden" name="id" value="{{ training.id }}">
            <label>description
                <input type="text" name="description" value="{{ training.description}}">
            </label>
            
            <label for="training_type_id">Type d'entrainement </label>
                    <select name="training_type_id" id="training_type_id">

            {% for trainingType in trainingType %}
            <!-- Boucle au travers de ma table membership-->
            <option value="{{ trainingType.id }}"{% if trainingType.id == training.training_type_id %} selected="selected"{% endif %}>{{trainingType.description}}</option>
                    {% endfor %}

                     <!-- Si idMembership coressepond a une des valeur id , l'option est selectionner-->
            </div>




            <input type="submit" value="Modifier" class='center'>
        </form>
        <form action="{{ path }}training/delete" method="post" class='upNdown'>
            <input type="hidden" name="id" value="{{ training.id}}">
            <input type="submit" value="Effacer">
        </form>
        </div>
    </main>
    
</body>
</html>