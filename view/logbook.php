{{ include('header.php', {title: 'LogBook'})}}

<section class='tableWrap'>


    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>user_id</th>
                <th>user_name</th>
                <th>fingerPrint</th>
                <th>ip_adress</th>
                <th>TimeStamp</th>

            </tr>
        </thead>

        <tbody>
            {% for entries in entries %}

            <tr>
                <td>{{ entries.id }}</td>
                <td>{{ entries.user_id }}</td>
                <td>{{ entries.user_name }}</td>
                <td>{{ entries.fingerPrint }}</td>
                <td>{{ entries.ip_adress }}</td>
                <td>{{ entries.login_time }}</td>
            {% endfor %}
        </tbody>

    </table>
 
</section>
</main>

</body>

</html>