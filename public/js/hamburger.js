const hamburger = document.querySelector('#menu')

hamburger.addEventListener('click', function(){
    hamburger.classList.toggle('hamburger-active')
})

function Menu(e) {
    let list = document.querySelector('ul');
    e.name === 'menu' ? (e.name = "close", list.classList.add('top-[85px]'), list.classList.add('opacity-100')) : (e.name = "menu", list.classList.remove('top-[85px]'), list.classList.remove('opacity-100'))
}