{{ include('header.php', {title: 'Home'})}}
<body>



<tr>
                        <td>{{ session.user_id }}</td>
                        <td>{{ session.privilege_id}}</td>
                        <td>{{ session.user_name }}</td>
                        <td>{{ session.fingerPrint }}</td>
                        <td>{{ session.ip_adress }}</td>
                        <!-- ip adress retourne ::1 qui est la version compress de  0:0:0:0:0:0:0:1.
                        En gros, localHost(127.0.0.1.-->
                        <td>{{ session.login_time }}</td>
</tr>
<main>
        <div class="logoAcceuil">
            <img src="{{path}}multimedia/logoNavv.svg" alt="">
        </div>
    </main>


</body>
</html>