<!DOCTYPE html>
<html lang="en">
<head>
  <title>Food</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>/* Global Styles */

 body {
  font-family: 'Arial', sans-serif;
  background-color: #f8f9fa;
  margin: 0;
  padding: 0;
  }

/* Green badge */
.menu-of-the-day-badge {
  position: absolute;
  top: 0;
  right: 0;
  padding: 5px 10px;
  background-color: #28a745;
  color: #fff;
  border-radius: 0 0 0 5px;
  z-index: 1;
}

/* Adjust image container */
.col-lg-3.position-relative {
  position: relative;
}

/* Container Styles */
.container-fluid {
  background-color: #ffffff;
  border-bottom: 2px solid #dee2e6;
  padding: 20px;
}

/* Row Styles */
.row.text-center {
  margin-top: 20px;
}

/* Button Styles */
#food,
.col.p-0.border {
  padding: 10px;
  cursor: pointer;
  transition: background-color 0.3s, color 0.3s;
  border: 1px solid #ced4da;
  border-radius: 5px;
}

#food:hover,
.col.p-0.border:hover {
  background-color: #0056b3;
  color: #ffffff;
}

/* Input Group Styles */
.input-group {
  margin-top: 20px;
  margin-bottom: 20px;
}

.input-group button {
  padding: 0.375rem 0.75rem; /* Adjust padding for smaller buttons */
}

.input-group .btn-outline-secondary {
  border-radius: 0;
  margin-right: 0;
}

.input-group .btn-success {
  border-radius: 0;
  margin-left: 0;
}

.input-group .form-control {
  padding: 0.375rem 0.75rem; /* Adjust padding for smaller input field */
  width: 60px; /* Set a fixed width for the input field */
  text-align: center; /* Center align text */
}

.input-group .input-group-text {
  border-radius: 0;
  margin: 0;
}

/* Dropdown Styles */
.dropdown {
  margin-bottom: 20px;
}

.dropdown-toggle {
  border-radius: 0;
}

.dropdown-item {
  cursor: pointer;
  transition: background-color 0.3s, color 0.3s;
}

.dropdown-item:hover {
  background-color: #0056b3;
  color: #ffffff;
}

/* Food Items Styles */
#food-items {
  margin-bottom: 20px;
}

.row.position-relative {
  margin-top: 20px;
}

.img-fluid {
  max-width: 100%;
  height: auto;
  border-radius: 5px;
}

/* Food Details Styles */
.food-details {
  padding: 10px;
}

.food-details b {
  font-size: 1.2em;
}

.food-details .text-muted {
  font-size: 0.9em;
}

.food-details .btn-outline-secondary,
.food-details .btn-success {
  border-radius: 0;
}


.food-details .btn-success {
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  margin-top: 10px; /* Add some margin between the input group and Add to Cart button */
}
.food-details .btn-success:hover {
  background-color: #28a745;
  border-color: #28a745;
}
.food-details .input-group {
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
}
.food-details .input-group,
.food-details .btn-group {
  margin-top: 5px; /* Add some margin */
}

/* Badge Styles */
.badge {
  font-size: 0.8em;
}

/* Background Styles */
.bg-light {
  background-color: #f8f9fa !important;
}

