<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ title }} </title>
    <link rel="stylesheet" href="{{ path }}css/style.css">
</head>
<?php

?>
<body>

    <nav>
        <ul>

           
    
                {% if guest %}
                <li><a href='{{path}}user/create'>inscris-toi</a></li>
                <li><a href="{{path}}user/login">Login</a></li>
                {% else %}
                {% if session.privilege_id == 1 %}
                <li class='userWelcome'>Welcome back {{ session.user_name }}</li>
                 <li><a href='{{path}}'>Home</a></li>
                <li><a href='{{path}}training/create'>creer un entrainement</a></li>
                <li><a href='{{path}}user'>Modifications de compte</a></li>
                <li><a href='{{path}}training'>zone entrainement</a></li>
                <li><a href='{{path}}logbook'>Log Book </a></li>
                
                <li><form action="{{ path }}user/logoutt" method="post">

                {% elseif session.privilege_id == 3  %}
                <li class='userWelcome'>Welcome back {{ session.user_name }}</li>
                 <li><a href='{{path}}'>Home</a></li>
                <li><a href='{{path}}training/create'>creer un entrainement</a></li>
                <li><a href='{{path}}user'>Modifications de compte</a></li>
                <li><a href='{{path}}training'>zone entrainement</a></li>
                <li><form action="{{ path }}user/logoutt" method="post">
                {% elseif session.privilege_id == 2 %}
                <li class='userWelcome'>Welcome back {{ session.user_name }}</li>
                 <li><a href='{{path}}'>Home</a></li>
                <!-- Enlever le lien de creation entrainement pour Client-->
                <li><a href='{{path}}user'>Modifications de compte</a></li>
                <li><a href='{{path}}training'>zone entrainement</a></li>
                <li><form action="{{ path }}user/logoutt" method="post">
                {% endif %}
<input type="submit" value="LOGOUT">
</form></li>
                {% endif %}
        </ul>
    </nav>

    <header>
        <h1>{{ pageHeader}}</h1>
    </header>
    <aside>
        {% if errors is defined %}
        <span class="error">{{ errors | raw}}</span>
        {% endif %}
    </aside>