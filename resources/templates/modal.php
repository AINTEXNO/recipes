<section class="modal-window">
    <div class="modal">
        <img src="/resources/img/Depositphotos_113244196_l-2015-pic905-895x505-51158.jpg" alt="Моадльное окно" class="modal__image">
        <div class="modal__content">
            <div class="modal-login-view">
                <h2 class="form-title modal__subtitle">Авторизация</h2>
                <form action="#" method="POST" class="login-form">
                    <input type="text" placeholder="Адрес электронной почты" id="email" class="modal-form__input">
                    <input type="password" placeholder="Пароль" id="password" class="modal-form__input">
                    <div class="error-block" id="login-error-block"></div>
                    <button type="submit" class="login-button" id="login-button">Войти</button>
                    <a href="#" class="reg-link link-resize" id="reg">Зарегистрироваться</a>
                </form>
                <a href="#" class="reg-link" id="reg">Зарегистрироваться</a>
            </div>
            <div class="modal-register-view">
                <h2 class="form-title modal__subtitle">Регистрация</h2>
                <form action="#" method="POST" class="register-form">
                    <input type="text" placeholder="Адрес электронной почты" id="reg-email" class="modal-form__input">
                    <input type="password" placeholder="Пароль" id="reg-password" class="modal-form__input">
                    <input type="password" placeholder="Повторите пароль" id="reg-confirm-password" class="modal-form__input">
                    <div class="error-block" id="register-error-block"></div>
                    <button type="submit" class="login-button" id="register-button">Зарегистрироваться</button>
                    <a href="#" class="reg-link link-resize" id="log">Войти</a>
                </form>
                <a href="#" class="reg-link" id="log">Войти</a>
            </div>
        </div>
    </div>
</section>