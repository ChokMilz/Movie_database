<!DOCTYPE html>
<html>
<head>
    <title>Movie Database</title>
    <script src="https://unpkg.com/htmx.org"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
        echo "Hello, World! This is a PHP page running on XAMPP.";
?>
    <h1>Movie Database</h1>
    <form>
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>
        <br>
        <button type="button" data-username="username" data-password="password" id="query1" hx-post="php/query_m1.php" hx-trigger="click" hx-target="#result">
    Query 1  
</button>
<button type="button" data-username="username" data-password="password" id="query2" hx-post="php/query_m2.php" hx-trigger="click" hx-target="#result">
    Query 2
</button>
<button type="button" data-username="username" data-password="password" id="query3" hx-post="php/query_m3.php" hx-trigger="click" hx-target="#result">
    Query 3
</button>
<script>
['query1', 'query2', 'query3'].forEach(function(buttonId) {
    document.getElementById(buttonId).addEventListener('click', function() {
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        this.setAttribute('hx-vals', JSON.stringify({ username: username, password: password }));
    });
});
</script>
    </form>
    <div id="result" style="width: 800px; height: 400px; border: 2px solid black; overflow: auto;"></div>
</body>
</html>


