{{ include('header.php', {title: 'Liste entraineemnt'})}}
    <main class='wrapperCentered'>
        
        <section class='trainingWrap'>
            
            
          
                    {% for training in training %}
                    <div class='trainingCard'>
                    
                        <div class="descriptionT">
                        <strong>Entrainement</strong>
                        <p>{{ training.description }}</p>
                        </div>

                        

            <div> 
            <strong>Type d'entrainement</strong>
            {% for trainingType in trainingType %}
            <!-- Boucle au travers de ma table training_type-->
            
            <p>{% if trainingType.id== training.training_type_id %} {{ trainingType.description }}  {% endif %}</p>
           
            
            {% endfor %}
                     <!-- Si idMembership coressepond a une des valeur id , la decscription correspondante sera afficher -->
            </div>




                    {% if session.privilege_id == 1 or session.privilege_id == 3  %}
                        <td><a href="{{ path }}training/edit/{{ training.id}}">Modifier l'entrainement</a></td>
                        {% endif %}
                        <!--Seulement les entraineur et adming peuvent modifier les entrainements-->
                    </div>
                    {% endfor %}
            
                </section>
                {% if session.privilege_id == 1 or session.privilege_id == 3  %}
                <button><a href="{{ path }}training/create">Créer un entrainement personnalisé</a></button> 
                {% endif %}
    </main>
 
</body>
</html>