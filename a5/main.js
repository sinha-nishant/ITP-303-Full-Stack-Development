function displayResults(results) {
	// Convert results to JS objects
	let convertedResults = JSON.parse(results);

	let numDisplayed = document.createElement("div");
	numDisplayed.id = "numDisplayed";
	numDisplayed.innerHTML = "Showing <b>" + convertedResults.results.length + "</b> of <b>" + convertedResults.total_results+ "</b> result(s)";
	document.querySelector(".container").innerHTML = "";
	document.querySelector(".container").appendChild(numDisplayed);

	let movies = [];
	// Create new element as you iterate through the results
	for (let i = 0; i < convertedResults.results.length; i++) {
		let movie = document.createElement("div");
		movie.classList.add("movie", "col", "col-sm-6", "col-md-4", "col-lg-3");
		let hoverInfo = document.createElement("div");
		hoverInfo.classList.add("hoverInfo");
		hoverInfo.innerHTML = "Rating: " + convertedResults.results[i].vote_average + " (" + convertedResults.results[i].vote_count +" votes)<br><br>";
		if (convertedResults.results[i].overview.length > 200) {
			hoverInfo.innerHTML += (convertedResults.results[i].overview.substring(0, 200) + "...");
		}
		else {
			hoverInfo.innerHTML += convertedResults.results[i].overview;
		}
		movie.appendChild(hoverInfo);
		let imageRow = document.createElement("div");
		imageRow.classList.add("row", "imageRow");
		let image = document.createElement("img");
		
		// If image src fails, switch to icon for unavailable image
		image.onerror = function() {
			image.setAttribute("src", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQbjpidNNgEsw5FilrgRG31qHay4kKeS_EnyQ&usqp=CAU");
		}

		image.setAttribute("src", "https://image.tmdb.org/t/p/w300" + convertedResults.results[i].poster_path);
		imageRow.appendChild(image);
		movie.appendChild(imageRow);
		let infoRow = document.createElement("div");
		infoRow.classList.add("row", "infoRow");
		let title = "<span>" + convertedResults.results[i].original_title + "</span>";
		let releaseDate = "<span>" + convertedResults.results[i].release_date + "</span>";
		infoRow.innerHTML = title + releaseDate;
		movie.appendChild(infoRow);
		movies.push(movie);
	}

	let movieRow = document.createElement("div");
	movieRow.classList.add("row", "movieRow");
	for (let i = 0; i < movies.length; i++) {
		if ((i != 0) && (i % 4) == 0) {
			document.querySelector(".container").appendChild(movieRow);
			// Create new movie row
			movieRow = document.createElement("div");
			movieRow.classList.add("row", "movieRow");
		}
		movieRow.appendChild(movies[i]);
	}
}

let ajax = function(endpoint, resolver) {
	let httpRequest = new XMLHttpRequest();
	httpRequest.open("GET", endpoint);
	httpRequest.send();
	
	httpRequest.onreadystatechange = function() {
		if (httpRequest.readyState == 4) {
			if (httpRequest.status == 200) {
				resolver(httpRequest.responseText);	
			}
		}
	}
}

document.querySelector("#search").onsubmit = function(event) {
	event.preventDefault();
	let searchInput = document.querySelector("#searchText").value.trim();
	let endpoint = "https://api.themoviedb.org/3/search/movie?api_key=177d44774a233e435dad6c23a97024db&language=en-US&query=" + searchInput;
	ajax(endpoint, displayResults);
}

let endpoint = "https://api.themoviedb.org/3/trending/movie/week?api_key=177d44774a233e435dad6c23a97024db";
ajax(endpoint, displayResults);
console.log("Called");