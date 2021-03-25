
<script>

    let jwt = localStorage.getItem('token');
    console.log(jwt);

    if( jwt  !== null ){
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "http://127.0.0.1/registerVerify", true);
        xhr.setRequestHeader('Authorization', `Bearer ${jwt}`);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        let param="token=ad70576a905229dd9b0ce59e9f19281f658ffd9ead850ee4b69b7ef0d6d11a824431a2b9914dd423e62c817be021633e6c73"

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
        let param="token=ad70576a905229dd9b0ce59e9f19281f658ffd9ead850ee4b69b7ef0d6d11a824431a2b9914dd423e62c817be021633e6c73"

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                console.log( xhr.response )
            }
        }

        xhr.send();
    } 
</script>