import $ from 'jquery';

class Search {
    // Descibe and initiate objects
    constructor() {
        this.openButton = $(".js-search-trigger");
        this.closeButton = $(".search-overlay__close")
        this.searchOverlay = $(".search-overlay");
        this.searchField = $("#search-term");
        this.resultsOverlay = $("#search-overlay__results");
        this.event();
        this.typingTimer;
        this.previousValue;
        this.isOverlayOpen = false;
        this.spinnerVisible = false;
    }

    // Events
    event() {
        this.openButton.on("click", this.openOverlay.bind(this));
        this.closeButton.on("click", this.closeOverlay.bind(this));
        $(document).on("keydown", this.keyPressDispacher.bind(this));
        this.searchField.on("keyup", this.typingLogic.bind(this))
    }

    // Methods
    typingLogic() {
        if (this.searchField.val() != this.previousValue) {
        clearTimeout(this.typingTimer);

        if(this.searchField.val()) {

            if (!this.spinnerVisible) {
                this.resultsOverlay.html('<div class="spinner-loader"></div>');
                this.spinnerVisible = true;
            }
            this.typingTimer = setTimeout(this.getResults.bind(this), 2000);
            
        } else {
            this.resultsOverlay.html('');
            this.spinnerVisible = false;
        }

        }
        this.previousValue = this.searchField.val();
    }

    getResults() {
        $.getJSON('http://virtual-school.local/wp-json/wp/v2/posts?search=' + this.searchField.val(), function (posts) {
            alert(posts[0].title.rendered);
        });
    }

    keyPressDispacher(e) {
        if(e.keyCode == 83 && !this.isOverlayOpen && !$("input, textarea").is(':focus')) {
            this.openOverlay();
        }
        if(e.keyCode == 27 && this.isOverlayOpen) {
            this.closeOverlay();
        }
    }

    openOverlay() {
        this.searchOverlay.addClass("search-overlay--active");
        $("body").addClass("body-no-scroll");
        this.isOverlayOpen = true;
    }    

    closeOverlay() {
        this.searchOverlay.removeClass("search-overlay--active");
        $("body").removeClass("body-no-scroll");
        this.isOverlayOpen = false;
    }
}

export default Search