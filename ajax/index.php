<!DOCTYPE html>
<html lang="ru">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Search User </title>
    <link rel="stylesheet" href="./bootstrap.min.css">
    <script>
        function showSuggestion(str) {
            if (str.length === 0) {
                document.getElementById('output').innerHTML = '';
            } else {
                // ajax request using fetch
                let reqHeader = new Headers();
                reqHeader.append('Content-Type', 'text/plain');
                let initObject = {
                    method: 'GET',
                    headers: reqHeader,
                };

                fetch('./suggest.php?q=' + str, initObject)
                    .then(function (response) {
                        return response.text();
                    })
                    .then(function (data) {
                        document.getElementById('output').innerHTML = data;
                    })
                    .catch(function (err) {
                        document.getElementById('output').innerHTML = err;
                    });
            }
        }
    </script>
</head>
<body>
<div class="container">
    <h1> Search Users</h1>
    <form>
        Search User: <label>
            <input type="text" class="form-control" onkeyup="showSuggestion(this.value)">
        </label>
    </form>
    <p>Suggestions: <span id="output" style="font-weight: bold"></span></p>
</div>
</body>
</html>