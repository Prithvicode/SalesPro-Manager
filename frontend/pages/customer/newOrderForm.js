document.addEventListener("DOMContentLoaded", function () {
  const addProductBtn = document.getElementById("addProductBtn");
  const productList = document.getElementById("productList");
  const submitOrderBtn = document.getElementById("submitNewOrder");
  submitOrderBtn.disabled = true;

  addProductBtn.addEventListener("click", function () {
    const productItem = document.createElement("tr");
    productItem.classList.add("product-item");

    productItem.innerHTML = `
                <td>
                  <select id="productName" name="productName"></select>
                </td>
                <td>
                  <input type="number" id="price" name="price" value="0.00" readonly>
                </td>
                <td>
                  
                  <input type="number" id="quantity" name="quantity" min="1" required>
                </td>
                <td>
                 
                  <input type="text" id="amount" name="amount" readonly>
                </td>
                <td>
                  <button type="button" class="reduceProductBtn">Remove</button>
                </td>
        `;
    //<label for="productName">Product Names:</label>
    //  <label for="price">Price:</label>
    productList.appendChild(productItem);

    // Fetch Product data for drop down options
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

    // console.log(productPrices);
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
      console.log(quantity);
      console.log("qthi this is quantiy");
      // Check if quantity is negative
      if (quantity < 0) {
        alert("Quantity cannot be negative");
        submitOrderBtn.disabled = true;
        // Disable submit button
      } else if (quantity > 0) {
        // console.log("Not negative");
        // console.log(quantity);
        const price = parseInt(priceInput.value);
        const amount = quantity * price;
        amountInput.value = amount;
        submitOrderBtn.disabled = false;
      } else if (quantity == 0) {
        alert("Quantity cannot be zero");
        submitOrderBtn.disabled = true;
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
