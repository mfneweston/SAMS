<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">

		<title>Update Schedule</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <!-- Google Font Link for Icons -->
	    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">

		<style>

			/* Import Google font - Poppins */
		    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
		    *{
		      margin: 0;
		      padding: 0;
		      box-sizing: border-box;
		      font-family: 'Poppins', sans-serif;
		    }

		    body {
		    	display: flex;
		    	align-items: flex-start;
		    	justify-content: flex-start;
		    	min-height: 100vh;
		    	background-color: white;
		    	margin: 20px;
		    }

		    .container {
		      display: flex;
		      flex-direction: column;
		      align-items: flex-start;
		      justify-content: flex-start;
		    }

		    .wrapper {
		    	width: 300px;
		    	height: 340px;
		    	background-color: white;
		    	border-radius: 10px;
		    	/*box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);*/
		    	margin-top: 80px;
		    	margin-right: 20px;
		    	margin-bottom: 20px;
		    	border: 1px solid;
		    }
		    .wrapper header {
		    	display: flex;
		    	align-items: center;
		    	justify-content: space-between;
		    	padding: 15px 20px 5px;
		    }

		    header .current-date {
		    	font-size: 1.2rem;
		    	font-weight: 500;
		    }
		    header .icons span {
		    	height: 38px;
		    	width: 38px;
		    	color: #878787;
		    	font-size: 1.9rem;
		    	margin: 0 1px;
		    	cursor: pointer;
		    	text-align: center;
		    	line-height: 38px;
		    	border-radius: 50%;
		    	
		    }
		    header .icons span:hover {
		    	background: #f2f2f2;
		    }
		    header .icons span:last-child {
		    	margin-right: -10px;
		    }

		    .calendar{
		    	padding: 10px;
		    }
		    .calendar ul {
		    	display: flex;
		    	list-style: none;
		    	flex-wrap: wrap;
		    	text-align: center;
		    }
		    .calendar .days {
		    	margin-bottom: 10px;
		    }
		    .calendar .weeks li {
		    	font-weight: 500;
		    }
		    .calendar ul li {
		    	position: relative;
		    	width: calc(100% / 7);
		    }
		    .calendar .days li {
		    	z-index: 1;
		    	cursor: pointer;
		    	margin-top: 15px;
		    }
		    .days li.inactive {
		    	color: #aaa;
		    }
		    .days li.active {
		    	color: #fff;
		    	
		    }
		    .calendar .days li::before {
		    	position: absolute;
		    	content: "";
		    	height: 30px;
		    	width: 30px;
		    	top: 50%;
		    	left: 50%;
		    	z-index: -1;
		    	border-radius: 50%;
		    	transform: translate(-50%, -50%);
		    	
		    }
		    .days li:hover::before {
		    	background : #f2f2f2;
		    }
		    .days li.active::before {
		    	background-color: #99CC66;
		    }

		    /* Add styles for the dropdown container */
		    .dropdown-container {
		      margin-top: 20px; /* Adjust the margin as needed */
		      width: 280px;
		    }

		    /* Add styles for the dropdown list */
		    select {
		      width: 100%;
		      padding: 10px;
		      border: 1px solid #ddd;
		      border-radius: 5px;
		      margin-top: 5px;
		    }


		    #calendar {
		      width: 200px;
		      padding: 20px;
		      border-right: 1px solid #ccc;

		    }

		    #schedule {
		      flex: 1;
		      padding: 20px;
		    }

		    table {
		      border-collapse: collapse;
		      width: 100%;
		    }

		    th, td {
		      border: 1px solid #ddd;
		      padding: 8px;
		      text-align: left;
		      
		    }

		    th {
		      background-color: #f2f2f2;
		      text-align: center !important;
		    }

		    .first-row {
		      /* Apply specific width to the first row */
		      width: 20px; /* Adjust the width as needed */
		    }

		    td:not(:first-child) {
		      width: 14.28%;
		      cursor: pointer;
		    }


		    td:not(:first-child):not(.highlight):hover {
		      background-color: #1976D2;
		    }
		    tr:nth-child(even) {
		      background-color: #f9f9f9; /* Light grey */
		    }

		    tr:nth-child(odd) {
		      background-color: #ffffff; /* White */
		    }

		    .highlight {
		      background-color: #99CC66; 
		    }

		    

		    
			
		</style>
	</head>

	<body>
		<div class="container">
		<div class="wrapper">
			<header>
				<p class="current-date">January 2024</p>
				<div class="icons">
					<span id="prev" class="material-symbols-rounded">chevron_left</span>
					<span id="next" class="material-symbols-rounded">chevron_right</span>
				</div>
			</header>

			<div class="calendar">
				<ul class="weeks">
					<li>Sun</li>
					<li>Mon</li>
					<li>Tue</li>
					<li>Wed</li>
					<li>Thu</li>
					<li>Fri</li>
					<li>Sat</li>
				</ul>

				<ul class="days"></ul>
			</div>
		</div>

		<div class="dropdown-container">
	      <!-- Dropdown container -->
	      <div style="padding-bottom: 20px;">
	      	<label for="dropdown">Select Sport Venue:</label>
		      <select id="dropdown">
		        <option value="option1">Option 1</option>
		        <option value="option2">Option 2</option>
		        <option value="option3">Option 3</option>
		      </select>
	      </div>
	      
	      <div>
	      	<label for="dropdown">Select Time Slot:</label>
		      <select  id="dropdown">
		        <option value="option1">Option 1</option>
		        <option value="option2">Option 2</option>
		        <option value="option3">Option 3</option>
		      </select>
	      </div>

	      
	    </div>

	   <!--  <div class="dropdown-container">
	    
	  	</div>
 -->


		
	  </div>

	  <!-- <div class="item"> -->
      
	      <div id="schedule">
		    <h2 style="margin-bottom: 20px;">Update Schedule</h2>
		    <div >

		      <table>
		        <thead>
		          <tr>
		            <th id="first-row">Time</th>
		            <!-- <th>Sun <br> Dec 31</th>
		            <th>Mon <br> Jan 1</th>
		            <th>Tue <br> Jan 2</th>
		            <th>Wed <br> Jan 3</th>
		            <th>Thu <br> Jan 4</th>
		            <th>Fri <br> Jan 5</th>
		            <th>Sat <br> Jan 6</th> -->
		          </tr>
		        </thead>
		         <tbody id="tableBody">
		         </tbody>
		      </table>

		    </div>
		  </div>

	    <!-- </div> -->

		<script>
			const daysTag = document.querySelector(".days"),
		    currentDate = document.querySelector(".current-date"),
		    prevNextIcon = document.querySelectorAll(".icons span");

		    // getting new date, current year and month
		    let date = new Date(),
		    currYear = date.getFullYear(),
		    currMonth = date.getMonth();

		    let selectedDate = new Date();  

		    // storing full name of all months in array
		    const months = ["January", "February", "March", "April", "May", "June", "July",
		                    "August", "September", "October", "November", "December"];        

		    const renderCalendar = () => {  
		        let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), // getting first day of month
		        lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(), // getting last date of month
		        lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), // getting last day of month
		        lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); // getting last date of previous month
		        let liTag = "";

		        for (let i = firstDayofMonth; i > 0; i--) { // creating li of previous month last days
		              liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
		        }

		        for (let i = 1; i <= lastDateofMonth; i++) { // creating li of all days of current month
		              // adding active class to li if the current day, month, and year matched
					let isToday = selectedDate && i === selectedDate.getDate() && currMonth === selectedDate.getMonth() && currYear === selectedDate.getFullYear() ? "active" : "";
					liTag += `<li class="${isToday}" onclick="selectDate(this)">${i}</li>`;

					// let isToday = i === date.getDate() && currMonth === new Date().getMonth() && currYear === new Date().getFullYear() ? "active" : "";
		   //          liTag += `<li class="${isToday}" onclick="selectDate(this)">${i}</li>`;
		        }

		        for (let i = lastDayofMonth; i < 6; i++) { // creating li of next month first days
		            liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`
		        }
		        currentDate.innerText = `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
		        daysTag.innerHTML = liTag;

		    };

		    renderCalendar();
		
			const selectDate = (dayElement) => {
			const day = parseInt(dayElement.textContent);
			selectedDate = new Date(currYear, currMonth, day);
			renderCalendar();
			
			};

			// Create time slots (you can customize the start and end times)
		    const startTime = 8; // 8 AM
		    const endTime = 24;  // 5 PM

		    for (let hour = startTime; hour <= endTime; hour++) {
		      const row = document.createElement('tr');
		      const timeCell = document.createElement('td');

		      timeCell.textContent = `${hour}:00`;
		      row.appendChild(timeCell);

		      // Create a cell for each day
		      for (let day = 0; day < 7; day++) {
		        const dayCell = document.createElement('td');
		        dayCell.textContent = ''; // Add a non-breaking space


		        dayCell.addEventListener('click', function () {
		            // Toggle the "highlight" class on each click
		            dayCell.classList.toggle('highlight');
		          });

		        row.appendChild(dayCell);
		      }

		      tableBody.appendChild(row);
		    }

		    // schedule
		    document.addEventListener('DOMContentLoaded', function () {
		    const tableBody = document.getElementById('tableBody');
		    const tableHeader = document.querySelector('thead tr');

		    const updateTableHeaders = () => {
		        const weekdays = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
		        const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];


		        // Clear existing headers
		        while (tableHeader.firstChild) {
		            tableHeader.removeChild(tableHeader.firstChild);
		        }

		        // Add "Time" as the first header
		        const timeHeader = document.createElement('th');
		        timeHeader.textContent = "Time";
		        tableHeader.appendChild(timeHeader);

		        // Add headers for each day with the date
		        for (let i = 0; i < 7; i++) {
		            const header = document.createElement('th');
		            const currentDate = new Date(currYear, currMonth, selectedDate.getDate() + i);
		            // const dayOfWeek = weekdays[i];
		            

		            function getDayOfWeek(year, month, day) {
					    const weekdays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
					    const date = new Date(year, month - 1, day); // month is 0-indexed in JavaScript Dates
					    const dayOfWeek = weekdays[date.getDay()];
					    return dayOfWeek;
					}

					// Example usage:
					const year = 2024;
					const month2 = 1; // January (0-indexed)
					const day = 3;   // 3rd day of the month
					const result = getDayOfWeek(year, month2, day);
					console.log(`The date ${year}-${month2}-${day} is a ${result}.`);


					const dayOfWeek = getDayOfWeek(currYear, currMonth + 1, selectedDate.getDate() + i); // Using the getDayOfWeek function
		            const month = months[currentDate.getMonth()];
		            const date = currentDate.getDate();
		            header.innerHTML = `${dayOfWeek} <br> ${month} ${date}`;
		            tableHeader.appendChild(header);
		        }
		    };

		    updateTableHeaders();


		    prevNextIcon.forEach(icon => { // getting prev and next icons
		        icon.addEventListener("click", () => { // adding click event on both icons
		            // if clicked icon is previous icon then decrement current month by 1 else increment it by 1
		            currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

		            if(currMonth < 0 || currMonth > 11) { // if current month is less than 0 or greater than 11
		                // creating a new date of current year & month and pass it as date value
		                date = new Date(currYear, currMonth, new Date().getDate());
		                currYear = date.getFullYear(); // updating current year with new date year
		                currMonth = date.getMonth(); // updating current month with new date month
		            } else {
		                date = new Date(); // pass the current date as date value
		            }
		            renderCalendar(); // calling renderCalendar function
		            // updateTableHeaders();
		        });
		    });

		  });

		</script>

	</body>
</html>