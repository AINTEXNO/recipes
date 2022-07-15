
class Accordion {
    constructor(accordion) {
        this._accordion = accordion
        this._items = accordion.children

        accordion.onclick = this.view.bind(this)
    }

    view(event) {
        const element = event.target.closest(`.${this._items[0].className}`);
        const itemHeight = element.lastElementChild.scrollHeight;

        if(element.dataset.active) {
            element.dataset.active = '';
            element.lastElementChild.style.height = itemHeight + 'px'
        }
        else {
            element.dataset.active = 'false';
            element.lastElementChild.style.height = 0 + 'px'
        }
    }
}

new Accordion(document.querySelector('.recipe-accordion'));