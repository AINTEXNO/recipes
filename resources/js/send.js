
class Send{
    constructor(form) {
        if(form) {
            this._form = form
            this._fields = form.querySelectorAll('input')
            form.onsubmit = this.find.bind(this)
        }
    }

    find(event) {
        event.preventDefault();

        const error = this._form.querySelector('#error');
        let formData = new FormData();

        const errors = this.validation(this._fields);

        if(!errors.length) {
            this._fields.forEach(element => formData.append(element.name, element.value));

            const parameters = {
                method: 'POST',
                body: formData,
                json: true
            }

            const response = this.request('/app/api/send.php', parameters);

            response.then(data => {
                if(data.status) {
                    this.clear(error)

                    error.style.color = '#4bc614';
                    error.insertAdjacentText('afterbegin', 'Подписка на email-рассылку оформлена!');
                }
                else {
                    this.clear(error)

                    this._fields[0].classList.add('error-field')
                    error.insertAdjacentText('afterbegin', 'Данный email уже использован');
                }
            })
        }
        else {
            this.clear(error)

            this._fields[0].classList.add('error-field')
            error.insertAdjacentText('afterbegin', errors[0][1]);
        }

        this._fields.forEach((element) => {
            element.addEventListener('input', () => {
                this.clear(error);
            })
        })
    }

    validation(fields) {
        let errors = [];

        fields.forEach(element => {
            if(!element.value.match(/^\S+@\S+\.\S+$/i))
                errors.push([element, 'Неверный формат электронной почты'])

            if(element.value.length < 6 || element.value.length > 60)
                errors.push([element, 'Недопустимая длина для электронной почты'])
        })

        return errors;
    }

    async request(uri, options = {}) {
        const optionsLength = Object.keys(options).length

        if(optionsLength) {
            const response = await fetch(uri, {
                method: options.method,
                headers: options.headers,
                body: options.body
            })

            return await options.json ? response.json() : response;
        }
        else {
            return await fetch(uri, {
                method: 'GET'
            })
        }
    }

    clear(field) {
        this._fields.forEach(element => {
            element.className = element.classList[0];
        })

        field.style.color = '#ee1c1c';
        field.innerHTML = '';
    }
}

const send = document.querySelector('.email-mailing') ?? false;
new Send(send);