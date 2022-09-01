import $ from 'jquery';

class SearchObject {
    //1. create and initiate the object
    constructor() {
        this.openButton = document.querySelectorAll(".js-search-trigger");
        this.closeButton = document.querySelector(".search-overlay__close");
        this.searchOverlay = document.querySelector(".search-overlay");
        this.searchField = document.querySelector("#search-term");
        this.events();
        this.isOverlayOpen = false;
        this.typingTimer;
    }
 
    //2. events
    events(){
        this.openButton[0].addEventListener('click', this.openOverlay.bind(this));
        this.openButton[1].addEventListener('click', this.openOverlay.bind(this));
        this.closeButton.addEventListener('click', this.closeOverlay.bind(this));
        this.searchField.addEventListener('keydown', this.typingLogic.bind(this));
        $(document).on("keydown", this.keyPressDispatcher.bind(this));
    }
 
    //3. methods (or functions)
    typingLogic() {
        clearTimeout(this.typingTimer);
        this.typingTimer = setTimeout(function () {console.log("you're on timeout");}, 1000);
    }

    keyPressDispatcher(e) {
        
        if (e.keyCode == 83 && !this.isOverlayOpen) {
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