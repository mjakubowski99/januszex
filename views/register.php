
<?php
    if( isset($data['error_message']) ) echo $data['error_message'].'!!!!';
?>


<form method="POST" action="/register">
    <label for="txt_email"> Email </label>
    <input type="email" name="txt_email"/>
    <br>
    <br>
    <label for="txt_password"> Hasło </label>
    <input type="password" name="txt_password"/>
    <br>
    <label for="txt_confirm"> Potwierdź hasło </label>
    <input type="password" name="txt_confirm"/>
    <br>
    <label for="txt_name"> Imię </label>
    <input type="text" name="txt_name"/>
    <br>
    <label for="txt_surname"> Nazwisko </label>
    <input type="text" name="txt_surname"/>
    <br>
    <label for="txt_city"> Miasto </label>
    <input type="text" name="txt_city"/>
    <br>
    <label for="txt_street"> Ulica </label>
    <input type="text" name="txt_street"/>
    <br>
    <label for="txt_home_number"> Numer domu </label>
    <input type="text" name="txt_home_number"/>
    <br>
    <label for="txt_flat_number"> Numer mieszkania </label>
    <input type="text" name="txt_flat_number"/>
    <br>
    <label for="txt_postoffice_name"> Poczta </label>
    <input type="text" name="txt_postoffice_name"/>
    <br>
    <label for="txt_postoffice_code"> Kod pocztowy </label>
    <input type="text" name="txt_postoffice_code"/>

    <br>

    <button> Submit </button>
</form>