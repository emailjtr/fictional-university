import $ from 'jquery';

class SearchObject {
    //1. create and initiate the object
    constructor() {
        this.resultsDiv = $("#search-overlay__results");
        this.openButton = document.querySelectorAll(".js-search-trigger");
        this.closeButton = document.querySelector(".search-overlay__close");
        this.searchOverlay = document.querySelector(".search-overlay");
        this.searchField = document.querySelector("#search-term");
        this.events();
        this.isOverlayOpen = false;
        this.isSpinnerVisible = false;
        this.previousValue;
        this.typingTimer;
    }
 
    //2. events
    events(){
        this.openButton[0].addEventListener('click', this.openOverlay.bind(this));
        this.openButton[1].addEventListener('click', this.openOverlay.bind(this));
        this.closeButton.addEventListener('click', this.closeOverlay.bind(this));
        this.searchField.addEventListener('keyup', this.typingLogic.bind(this));
        $(document).on("keydown", this.keyPressDispatcher.bind(this));
    }
 
    //3. methods (or functions)
    typingLogic() {
        if (this.searchField != this.previousValue) {
            clearTimeout(this.typingTimer);

            if (this.searchField) {
                if (!this.isSpinnerVisible) {
                this.resultsDiv.html('<div class="spinner-loader"></div>');
                this.isSpinnerVisible = true;
            }
            this.typingTimer = setTimeout(this.getResults.bind(this), 1000);
            } else {
                this.resultsDiv.html('');
                this.isSpinnerVisible = false;
            }
        }

        this.previousValue = this.searchField;
    }

    getResults() {
        this.resultsDiv.html("Real search results here...");
        this.isSpinnerVisible = false;
    }

    keyPressDispatcher(e) {
        
        if (e.keyCode == 83 && !this.isOverlayOpen && !$("input, textarea").is(':focus')) {
            this.openOverlay();
        }

        if (e.keyCode == 27 && this.isOverlayOpen) {
            this.closeOverlay();
        }
    }

    openOverlay(){
        this.searchOverlay.classList.add('search-overlay--active');
        $("body").addClass("body-no-scroll");
        this.isOverlayOpen = true; 
    }
 
    closeOverlay(){
        this.searchOverlay.classList.remove('search-overlay--active');
        $("body").removeClass("body-no-scroll");
        this.isOverlayOpen = false; 
    }
}
 
export default SearchObject;