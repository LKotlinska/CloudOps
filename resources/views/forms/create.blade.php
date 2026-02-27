<form action="" method="POST">
    @csrf

    <label for="name">Product name:</label>
    <input 
        type="text" 
        id="name" 
        name="name"
        placeholder="e.g. Vape startkit"
        required
    />

    <label for="description">Description:</label>
    <input 
        type="text" 
        id="description" 
        name="description" 
        placeholder="e.g. Product is rechargable... "
        required
    />

    <label for="price">Price:</label>
    <input
        type="number" 
        min="1" 
        step="any" 
        placeholder="e.g. 10.90 "
        required
    />
    
    <label for="stock">In stock:</label>
    <input
    type="number"
    placeholder="e.g. 12"
    min="1"
    />

    <!-- Product type and brand demo / these will need to be populated-->
    <label for="category">Product type:</label>
    <select id="category" name="categories" required>
        <option value="">Option1</option>
        <option value="">Option2</option>
        <option value="">Option3</option>
    </select>

    <label for="brand">Brand name:</label>
    <select id="brand" name="brands" required>
        <option value="">Option1</option>
        <option value="">Option2</option>
        <option value="">Option3</option>
    </select>
    <!-------------------------------------->

    <label for="strength">Nicotine strength in mg:</label>
    <input
        type="number"
        min="0"
        placeholder="e.g. 10"
        required
    />

    <label for="volume">Volume in ml:</label>
    <input 
        type="number"
        min="1"
        placeholder="e.g. 25"
        required
    />

    <label for="battery">Battery capacity in mah:</label>
    <input
        type="number"
        min="1"
        placeholder="e.g. 1000"
        required
    />

</form>