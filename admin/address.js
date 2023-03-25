		// Define the options for the Province, City and Barangay select elements
		var provinceOptions = [
  "Abra",
  "Agusan del Norte",
  "Agusan del Sur",
  "Aklan",
  "Albay",
  "Antique",
  "Apayao",
  "Aurora",
  "Basilan",
  "Bataan",
  "Batanes",
  "Batangas",
  "Benguet",
  "Biliran",
  "Bohol",
  "Bukidnon",
  "Bulacan",
  "Cagayan",
  "Camarines Norte",
  "Camarines Sur",
  "Camiguin",
  "Capiz",
  "Catanduanes",
  "Cavite",
  "Cebu",
  "Compostela Valley",
  "Cotabato",
  "Davao del Norte",
  "Davao del Sur",
  "Davao Occidental",
  "Davao Oriental",
  "Dinagat Islands",
  "Eastern Samar",
  "Guimaras",
  "Ifugao",
  "Ilocos Norte",
  "Ilocos Sur",
  "Iloilo",
  "Isabela",
  "Kalinga",
  "La Union",
  "Laguna",
  "Lanao del Norte",
  "Lanao del Sur",
  "Leyte",
  "Maguindanao",
  "Marinduque",
  "Masbate",
  "Misamis Occidental",
  "Misamis Oriental",
  "Mountain Province",
  "Negros Occidental",
  "Negros Oriental",
  "Northern Samar",
  "Nueva Ecija",
  "Nueva Vizcaya",
  "Occidental Mindoro",
  "Oriental Mindoro",
  "Palawan",
  "Pampanga",
  "Pangasinan",
  "Quezon",
  "Quirino",
  "Rizal",
  "Romblon",
  "Samar",
  "Sarangani",
  "Siquijor",
  "Sorsogon",
  "South Cotabato",
  "Southern Leyte",
  "Sultan Kudarat",
  "Sulu",
  "Surigao del Norte",
  "Surigao del Sur",
  "Tarlac",
  "Tawi-Tawi",
  "Zambales",
  "Zamboanga del Norte",
  "Zamboanga del Sur",
  "Zamboanga Sibugay"
];
		var cityOptions = {
			"Bulacan": [
  "Angat",
  "Balagtas",
  "Baliuag",
  "Bocaue",
  "Bulacan",
  "Bustos",
  "Calumpit",
  "Doña Remedios Trinidad",
  "Guiguinto",
  "Hagonoy",
  "Malolos",
  "Marilao",
  "Meycauayan",
  "Norzagaray",
  "Obando",
  "Pandi",
  "Paombong",
  "Plaridel",
  "Pulilan",
  "San Ildefonso",
  "San Jose del Monte",
  "San Miguel",
  "San Rafael",
  "Santa Maria"
],
			"Pampanga": ["San Fernando", "Angeles", "Mabalacat"],
			"Nueva Ecija": ["Cabanatuan", "Palayan", "San Jose"]
		};
		var barangayOptions = {
			"Norzagaray": ["Norzagaray"],
			"Malolos": ["Barangay 1", "Barangay 2", "Barangay 3"],
			"Meycauayan": ["Barangay A", "Barangay B", "Barangay C"],
			"Baliuag": ["Barangay X", "Barangay Y", "Barangay Z"],
			"San Fernando": ["Barangay P", "Barangay Q", "Barangay R"],
			"Angeles": ["Barangay M", "Barangay N", "Barangay O"],
			"Mabalacat": ["Barangay G", "Barangay H", "Barangay I"],
			"Cabanatuan": ["Barangay U", "Barangay V", "Barangay W"],
			"Palayan": ["Barangay S", "Barangay T", "Barangay U"],
			"San Jose": ["Barangay D", "Barangay E", "Barangay F"]
		};

		// Function to populate the City select element based on the Province selection
		function populateCities() {
			// Get the Province select element
			var provinceSelect = document.getElementById("provinceSelect");
			// Get the selected Province
			var selectedProvince = provinceSelect.value;
			// Get the City select element
			var citySelect = document.getElementById("citySelect");
			// Remove all options from the City select element
			citySelect.innerHTML = "";
			// If the selected Province is not empty
			if (selectedProvince !== "") {
				// Get the cities for the selected Province
				var cities = cityOptions[selectedProvince];
				// Add the cities as options to the City select element
				for (var i = 0; i < cities.length; i++) {
					var option = document.createElement("option");
					option.value = cities[i];
					option.text = cities[i];
					citySelect.add(option);
				}
			}
		}

		// Function to populate the Barangay select element based on the City selection
		function populateBarangays() {
			// Get the City select element
			var citySelect = document.getElementById("citySelect");
			// Get the selected City
			var selectedCity = citySelect.value;
			// Get the Barangay select element
			var barangaySelect = document.getElementById("barangaySelect");
			// Remove all options from the Barangay select element
			barangaySelect.innerHTML = "";
			// If the selected City is not empty
			if (selectedCity !== "") {
				// Get the barangays for the selected City
				var barangays = barangayOptions[selectedCity];
				// Add the barangays as options to the Barangay select element
for (var i = 0; i < barangays.length; i++) {
var option = document.createElement("option");
option.value = barangays[i];
option.text = barangays[i];
barangaySelect.add(option);
}
}
}