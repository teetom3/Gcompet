const navItems = document.querySelector('.sidebar');
const openNavBtn = document.querySelector('.open_nav');
const closeNavBtn = document.querySelector('.close_nav');


const openNav = () => {
    navItems.style.display = 'flex';
    
}

openNavBtn.addEventListener('click', openNav);




const closeNav = () => {
    navItems.style.display = 'none'; 
    
    

}

closeNavBtn.addEventListener('click',closeNav );






