// Need to add
// Cancellation time and status
// Date selection when Order Quota is completed.
// Duration and expected duration.

document.addEventListener("DOMContentLoaded", function () {
  const addProductBtn = document.getElementById("addProductBtn");
  const productList = document.getElementById("productList");
  const submitOrderBtn = document.getElementById("submitNewOrder");

  addProductBtn.addEventListener("click", function () {
    const productItem = document.createElement("div");
    productItem.classList.add("product-item");

    productItem.innerHTML = `
            <label for="productName">Product Names:</label>
            <select id="productName" name="productName"></select>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value=0.00 readonly>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>
            <label for="amount">Amount:</label>
            <input type="text" id="amount" name="amount"  readonly>
            <button type="button" class="reduceProductBtn">Remove</button>
        `;

    productList.appendChild(productItem);

    // Fetch Product data from PHP script

    const productNameInput = productItem.querySelector("#productName");

    let productPrices = {};

    const url =
      "http://localhost/InventoryAndSalesManagement/backend/functions/product/getProduct.php";

    const options = {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    };
    fetch(url, options)
      .then((response) => response.json())
      .then((data) => {
        // console.log(data[0].SellingPrice);

        //default price
        priceInput.value = data[0].SellingPrice;

        data.forEach((item) => {
          productPrices[item.ProductID] = item.SellingPrice; // store price values
          const option = document.createElement("option");
          option.value = item.ProductID;
          option.textContent = item.ProductName;
          productNameInput.appendChild(option);
        });
      });

    console.log(productPrices);
    const priceInput = productItem.querySelector("#price");
    const quantityInput = productItem.querySelector("#quantity");
    const amountInput = productItem.querySelector("#amount");

    // Style
    priceInput.style.width = "100px";
    quantityInput.style.width = "90px";
    amountInput.style.width = "100px";

    // Set Price according to Select Product Name
    productNameInput.addEventListener("change", function () {
      priceInput.value = productPrices[productNameInput.value];
      // Calculate Amount when Product Change
      const quantity = parseInt(quantityInput.value);
      const price = parseInt(priceInput.value);

      if (isNaN(quantity)) {
        amountInput.value = "";
        console.log("quantity is nana");
      } else {
        const amount = quantity * price;
        amountInput.value = amount;
        console.log("quntity is number");
      }
    });
    // Calculate Amount when Quantity change.
    quantityInput.addEventListener("input", function () {
      const quantity = parseInt(quantityInput.value);
      // Check if quantity is negative
      if (quantity < 0) {
        alert("Quantity cannot be negative");
        submitOrderBtn.disabled = true; // Disable submit button
      } else {
        const price = parseInt(priceInput.value);
        const amount = quantity * price;
        amountInput.value = amount;
      }
    });

    // Remove button functionality
    const reduceProductBtns = productItem.querySelectorAll(".reduceProductBtn");
    reduceProductBtns.forEach(function (btn) {
      btn.addEventListener("click", function () {
        const parentProductItem = btn.closest(".product-item");
        productList.removeChild(parentProductItem);
      });
    });
  });
});
