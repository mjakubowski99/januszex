

<form method="POST" action="/login">
    <label for="email"> Email </label>
    <input type="email" name="email"/>
    <br>
    <br>
    <label for="email"> Password </label>
    <input type="password" name="password"/>
    <br>
    <button> Submit </button>
</form>

<script>
    let token = localStorage.getItem('token');
    console.log(token);
    if( token !== null ){
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "http://127.0.0.1/login", true);
        xhr.setRequestHeader('Authorization', `Bearer ${token}`);

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                console.log( xhr.response )
            }
        }

        xhr.send();
    }
</script>