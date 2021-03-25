<script>

let token = localStorage.getItem('token');
    if( token !== null ){
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "http://127.0.0.1/resendVerification", true);
        xhr.setRequestHeader('Authorization', `Bearer ${token}`);

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                console.log( xhr.response )
            }
        }

        xhr.send();
    }
    else{
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "http://127.0.0.1/resendVerification", true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                console.log( xhr.response )
            }
        }

        xhr.send();
    }

</script>