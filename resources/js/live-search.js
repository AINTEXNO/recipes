
class LiveSearch {
    constructor( targetElement, element) {
        this.targetElement = targetElement
        this._element = element
        this._field = element.querySelector('input')
        this._list = element.querySelector('.query-list')
        this.button = element.querySelector('button')

        this.button.onclick = this.send.bind(this);
        targetElement.onclick = this.view.bind(this)
    }

    view() {
        this.removeProperty(this._element.firstElementChild, 'search--out')
        this.addProperty(this._element, 'live-search-section--active')

        this.search();
        this._element.addEventListener('click', (event) => this.close(event.target));
    }

    search() {
        const response = this.data();
        const recipes = [];

        response.then(result => {result.data.forEach(element => recipes.push(element))})

        this._field.addEventListener('input', (event) => {
            this._list.innerHTML = ''

            recipes.forEach((element) => {
                const value = event.target.value.replace(/[^a-zа-яё\- ]/gi, '');
                const title = element.title.toLocaleLowerCase().replace(/[^a-zа-яё ]/gi, '');

                if(title.includes(value.toLocaleLowerCase().trim()) && this._list.children.length < 6) {
                    this._list.insertAdjacentHTML('afterbegin', `
                        <li class="query-list__item"><a href="#">${element.title}</a></li>
                    `)
                }

                if(value.length < 1 || !value.trim().length)
                    this._list.innerHTML = '';

                this._list.addEventListener('click', (event) => this._field.value = event.target.innerText)
            })

        })
    }

    send(event) {
        event.preventDefault();

        const query = this._field.value.replace(/[^a-zа-яё\- ]/gi, '');
        document.location.href = `/search/${encodeURIComponent(query)}`
    }

    async data() {
        const response = await fetch('/app/api/recipes.php', {method: 'GET'});
        return await response.json();
    }

    close(target) {
        const search = this._element.firstElementChild;

        if(!target.closest('.search') || target.closest('.close-search-btn')) {
            this.addProperty(search, 'search--out')
            setTimeout(() => {
                this.removeProperty(this._element, 'live-search-section--active')
            }, 300)
        }
    }

    query(element) {
        return this._element.querySelector(element);
    }

    addProperty(element, property) {
        element.classList.add(property)
    }

    removeProperty(element, property) {
        element.classList.remove(property)
    }
}

const targetElement = document.querySelector('#search-input'),
    searchElement = document.querySelector('.live-search-section');

new LiveSearch(targetElement, searchElement);