/* Shadow Styles */
.shadow-sm {
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Button Success Styles */
.btn-success {
  font-size: 0.8em;
}

.btn-success.p-1 {
  padding: 5px 20px;
  border-radius: 0;
  display: inline-block;
  margin-left: 10px;
}

/* Cart Button Styles */
.cart-button {
  display: inline-flex;
  align-items: center;
}

.cart-button .badge {
  margin-left: 7px;
  background-color: #dc3545;
  color: #fff;
  padding: 3px 6px;
  border-radius: 50%;
  animation: pulse 1.5s infinite alternate;
}

.cart-button .badge:hover {
  background-color: #c82333;
}

/* Animation Styles */
@keyframes pulse {
  from {
    transform: scale(1);
  }
  to {
    transform: scale(1.2);
  }
}

/* Responsive Styles */
/* Responsive Styles */
@media (max-width: 576px) {
  .food-image {
    height: auto;
  }
   .food-details .input-group,
  .food-details .btn-group {
    margin-top: 20px; /* Increase margin for smaller screens */
  }
  .position-relative {
    position: static;
  }
  .position-absolute {
    position: static;
  }
  .mb-1 {
    margin-bottom: 0.5rem !important;
  }
  .input-group .form-control {
    width: 50px; /* Further reduce width for smaller screens */
    padding: 0.25rem 0.5rem; /* Adjust padding for smaller screens */
    font-size: 0.9em; /* Reduce font size for smaller screens */
  }
  .input-group button {
    padding: 0.25rem 0.5rem; /* Adjust padding for smaller screens */
    font-size: 0.9em; /* Reduce font size for smaller screens */
  }
}


@media (min-width: 576px) and (max-width: 767px) {
  .food-image {
    height: 30vh;
  }
}

@media (min-width: 768px) and (max-width: 991px) {
  .food-image {
    height: 30vh;
  }
}

@media (min-width: 992px) and (max-width: 1199px) {
  .food-image {
    height: 40vh;
  }
}

@media (min-width: 1200px) and (max-width: 1399px) {
  .food-image {
    height: 40vh;
  }
}

@media (min-width: 1400px) {
  .food-image {
    height: 50vh;
  }
}

</style>
</head>
<body>
    @include("layouts.navigation")
  <div class="container-fluid border-bottom mt-5">
    <div class="row text-center mt-3 mx-1 bg-light shadow-sm">
      <div class="col p-0 border bg-primary text-white food-button">Food</div>
      <div class="col p-0 border bar-button">Bar</div>

    </div>
    <div class="row mt-3 mx-1">
      <div class="col-10 col-lg-11 p-0">
        <div class="input-group">
          <input type="search" placeholder="Search" class="form-control">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
      <div class="col-2 col-lg-1 d-flex justify-content-end px-0">
        <a href="{{ route('cart.index') }}" class="btn btn-success p-1">
          Cart
          <span id="cartCountBadge" class="badge bg-secondary"></span>
        </a>
      </div>
    </div>
    <div class="row mt-3 mx-1">
      <div class="col-3 col-sm-2 col-md-2 col-lg-1 px-0">
        <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            Filter
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            @foreach ($categories as $category)
            <li>
              <a class="dropdown-item category-filter" href="#" data-category-id="{{ $category->id }}">{{ $category->name }}</a>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
      <div class="col-9 col-sm-10 col-md-10 col-lg-11">
        <div class="form-check">
          <input type="checkbox" id="menuOfDayCheckbox" checked>
          <label for="menuOfDayCheckbox">Menu of the Day</label>
        </div>
      </div>
    </div>

    <div class="container-fluid mb-3" id="food-items">
      @if(isset($items))
      @foreach($items as $item)
      <div class="row mx-2 mt-3 rounded position-relative shadow align-items-center">
    <div class="col-12 col-md-4 col-lg-3 p-0 position-relative">
        <img src="{{ asset('images/' . $item->image_path) }}" class="img-fluid rounded w-100 food-image" alt="Food-Image">
        @if($item->is_menu_item)
        <span class="badge menu-of-the-day-badge">Menu of the Day</span>
        @endif
    </div>
    <div class="col-12 col-md-8 col-lg-9">
        <div>
            <b>{{ $item->name }}</b>
        </div>
        <div class="text-muted">{{ $item->description }}</div>
        <div>Rs. {{ $item->price }}</div>
        <div class="position-relative mb-1">
    <div class="input-group">
        <div class="input-group-prepend">
            <button class="btn btn-outline-secondary" type="button" onclick="decrementQuantity('{{ $item->id }}')">-</button>
        </div>
        <input type="number" class="form-control text-center w-auto" value="1" id="quantity_{{ $item->id }}" readonly>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" onclick="incrementQuantity('{{ $item->id }}')">+</button>
        </div>
    </div>
</div>
<button class="btn btn-success mt-2" onclick="addItemToCart('{{ $item->id }}', '{{ $item->name }}', '{{ $item->price }}', '{{ $item->image_path }}', updateCartBadge)">Add to Cart</button>

    </div>
</div>

      @endforeach
      @else
      <p>No items found.</p>
      @endif
    </div>


    <div class="container-fluid mb-3" id="bar-items" style="display: none;">
    <!-- Initially hide the bar items container -->
    <p>this is bar page</p> <!-- Placeholder content -->
    
    
  </div>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

  <script>
    // Global variable to store cart items
    var cartItems = {!! json_encode($cartItems) !!} || [];

    $(document).ready(function () {
      var referrer = document.referrer; // Get the referrer URL
      console.log('Referrer URL:', referrer);

      // Check if the referrer URL contains the URL of the menu page
      if (referrer.includes("http://127.0.0.1:8000/menu")) {
        $('#menuOfDayCheckbox').prop('checked', true);
        console.log('Checkbox state set to true');
        // Fetch and display all Menu of the Day items
        fetchMenuOfTheDayItems();
      } else {
        $('#menuOfDayCheckbox').prop('checked', false); // Set the checkbox to false to display all Menu of the Day items by default
        console.log('Checkbox state set to false');
      }
    });

    // Function to fetch and display all Menu of the Day items
    function fetchMenuOfTheDayItems() {
      $.ajax({
        type: 'GET',
        url: '/get-menu-of-the-day-items', //
        dataType: 'json',
        success: function (data) {
            // Display all Menu of the Day items
            displayItems(data); // Pass the data directly to displayItems function
            console.log('All Menu of the Day items displayed:', data);
        },
        error: function (error) {
            console.error('Error fetching Menu of the Day items:', error);
        }
    });
}

// Click event for category filter
$('.category-filter').click(function (e) {
    e.preventDefault();
    var categoryId = $(this).data('category-id');
    var showMenuOfDay = $('#menuOfDayCheckbox').is(':checked');

    console.log('Category filter clicked');
    console.log('Category ID:', categoryId);
    console.log('Menu of the Day checkbox checked:', showMenuOfDay);

    // Make an AJAX request to fetch items for the selected category
    $.ajax({
        type: 'GET',
        url: '/get-items-by-category/' + categoryId,
        dataType: 'json',
        success: function (data) {
            // Filter the data based on the "Menu of the Day" checkbox
            if (showMenuOfDay) {
                // Filter items to display only those marked as menu items
                var menuItems = data.filter(item => item.is_menu_item);
                displayItems(menuItems, categoryId);
                console.log('Menu of the Day items displayed:', menuItems);
            } else {
                // Display all items if the checkbox is not checked
                displayItems(data, categoryId);
                console.log('Filtered items displayed:', data);
            }
        },
        error: function (error) {
            console.error('Error fetching items:', error);
        }
    });
});

// Click event for Menu of the Day checkbox
$('#menuOfDayCheckbox').change(function () {
    var showMenuOfDay = $(this).is(':checked');

    console.log('Menu of the Day checkbox state changed:', showMenuOfDay);

    if (showMenuOfDay) {
        // Fetch and display all Menu of the Day items
        fetchMenuOfTheDayItems();
    } else {
        // Fetch and display all items
        fetchAllMenuItems(); // Assuming this function fetches all menu items
    }
});

function fetchAllMenuItems() {
    $.ajax({
        type: 'GET',
        url: '/get-all-items', // Update the URL to match the correct route
        dataType: 'json',
        success: function (data) {
            // Display all menu items
            displayItems(data, 0); // Assuming category ID for all menu items is 0
            console.log('All menu items displayed:', data);
        },
        error: function (error) {
            console.error('Error fetching all menu items:', error);
        }
    });
}

// Function to display items
function displayItems(items, categoryId) {
    var foodItemsContainer = $('#food-items');

    // Check if items are available
    if (items.length > 0) {
        // Clear the existing items
        foodItemsContainer.empty();

        items.forEach(function (item) {
            var newItem = `
                <div class="row mx-2 mt-3 rounded position-relative shadow align-items-center">
                    <div class="col-4 col-lg-3 p-0 position-relative">
                        <img src="{{ asset('images/') }}/${item.image_path}" class="img-fluid rounded w-100 food-image" alt="Food-Image">
                        ${item.is_menu_item ? '<span class="badge menu-of-the-day-badge">Menu of the Day</span>' : ''}
                    </div>
                    <div class="col-8 col-lg-9">
                        <div>
                            <b>${item.name}</b>
                        </div>
                        <div class="text-muted">${item.description}</div>
                        <div>Rs. ${item.price}</div>
                          <div class="position-relative mb-1">
    <div class="input-group">
        <div class="input-group-prepend">
            <button class="btn btn-outline-secondary" type="button" onclick="decrementQuantity('{{ $item->id }}')">-</button>
        </div>
        <input type="number" class="form-control text-center w-auto" value="1" id="quantity_{{ $item->id }}" readonly>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" onclick="incrementQuantity('{{ $item->id }}')">+</button>
        </div>
    </div>
</div>
<button class="btn btn-success mt-2" onclick="addItemToCart('{{ $item->id }}', '{{ $item->name }}', '{{ $item->price }}', '{{ $item->image_path }}', updateCartBadge)">Add to Cart</button>

                    </div>
                </div>`;

            foodItemsContainer.append(newItem);
        });

        // Change the category name
        $('#food').text(categoryNameFromId(categoryId));
    } else {
        // Display a message if no items are available
        foodItemsContainer.html('<p>No items found.</p>');
    }
}

// Function to add item to cart
function addItemToCart(itemId, itemName, itemPrice, itemImagePath, ...callbacks) {
    var quantityInput = $('#quantity_' + itemId);
    var quantity = parseInt(quantityInput.val()) || 1;

    var item = {
        id: itemId,
        name: itemName,
        price: itemPrice,
        quantity: quantity,
        image_path: itemImagePath
    };

    var existingItemIndex = cartItems.findIndex(i => i.id === itemId);

    if (existingItemIndex !== -1) {
        cartItems[existingItemIndex].quantity += quantity;
    } else {
        cartItems.push(item);
    }

    // Loop through the provided callbacks and execute them
    if (callbacks && callbacks.length > 0) {
        callbacks.forEach(callback => {
            if (typeof callback === 'function') {
                callback(item);
            }
        });
    }

    // Update the cart badge count
    updateCartBadge(cartItems.reduce((total, item) => total + item.quantity, 0));
    addToCartTable(item);
}
// Function to fetch and display bar categories in the filter
function fetchAndDisplayBarCategories() {
    $.ajax({
        type: 'GET',
        url: '/get-bar-categories', // Replace this URL with the endpoint to fetch bar categories
        dataType: 'json',
        success: function (categories) {
            // Empty the filter dropdown menu
            $('.dropdown-menu').empty();

            // Add bar categories to the filter dropdown menu
            categories.forEach(function (category) {
                var menuItem = '<li><a class="dropdown-item category-filter" href="#" data-category-id="' + category.id + '">' + category.name + '</a></li>';
                $('.dropdown-menu').append(menuItem);
            });
        },
        error: function (error) {
            console.error('Error fetching bar categories:', error);
        }
    });
}
$(document).ready(function () {
    $('.bar-button').click(function () {
        console.log("Bar button clicked!");
        $('#bar-items').toggle();
        $('#food-items').toggle();
        console.log("Bar items container display:", $('#bar-items').css('display'));
          

    
        // Fetch and display bar categories in the filter when Bar button is clicked
        fetchAndDisplayBarCategories();
        fetchAndDisplayBarItems();
    });
// Event handler for filter button click
$(document).on('click', '.category-filter', function () {
    console.log("Bar filter pressed!");
    
});
    $('.food-button').click(function () {
        console.log("Food button clicked!");
        // Redirect to the food page
        window.location.href = "{{ route('food.index') }}";
    });
});
function fetchAndDisplayBarItems() {
    $.ajax({
        type: 'GET',
        url: '/get-bar-items', // Update the URL to match the endpoint for fetching bar items
        dataType: 'json',
        success: function (items) {
            // Display bar items
            displayBarItems(items);
            console.log('Bar items displayed:', items);
        },
        error: function (error) {
            console.error('Error fetching bar items:', error);
        }
    });
}
// Click event for bar category filter
$('.bar-category-filter').click(function (e) {
    e.preventDefault();
    var categoryId = $(this).data('category-id');

    console.log('Bar Category filter clicked');
    console.log('Category ID:', categoryId);

    // Make an AJAX request to fetch bar items for the selected category
    $.ajax({
        type: 'GET',
        url: '/get-bar-items-by-category/' + categoryId,
        dataType: 'json',
        success: function (data) {
            // Display the bar items based on the selected category
            displayBarItems(data);
            console.log('Bar items for category', categoryId, 'displayed:', data);
        },
        error: function (error) {
            console.error('Error fetching bar items:', error);
        }
    });
});

// Function to display bar items
function displayBarItems(items) {
    var barItemsContainer = $('#bar-items');

    // Check if items are available
    if (items.length > 0) {
        // Clear the existing items
        barItemsContainer.empty();

        items.forEach(function (item) {
            var newItem = `
                <div class="row mx-2 mt-3 rounded position-relative shadow align-items-center">
                    <div class="col-4 col-lg-3 p-0 position-relative">
                        <img src="{{ asset('images/') }}/${item.image_path}" class="img-fluid rounded w-100 food-image" alt="Food-Image">
                        ${item.is_menu_item ? '<span class="badge menu-of-the-day-badge">Menu of the Day</span>' : ''}
                    </div>
                    <div class="col-8 col-lg-9">
                        <div>
                            <b>${item.name}</b>
                        </div>
                        <div class="text-muted">${item.description}</div>
                        <div>Rs. ${item.price}</div>
                        <div class="position-absolute bottom-0 end-0 mb-1 mx-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary" type="button" onclick="decrementQuantity('${item.id}')">-</button>
                                </div>
                                <input type="number" class="form-control text-center w-auto" value="1" id="quantity_${item.id}" readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" onclick="incrementQuantity('${item.id}')">+</button>
                                    <button class="btn btn-success ms-1" onclick="addItemToCart('${item.id}', '${item.name}', '${item.price}', '${item.image_path}', updateCartBadge, addToCartTable)">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;

            barItemsContainer.append(newItem);
        });
    } else {
        // Display a message if no items are available
        barItemsContainer.html('<p>No items found.</p>');
    }
}
// Function to update cart badge
function updateCartBadge(quantity) {
    var cartCountBadge = $('#cartCountBadge');
    cartCountBadge.text(quantity);
}

// Function to decrement quantity
function decrementQuantity(itemId) {
    var quantityInput = $('#quantity_' + itemId);
    var currentQuantity = parseInt(quantityInput.val()) || 1;

    // Ensure quantity is at least 1 before decrementing
    if (currentQuantity > 1) {
        var newQuantity = currentQuantity - 1;
        quantityInput.val(newQuantity);
        quantityInput.trigger('change'); // Trigger change event
    }
}

// Function to add item to cart table
  function addToCartTable(item) {
  console.log('Adding to cart:', item);

  // Add the AJAX call to add the item to the cart table
  $.ajax({
    url: '{{ route("cart.add") }}',
    method: 'POST',
    data: {
      item_id: item.id,
      name: item.name,
      price: item.price,
      quantity: $('#quantity_' + item.id).val(),
      image_path: item.image_path,
      _token: '{{ csrf_token() }}', // Add CSRF token for Laravel
    },
    success: function (response) {
      // Handle success response if needed
      console.log(response);
    },
    error: function (error) {
      // Handle error if needed
      console.error(error);
    }
  });
}

// Function to increment quantity
function incrementQuantity(itemId) {
    var quantityInput = $('#quantity_' + itemId);
    var currentQuantity = parseInt(quantityInput.val()) || 1;

    // Increment quantity
    var newQuantity = currentQuantity + 1;
    quantityInput.val(newQuantity);
    quantityInput.trigger('change'); // Trigger change event
}

// Function to get category name from ID
function categoryNameFromId(categoryId) {
    var categories = {!! json_encode($categories) !!};
    var category = categories.find(c => c.id === categoryId);
    return category ? category.name : 'Food';
}
</script>

</body>
</html>