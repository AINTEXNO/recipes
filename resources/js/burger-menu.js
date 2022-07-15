
class BurgerMenu {
    constructor(target, menu) {
        this._target = target
        this._menu = menu

        target.onclick = this.view.bind(this)
    }

    view() {
        this._menu.classList.add('side-menu--active');

        document.body.addEventListener('click', this.close.bind(this));
    }

    close(event) {
        const target = event.target;

        if(target.closest('.wrapper') || target.closest(target.className)) {
            this._menu.classList.remove('side-menu--active');
        }
    }
}

const menu = document.querySelector('.side-menu');
const burgerMenuTarget = document.querySelector('.burger-menu-icon');

new BurgerMenu(burgerMenuTarget, menu);