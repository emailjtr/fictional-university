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
		$.getJSON(universityData.root_url + '/wp-json/university/v1/search?term=' + this.searchField.value, (results) => {
			this.resultsDiv.innerHTML = `
				<div class="row">
				<div class="one-third">
					<h2 class="search-overlay__section-title">General Information</h2>
					${results.generalInfo.length ? '<ul class="link-list min-list">' : '<p>No results found</p>'}
					${results.generalInfo.map(item => `<li><a href="${item.permalink}" style="font-size:2.5rem;">${item.title}</a> ${item.postType == 'post' ? `by ${item.authorName}` : ''}</li>`).join('')}
					${results.generalInfo.length ? '</ul>' : ''}
				</div>
				<div class="one-third">
					<h2 class="search-overlay__section-title">Programs</h2>
					${results.programs.length ? '<ul class="link-list min-list">' : `<p>No results found. <a href="${universityData.root_url}/programs">View all programs</a></p>`}
					${results.programs.map(item => `<li><a href="${item.permalink}" style="font-size:2.5rem;">${item.title}</a></li>`).join('')}
					${results.programs.length ? '</ul>' : ''}
					<h2 class="search-overlay__section-title">Professors</h2>
					
				</div>
				<div class="one-third">
					<h2 class="search-overlay__section-title">Campuses</h2>
					${results.campuses.length ? '<ul class="link-list min-list">' : `<p>No results found. <a href="${universityData.root_url}/campuses">View all campuses</a></p>`}
					${results.campuses.map(item => `<li><a href="${item.permalink}" style="font-size:2.5rem;">${item.title}</a> ${item.postType == 'post' ? `by ${item.authorName}` : ''}</li>`).join('')}
					${results.campuses.length ? '</ul>' : ''}
					<h2 class="search-overlay__section-title">Events</h2>
					
				</div>
				</div>
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