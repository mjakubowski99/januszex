
<?php
    if( isset($data['error_message']) ) echo $data['error_message'].'!!!!';
?>


<form method="POST" action="/register">
    <label for="mail"> Email </label>
    <input type="email" name="email"/>
    <br>
    <br>
    <label for="password"> Hasło </label>
    <input type="password" name="password"/>
    <br>
    <label for="confirm"> Potwierdź hasło </label>
    <input type="password" name="confirm"/>
    <br>
    <label for="name"> Imię </label>
    <input type="text" name="name"/>
    <br>
    <label for="surname"> Nazwisko </label>
    <input type="text" name="surname"/>
    <br>
    <label for="city"> Miasto </label>
    <input type="text" name="city"/>
    <br>
    <label for="street"> Ulica </label>
    <input type="text" name="street"/>
    <br>
    <label for="home_number"> Numer domu </label>
    <input type="text" name="home_number"/>
    <br>
    <label for="flat_number"> Numer mieszkania </label>
    <input type="text" name="flat_number"/>
    <br>
    <label for="postoffice_name"> Poczta </label>
    <input type="text" name="postoffice_name"/>
    <br>
    <label for="postoffice_code"> Kod pocztowy </label>
    <input type="text" name="postoffice_code"/>

    <br>

    <button> Submit </button>
</form>