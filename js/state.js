document.addEventListener('DOMContentLoaded', function () {
    // Get all select elements with the class 'state-select'
    var stateSelects = document.querySelectorAll('.state-select');

    stateSelects.forEach(function (stateSelect) {
        // Retrieve the selected state from the data attribute
        var selectedState = stateSelect.getAttribute('data-selected-state');

        console.log("Processing select element with selected state: " + selectedState); // Debugging line

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

        // Clear existing options (if any) and add the default "Select State" option
        stateSelect.innerHTML = '<option value="">Select State</option>';

        // Populate options dynamically
        states.forEach(function (state) {
            var option = document.createElement('option');
            option.value = state;
            option.textContent = state;
            stateSelect.appendChild(option);

            // Select the option if it matches the selectedState from the data attribute
            if (state === selectedState) {
                option.selected = true;
                console.log("Selected state set: " + state); // Debugging line
            }
        });
    });
});
