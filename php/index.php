<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote Application</title>


    <style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f5f7fa;
    color: #333;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
  }

  form {
    background: white;
    padding: 30px 40px;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    max-width: 320px;
    width: 100%;
  }

  h1 {
    text-align: center;
    margin-bottom: 25px;
    font-weight: 600;
    color: #2c3e50;
  }

  label {
    display: block;
    font-size: 1.1em;
    margin-bottom: 15px;
    cursor: pointer;
  }

  input[type="radio"] {
    margin-right: 10px;
    accent-color: #3498db; /* Couleur bleu moderne pour le radio */
    cursor: pointer;
  }

  button {
    width: 100%;
    padding: 12px 0;
    background-color: #3498db;
    border: none;
    border-radius: 5px;
    color: white;
    font-size: 1.1em;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  button:hover {
    background-color: #2980b9;
  }
</style>


</head>
<body>
    <h1>Votez pour votre préférence</h1>
    <form action="vote.php" method="post">
        <label>
            <input type="radio" name="vote" value="monogamie" required> Monogamie
        </label><br>
        <label>
            <input type="radio" name="vote" value="polygamie" required> Polygamie
        </label><br><br>
        <button type="submit">Voter</button>
    </form>
</body>
</html>
