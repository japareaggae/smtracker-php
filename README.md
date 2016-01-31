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

[sm]: http://www.stepmania.com/
