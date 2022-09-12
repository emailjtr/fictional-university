import $ from 'jquery';

class Search {
	//describe and initiate object
	constructor(){
		this.openButton = document.querySelector('.js-search-trigger');
		this.closeButton = document.querySelector('.search-overlay__close');
		this.searchOverlay = document.querySelector('.search-overlay');
		this.searchField = document.getElementById('search-term');
		this.resultsDiv = document.getElementById('search-overlay__results');
		this.allInputs = document.querySelectorAll('input, textarea');
 
		this.overlayOpen = false;
		this.spinnerVisible = false;
		this.timer;
		this.oldValue;
 
		this.events();
	}
 
	//events
	events = () => {
		this.openButton.addEventListener('click', this.openOverlay);
		this.closeButton.addEventListener('click', this.closeOverlay);
		document.addEventListener('keydown', this.keyPressDispatcher);
		this.searchField.addEventListener('keyup', this.typingLogic);
 
	};
 
	//methods (functions)
	openOverlay = () =>{
		this.searchOverlay.classList.add('search-overlay--active');
		document.querySelector('body').classList.add('body-no-scroll');
		this.overlayOpen = true;
	};
 
	closeOverlay = () =>{
		this.searchOverlay.classList.remove('search-overlay--active');
		document.querySelector('body').classList.remove('body-no-scroll');
		this.overlayOpen = false;
	};
 
	keyPressDispatcher = (key) =>{
			if(key.key === 's' && !this.overlayOpen && this.checkFocus(this.allInputs)) this.openOverlay();
			if(key.key === 'Escape' && this.overlayOpen && this.checkFocus(this.allInputs)) this.closeOverlay();
	}
 
	typingLogic = () =>{
 
		if (this.searchField.value != this.oldValue ){
			clearTimeout(this.timer);
 
			if (this.searchField.value){
				if(!this.spinnerVisible){
					this.resultsDiv.innerHTML = '<div class="spinner-loader"></div>';
					this.spinnerVisible = true;
				}
				this.timer = setTimeout(this.getResults, 1000);
			}else{
				this.resultsDiv.innerHTML = '';
				this.spinnerVisible = false;
			}
			
		}
		
		this.oldValue = this.searchField.value; 
	}
 
	getResults= () =>{
		$.getJSON('http://fictional-university.local/wp-json/wp/v2/posts?search=' + this.searchField.value, posts =>{
			this.resultsDiv.innerHTML = `
				<h2 class="search-overlay__section-title">General Information</h2>
				<ul class="link-list min-list">
					${posts.map(item => `<li><a href="${item.link}">${item.title.rendered}</a></li>`).join('')}
				</ul>
			`;
		});
	}
 
	checkFocus = (all) =>{
		//loops through all inputs
		for (const el of all) {
			//checks if any of the inputs have focus
			//returns false as soon as it finds focused elements
			if( document.activeElement == el ) return false;
		}
		//else return true
		return true;
	}
 
}
 
export default Search;