<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name = "viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="newstyle.css?v=99">

    <title> Student Information System</title>
    </head>
<body>
<header class="header">
<!-- navigation -->
<div class="container-navbar">

<b><a href="#home" class="Logo"> ACADEMY <span>HUB</a></b>
 <nav class="nav-menu">
 <a href="#home">Home</a>
<a href="#Product">Product</a>
<a href="#About">About</a>
<a href="#Admin">Admin</a>
<a href="main.html" class="nav-btn">Sign in</a>
</nav>
</div>
</header>

 <?php
 include 'db.php';

$sql = "SELECT * FROM product_ople";
$result = $conn->query($sql);
?>
<!-- Main -->
<main>
 <section class="products">
 <div class="grid-card">
   <?php
   if ($result && $result->num_rows > 0) {
         while ($product = $result->fetch_assoc()) {
    ?>

        <div class="card">

             <div class="Image">

             <img src="images/<?php echo $product['image']; ?>" alt="product">
            </div>
             

             <div class="product-name">
               <?php echo htmlspecialchars($product['product_name']); ?>
               </div>

             <div class="product-price">
             Price: <?php echo number_format($product['price'], 2); ?>
             </div>


            <div class="product-stocks">
            Stocks: <?php echo (int)$product['stocks']; ?>
            </div>
       
             <div class="btn">
              <button class="buy-now"
              onclick="openBuyNow(
                <?php echo $product['product_id']; ?>,
                '<?php echo addslashes($product['product_name']); ?>',
                <?php echo $product['price']; ?>,
                <?php echo $product['stocks']; ?>,
                '<?php echo $product['image']; ?>''
              )">
              Buy Now
              </button>
              
              
            <button class="add-cart"
            onclick="addToCard(
            <?php echo (int)$product['product_id']; ?>,
            <?php echo htmlspecialchars(json_encode($product['product_name']), ENT_QUOTES, 'UTF-8'); ?>,
            <?php echo (float)$product['price']; ?>
            )">
          Add to cart</button>
                  </div>

        </div>
<?php 
      }
 } else {
  echo "<p>No products available.</p>";
 }

 $conn->close();
 ?>
</div>


<div class="mode-overlay" id="buyNowModal">
  <div class="checkout-modal">
    <div class="modal-header">
      <h2>Product Checkout</h2>
      
      <button type="button" class="modal-close"
         onclick="closeBuyNow()">
         &times;
        </button>
    <div>
      <!-- modal content -->
       <form id="checkoutForm">
        <!-- product information -->
         <div class="checkout-product">
          
         <div class="checkout-image">
          <img id="checkoutImage" src="" alt="Product Image">
           </div> 

           <div class="checkout-details">
            <h3 id="checkoutName">Product Name</h3>
            <p>
              Price:
              <strong id="checkoutPrice">$0.00</strong>
            </p>
            <p>
              Available Stocks:
              <strong id="checkoutStocks">0</strong>
              </p>
            </div>
         </div>
        
         <hr>
         <!-- Costumer information -->

         <h3 class="from-heading">Costumer Information</h3>
    <div class="form-group">
          <label for="customerName">Full Name</label>

          <input type="text"
          id="customerName"
          name="customer_name"
          placeholder="Enter your full name"
          required>
    </div>

    <div class="form-group>
        <label for="customerAddress">Delivery Address</label>

        <textarea
          id="costumerAddress"
          name="customer_address"
          placeholder="Enter your complete delivery address"
          rows="3"
          required></textarea>
    </div>

    <div class="form-group">
        <label for="customerContact">Contact Number</label>

        <input type="tel"
          id="customerContact"
          name="customer_contact"
          placeholder="Enter your contact number"
          required>
     </div>

     <!--QUANTITY-->
     <div class="form-group">
        <label for="orderQuantity">Quantity to Order</label>

        <input type="number"
          id="orderQuantity"
          name="quantity"
          value="1"
          min="1"
          step="1"
          required>
        <small id="quantityMessage">
          Minimum order: 1
        </small>
     </div>
     <!-- total amount -->
      <div class="checkout-total">
        <span>Total Amount:</span>
        <strong id="checkoutTotal">$0.00</strong>
      </div> 

      <div class="checkout-buttons">
        <button type="button"
        class="cancel-btn"
        onclick="closeBuyNow()">
        cancel
</button>
<button type="submit"
class="purchase-btn">
Confirm purchase
</button>
</div>
</form>
</div>
</div>






</section>
</main>
</body>
</html>


