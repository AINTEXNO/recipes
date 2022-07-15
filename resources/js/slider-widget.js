
class SliderWidget {
    constructor(widget) {
        if(widget) {
            this._widget = widget;
            this._articles = widget.querySelectorAll('.recent-article')
            this._content = document.querySelector('.wrapper')
            this._line = widget.querySelector('.recent-posts-line')
            this.count = 0
            this.shift = 0

            window.onload = this.show.bind(this)
            window.onresize = this.show.bind(this)
            widget.onclick = this.slider.bind(this)
        }
    }

    slidesNumber() {
        const maxWidth = 1620;
        const maxSlides = 6;

        const currentWidth = this._content.clientWidth;

        return Math.round((currentWidth * maxSlides) / maxWidth);
    }

    show() {
        const posts = this.slidesNumber();
        const articleWidth = (this._content.clientWidth - 10 * (posts - 1)) / posts;

        this._line.style.marginLeft = 0 + 'px';

        this.count = 0;
        this.shift = 0;

        this._content.firstElementChild.style.height = articleWidth * 1.4 + 'px';

        this._articles.forEach(element => {
            element.style.minWidth = articleWidth + 'px';
            element.style.height = articleWidth * 1.4 + 'px';
        });

        document.querySelector('.preloader').style.display = 'none';
    }

    slider(event) {
        const target = event.target;
        const posts = this._articles.length - this.slidesNumber();

        let offset = this._articles[0].offsetWidth;

        offset += 10;

        target.closest('.next-button') && this.count < posts ? (this.count++, this.shift+= offset) : null;
        target.closest('.prev-button') && this.count > 0 ? (this.count--, this.shift -= offset) : null;

        this._line.style.marginLeft = -this.shift + 'px';
    }
}

const sliderWidget = document.querySelector('.recent-posts') ?? false
new SliderWidget(sliderWidget);