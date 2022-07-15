    <footer class="footer">
        <div class="footer__top">
            <nav class="footer-menu">
                <a href="#" class="footer-menu__item">Вход</a>
                <a href="#" class="footer-menu__item">Регистрация</a>
                <a href="#" class="footer-menu__item">Пользовательское соглашение</a>
                <a href="#" class="footer-menu__item">Помощь</a>
            </nav>
            <div class="social-icons footer-icons">
                <img src="/resources/img/facebook_icon-icons.com_59205.svg" alt="Facebook" class="social-icons__item">
                <img src="/resources/img/twitter_icon-icons.com_66093.svg" alt="Twitter" class="social-icons__item">
                <img src="/resources/img/vk_icon-icons.com_65934.svg" alt="Vkontakte" class="social-icons__item">
                <img src="/resources/img/google_icon-icons.com_62736.svg" alt="Google" class="social-icons__item">
            </div>
        </div>
        <div class="hor-line"></div>
        <p class="footer-info">receptyblud.ru &#169; Все права защищены. 2020-2021</p>
    </footer>
    </div>
</main>
    <?php
        use app\classes\Router;
        $scripts = Router::loadScripts($_SERVER['REQUEST_URI']);
        foreach ($scripts as $script) echo $script;
    ?>
</body>
</html>