<!DOCTYPE html>
<html>
<head>
	<title>StepMania Score Tracker</title>
	<link rel="stylesheet" href="stylesheet.css">
</head>

<body>
<?php
// Define the tracked and the ignored difficulties.
$difficulties = array("Easy", "Medium", "Hard", "Challenge");

// Define the filename for the Stats.xml file.
$filename = "Stats.xml";

// Use StepMania's images for grades.
$grade_images = True;

// Converts StepMania tiers into grades, using the default theme's metrics
// as a guideline.
function ConvertTier2Grade($tier){
	$grade = "";

	if (!$tier){
		$tier = "Failed";
	}

	global $grade_images;
	if ($grade_images){
		$grade = "<img src='images/".$tier.".png'>";
	}
	else {
		switch ($tier){
			case "Failed":
				$grade = "F"; break;
			case "Tier07":
				$grade = "D"; break;
			case "Tier06":
				$grade = "C"; break;
			case "Tier05":
				$grade = "B"; break;
			case "Tier04":
				$grade = "A"; break;
			case "Tier03":
				$grade = "AA"; break;
			case "Tier02":
				$grade = "AAA"; break;
			case "Tier01":
				$grade = "AAAA"; break;
			default:
				$grade = "F"; break;
		}
	}
	return $grade;
};

?>
<h1>StepMania Score Tracker</h1>
<table>
<thead>
<tr>
	<th></th>
	<th></th>
<?php
	foreach ($difficulties as $diff){
		printf("<th colspan=8>".$diff."</th>\n");
	}
?>
</tr>
<tr>
	<th>Group</th>
	<th>Title</th>
<?php
// Let PHP create the headers for all difficulties
foreach($difficulties as $diff){
printf("
	<th>Grade</th>
	<th>%%</th>
	<th>Flawless</th>
	<th>Perfect</th>
	<th>Great</th>
	<th>Good</th>
	<th>Boo</th>
	<th>Miss</th>\n");
}
?>
</tr>
</thead>
<tbody>
<?php
	// Load the Stats.xml file
	if (file_exists($filename)){
		$stats = simplexml_load_file($filename);

		// Traverse to the Song array
		foreach($stats->SongScores->Song as $song){
			// Start our song row
			printf("<tr>\n");
			// Get song group and title ($songfolder is usually just "Songs" and can be ignored)
			list($songfolder, $group, $title) = explode("/", $song['Dir']);
			printf("<td class='group'>".$group."</td>\n");
			printf("<td class='title'>".$title."</td>\n");
			// Get step information for the song
			$steps = $song->Steps;
			// The step information is an array where each value corresponds to a difficulty.
			// We will traverse it using plain indexes
			$stepcounter = 0;
			// We want information for all the difficulties we track
			foreach ($difficulties as $diff){
				// Ignore the difficulties not tracked
				if(!in_array($steps[$stepcounter]['Difficulty'], $difficulties)){
					$stepcounter++;
				}
				// Retrieve the information we want
				if ($steps[$stepcounter]['Difficulty'] == $diff){
					// StepMania creates ghost entries for songs if you PlayerAutoPlay them, so avoid showing these
					if (isset($steps[$stepcounter]->HighScoreList->HighScore[0]->Grade)){
						printf("<td class='". $diff ." grade'>" .ConvertTier2Grade($steps[$stepcounter]->HighScoreList->HighScore[0]->Grade). "</td>");
						printf("<td class='". $diff ." percent'>". floatval($steps[$stepcounter]->HighScoreList->HighScore[0]->PercentDP)*100 . "%%</td>");
						printf("<td class='". $diff ."'>". $steps[$stepcounter]->HighScoreList->HighScore[0]->TapNoteScores->W1 . "</td>");
						printf("<td class='". $diff ."'>". $steps[$stepcounter]->HighScoreList->HighScore[0]->TapNoteScores->W2 . "</td>");
						printf("<td class='". $diff ."'>". $steps[$stepcounter]->HighScoreList->HighScore[0]->TapNoteScores->W3 . "</td>");
						printf("<td class='". $diff ."'>". $steps[$stepcounter]->HighScoreList->HighScore[0]->TapNoteScores->W4 . "</td>");
						printf("<td class='". $diff ."'>". $steps[$stepcounter]->HighScoreList->HighScore[0]->TapNoteScores->W5 . "</td>");
						printf("<td class='". $diff ."'>". $steps[$stepcounter]->HighScoreList->HighScore[0]->TapNoteScores->Miss . "</td>");
						printf("\n");
					} else {
						for ($i = 0; $i < 8; $i++) {
							printf("<td class='".$diff."'></td>");
						}
						printf("\n");
					}
					$stepcounter++;
				}
				// If there are no records for this song on this difficulty, print empty cells
				else{
					for ($i=0;$i<8;$i++){
						printf("<td class='".$diff."'></td>");
					}
					printf("\n");
				}
			}
			// End the table row
			printf("</tr>\n");
		}
	}
	else {
		echo "<tr><td>Failed to load stats file</tr></td>";
	}
?>
</tbody>
</table>
<footer>
<p>
	Last updated on
<?php
if (file_exists($filename)){
	printf($stats->GeneralData->LastPlayedDate);
} else {
	printf("unknown date");
};
?>
</p>
</footer>
</body>
</html>
