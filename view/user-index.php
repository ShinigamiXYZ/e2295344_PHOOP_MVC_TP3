{{ include('header.php', {title: 'Liste client'})}}
    <main class='wrapperCentered'>

        <section class='tableWrap'>

        <h1>{{ user_info.nom }}</h1>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>adresse</th>
                        <th>courriel</th>
                        <th>Abonnement</th>
                        <th>Type d'utilisateurs</th>
                        <th></th>

                    </tr>
                </thead>

                <tbody>
{% if session.privilege_id == 1 or session.privilege_id == 3 %}

                    {% for user in user %}

                    <tr>
                        <td>{{ user.nom }}</td>
                        <td>{{ user.adresse }}</td>
                        <td>{{ user.email }}</td>


                          {% for membership in membership %}
                            {% if membership.id == user.membership_id %}
                        <td>{{membership.membership}}</td>
                             {% endif %}
                        {% endfor %}


                        {% for userType in userType %}
                             {% if userType.id == user.user_type_id  %}
                        <td>{{userType.description}}</td>
                            {% endif %}
                        {% endfor %}
    
                        {% if session.privilege_id == 3 %}
                                {% if user.user_type_id ==1 %}
                                <td><a href="#">YOU DONT HAVE THIS POWER</a></td>
                                {%else%}
                                <td><a href="{{ path }}user/edit/{{ user.id}}">Modifier</a></td>
                                {%endif%}
                        {% elseif session.privilege_id == 1 %}
                        <td><a href="{{ path }}user/edit/{{ user.id}}">Modifier</a></td>
                        {% endif %}
                    </tr>
                    {% endfor %}
                </tbody>
                
                
{% elseif session.privilege_id == 2  %}
<!---S'il s'agis d'un client il peu selement se voir lui même.-->

{% for user in user %}
{% if session.email == user.email  %} <!--Email clef unique -->
<tr>
    <td>{{ user.nom }}</td>
    <td>{{ user.adresse }}</td>
    <td>{{ user.email }}</td>


    {% for membership in membership %}
    {% if membership.id == user.membership_id %}
    <td>{{membership.membership}}</td>
    {% endif %}
    {% endfor %}


    {% for userType in userType %}
    {% if userType.id == user.user_type_id  %}
    <td>{{userType.description}}</td>
    {% endif %}
    {% endfor %}
    <td><a href="{{ path }}user/edit/{{ user.id}}">Modifier votre compte</a></td>
</tr>
{% endif %}
{% endfor %}
</tbody>



{% endif %}
            </table>
            <button><a href="{{ path }}user/create">Ajouter Nouvel utilisateurs</a></button>
        </section>
    </main>

</body>

</html>