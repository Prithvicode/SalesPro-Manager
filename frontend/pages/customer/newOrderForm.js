document.addEventListener("DOMContentLoaded", function () {
  const addProductBtn = document.getElementById("addProductBtn");
  const productList = document.getElementById("productList");

  addProductBtn.addEventListener("click", function () {
    const productItem = document.createElement("div");
    productItem.classList.add("product-item");

    productItem.innerHTML = `
         <label for="productName">Product Names:</label>
          <select id="productName" name="productName">
              <option value="product1">Product 1</option>
              <option value="product2">Product 2</option>
              <!-- Add more options as needed -->
          </select>
        <label for="price">Price:</label>
          <input type="number" id="price" name="price" value ='123' readonly>

          <label for="quantity">Quantity:</label>
          <input type="number" id="quantity" name="quantity" required>

          <label for="amount">Amount:</label>
          <input type="text" id="amount" name="amount"  readonly>

          <button type="button" class="reduceProductBtn">Remove </button> 
      `;

    productList.appendChild(productItem);

    //  Remove button functionality
    const reduceProductBtns = productItem.querySelectorAll(".reduceProductBtn");
    reduceProductBtns.forEach(function (btn) {
      btn.addEventListener("click", function () {
        const parentProductItem = btn.closest(".product-item");
        productList.removeChild(parentProductItem);
      });
    });

    const quantityInput = productItem.querySelector("#quantity");
    const amountInput = productItem.querySelector("#amount");
    const priceInput = productItem.querySelector("#price");

    priceInput.style.width = "100px";
    quantityInput.style.width = "90px";
    amountInput.style.width = "100px";

    quantityInput.addEventListener("input", function () {
      const quantity = parseInt(quantityInput.value);
      const price = parseInt(priceInput.value);
      const amount = quantity * price;
      amountInput.value = amount;
    });
  });
});
