<form method="POST" action="/admin/products">
    <select name="option">
        <option value="Add">Dodaj produkt</option>
        <option value="Edit">Edytuj produkt</option>
        <option value="List">Lista produktów</option>
    </select><br>
    <label for="productID">Wpisz ID produktu, który chcesz edytować</label>
    <input type="text" name="productID"/>
    <br>
    <label for="name">Nazwa </label>
    <input type="text" name="name"/>
    <br>
    <label for="path">Sciezka do zdjecia </label>
    <input type="text" name="path"/>
    <br>
    <label for="price">Cena </label>
    <input type="text" name="price"/>
    <br>
    <label for="category">Kategoria </label>
    <input type="text" name="category"/>
    <br>
    <label for="subcategory">Podkategoria </label>
    <input type="text" name="subcategory"/>
    <br>
    <label for="description">Opis </label>
    <input type="text" name="description"/>

    <label for="quantity">Ilość </label>
    <input type="text" name="quantity"/>
    <button> Test </button>
</form>
