
class Menu {
    constructor(element) {
        this._element = element
        element.onclick = this.onclick.bind(this)
    }

    onclick(event) {
        const target = event.target;
        const item = target.closest('.accordion-item__top') || false

        if(item)
            this.showMenuItem(target.closest('.accordion-item__top').parentNode);

    }

    showMenuItem(target) {
        const
            isActive = target.dataset.active || false,
            side = target.lastElementChild,
            arrow = target.querySelector('.accordion-item__arrow');

        if(isActive === 'false' && isActive) {
            target.dataset.active = 'true';

            side.style.height = side.scrollHeight + 'px';
            side.style.opacity = '1';
            this.addProperty(arrow, 'accordion-item__arrow--active');
        }

        if(isActive === 'true' && isActive) {
            target.dataset.active = 'false';

            side.style.height = 0;
            side.style.opacity = 0;
            this.removeProperty(arrow, 'accordion-item__arrow--active');
        }
    }

    addProperty(element, property) {
        element.classList.add(property);
    }

    removeProperty(element, property) {
        element.classList.remove(property);
    }
}

const element = document.querySelector('.side-menu');
new Menu(element);