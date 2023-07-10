//Setting up light and dark themes

const lighticon = document.querySelector("#light-icon");
const darkicon = document.querySelector("#dark-icon");
const lighticontheme = document.querySelector("#light-icon-theme");
const darkicontheme = document.querySelector("#dark-icon-theme");
if (!localStorage.hasOwnProperty('theme')) localStorage.setItem('theme', 'dark');
if (localStorage.getItem('theme') === 'light') changeThemeToLight();
else if (localStorage.getItem('theme') === 'dark') changeThemeToDark();

darkicon.onclick = changeThemeToLight;
lighticon.onclick = changeThemeToDark;
darkicontheme.onclick = changeThemeToLight;
lighticontheme.onclick = changeThemeToDark;

function changeThemeToLight() {
    document.body.classList.add("light-theme");
    localStorage.setItem('theme', 'light');
    darkicon.style.display = "none";
    lighticon.style.display = "inline-block";
    darkicontheme.style.display = "none";
    lighticontheme.style.display = "block";
}

function changeThemeToDark() {
    document.body.classList.remove("light-theme");
    localStorage.setItem('theme', 'dark');
    darkicon.style.display = "inline-block";
    lighticon.style.display = "none";
    darkicontheme.style.display = "block";
    lighticontheme.style.display = "none";
}

//Toggling suboption list

const suboption = document.querySelector('#option');
const suboptionicon = suboption.children[0];
const suboptionlist = suboption.children[1];
suboptionicon.onclick = () => {
    if(suboptionlist.className == "sublist") {
        suboptionicon.style.transform = "rotate(-180deg)";
        suboptionlist.className = "sublist show";
    }
    else if(suboptionlist.className == "sublist show" || mclick!=suboptionlist) {
        suboptionicon.style.transform = "rotate(0deg)";
        suboptionlist.className = "sublist";
    }
}
window.onclick = (e) => {
    if(e.target!=suboptionicon) {
        if(e.target!=suboptionlist) {
            suboptionicon.style.transform = "rotate(0deg)";
            suboptionlist.className = "sublist";
        }
    }
}

//Opening and closing of contact us page

const showcontactus = document.querySelectorAll(".show-contactus");
for(i = 0; i < showcontactus.length; i++) {
    showcontactus[i].onclick = () => {
        document.querySelector(".popup").classList.add("active");
    }
}
document.querySelector(".popup .close-btn").addEventListener("click",function(){
    document.querySelector(".popup").classList.remove("active");
});

//Opening and closing of modal

const openmodal = document.querySelectorAll(".open-modal");
const modal = document.querySelector("#modal");
for(i=0; i<openmodal.length; i++) {
    openmodal[i].onclick = () => {
        modal.classList.add("modalshow");
        scrollVisibility();  //Correct
        // printf();
    }
}
const closemodal = document.querySelector("#modal .close-btn");
closemodal.onclick = () => {
    modal.classList.remove("modalshow");
}

//Scrolling horizontally

const leftscroll = document.querySelector("#leftarrow");
const rightscroll = document.querySelector("#rightarrow");
const element = document.querySelector("#groupgrid-content");

let currentScrollPosition;
if (element != null) currentScrollPosition = element.scrollLeft;
let scrollAmount = 100;

if (leftscroll != null) {
    leftscroll.onclick = () => {
        scrollHorizontally(-1);
        // console.log("Left clicked");
    }
}

if (rightscroll != null) {
    rightscroll.onclick = () => {
        scrollHorizontally(1);
        // console.log("Right clicked");
    }
}

if (element != null) {
    element.addEventListener('scroll', () => {
        // console.log("scrolled");
        scrollVisibility();
    });
}

function scrollHorizontally(val) {
    element.scrollBy({
        top: 0,
        left: val*scrollAmount,
        behavior: 'smooth'
    });
    // console.log(element.scrollLeft);
    scrollVisibility();
}

function scrollVisibility() {
    if(element.scrollWidth - element.clientWidth == element.scrollLeft) {
        // console.log("End of right scroll");
        rightscroll.style.transform = "scale(0)";
    }
    else {
        // console.log("Continue scrolling right");
        rightscroll.style.transform = "scale(1)";
    }

    if(element.scrollLeft == 0) {
        // console.log("End of left scroll");
        leftscroll.style.transform = "scale(0)";

    }
    else {
        // console.log("Continue scrolling left");
        leftscroll.style.transform = "scale(1)";
    }
}