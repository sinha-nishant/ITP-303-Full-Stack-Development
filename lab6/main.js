$.ajax({
	method: "GET",
	url: "http://api.weatherbit.io/v2.0/current",
	data: {
		key: "cbca269f070546ab85f6e95c78f1dd49",
		city: "Los Angeles",
		units: "I"
	}
}).done(
	function(results) {
		// when a response is recieved
		console.log(results);
		$("#weather").text("Today's weather in Los Angeles: " + results.data[0].temp + "° " + results.data[0].weather.description + ". " + "Feels like " + results.data[0].app_temp + "°");
	}
);