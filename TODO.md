To do list:
===========

	Steps:
		- MERISE ma gueule
		- database
		- back end
		- front end
		- services
		- features

	Intel:
		- department:
			- diploma:
				- semester:
					- module:
						- subject:
							- category (math, bio, ...)
							- name
							- ects
		- exams:
			- subject
			- duration
		- rooms:
			- size (how many students? who cares about the actual surface?)
		- timetable (for a given room):
			- room
			- date / time start
			- date / time end
			- availability

	Back end:
		- different algorithms to sort the exams within the timetable (@see Optimisation DUT)
		- generate ics file

	Front end:
		- menu:
			- new
			- see exams
			- see rooms
			- see calendar
		- pages:
			- home
			- display week
			- flow:
				- add module (pick up from list / create)
				- add subject (pick up from list / create)
				- add room (pick up from list / create)
				- add exams (multiple)
				- compute "timetabling"
				- save to database

	Features:
		- export to icalendar (.ics file) / display in a calendar (@see DPT website):
			- by room
			- by semester
			- ...
			- all
		- allow manual sort