
class Modal {
    constructor(target, modal) {
        this._modal = modal
        this._login = modal.querySelector('.modal-login-view')
        this._register = modal.querySelector('.modal-register-view')
        this._loginError = modal.querySelector('#login-error-block')
        this._fields = modal.querySelectorAll('input');
        this._registerError = modal.querySelector('#register-error-block')
        target.onclick = this.showModalWindow.bind(this)
    }

    showModalWindow(event) {
        event.preventDefault();

        this.addProperty(this._modal, 'modal-window--active')
        this.addProperty(this._login, 'modal-content--active')

        this._modal.addEventListener('click', (event) => {this.modalController(event)})
    }

    modalController(event) {
        const target = event.target;

        if(target.closest('#log'))
            this.showLoginForm()

        if(target.closest('#reg'))
            this.showRegisterForm()

        if(target.closest('#login-button'))
            this.loginUser(event)

        if(target.closest('#register-button'))
            this.registerUser(event)

        if(!target.closest('.modal'))
            this.closeModalWindow()
    }

    validator(parameters) {
        const keys = Object.keys(parameters);
        const values = Object.values(parameters);
        const errors = [];

        keys.forEach((element, elementIndex) => {
            const domElement = this.query(`#${element}`) || this.query(`.${element}`);

            const lengthValue = Array.isArray(values[elementIndex][1]) ? values[elementIndex][1] : String(values[elementIndex][1]).split(' ');
            const minArrayElement = Number(Math.min.apply(null, lengthValue));
            const maxArrayElement = Number(Math.max.apply(null, lengthValue));

            const errorName = values[elementIndex][3] || element;

            this.removeProperty(domElement, 'error-field');

            if(values[elementIndex][2] && domElement.value == '')
                errors.push([domElement, `Поле ${errorName} обязательно для заполения`]);

            if(domElement.value.length < minArrayElement || domElement.value.length > maxArrayElement)
                errors.push([domElement, `Недопустимая длина для поля ${errorName}`]);

            if(!domElement.value.match(values[elementIndex][0]))
                errors.push([domElement,`В поле ${errorName} введены запрещенные символы`]);
        })

        return errors;
    }

    loginUser(event) {
        event.preventDefault();

        // validate parameters
        // field id : regular expression, length, required, fieldName

        const validate = {
            'email' : [/^\S+@\S+\.\S+$/i, [6, 50], true, 'адрес электронной почты'],
            'password' : [/^[A-Za-z0-9@!_-]+$/i, [6, 30], true, 'пароль']
        }

        const validateResult = this.validator(validate);

        if(validateResult.length == 0) {
            let formData = new FormData();

            formData.append('email', this.query('#email').value);
            formData.append('password', this.query('#password').value);

            const options = {
                method: 'POST',
                body: formData,
                json: true
            }

            const response = this.request('../app/api/login.php', options);

            response.then(response => {
                if(response.status) {
                    localStorage.setItem('userId', response.data.id);
                    document.location.href = "../admin";
                }
            })
        }
        else {
            this._loginError.innerHTML = '';
            this._loginError.insertAdjacentText('afterbegin', validateResult[0][1]);
            this.addProperty(validateResult[0][0], 'error-field');
        }
    }

    registerUser(event) {
        event.preventDefault();

        const validate = {
            'reg-email' : [/^\S+@\S+\.\S+$/i, [6, 50], true, 'адрес электронной почты'],
            'reg-password' : [/^[A-Za-z0-9@!_-]+$/i, [6, 30], true, 'пароль'],
            'reg-confirm-password' : [/^[A-Za-z0-9@!_-]+$/i, [6, 30], true, 'повторите пароль'],
        }

        const validateResult = this.validator(validate);

        if(!validateResult.length) {
            const password = this.query('#reg-password'),
                passwordConfirm = this.query('#reg-confirm-password');

            if(password.value === passwordConfirm.value) {
                this.clear();

                let formData = new FormData();

                formData.append('email', this.query('#reg-email').value);
                formData.append('password', this.query('#reg-password').value);
                formData.append('password_confirm', this.query('#reg-confirm-password').value);

                const options = {
                    method: 'POST',
                    body: formData
                }

                const response = this.request('../app/api/register.php', options);

                console.log(response)
            }
            else {
                this.addProperty(password, 'error-field');
                this.addProperty(passwordConfirm, 'error-field');

                this._registerError.innerHTML = '';
                this._registerError.insertAdjacentText('afterbegin', 'Введенные пароли не совпадают');
            }
        }
        else {
            this._registerError.innerHTML = '';
            this._registerError.insertAdjacentText('afterbegin', validateResult[0][1]);

            this.addProperty(validateResult[0][0], 'error-field');
        }
    }

    showLoginForm() {
        this.addProperty(this._login, 'modal-content--active')
        this.removeProperty(this._register, 'modal-content--active')
        this.clear();
    }

    showRegisterForm() {
        this.addProperty(this._register, 'modal-content--active')
        this.removeProperty(this._login, 'modal-content--active')
        this.clear();
    }

    closeModalWindow() {
        this.removeProperty(this._login, 'modal-content--active')
        this.removeProperty(this._register, 'modal-content--active')

        this.removeProperty(this._modal, 'modal-window--active')
        this.clear();
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

    clear() {
        this._fields.forEach(element => {
            element.className = element.classList[0];
        })

        this._loginError.innerHTML = '';
        this._registerError.innerHTML = '';
    }

    query(element) {
        return this._modal.querySelector(element);
    }

    addProperty(element, property) {
        element.classList.add(property)
    }

    removeProperty(element, property) {
        element.classList.remove(property)
    }
}

const modal = document.querySelector('.modal-window');
const target = document.querySelector('#modal');
new Modal(target, modal);
new Modal(document.querySelector('#new-author'), modal);