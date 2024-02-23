// JavaScript code
$(document).ready(function() {
    // Customer Form Validation
    document.getElementById('customer-form').addEventListener('submit', function(event) {
        event.preventDefault();
        var firstName = document.getElementById('first-name').value.trim();
        var lastName = document.getElementById('last-name').value.trim();
        var contactNumber = document.getElementById('contact-number').value.trim();
        var district = document.getElementById('district').value.trim();

        // Regular expressions for validation
        var nameRegex = /^[A-Za-z]+$/;
        var numberRegex = /^[0-9]+$/;

        // Validating First Name
        if (!nameRegex.test(firstName)) {
            alert('First name should contain only alphabets.');
            return false;
        }

        // Validating Last Name
        if (!nameRegex.test(lastName)) {
            alert('Last name should contain only alphabets.');
            return false;
        }

        // Validating Contact Number
        if (!numberRegex.test(contactNumber) || contactNumber.length !== 10) {
            alert('Contact number should contain exactly 10 digits and only numbers.');
            return false;
        }

        // Validating District
        if (!numberRegex.test(district)) {
            alert('District should contain only numbers.');
            return false;
        }

        // Additional validation can be added here

        this.submit();
    });
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
