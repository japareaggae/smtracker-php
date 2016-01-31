smtracker - StepMania Score Tracker
=====

smtracker is a simple [StepMania][sm] score tracker written in PHP. It
works by parsing your Stats.xml file using SimpleXML, and printing the
results.

Known Issues
-----

* The Stats.xml file does not know the true title of the songs, only
the folder where they are located. This means that some songs can show
up with weird titles.
* Some themes can define more or less grading tiers than the default
theme (Simply Love defines 17 tiers), and/or define different note
timings (such as only checking if you hit or missed the note).
smtracker will not work properly with such themes, as it follows the
metrics defined by the default theme. Percentages should always work
fine regardless of the theme, however.

[sm]: http://www.stepmania.com/
