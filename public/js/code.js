
//-----------------------------------------TRABAJAR ASIDE-----------------------------------------//

let menuButton = document.querySelector(".Header__Button");
let aside = document.querySelector(".Aside");
aside.isVisible = true;

let section = document.querySelector(".Section");

const showAside = ()=>{
	if(!aside.isVisible){
		aside.style.transform = "translateX(0rem)";
		section.style.width = "calc(100% - 14rem)";
		section.style.transform = "translateX(11rem)";	
	}
	else{
		aside.style.transform = "translateX(-11rem)";
		section.style.width = "calc(100% - 3rem)";	
		section.style.transform = "translateX(0)";			
	}
	aside.isVisible = !aside.isVisible;
}

const activeMenuButton = ()=>{
	menuButton.addEventListener("click",showAside);
}

activeMenuButton();