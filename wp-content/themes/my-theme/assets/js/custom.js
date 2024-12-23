class InfiniteScroll extends HTMLElement {
    constructor() {
        super();
        this.page = 2;
        this.loading = false;
        this.offset = 200; 
        this.ajaxUrl = infiniteScrollData?.ajaxUrl
        this.action = infiniteScrollData?.action 
        this.containerSelector = infiniteScrollData?.container 
        this.loaderSelector = infiniteScrollData?.loaderSelector
        this.isLastPage = false;  
    }

    connectedCallback() {

        this.container = document.querySelector(this.containerSelector);
        this.loader = document.querySelector(this.loaderSelector);

        if (!this.container || !this.loader || !this.ajaxUrl) {
            console.error('InfiniteScroll: Missing required elements or AJAX URL.');
            return;
        }

        this.init();
    }

    init() {
        this.lastScrollPosition = 0;
        window.addEventListener('scroll', () => this.onScroll());
    }

    onScroll() {
        const scrollBottom = window.scrollY + window.innerHeight;
        const documentHeight = document.body.offsetHeight;
    
        const isScrollingDown = window.scrollY > this.lastScrollPosition;
        this.lastScrollPosition = window.scrollY;
    
        if (isScrollingDown && scrollBottom >= documentHeight - this.offset && !this.loading && !this.isLastPage) {
            this.loadMorePosts();
        }
    }

    loadMorePosts() {
        this.loading = true;
        this.loader.style.display = 'flex';

        const formData = new FormData();
        formData.append('action', this.action);
        formData.append('page', this.page);

        fetch(this.ajaxUrl, {
            method: 'POST',
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {

                // console.log(data); 
                if (data.content.trim() && data.content !== 'no_more_posts') {
                    this.container.insertAdjacentHTML('beforeend', data.content);
                    this.page++;
                }


                if (data.is_last_page) {
                    this.isLastPage = true;
                    this.loader.innerHTML = 'No more posts';
                }

                this.loading = false;
                this.loader.style.display = 'none';
            })
            .catch((error) => {
                console.error('Error loading posts:', error);
                this.loading = false;
                this.loader.style.display = 'none';  
            });
    }
}

customElements.define('infinite-scroll', InfiniteScroll);
