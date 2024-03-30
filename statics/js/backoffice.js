const tabs = [...document.querySelectorAll('.tab')]

tabs.forEach(tab => tab.addEventListener("click", tabsAnimation))
const tabContents = [...document.querySelectorAll(".tabContent")]

function tabsAnimation(e){

    const indexToRemove = tabs.findIndex(tab => tab.classList.contains("activeTab"))

    tabs[indexToRemove].setAttribute("aria-selected","false")
    tabs[indexToRemove].setAttribute("tabindex","-1")
    tabs[indexToRemove].classList.remove("activeTab");
    tabContents[indexToRemove].classList.remove("activeTabContent");

    const indexToShow = tabs.indexOf(e.target)

    tabs[indexToShow].setAttribute("tabindex","0")
    tabs[indexToShow].setAttribute("aria-selected","true")
    tabs[indexToShow].classList.add("activeTab")
    tabContents[indexToShow].classList.add("activeTabContent")
}

tabs.forEach(tab => tab.addEventListener("keydown",arrowNavigation))

let tabFocus = 0;
function arrowNavigation(e){
    if(e.keyCode ===39 || e.keyCode === 37){
        tabs[tabFocus].setAttribute("tabindex", -1)

        if(e.keyCode === 39){
            tabFocus++;

            if(tabFocus >= tabs.length){
                tabFocus = 0;
            }
        } else if (e.keyCode === 37){
            tabFocus--;
            if(tabFocus < 0) {
                tabFocus = tabs.length -1;
            }
        }
        tabs[tabFocus].setAttribute("tabindex", 0)
        tabs[tabFocus].focus()
    }
}