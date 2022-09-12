import $ from 'jquery';

class Search {
	//describe and initiate object
	constructor(){
		this.addSearchHTML();
		this.openButton1 = document.querySelector('.js-search-trigger');
		this.openButton2 = document.querySelector('.search-trigger');
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
		this.openButton1.addEventListener('click', this.openOverlay);
		this.openButton2.addEventListener('click', this.openOverlay);
		this.closeButton.addEventListener('click', this.closeOverlay);
		document.addEventListener('keydown', this.keyPressDispatcher);
		this.searchField.addEventListener('keyup', this.typingLogic);
 
	};
 
	//methods (functions)
	openOverlay = () =>{
		this.searchOverlay.classList.add('search-overlay--active');
		document.querySelector('body').classList.add('body-no-scroll');
		this.searchField.value = '';
		setTimeout(() => this.searchField.focus(), 301)
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
				this.timer = setTimeout(this.getResults, 750);
			}else{
				this.resultsDiv.innerHTML = '';
				this.spinnerVisible = false;
			}
			
		}
		
		this.oldValue = this.searchField.value; 
	}
 
	getResults= () =>{
		$.when(
			$.getJSON(universityData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.value), 
			$.getJSON(universityData.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.value)
			).then((posts, pages) => {
			var combinedResults = posts[0].concat(pages[0]);
				this.resultsDiv.innerHTML = `
				<h2 class="search-overlay__section-title">General Information</h2>
				${combinedResults.length ? '<ul class="link-list min-list">' : '<p>No results found</p>'}
				${combinedResults.map(item => `<li><a href="${item.link}" style="font-size:2.5rem;">${item.title.rendered}</a> ${item.type == 'post' ? `by ${item.authorName}` : ''}<br>${item.excerpt.rendered}</li>`).join('')}
				${combinedResults.length ? '</ul>' : ''}
			`;
			this.spinnerVisible = false;
		}, () => {
			this.resultsDiv.innerHTML = '<p>Unexpected error. Try something else.</p>';
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

	addSearchHTML() {
			$("body").append(`
				<div class="search-overlay">
				<div class="search-overlay__top">
					<div class="container">
					<i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
					<input type="text" class="search-term" placeholder="Searching for something?" id="search-term" autocomplete="off">
					<i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
					</div>
				</div>

				<div class="container">
					<div id="search-overlay__results">
					
					</div>
				</div>

				</div>
			`);
		}
 
}
 
export default Search;