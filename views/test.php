
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

  /*  let jwt = localStorage.getItem('token');

    if( jwt  !== null ){
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "http://127.0.0.1/registerVerify", true);
        xhr.setRequestHeader('Authorization', `Bearer ${jwt}`);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        let param="token="

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                console.log( xhr.response )
            }
        }

        xhr.send(param);
    }
    else{
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "http://127.0.0.1/registerVerify", true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        let param="token="

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                console.log( xhr.response )
            }
        }

        xhr.send(param);
    } */
</script>