// Get weather from WeatherBit given city name
let getWeather = function(city) {
	$.ajax({
		method: "GET",
		url: "http://api.weatherbit.io/v2.0/current",
		data: {
			key: "cbca269f070546ab85f6e95c78f1dd49",
			city: city,
			units: "I"
		}
	}).done(
		function(results) {
			$("#temp").text(results.data[0].temp);
			$("#description").text(results.data[0].weather.description);
			$("#feels-temp").text(results.data[0].app_temp);
		}
	);
}

// Load weather for default selection when page loads
$(document).ready(function() {
	getWeather($("#location").val());
}); 

// Get weather for new location when selected location is changed
$("#location").change(function() {
	getWeather($("#location").val());
});

// When user clicks enter, add todo to list
$("#todo-input").keypress(function(event) {
	// 13 is the keyCode for the 'enter' key
    if(event.keyCode === 13){
		let todo = document.createElement("div");
		todo.classList.add("todo");
		todo.innerHTML = "<i class='fa fa-square-o'></i>" + $("#todo-input").val();
		$("#todo-input").val("");
        $("#todo-list").append(todo);
		$(".todo").click(function() {
			$(this).css("background-color", "gray");
			$(this).css("text-decoration", "line-through");
			$(this).css("font-style", "italic");
		});
    }
});

$("#hide").click(function() {
	// let inputBox = .css("display", "none")
	if ($("#todo-input").css("display") === "none") {
		$("#todo-input").css("display", "inline");
	}
	else {
		$("#todo-input").css("display", "none");
	}
});