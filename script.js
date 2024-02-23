// JavaScript code
$(document).ready(function() {
    // Customer Form Validation
document.getElementById('customer-form').addEventListener('submit', function(event) {
    event.preventDefault();
    var firstName = document.getElementById('first-name').value.trim();
    var lastName = document.getElementById('last-name').value.trim();
    var contactNumber = document.getElementById('contact-number').value.trim();
    var district = document.getElementById('district').value.trim();

    if (firstName === '' || lastName === '' || contactNumber === '' || district === '') {
        alert('Please fill in all fields.');
        return false;
    }

    // Additional validation can be added here

    this.submit();
});

// Item Form Validation
document.getElementById('item-form').addEventListener('submit', function(event) {
    event.preventDefault();
    var itemCode = document.getElementById('item-code').value.trim();
    var itemName = document.getElementById('item-name').value.trim();
    var itemCategory = document.getElementById('item-category').value.trim();
    var itemSubcategory = document.getElementById('item-subcategory').value.trim();
    var quantity = document.getElementById('quantity').value.trim();
    var unitPrice = document.getElementById('unit-price').value.trim();

    if (itemCode === '' || itemName === '' || itemCategory === '' || itemSubcategory === '' || quantity === '' || unitPrice === '') {
        alert('Please fill in all fields.');
        return false;
    }

    // Additional validation can be added here

    this.submit();
});
});
