smtracker - StepMania Score Tracker
=====

smtracker is a simple [StepMania][sm] score tracker written in PHP. It
works by parsing your Stats.xml file using SimpleXML, and printing the
results. This may work well if you want to show off your scores over
the Internet. If you want a local score tracker, you may want
[smtracker-python][smtp] instead.

Known Issues
-----

* The Stats.xml file does not know any information about a song, except
where it's located. This means some songs (especially songs with
Japanese titles) will not appear with the same title as in game.
* Some themes can define more or less grading tiers than the default
theme (Simply Love defines 17 tiers), which will cause missing grades
on the table.
* Some themes can define more or less note timings (such as only
checking if you hit or missed the arrow), which can cause empty cells
on the table (if less) or won't print other timings (if more).

[sm]: http://www.stepmania.com/
[smtp]: https://github.com/japareaggae/smtracker-python
