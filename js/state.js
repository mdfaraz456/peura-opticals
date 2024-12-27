document.addEventListener('DOMContentLoaded', function () {
    // Get the select element and the selected state from the data attribute
    var stateSelect = document.getElementById('state');
    if (!stateSelect) {
        console.error("Element with id 'state' not found.");
        return; 
    }

    // Retrieve the selected state from the data attribute
    var selectedState = stateSelect.getAttribute('data-selected-state');

    var states = [
        "Andaman and Nicobar Islands",
        "Andhra Pradesh",
        "Arunachal Pradesh",
        "Assam",
        "Bihar",
        "Chandigarh",
        "Chhattisgarh",
        "Dadra and Nagar Haveli and Daman and Diu",
        "Delhi",
        "Goa",
        "Gujarat",
        "Haryana",
        "Himachal Pradesh",
        "Jammu and Kashmir",
        "Jharkhand",
        "Karnataka",
        "Kerala",
        "Ladakh",
        "Lakshadweep",
        "Madhya Pradesh",
        "Maharashtra",
        "Manipur",
        "Meghalaya",
        "Mizoram",
        "Nagaland",
        "Odisha",
        "Puducherry",
        "Punjab",
        "Rajasthan",
        "Sikkim",
        "Tamil Nadu",
        "Telangana",
        "Tripura",
        "Uttar Pradesh",
        "Uttarakhand",
        "West Bengal"
    ];

    states.forEach(function (state) {
        var option = document.createElement('option');
        option.value = state;
        option.textContent = state;
        stateSelect.appendChild(option);

        if (state === selectedState) {
            option.selected = true;  
        }
    });
});
