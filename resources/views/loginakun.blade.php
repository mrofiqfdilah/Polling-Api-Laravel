<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <form action="http://127.0.0.1:8000/api/auth/login" method="post">
    @csrf
    <input type="text" name="username" placeholder="Masukan Usrname"><br>
    <input type="password" name="password" placeholder="Masukan Password"><br>
    <select name="role" id="" style="display: none;">
        <option value="Member">Member</option>
        <option value="Admin" disabled>Admin</option>
    </select>
    <button>Input</button>
    </form>
</body>
</html>