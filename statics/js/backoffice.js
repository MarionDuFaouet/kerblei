// ADMIN TAB-------------------------------------------------------------------------------------
// Get all tab elements and convert the NodeList to an array
const tabs = [...document.querySelectorAll('.tab')];

// Add click event listeners to each tab, triggering the tabsAnimation function
tabs.forEach(tab => tab.addEventListener("click", tabsAnimation));

// Get all tab content elements
const tabContents = [...document.querySelectorAll(".tabContent")];

// Function to handle tab animation and content display
function tabsAnimation(e){
    // Find index of the currently active tab
    const indexToRemove = tabs.findIndex(tab => tab.classList.contains("activeTab"));

    // Remove activeTab class and aria-selected attributes from the currently active tab
    tabs[indexToRemove].setAttribute("aria-selected","false");
    tabs[indexToRemove].setAttribute("tabindex","-1");
    tabs[indexToRemove].classList.remove("activeTab");
    tabContents[indexToRemove].classList.remove("activeTabContent");

    // Find index of the tab that was clicked
    const indexToShow = tabs.indexOf(e.target);

    // Add activeTab class and aria-selected attributes to the clicked tab
    tabs[indexToShow].setAttribute("tabindex","0");
    tabs[indexToShow].setAttribute("aria-selected","true");
    tabs[indexToShow].classList.add("activeTab");
    tabContents[indexToShow].classList.add("activeTabContent");
}

// Add keydown event listeners to each tab for arrow key navigation
tabs.forEach(tab => tab.addEventListener("keydown",arrowNavigation));

// Variable to keep track of the currently focused tab
let tabFocus = 0;

// Function to handle arrow key navigation between tabs
function arrowNavigation(e){
    if(e.keyCode === 39 || e.keyCode === 37){ // Check if the pressed key is left or right arrow
        tabs[tabFocus].setAttribute("tabindex", -1); // Remove tabindex from the currently focused tab

        if(e.keyCode === 39){ // Right arrow key
            tabFocus++;
            if(tabFocus >= tabs.length){ // Wrap around to the first tab if reaching the end
                tabFocus = 0;
            }
        } else if (e.keyCode === 37){ // Left arrow key
            tabFocus--;
            if(tabFocus < 0) { // Wrap around to the last tab if reaching the beginning
                tabFocus = tabs.length - 1;
            }
        }
        tabs[tabFocus].setAttribute("tabindex", 0); // Set tabindex to 0 for the newly focused tab
        tabs[tabFocus].focus(); // Set focus to the newly focused tab
    }
}



// PRODUCT SELECTION---------------------------------------------------------------------------------
// Function to fill the form with the data of the selected product
function fillForm(productId) {
    // Set the value of the hidden input field for the selected product ID
    document.getElementById("selectedProductId").value = productId;

    // Set the values of form fields with PHP echo statements
    document.getElementById("productName").value = "<?php echo $product['name']; ?>";
    document.getElementById("productDegre").value = "<?php echo $product['degree']; ?>";
    document.getElementById("productDescription").value = "<?php echo $product['designation']; ?>";
    document.getElementById("productPrice").value = "<?php echo $product['unitPrice']; ?>";
    document.getElementById("productPictureRef").value = "<?php echo $product['pictureRef']; ?>";
}
