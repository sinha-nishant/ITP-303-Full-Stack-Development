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
	console.log("location0:" + localStorage.getItem("location"));
	if (localStorage.getItem("location")) {
		getWeather(localStorage.getItem("location"));

		$( "#location option[value=" + localStorage.getItem("location") + "]").prop("selected", "selected");
	}
	else {
		getWeather($("#location").val());
	}
}); 

// Get weather for new location when selected location is changed
$("#location").change(function() {
	getWeather($("#location").val());
	localStorage.setItem("location", $("#location").val());
	console.log("location1:" + localStorage.getItem("location"));
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
    }
});

$("#hide").click(function() {
	if ($("#todo-input").css("display") === "none") {
		$("#todo-input").fadeIn("slow", function() {
			$("#todo-input").css("display", "inline");
		});
	}
	else {
		$("#todo-input").fadeOut("slow", function() {
			$("#todo-input").css("display", "none");
		});
	}
});

$( "#todo-list" ).on("click", "div", function() {
	if ($(this).hasClass("todo-done")) {
		$(this).removeClass("todo-done");
	}
	else {
		$(this).addClass("todo-done");
	}
});

$("#todo-list").on("click", ".fa-square-o", function(event) {
	event.stopPropagation();
	$(this).parent().fadeOut("slow", function() {
		$(this).remove();
	})
});