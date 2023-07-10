// const theme = document.querySelector("#theme");

// function themeclick() {
// 	theme.addEventListener("click", () => {
// 		theme.querySelector("span").classList.toggle("fa-moon");
// 		// theme.querySelector("span").classList.toggle("fa-solid");
// 	})
// }

let sideopt = document.querySelectorAll('.sideopt');
// console.log(sideopt);
for(let i = 0;i<sideopt.length;i++) {
	sideopt[i].onclick = function() {
		let j = 0;
		while(j < sideopt.length) {
			sideopt[j++].className = "sideopt";
		}
		sideopt[i].className = "sideopt active";
	}
}

function setActiveClass(section, option) {
	if(section.getBoundingClientRect().top<=70 && section.getBoundingClientRect().bottom>=70) {
		if(option.className=="sideopt")
		option.className="sideopt active";
	}
	else {
		if(option.className=="sideopt active")
		option.className="sideopt";
	}
}

document.addEventListener("scroll", function() {
	const contentlist = document.querySelector(".sidebar-contentlist").children;
	const sections = document.querySelector(".main-content").children;
	for (let i = 0; i < sections.length; i++) {
		setActiveClass(sections[i],contentlist[i]);
	}
});

window.onkeydown = (e) => {
 	if (e.keyCode == 32) {
		e.preventDefault();
		const contentlist = document.querySelector(".sidebar-contentlist").children;
		const sections = document.querySelector(".main-content").children;
		let activecontent = document.querySelector(".sidebar-contentlist > .active");
		let id;
		for (let i = 0; i < contentlist.length; i++) {
			if (contentlist[i] == activecontent) {
				id = i;
				break;
			}
		}
		if (e.shiftKey) {
			if (id != 0) {
				document.querySelector('html').scrollTo(0, document.querySelector('html').scrollTop + sections[id-1].getBoundingClientRect().y);
			}
		}
		else {
			if (id != contentlist.length - 1) {
				document.querySelector('html').scrollTo(0, document.querySelector('html').scrollTop + sections[id+1].getBoundingClientRect().y);
			}
		}
 	}
}

let srbi = document.querySelectorAll('.search-results-bookinfo');
// console.log(sideopt);
for(let i = 0;i<srbi.length;i++) {
	srbi[i].onclick = function(e) {
		if(e.target != srbi[i].children[2] && e.target != srbi[i].children[2].children[0] && e.target != srbi[i].children[2].children[0].children[0]) {
			if(srbi[i].children[2].classList.contains("active")==false) {
				let j = 0;
				while(j < srbi.length) {
					srbi[j].children[2].classList.remove("active");
					srbi[j].children[1].lastElementChild.innerHTML = "Click to show options";
					j++;
				}
				srbi[i].children[2].classList.add("active");
				srbi[i].children[1].lastElementChild.innerHTML = "Click to hide options";
			}
			else {
				srbi[i].children[2].classList.remove("active");
				srbi[i].children[1].lastElementChild.innerHTML = "Click to show options";
			}
		}
	}
}